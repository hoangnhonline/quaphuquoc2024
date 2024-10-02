<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cate;
use App\Models\CateChild;
use App\Models\ProductCate;
use App\Models\MetaData;
use Helper, File, Session, Auth;

class CateChildController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {        
        $cate_id = $request->cate_id > 0 ? $request->cate_id : 1;               
        $detailCate = Cate::find($cate_id);
        $items = CateChild::where('cate_id', '=', $cate_id)->where('status', 1)->orderBy('display_order')->get();
        $cateArr = Cate::where('status', 1)->orderBy('display_order')->get();
        
        return view('backend.cate-child.index', compact( 'items' , 'cate_id', 'cateArr', 'detailCate'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {
        $cate_id = $request->cate_id ?? 1;        
        $detailCate = Cate::find($cate_id);
        $cateArr = Cate::where('status', 1)->orderBy('display_order')->get();

        return view('backend.cate-child.create', compact( 'cate_id', 'cateArr', 'detailCate'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  Request  $request
    * @return Response
    */
    public function store(Request $request)
    {
        $dataArr = $request->all();
        
        $this->validate($request,[
            'cate_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
        ],
        [
            'cate_id.required' => 'Bạn chưa chọn danh mục cấp 1',
            'name.required' => 'Bạn chưa nhập tên danh mục cấp 2',
            'slug.required' => 'Bạn chưa nhập slug',
        ]);

        $dataArr['bg_color'] = $dataArr['bg_color'] ?? '#EE484F';
        
        $dataArr['alias'] = str_slug($dataArr['name'], " ");
        
        $dataArr['created_user'] = $dataArr['updated_user'] = Auth::user()->id;        

        if($dataArr['icon_url'] && $dataArr['icon_name']){
            
            $tmp = explode('/', $dataArr['icon_url']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('gfamily.upload_path').$dataArr['icon_url'], config('gfamily.upload_path').$destionation);
            
            $dataArr['icon_url'] = $destionation;
        }
        $detailCate = Cate::find($dataArr['cate_id']);
        $dataArr['is_hot'] = isset($dataArr['is_hot']) ? 1 : 0;    
        $dataArr['menu_ngang'] = isset($dataArr['menu_ngang']) ? 1 : 0;    
        $dataArr['menu_doc'] = isset($dataArr['menu_doc']) ? 1 : 0;  

        $dataArr['display_order'] = 1;
        $dataArr['parent_id'] = $detailCate->parent_id;
        $rs = CateChild::create($dataArr);        
        $id = $rs->id;

        $this->storeMeta( $id, 0, $dataArr);

        Session::flash('message', 'Tạo mới danh mục thành công');

        return redirect()->route('cate-child.index',['cate_id' => $dataArr['cate_id']]);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
    //
    }
    public function storeMeta( $id, $meta_id, $dataArr ){
       
        $arrData = [ 'title' => $dataArr['meta_title'], 'description' => $dataArr['meta_description'], 'keywords'=> $dataArr['meta_keywords'], 'custom_text' => $dataArr['custom_text'], 'updated_user' => Auth::user()->id ];
        if( $meta_id == 0){
            $arrData['created_user'] = Auth::user()->id;            
            $rs = MetaData::create( $arrData );
            $meta_id = $rs->id;
            
            $modelSp = CateChild::find( $id );
            $modelSp->meta_id = $meta_id;
            $modelSp->save();
        }else {
            $model = MetaData::find($meta_id);           
            $model->update( $arrData );
        }              
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $detail = CateChild::find($id);
        $cate_id = $detail->cate_id;
        $detailCate = Cate::find($cate_id);
        $cateArr = Cate::where('parent_id', $detailCate->parent_id)->orderBy('display_order')->get();
        $meta = (object) [];
        if ( $detail->meta_id > 0){
            $meta = MetaData::find( $detail->meta_id );
        }               
        return view('backend.cate-child.edit', compact( 'detail', 'cateArr', 'meta', 'detailCate', 'cate_id'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  Request  $request
    * @param  int  $id
    * @return Response
    */
    public function update(Request $request)
    {
        $dataArr = $request->all();
        
        $this->validate($request,[
            'cate_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
        ],
        [
            'cate_id.required' => 'Bạn chưa chọn danh mục cấp 1',
            'name.required' => 'Bạn chưa nhập tên danh mục cấp 2',
            'slug.required' => 'Bạn chưa nhập slug',
        ]);

        $dataArr['bg_color'] = $dataArr['bg_color'] != '' ? $dataArr['bg_color'] : '#EE484F';

        $dataArr['alias'] = str_slug($dataArr['name'], " ");

        $model = CateChild::find($dataArr['id']);

        $dataArr['updated_user'] = Auth::user()->id;
        if($dataArr['icon_url'] && $dataArr['icon_name']){
            
            $tmp = explode('/', $dataArr['icon_url']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('gfamily.upload_path').$dataArr['icon_url'], config('gfamily.upload_path').$destionation);
            
            $dataArr['icon_url'] = $destionation;
        }
        $dataArr['is_hot'] = isset($dataArr['is_hot']) ? 1 : 0;    
        $dataArr['menu_ngang'] = isset($dataArr['menu_ngang']) ? 1 : 0;    
        $dataArr['menu_doc'] = isset($dataArr['menu_doc']) ? 1 : 0;

        $model->update($dataArr);

        $this->storeMeta( $dataArr['id'], $dataArr['meta_id'], $dataArr);
        Session::flash('message', 'Cập nhật danh mục thành công');

        return redirect()->route('cate-child.edit', $dataArr['id']);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        // delete
        $model = CateChild::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa danh mục thành công');
        return redirect()->route('cate-child.index',[$model->cate_id]);
    }
}
