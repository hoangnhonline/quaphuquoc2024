<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\LoaiThuocTinh;
use App\Models\ProductCate;
use Helper, File, Session, Auth;

class LoaiThuocTinhController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {   
        $parent_id = $request->parent_id;
        $loaiSp = ProductCate::lists('name', 'id')->toArray();       
        $query = LoaiThuocTinh::whereRaw('1');
        if( $parent_id > 0 ){
            $query->where('parent_id' , $parent_id);
        }
        $items = $query->get()->sortBy('display_order');

        return view('backend.loai-thuoc-tinh.index', compact( 'items', 'loaiSp', 'parent_id' ));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {   
        $parent_id = $request->parent_id;

        $loaiSp = ProductCate::all()->sortBy('display_order');

        return view('backend.loai-thuoc-tinh.create', compact('loaiSp', 'parent_id'));
    }

    public function getLoaiThuocTinhByLoaiId(Request $request){
        $parent_id = $request->parent_id;

        $loaiThuocTinh = LoaiThuocTinh::where('parent_id', $parent_id)->orderBy('display_order')->get();

        return view('backend.loai-thuoc-tinh.ajax-get-thuoc-tinh', compact('loaiThuocTinh'));
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
            'name' => 'required'           
        ],
        [
            'name.required' => 'Bạn chưa nhập tên loại thuộc tính'            
        ]);
        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);

        $dataArr['created_user'] = Auth::user()->id;

        $dataArr['updated_user'] = Auth::user()->id;

        $dataArr['display_order'] = 1;
      
        LoaiThuocTinh::create($dataArr);

        Session::flash('message', 'Tạo mới loại thuộc tính thành công');

        return redirect()->route('loai-thuoc-tinh.index', ['parent_id' => $dataArr['parent_id']]);
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

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $loaiSp = ProductCate::all()->sortBy('display_order');

        $detail = LoaiThuocTinh::find($id);

        return view('backend.loai-thuoc-tinh.edit', compact( 'detail', 'loaiSp'));
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
            'name' => 'required'           
        ],
        [
            'name.required' => 'Bạn chưa nhập tên loại thuộc tính'
           
        ]);        

        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);      

        $dataArr['updated_user'] = Auth::user()->id;

        $model = LoaiThuocTinh::find($dataArr['id']);

        $model->update($dataArr);

        Session::flash('message', 'Cập nhật loại thuộc tính thành công');

        return redirect()->route('loai-thuoc-tinh.edit', $dataArr['id']);
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
        $model = LoaiThuocTinh::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa loại thuộc tính thành công');
        return redirect()->route('loai-thuoc-tinh.index');
    }
}
