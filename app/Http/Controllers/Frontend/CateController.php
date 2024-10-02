<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ProductCate;
use App\Models\Cate;
use App\Models\Product;
use App\Models\ProductImg;
use App\Models\Banner;
use App\Models\Location;
use App\Models\City;
use App\Models\Pages;
use App\Models\MetaData;
use Helper, File, Session, Auth, DB;

class CateController extends Controller
{
    
    public static $loaiSp = []; 
    public static $loaiSpArrKey = [];    

    public function __construct(){
        
       

    }
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {   
        $productArr = [];
        $slug = $request->slug;
        $rs = ProductCate::where('slug', $slug)->first();
        
        if($rs){//danh muc cha
            $parent_id = $rs->id;
            
            $query = Product::where('parent_id', $parent_id)
               
                ->where('price', '>', 0)                
                ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')
                
                ->select('product_img.image_url', 'product.*');
                if($rs->price_sort == 0){
                    $query->where('price', '>', 0)->orderBy('product.price', 'asc');
                }else{
                    $query->where('price', '>', 0)->orderBy('product.price', 'desc');
                }
                //->where('product_img.image_url', '<>', '')
                $query->orderBy('product.id', 'desc');

                $productList  = $query->limit(36)->get();
                $productArr = $productList->toArray();
            $socialImage = $rs->banner_menu;
            if( $rs->meta_id > 0){
               $seo = MetaData::find( $rs->meta_id )->toArray();
            }else{
                $seo['title'] = $seo['description'] = $seo['keywords'] = $rs->name;
            }                                     
            return view('frontend.cate.parent', compact('productList','productArr', 'rs', 'socialImage', 'seo'));
        }else{
            $detail = Pages::where('slug', $slug)->first();
            if(!$detail){
                return redirect()->route('home');
            }
            $seo['title'] = $detail->meta_title ? $detail->meta_title : $detail->title;
            $seo['description'] = $detail->meta_description ? $detail->meta_description : $detail->title;
            $seo['keywords'] = $detail->meta_keywords ? $detail->meta_keywords : $detail->title;           
            return view('frontend.pages.index', compact('detail', 'seo'));    
        }
    }
    
    public function getSeoInfo($meta_id){

    }
  
    
    
   
    function getGiaFromTo($slugGia){
        switch ($slugGia) {
            case 'duoi-1-trieu':
                $from = 0;
                $to = 1000000;
                $title = "Dưới 1 triệu";
                break;           
            case 'tu-1-den-2-trieu':
                $from = 1000001;
                $to = 2000000;
                $title = "Từ 1 - 2 triệu";
                break;
            case 'tu-2-den-4-trieu':
                $from = 2000001;
                $to = 4000000;
                $title = "Từ 2 - 4 triệu";
                break;
            case 'tu-4-den-8-trieu':
                $from = 4000001;
                $to = 8000000;
                $title = "Từ 4 - 8 triệu";
                break;
            case 'tu-8-den-16-trieu':
                $from = 8000001;
                $to = 16000000;
                $title = "Từ 8 - 16 triệu";
                break;
            case 'tren-16-trieu':
                $from = 16000001;
                $to = 1000000000;
                $title = "Trên 16 triệu";
                break;         
            default:
                $from = 0;
                $to = 100000000;
                $title = "Trên 16 triệu";
                break;
        }
        return ['from' => $from, 'to' => $to, 'title' => $title];
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function search(Request $request)
    {

        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        
        $layout_name = "main-category";
        
        $page_name = "page-category";

        $cateArr = $cateActiveArr = $moviesActiveArr = [];

        $tu_khoa = $request->k;
        
        $is_search = 1;

        $moviesArr = Film::where('alias', 'LIKE', '%'.$tu_khoa.'%')->orderBy('id', 'desc')->paginate(20);

        return view('frontend.cate', compact('settingArr', 'moviesArr', 'tu_khoa',  'is_search', 'layout_name', 'page_name' ));
    }

      
    
    

    public function newsList(Request $request)
    {
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        $layout_name = "main-news";
        
        $page_name = "page-news";

        $cateArr = $cateActiveArr = $moviesActiveArr = [];
       
        $cateDetail = ArticlesCate::where('slug' , 'tin-tuc')->first();
        $title = trim($cateDetail->meta_title) ? $cateDetail->meta_title : $cateDetail->name;

        $articlesArr = Articles::where('cate_id', 1)->orderBy('id', 'desc')->paginate(10);
        $hotArr = Articles::where( ['cate_id' => 1, 'is_hot' => 1] )->orderBy('id', 'desc')->limit(5)->get();
        return view('frontend.news-list', compact('title','settingArr', 'hotArr', 'layout_name', 'page_name', 'articlesArr'));
    }

    public function newsDetail(Request $request)
    {
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        $layout_name = "main-news";
        
        $page_name = "page-news";

        $id = $request->id;

        $detail = Articles::where( 'id', $id )
                ->select('id', 'title', 'slug', 'description', 'image_url', 'content', 'meta_title', 'meta_description', 'meta_keywords', 'custom_text')
                ->first();
        if(!$detail){
            return redirect()->route('home');
        }

        if( $detail ){
            $cateArr = $cateActiveArr = $moviesActiveArr = [];
        
            
            $title = trim($detail->meta_title) ? $detail->meta_title : $detail->title;

            $hotArr = Articles::where( ['cate_id' => 1, 'is_hot' => 1] )->where('id', '<>', $id)->orderBy('id', 'desc')->limit(5)->get();

            return view('frontend.news-detail', compact('title', 'settingArr', 'hotArr', 'layout_name', 'page_name', 'detail'));
        }else{
            return view('erros.404');
        }     

        
    }

}
