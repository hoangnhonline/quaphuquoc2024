<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ThuongHieu;
use Helper, File, Session, Auth;

class ThuongHieuController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {        
        $items = ThuongHieu::all();
        return view('backend.thuong-hieu.index', compact( 'items'));
    }  
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {
        return view('backend.thuong-hieu.create');
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
            'name.required' => 'Bạn chưa nhập nội dung'            
        ]);        
   
        ThuongHieu::create($dataArr);

        Session::flash('message', 'Tạo mới icon thành công');

        return redirect()->route('thuong-hieu.index');
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
    public function edit(Request $request)
    {
        $id = $request->id;        
        $detail = ThuongHieu::find($id);
       
        return view('backend.thuong-hieu.edit', compact( 'detail'));
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
        
        $model = ThuongHieu::find($dataArr['id']);

        $this->validate($request,[
            'name' => 'required'            
        ],
        [
            'name.required' => 'Bạn chưa nhập nội dung'            
        ]);

        $model->update($dataArr);

        Session::flash('message', 'Cập nhật icon thành công');

        return redirect()->route('thuong-hieu.index');
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
        $model = ThuongHieu::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa thương hiệu thành công');
        return redirect()->route('thuong-hieu.index');
    }
}
