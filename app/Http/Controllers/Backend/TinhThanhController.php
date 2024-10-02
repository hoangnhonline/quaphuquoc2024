<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\City;
use Helper, File, Session, Auth;

class CityController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        $parent_id = isset($request->parent_id) ? $request->parent_id : 0;

        $name = isset($request->name) && $request->name != '' ? $request->name : '';
        
        $query = City::whereRaw('1');
               
        $query->where('parent_id', $parent_id);        
        
        if( $name != ''){
            $query->where('name', 'LIKE', '%'.$name.'%');
        }
        $items = $query->orderBy('id', 'desc')->paginate(65);
        
        return view('backend.tinh.index', compact( 'items', 'name', 'parent_id' ));
    }      

    /**
    * Store a newly created resource in storage.
    *
    * @param  Request  $request
    * @return Response
    */    

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
    public function create(Request $request)
    {
        $parent_id = $request->parent_id;        

        $detail = City::find($id);

        $parentArr = City::where('parent_id', 0)->get();

        return view('backend.tinh.edit', compact('detail', 'parentArr', 'parent_id'));
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {

        $detail = City::find($id);

        $parentArr = City::where('parent_id', 0)->get();

        return view('backend.tinh.edit', compact('detail', 'parentArr'));
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
            'name' => 'required',
        ],
        [   
            'name.required' => 'Bạn chưa nhập Tên',            
        ]);    
       
        $model = City::find($dataArr['id']);

        $model->update($dataArr);

        Session::flash('message', 'Cập nhật thành công');        

        return redirect()->route('tinh.index', ['parent_id' => $dataArr['parent_id']]);
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
        $model = City::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa thành công');
        return redirect()->route('tinh.index');
    }
}
