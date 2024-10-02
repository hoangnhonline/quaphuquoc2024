<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Articles;
use App\Models\ArticlesCate;
use App\Models\ArticlesCateParent;

use App\Models\Settings;
use App\Models\Account;
use App\Models\Banner;
use Helper, File, Session, Auth, Hash;

class NewsController extends Controller
{
    public function __construct(){
        
    }
     
    public function newsList(Request $request)
    {
        
        $search = isset($request->search) && $request->search != '' ? $request->search : ''; 
        $cate_id = isset($request->cate_id) && $request->cate_id != '' ? $request->cate_id : '';
        
        $query = Articles::where('status', 1);
        $hotArr = Articles::where( 'is_hot', 1 )->orderBy('id', 'desc')->limit(8)->get();
        $newsLast = $query->orderBy('id', 'desc')->paginate(3);
        if( $search != ''){
            $query->where('alias', 'LIKE', '%'.$search.'%');
        }
        if( $cate_id != ''){
            $query->where('cate_id',$cate_id );
        }

        $newsList = $query->orderBy('id', 'desc')->paginate(10);
        foreach( $newsList as $news ) {
            if ($news->created_user) {
                
                $author = Account::where('id', $news->created_user)->get();
                foreach( $author as $aut ) {
                    $news->name = $aut->full_name;
                }
            } else {
                $news->name = "Admin";
            }
        }
        $cateParentList = ArticlesCate::where('status', 1)->orderBy('id', 'asc')->get();

        foreach ($cateParentList as $cate) {
            $temp = Articles::where('cate_id', $cate->id)->get();
            $cate->count = $temp->count();
        }
        $banner_news =   Banner::where(['object_id' => 4, 'object_type' => 3])->where('status',1)->orderBy('display_order', 'asc')->orderBy('id', 'asc')->limit(2)->get();
        $seo['title'] = $seo['description'] = $seo['keywords'] = 'Tin tức';

        return view('frontend.news.index', compact('newsList', 'newsLast', 'search', 'cateParentList','seo','hotArr','banner_news'));

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
                $news->name = "Admin";
            }
        }
       
        $query = ArticlesCate::where('status', 1);
        $cateParentList = $query->orderBy('id', 'asc')->get();
        foreach ($cateParentList as $cate) {
            $temp = Articles::where('cate_id', $cate->id)->get();
            $cate->count=$temp->count();
        }
        $banner_news =   Banner::where(['object_id' => 4, 'object_type' => 3])->where('status',1)->orderBy('display_order', 'asc')->orderBy('id', 'asc')->limit(2)->get();
     
        $seo['title'] = $cateDetail->meta_title ? $cateDetail->meta_title : $cateDetail->title;
        $seo['description'] = $cateDetail->meta_description ? $cateDetail->meta_description : $cateDetail->title;
        $seo['keywords'] = $cateDetail->meta_keywords ? $cateDetail->meta_keywords : $cateDetail->title;

        return view('frontend.news.index', compact('newsList','newsLast','search','cateParentList','seo','hotArr','cateDetail','banner_news'));



    }
    public function newsCateParentList(Request $request)
    {
        $search = isset($request->search) && $request->search != '' ? $request->search : ''; 
        $slug = $request->slug;
        $slugArticlesCateParent = $request->slugArticlesCateParent;
        
        $hotArr = Articles::where( 'is_hot', 1 )->orderBy('id', 'desc')->limit(3)->get();
        $query = Articles::where('status', 1);
        $newsLast = $query->orderBy('id', 'desc')->paginate(3);

        $cateDetail = ArticlesCate::where('slug' , $slug)->first();
        $cateParentDetail = ArticlesCateParent::where('slug' , $slugArticlesCateParent)->first();
        $newsList = Articles::where('parent_id', $cateParentDetail->id)->orderBy('id', 'desc')->paginate(8);


        foreach( $newsList as $news ) {
            if ($news->created_user) {
                
                $author = Account::where('id', $news->created_user)->get();
                foreach( $author as $aut ) {
                    $news->name = $aut->full_name;
                }
            } else {
                $news->name = "Admin";
            }
        }
       
        $query = ArticlesCate::where('status', 1);
        $cateParentList = $query->orderBy('id', 'asc')->get();
        foreach ($cateParentList as $cate) {
            $temp = Articles::where('cate_id', $cate->id)->get();
            $cate->count=$temp->count();
        }
        $banner_news =   Banner::where(['object_id' => 4, 'object_type' => 3])->where('status',1)->orderBy('display_order', 'asc')->orderBy('id', 'asc')->limit(2)->get();
     
        $seo['title'] = $cateParentDetail->meta_title ? $cateParentDetail->meta_title : $cateParentDetail->title;
        $seo['description'] = $cateParentDetail->meta_description ? $cateParentDetail->meta_description : $cateParentDetail->title;
        $seo['keywords'] = $cateParentDetail->meta_keywords ? $cateParentDetail->meta_keywords : $cateParentDetail->title;

        return view('frontend.news.parent', compact('newsList','newsLast','search','cateParentList','seo','hotArr','cateDetail','banner_news', 'cateParentDetail'));



    }

     public function newsDetail(Request $request)
    {     
        $id = $request->id;  
        $slug = $request->slug;
        if($id){
            $detail = Articles::where( 'id', $id )
                ->select('id', 'title', 'slug', 'description', 'image_url', 'content', 'meta_title', 'meta_description', 'meta_keywords', 'custom_text', 'created_at', 'cate_id')
                ->first();
        }else{
            $detail = Articles::where( 'slug', $slug )
                ->select('id', 'title', 'slug', 'description', 'image_url', 'content', 'meta_title', 'meta_description', 'meta_keywords', 'custom_text', 'created_at', 'cate_id')
                ->first();
        }   
        
        $query = ArticlesCate::where('status', 1);
        $cateParentList = $query->orderBy('id', 'asc')->get();
        foreach ($cateParentList as $cate) {
            $temp = Articles::where('cate_id', $cate->id)->get();
            $cate->count=$temp->count();
        }
        if(!$detail) return view('erros.404');               

        $title = trim($detail->meta_title) ? $detail->meta_title : $detail->title;
        $hotArr = Articles::where( 'is_hot', 1 )->where('id', '<>', $id)->orderBy('id', 'desc')->limit(8)->get();
        $otherList = Articles::where( 'cate_id', $detail->cate_id )->where('id', '<>', $id)->orderBy('id', 'desc')->limit(2)->get();
        $seo['title'] = $detail->meta_title ?? $detail->title;
        $seo['description'] = $detail->meta_description ?? $detail->title;
        $seo['keywords'] = $detail->meta_keywords ?? $detail->title;
        $socialImage = $detail->image_url;
        $banner_news =   Banner::where(['object_id' => 4, 'object_type' => 3])->where('status',1)->orderBy('display_order', 'asc')->orderBy('id', 'asc')->limit(2)->get();
        return view('frontend.news.detail', compact('title',  'hotArr', 'detail', 'otherList', 'seo', 'socialImage', 'cateParentList','banner_news'));

    }
}
