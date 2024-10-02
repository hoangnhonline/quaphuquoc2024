<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ProductCate;
use App\Models\Cate;
use App\Models\CateChild;
use App\Models\Product;
use App\Models\ProductImg;
use App\Models\Banner;
use App\Models\Location;
use App\Models\City;
use App\Models\Pages;
use App\Models\MetaData;
use Helper, File, Session, Auth, DB;

class ProductController extends Controller
{
    
    public static $loaiSp = []; 
    public static $loaiSpArrKey = [];    

    public function __construct(){

    }
    public function cateChild(Request $request)
    {   
        $productArr = [];
        $slugProductCate = $request->slugProductCate;
        $slugCateChild = $request->slugCateChild;
        $slug = $request->slug;
        $rsParent = ProductCate::where('slug', $slugProductCate)->first();
        $rsCate = Cate::where('slug', $slug)->first();
     
        $rs = CateChild::where('slug', $slugCateChild)->first();
        
        if($rs){//danh muc con
            $cate_child_id = $rs->id;            
            $query = Product::where('product.status', 1)->where('cate_child_id', $cate_child_id)
                ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')                
                ->select('product_img.image_url', 'product.*')
                ->where('price', '>', 0);
                if($rs->price_sort == 0){
                    $query->orderBy('product.price', 'asc');
                }else{
                    $query->orderBy('product.price', 'desc');
                }
                $query->orderBy('product.id', 'desc');
                $productList  = $query->paginate(36);
                $socialImage = $rs->banner_menu;
            if( $rs->meta_id > 0){
               $seo = MetaData::find( $rs->meta_id )->toArray();
            }else{
                $seo['title'] = $seo['description'] = $seo['keywords'] = $rs->name;
            }                                     
            return view('frontend.product.cate-child', compact('productList', 'rs', 'socialImage', 'seo', 'rsParent', 'rsCate'));
        }else{
            $detail = Pages::where('slug', $slug)->first();
            if(!$detail){
                return views('errors.404');
            }
            $seo['title'] = $detail->meta_title ? $detail->meta_title : $detail->title;
            $seo['description'] = $detail->meta_description ? $detail->meta_description : $detail->title;
            $seo['keywords'] = $detail->meta_keywords ? $detail->meta_keywords : $detail->title;           
            return view('frontend.pages.index', compact('detail', 'seo'));    
        }
    }
    public function cate(Request $request)
    {   
        $productArr = [];
        $slugProductCate = $request->slugProductCate;
        $rsParent = ProductCate::where('slug', $slugProductCate)->first();
        $slug = $request->slug;
        $rs = Cate::where('slug', $slug)->first();
        
        if($rs){//danh muc con
            $cate_id = $rs->id;            
            $query = Product::where('product.status', 1)->where('cate_id', $cate_id)
                ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')                
                ->select('product_img.image_url', 'product.*')
                ->where('price', '>', 0);
                if($rs->price_sort == 0){
                    $query->orderBy('product.price', 'asc');
                }else{
                    $query->orderBy('product.price', 'desc');
                }
                $query->orderBy('product.id', 'desc');
                $productList  = $query->paginate(36);
                $socialImage = $rs->banner_menu;
            if( $rs->meta_id > 0){
               $seo = MetaData::find( $rs->meta_id )->toArray();
            }else{
                $seo['title'] = $seo['description'] = $seo['keywords'] = $rs->name;
            }                                     
            return view('frontend.product.cate', compact('productList', 'rs', 'socialImage', 'seo', 'rsParent'));
        }else{
            $detail = Pages::where('slug', $slug)->first();
            if(!$detail){
                return views('errors.404');
            }
            $seo['title'] = $detail->meta_title ? $detail->meta_title : $detail->title;
            $seo['description'] = $detail->meta_description ? $detail->meta_description : $detail->title;
            $seo['keywords'] = $detail->meta_keywords ? $detail->meta_keywords : $detail->title;           
            return view('frontend.pages.index', compact('detail', 'seo'));    
        }
    }

    public function parentCate(Request $request)
    {   
        $productArr = [];
        $slugProductCate = $request->slugProductCate;

        $rs = ProductCate::where('slug', $slugProductCate)->first();
        
        if($rs){//danh muc cha
            $parent_id = $rs->id;            
            $query = Product::where('product.status', 1)->where('parent_id', $parent_id)
                ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')                
                ->select('product_img.image_url', 'product.*')
                ->where('price', '>', 0);
                if($rs->price_sort == 0){
                    $query->orderBy('product.price', 'asc');
                }else{
                    $query->orderBy('product.price', 'desc');
                }
                $query->orderBy('product.id', 'desc');
                $productList  = $query->paginate(36);
                $socialImage = $rs->banner_menu;
            if( $rs->meta_id > 0){
               $seo = MetaData::find( $rs->meta_id )->toArray();
            }else{
                $seo['title'] = $seo['description'] = $seo['keywords'] = $rs->name;
            }                                     
            return view('frontend.product.parent-cate', compact('productList', 'rs', 'socialImage', 'seo'));
        }else{
            $detail = Pages::where('slug', $slugProductCate)->first();
            if(!$detail){
                return views('errors.404');
            }
            $seo['title'] = $detail->meta_title ? $detail->meta_title : $detail->title;
            $seo['description'] = $detail->meta_description ? $detail->meta_description : $detail->title;
            $seo['keywords'] = $detail->meta_keywords ? $detail->meta_keywords : $detail->title;           
            return view('frontend.pages.index', compact('detail', 'seo'));    
        }
    }

    public function search(Request $request)
    {
        
        $tu_khoa = $request->keyword;
        
        if ($tu_khoa == "") {
            $seo['title'] = $seo['description'] =$seo['keywords'] = "Tìm kiếm sản phẩm";
            
            return view('frontend.product.search', compact('tu_khoa', 'seo'));
        }

        $productArr = Product::where('product.alias', 'LIKE', '%'.$tu_khoa.'%')->where('so_luong_ton', '>', 0)->where('price', '>', 0)->where('product_cate.status', 1)
                        ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')
                        ->join('product_cate', 'product_cate.id', '=', 'product.parent_id')
                        ->select('product_img.image_url', 'product.*')
                        ->orderBy('id', 'desc')->paginate(20);
        $seo['title'] = $seo['description'] =$seo['keywords'] = "Tìm kiếm sản phẩm theo từ khóa '".$tu_khoa."'";
       
        return view('frontend.product.search', compact('productArr', 'tu_khoa', 'seo'));
    }
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        $products = Product::where('status',1)->get();
        $seo['title'] = $seo['description']= $seo['keywords']="Sản phẩm";   
        return view('frontend.product.index',compact('seo','products'));
    }

    public function cateProduct(Request $request)
    {
        $slug = $request->slug;
        $cate = ProductCate::where('slug' , $slug)->first();
        $products = Product::where('parent_id', $cate->id)->orderBy('id', 'desc')->paginate(16);
        $seo['title'] = $seo['description']= $seo['keywords']=$cate->name;
        return view('frontend.product.index',compact('seo','products'));
    }

    public function detail(Request $request)
    {   
        $id = $request->id;
        $detail = Product::find($id);
        if(!$detail){
            return redirect()->route('home');
        }
          
        if( $detail->meta_id > 0){
           $meta = MetaData::find( $detail->meta_id )->toArray();
           $seo['title'] = $meta['title'] != '' ? $meta['title'] : $detail->name;
           $seo['description'] = $meta['description'] != '' ? $meta['description'] : $detail->name;
           $seo['keywords'] = $meta['keywords'] != '' ? $meta['keywords'] : $detail->name;
        }else{
            $seo['title'] = $seo['description'] = $seo['keywords'] = $detail->name;
        }               
        
        $socialImage = ProductImg::find($detail->thumbnail_id)->image_url;
        $query = Product::where('status', 1);
        if($detail->cate_child_id){
            $query->where('cate_child_id', $detail->cate_child_id);
        }
        if($detail->cate_id){
            $query->where('cate_id', $detail->cate_id);
        }
        if($detail->parent_id){
            $query->where('parent_id', $detail->parent_id);
        }
        $relatedList = $query->orderBy('is_hot')->limit(10)->get();
        return view('frontend.product.detail', compact('detail', 'seo', 'socialImage', 'relatedList'));
    }

}
