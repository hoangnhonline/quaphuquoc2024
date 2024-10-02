<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ThuocTinh;
use App\Models\LoaiThuocTinh;
use App\Models\ProductCate;
use Helper, File, Session, Auth;

class ThuocTinhController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {   
        $loai_thuoc_tinh_id = $request->loai_thuoc_tinh_id;

        $parent_id = $request->parent_id;
        
        $loaiSp = ProductCate::lists('name', 'id')->toArray();
        /*
        $ltt = LoaiThuocTinh::where('parent_id', 8)->get();
        foreach($ltt as $lt){
            echo $lt->id."-".$lt->name;
            echo "<br>";
            $tt = ThuocTinh::where('loai_thuoc_tinh_id', $lt->id)->get();
            foreach ($tt as $t) {
                echo $t->id; echo "<br>";
            }
        }
        die;
        */
        $query = ThuocTinh::whereRaw('1');

        if( $parent_id > 0 ){

            $query->where('parent_id' , $parent_id);

            $loaiThuocTinh = LoaiThuocTinh::where('parent_id', $parent_id)->lists('name', 'id')->toArray();

        }else{
            $loaiThuocTinh = [];
        }
        if( $loai_thuoc_tinh_id > 0 ){

            $query->where('loai_thuoc_tinh_id' , $loai_thuoc_tinh_id);

        }
        $items = $query->get()->sortBy('display_order');

        return view('backend.thuoc-tinh.index', compact( 'items', 'loaiSp', 'loai_thuoc_tinh_id', 'parent_id', 'loaiThuocTinh'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {           

        $loai_thuoc_tinh_id = $request->loai_thuoc_tinh_id;

        $parent_id = $request->parent_id;

        $loaiSp = ProductCate::all()->sortBy('display_order');
        $query = ThuocTinh::whereRaw('1');
        if( $parent_id > 0 ){

            $query->where('parent_id' , $parent_id);

            $loaiThuocTinh = LoaiThuocTinh::where('parent_id', $parent_id)->lists('name', 'id')->toArray();

        }else{
            $loaiThuocTinh = [];
        }

        return view('backend.thuoc-tinh.create', compact('loaiSp', 'loaiThuocTinh', 'loai_thuoc_tinh_id', 'parent_id'));
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
            'name.required' => 'Bạn chưa nhập tên thuộc tính'            
        ]);
        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);

        $dataArr['created_user'] = Auth::user()->id;

        $dataArr['updated_user'] = Auth::user()->id;

        $dataArr['display_order'] = 1;
        
        ThuocTinh::create($dataArr);

        Session::flash('message', 'Tạo mới thuộc tính thành công');
        return redirect()->route('thuoc-tinh.create');
        //return redirect()->route('thuoc-tinh.index', ['loai_thuoc_tinh_id' => $dataArr['loai_thuoc_tinh_id'], 'parent_id' => $dataArr['parent_id']]);

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

        $detail = ThuocTinh::find($id);
             
        $loaiThuocTinh = LoaiThuocTinh::where('parent_id', $detail->parent_id)->lists('name', 'id')->toArray();

        
        return view('backend.thuoc-tinh.edit', compact( 'detail', 'loaiSp', 'loaiThuocTinh'));
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
            'name.required' => 'Bạn chưa nhập tên thuộc tính'
           
        ]);        

        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);      

        $dataArr['updated_user'] = Auth::user()->id;

        $model = ThuocTinh::find($dataArr['id']);

        $model->update($dataArr);

        Session::flash('message', 'Cập nhật thuộc tính thành công');

        return redirect()->route('thuoc-tinh.index', ['loai_thuoc_tinh_id' => $dataArr['loai_thuoc_tinh_id'], 'parent_id' => $dataArr['parent_id']]);
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
        $model = ThuocTinh::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa thuộc tính thành công');
        return redirect()->route('thuoc-tinh.index');
    }
}
