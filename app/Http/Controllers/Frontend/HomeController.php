<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ProductCate;
use App\Models\Cate;
use App\Models\Product;
use App\Models\ProductImg;
use App\Models\Location;
use App\Models\City;
use App\Models\Articles;
use App\Models\ArticlesCate;
use App\Models\Customer;
use App\Models\Newsletter;
use App\Models\Settings;
use App\Models\Account;
use App\Models\Banner;

use Helper, File, Session, Auth, Hash;

class HomeController extends Controller
{
    
    public static $loaiSp = []; 
    public static $loaiSpArrKey = [];    

    public function __construct(){
        
       

    }
    public function getChild(Request $request){
        $module = $request->mod;
        $id = $request->id;
        $column = $request->col;
        return Helper::getChild($module, $column, $id);
    }
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {             
       // dd(Hash::make('123465@');
        $productArr = $manhinhArr = [];        
        //$hoverInfo = [];
        $loaiSp = ProductCate::where('status', 1)->get();
        
        $settingArr = Settings::whereRaw('1')->pluck('value', 'name');
        $seo = $settingArr;
        $seo['title'] = $settingArr['site_title'];
        $seo['description'] = $settingArr['site_description'];
        $seo['keywords'] = $settingArr['site_keywords'];
        $socialImage = $settingArr['banner'];
        $articlesList = Articles::where(['cate_id' => 1, 'is_hot' => 1])->orderBy('id', 'desc')->limit(3)->get();
        $products = Product::where(['status'=> 1,'is_hot' => 1])->get();
        foreach($products as $product){
            $productArr[$product->parent_id][] = $product;
        }
        $banners = Banner::where(['object_id' => 1, 'object_type' => 3])->orderBy('display_order', 'asc')->orderBy('id', 'asc')->get();
        $banner_sales =   Banner::where(['object_id' => 3, 'object_type' => 3])->where('status',1)->orderBy('display_order', 'asc')->orderBy('id', 'asc')->get();
        $banner_sales2 =   Banner::where(['object_id' => 4, 'object_type' => 3])->where('status',1)->orderBy('display_order', 'asc')->orderBy('id', 'asc')->get();
        return view('frontend.home.index', compact( 'seo','products','banners','banner_sales', 'articlesList', 'loaiSp', 'productArr', 'banner_sales2'));
    }
   
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    
    public function contact(Request $request){        

        $seo['title'] = 'Liên hệ';
        $seo['description'] = 'Liên hệ';
        $seo['keywords'] = 'Liên hệ';
        $socialImage = '';
        return view('frontend.contact.index', compact('seo', 'socialImage'));
    }

     
    public function newsList(Request $request)
    {
        
        $search = isset($request->search) && $request->search != '' ? $request->search : ''; 
        $cate_id = isset($request->cate_id) && $request->cate_id != '' ? $request->cate_id : '';
        
        $query = Articles::where('status', 1);
        $hotArr = Articles::where( 'is_hot', 1 )->orderBy('id', 'desc')->limit(3)->get();
        $newsLast = $query->orderBy('id', 'desc')->paginate(3);
        if( $search != ''){
            $query->where('alias', 'LIKE', '%'.$search.'%');
        }
        if( $cate_id != ''){
            $query->where('cate_id',$cate_id );
        }

        $newsList = $query->orderBy('id', 'desc')->paginate(8);

        foreach( $newsList as $news ) {
            if ($news->created_user) {
                
                $author = Account::where('id', $news->created_user)->get();
                foreach( $author as $aut ) {
                    $news->name = $aut->full_name;
                }
            } else {
                $news->name="non-author";
            }
        }
       
        $query = ArticlesCate::where('status', 1);
        $cateParentList = $query->orderBy('id', 'asc')->get();
        foreach ($cateParentList as $cate) {
            $temp = Articles::where('cate_id', $cate->id)->get();
            $cate->count=$temp->count();
        }
        $seo['title'] = $seo['description'] = $seo['keywords'] = 'Ẩm thực đà nẵng';

        return view('frontend.news.index', compact('newsList','newsLast','search','cateParentList','seo','hotArr'));

    }   
    
    public function newscateList(Request $request)
    {
        $search = isset($request->search) && $request->search != '' ? $request->search : ''; 
        $slug = $request->slug;
        $hotArr = Articles::where( 'is_hot', 1 )->orderBy('id', 'desc')->limit(3)->get();
        $query = Articles::where('status', 1);
        $newsLast = $query->orderBy('id', 'desc')->paginate(3);

        $cateDetail = ArticlesCate::where('slug' , $slug)->first();
        $newsList = Articles::where('cate_id', $cateDetail->id)->orderBy('id', 'desc')->paginate(8);


        foreach( $newsList as $news ) {
            if ($news->created_user) {
                
                $author = Account::where('id', $news->created_user)->get();
                foreach( $author as $aut ) {
                    $news->name = $aut->full_name;
                }
            } else {
                $news->name="non-author";
            }
        }
       
        $query = ArticlesCate::where('status', 1);
        $cateParentList = $query->orderBy('id', 'asc')->get();
        foreach ($cateParentList as $cate) {
            $temp = Articles::where('cate_id', $cate->id)->get();
            $cate->count=$temp->count();
        }
        // $seo['title'] = $seo['description'] = $seo['keywords'] = 'Tin Tức';
        $seo['title'] = $cateDetail->meta_title ? $cateDetail->meta_title : $cateDetail->title;
        $seo['description'] = $cateDetail->meta_description ? $cateDetail->meta_description : $cateDetail->title;
        $seo['keywords'] = $cateDetail->meta_keywords ? $cateDetail->meta_keywords : $cateDetail->title;

        return view('frontend.news.index', compact('newsList','newsLast','search','cateParentList','seo','hotArr'));



    }

     public function newsDetail(Request $request)
    {     
        $id = $request->id;

        $detail = Articles::where( 'id', $id )
                ->select('id', 'title', 'slug', 'description', 'image_url', 'content', 'meta_title', 'meta_description', 'meta_keywords', 'custom_text', 'created_at', 'cate_id')
                ->first();
        $is_km = $is_news = $is_kn = 0;

        $query = ArticlesCate::where('status', 1);
        $cateParentList = $query->orderBy('id', 'asc')->get();
        foreach ($cateParentList as $cate) {
            $temp = Articles::where('cate_id', $cate->id)->get();
            $cate->count=$temp->count();
        }
        
        if( $detail ){           

            $title = trim($detail->meta_title) ? $detail->meta_title : $detail->title;

            $hotArr = Articles::where( 'is_hot', 1 )->where('id', '<>', $id)->orderBy('id', 'desc')->limit(5)->get();
            $otherList = Articles::where( 'cate_id', $detail->cate_id )->where('id', '<>', $id)->orderBy('id', 'desc')->limit(2)->get();
            $seo['title'] = $detail->meta_title ? $detail->meta_title : $detail->title;
            $seo['description'] = $detail->meta_description ? $detail->meta_description : $detail->title;
            $seo['keywords'] = $detail->meta_keywords ? $detail->meta_keywords : $detail->title;
            $socialImage = $detail->image_url; 
            $is_km = $detail->cate_id == 2 ? 1 : 0;
            $is_news = $detail->cate_id == 1 ? 1 : 0;
            $is_kn = $detail->cate_id == 4 ? 1 : 0;
            return view('frontend.news.news-detail', compact('title',  'hotArr', 'detail', 'otherList', 'seo', 'socialImage', 'is_km', 'is_news', 'is_kn','cateParentList'));
        }else{
            return view('erros.404');
        }
    }

    public function registerNews(Request $request)
    {

        $email = $request->email;
        $newsletter = Newsletter::where('email', $email)->first();
        if(is_null($newsletter)) {
           $newsletter = new Newsletter;
           $newsletter->email = $email;
           $newsletter->is_member = Customer::where('email', $email)->first() ? 1 : 0;
           $newsletter->save();
           Session::flash('msg', 'Gửi liên hệ thành công.');
        } else {
            Session::flash('msg', 'Địa chỉ email này đã đăng kí nhận tin tức.');
        }

        return back();
    }

}
