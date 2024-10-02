<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ProductCate;
use App\Models\ArticlesCateParent;
use App\Models\Cate;
use App\Models\Settings;
use App\Models\Articles;
use Session;
//use App\Models\Entity\SuperStar\Account\Traits\Behavior\SS_Shortcut_Icon;

/**
 * This is provider for using view share
 * @author AnPCD
 */
class ViewComposerServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//Call function composerSidebar
		$this->composerMenu();	
		
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Composer the sidebar
	 */
	private function composerMenu()
	{
		
		view()->composer( '*' , function( $view ){
			$routeName = \Request::route()->getName();

			$menuNgang = $menuDoc = $loaiSpHot = [];
			$loaiSp = ProductCate::where(['status' => 1])->orderBy('display_order')->get();

			$articlesCateParent = ArticlesCateParent::where(['status' => 1])->get();
			$articlesAbout = Articles::where('cate_id', 11)->get();
	        if( $loaiSp ){

	            foreach ( $loaiSp as $key => $value) {
	            	$tmpArr = ['name' => $value->name, 'slug' => $value->slug, 'id' => $value->id, 'icon_url' => $value->icon_url, 'bg_color' => $value->bg_color, 'home_style' => $value->home_style, 'is_hover' => $value->is_hover, 'is_hot' => $value->is_hot, 'menu_ngang' => $value->menu_ngang, 'menu_doc' => $value->menu_doc, 'icon_mau' => $value->icon_mau , 'banner_menu' => $value->banner_menu, 'icon_km' => $value->icon_km];	            		
	            	$child = Cate::where(['status' => 1, 'parent_id' => $value->id])
	                    ->orderBy('display_order')
	                    ->select('name', 'slug', 'id', 'bg_color', 'icon_url', 'home_style')
	                    ->get()->toArray();
	                  
	                $loaiSpKey[$value->id] = $tmpArr;
	                $loaiSpKey[$value->id]['child'] = $child;
	            	if( $value->menu_ngang == 1){
	            		$menuNgang[$value->id] = $tmpArr;
	            		$menuNgang[$value->id]['child'] = $child;
	            	}
	            	if( $value->menu_doc == 1){
	            		$menuDoc[$value->id] = $tmpArr;	
	            		$menuDoc[$value->id]['child'] = $child;
	            	}
	            	if( $value->is_hot == 1){
	            		$loaiSpHot[$value->id] = $tmpArr;
	            		$loaiSpHot[$value->id]['child'] = $child;
	            	}	                
	            }
	        }    
	        $settingArr = Settings::whereRaw('1')->pluck('value', 'name');
	        // cal total product in cart
	       	$cart = Session::get('cart');
	       	$totalProductCart = 0;
	       	if(!empty($cart)){
	       		foreach($cart as $product_id => $product){
	       			$totalProductCart +=  $product['amount'];
	       		}
	       	}
			$view->with( ['loaiSpKey' => $loaiSpKey, 'menuNgang' => $menuNgang, 'menuDoc' => $menuDoc, 'loaiSpHot' => $loaiSpHot, 'settingArr' => $settingArr, 'loaiSp' => $loaiSp, 'totalProductCart' => $totalProductCart,
				'routeName' => $routeName, 'articlesCateParent' => $articlesCateParent, 'articlesAbout' => $articlesAbout

		] );
		});
	}
	
}
