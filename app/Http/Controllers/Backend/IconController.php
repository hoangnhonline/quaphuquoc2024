<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Icons;
use Helper, File, Session, Auth;

class IconController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {        
        $items = Icons::all();
        return view('backend.icons.index', compact( 'items'));
    }  
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {
        return view('backend.icons.create');
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
            'content' => 'required'            
        ],
        [
            'content.required' => 'Bạn chưa nhập nội dung'            
        ]);        
   
        Icons::create($dataArr);

        Session::flash('message', 'Tạo mới icon thành công');

        return redirect()->route('icons.index');
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
        $detail = Icons::find($id);
       
        return view('backend.icons.edit', compact( 'detail'));
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
        
        $model = Icons::find($dataArr['id']);

        $this->validate($request,[
            'content' => 'required'            
        ],
        [
            'content.required' => 'Bạn chưa nhập nội dung'            
        ]);

        $model->update($dataArr);

        Session::flash('message', 'Cập nhật icon thành công');

        return redirect()->route('icons.index');
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
        $model = Icons::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa icon thành công');
        return redirect()->route('icon.index');
    }
}
