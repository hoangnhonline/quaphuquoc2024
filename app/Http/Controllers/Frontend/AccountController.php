<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Helper, File, Session, Auth, DB;

class AccountController extends Controller
{
    
    public function __construct(){
        
       

    }
   
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function loginForm(Request $request)
    {

       // $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        
        $tu_khoa = $request->k; 
        if (Session::get('login')) {
            return redirect()->route('home');;
        } 

        $seo['title'] = $seo['description'] = $seo['keywords'] = "Đăng nhập tài khoản";    

        return view('frontend.account.login', compact('tu_khoa', 'seo' ));
    }

    public function registerForm(Request $request)
    {

       // $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        
        $tu_khoa = $request->k;   
        if (Session::get('login')) {
            return redirect()->route('home');;
        }    

        $seo['title'] = $seo['description'] = $seo['keywords'] = "Đăng kí tài khoản";

        return view('frontend.account.register', compact('tu_khoa', 'seo' ));
    }

    

    

}
