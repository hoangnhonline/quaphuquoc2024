<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ProductCate;
use App\Models\MetaData;
use App\Models\Cate;
use Helper, File, Session, Auth;

class ProductCateController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        $items = ProductCate::where('status', 1)->orderBy('display_order', 'asc')->get();
        return view('backend.product-cate.index', compact( 'items' ));
    }
    public function ajaxLoadCate(Request $request){
        $parent_id = $request->parent_id ?? null;
       // dd($parent_id);
        if(!$parent_id) return '';
        
        $items = Cate::where(['status' => 1, 'parent_id' => $parent_id])->get();
        return view('backend.product-cate.ajax-load-cate', compact( 'items' ));
            
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        return view('backend.product-cate.create');
    }

    public function thuocTinh(Request $request){      

        $parent_id = $request->parent_id;
        
        $detailLoai = ProductCate::find( $parent_id );
              
        
        $thuocTinhArr = [];
        $loaiSpArr = ProductCate::all();
        
        if( $parent_id ){            
            
            
            $loaiThuocTinhArr = LoaiThuocTinh::where('parent_id', $parent_id)->orderBy('display_order')->get();

            if( $loaiThuocTinhArr->count() > 0){
                foreach ($loaiThuocTinhArr as $value) {

                    $thuocTinhArr[$value->id]['id'] = $value->id;
                    $thuocTinhArr[$value->id]['name'] = $value->name;

                    $thuocTinhArr[$value->id]['child'] = ThuocTinh::where('loai_thuoc_tinh_id', $value->id)->select('id', 'name')->orderBy('display_order')->orderBy('id')->get()->toArray();
                }
                
            }
        }        
        
        return view('backend.product-cate.thuoc-tinh', compact( 'detailLoai', 'parent_id', 'thuocTinhArr', 'thuocTinhArr'));
    }

    public function editThuocTinh(Request $request){      

        $parent_id = $request->parent_id;
        
        $detailLoai = ProductCate::find( $parent_id );
        
        $id = $request->id;
        $detail = HoverInfo::find( $id );

        $str_thuoctinh_id = $detail->str_thuoctinh_id;
        $arrSelected = explode(",", $str_thuoctinh_id);      
        
        $thuocTinhArr = [];
        $loaiSpArr = ProductCate::all();
        
        if( $parent_id ){            
            
            
            $loaiThuocTinhArr = LoaiThuocTinh::where('parent_id', $parent_id)->orderBy('display_order')->get();

            if( $loaiThuocTinhArr->count() > 0){
                foreach ($loaiThuocTinhArr as $value) {

                    $thuocTinhArr[$value->id]['id'] = $value->id;
                    $thuocTinhArr[$value->id]['name'] = $value->name;

                    $thuocTinhArr[$value->id]['child'] = ThuocTinh::where('loai_thuoc_tinh_id', $value->id)->select('id', 'name')->orderBy('display_order')->get()->toArray();
                }
                
            }
        }        
        
        return view('backend.product-cate.edit-thuoc-tinh', compact( 'detailLoai', 'parent_id', 'thuocTinhArr', 'thuocTinhArr', 'arrSelected', 'detail'));
    }

    public function storeThuocTinh(Request $request)
    {
        $dataArr = $request->all();
        
        $this->validate($request,[
            'text_hien_thi' => 'required',
            
        ],
        [
            'text_hien_thi.required' => 'Bạn chưa nhập text hiển thị',            
        ]);

        if( !empty($dataArr['str_thuoc_tinh_id'])){
            $dataArr['str_thuoctinh_id'] = implode(',', $dataArr['str_thuoc_tinh_id']);
        }
        $dataArr['display_order'] = 1;
        HoverInfo::create( $dataArr );
        Session::flash('message', 'Thêm mới danh sách thuộc tính hiển thị thành công');

        return redirect()->route('product-cate.list-thuoc-tinh', ['parent_id' => $dataArr['parent_id']]);
    }

    public function listThuocTinh( Request $request){
        
        $parent_id = $request->parent_id;
        
        $detailLoai = ProductCate::find( $parent_id );
        $str_thuoctinh_id = '';
        $items = HoverInfo::where('parent_id', $parent_id)->orderBy('display_order', 'asc')->orderBy('id', 'asc')->get();
        if( $items){
            foreach ($items as $key => $value) {
                $str_thuoctinh_id .= $value->str_thuoctinh_id.",";
            }
        }
        $str_thuoctinh_id = rtrim($str_thuoctinh_id, ",");
        $tmpArr = explode(",",$str_thuoctinh_id);
        foreach ($tmpArr as $key => $value) {            
            $thuoctinh[$value] = ThuocTinh::find($value)->name;
        }        
        return view('backend.product-cate.list-thuoc-tinh', compact('detail', 'detailLoai', 'items', 'thuoctinh'));

    }
    public function updateThuocTinh(Request $request)
    {
        $dataArr = $request->all();
        
        $this->validate($request,[
            'text_hien_thi' => 'required',
            
        ],
        [
            'text_hien_thi.required' => 'Bạn chưa nhập text hiển thị',            
        ]);
  
        if( !empty($dataArr['str_thuoc_tinh_id'])){
            $dataArr['str_thuoctinh_id'] = implode(',', $dataArr['str_thuoc_tinh_id']);
        }

        $dataArr['display_order'] = 1;
        $model = HoverInfo::find( $dataArr['id'] );
        $model->update( $dataArr );
        Session::flash('message', 'Cập nhật thuộc tính hiển thị thành công');

        return redirect()->route('product-cate.list-thuoc-tinh', ['parent_id' => $dataArr['parent_id']]);
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
            'name' => 'required',
            'slug' => 'required',
            'phi_dich_vu' => 'numeric',
        ],
        [
            'name.required' => 'Bạn chưa nhập tên danh mục',
            'slug.required' => 'Bạn chưa nhập slug',
            'phi_dich_vu.numeric' => 'Vui lòng nhập phí dịch vụ hợp lệ',
        ]);

        $dataArr['bg_color'] = $dataArr['bg_color'] != '' ? $dataArr['bg_color'] : '#EE484F';
        
        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);
       
        if($dataArr['icon_url'] && $dataArr['icon_name']){
            
            $tmp = explode('/', $dataArr['icon_url']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('gfamily.upload_path').$dataArr['icon_url'], config('gfamily.upload_path').$destionation);
            
            $dataArr['icon_url'] = $destionation;
        }  
        if($dataArr['banner_menu'] && $dataArr['banner_name']){
            
            $tmp = explode('/', $dataArr['banner_menu']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('gfamily.upload_path').$dataArr['icon_url'], config('gfamily.upload_path').$destionation);
            
            $dataArr['banner_menu'] = $destionation;
        }
        if($dataArr['icon_mau'] && $dataArr['image_name_mau']){
            
            $tmp = explode('/', $dataArr['icon_mau']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('gfamily.upload_path').$dataArr['icon_mau'], config('gfamily.upload_path').$destionation);
            
            $dataArr['icon_mau'] = $destionation;
        }  
        if($dataArr['icon_km'] && $dataArr['image_name_km']){
            
            $tmp = explode('/', $dataArr['icon_km']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('gfamily.upload_path').$dataArr['icon_km'], config('gfamily.upload_path').$destionation);
            
            $dataArr['icon_km'] = $destionation;
        }  

        $dataArr['is_hot'] = isset($dataArr['is_hot']) ? 1 : 0;    
        $dataArr['menu_ngang'] = isset($dataArr['menu_ngang']) ? 1 : 0;    
        $dataArr['menu_doc'] = isset($dataArr['menu_doc']) ? 1 : 0;    
        $dataArr['is_hover'] = isset($dataArr['is_hover']) ? 1 : 0;    
        $dataArr['created_user'] = Auth::user()->id;

        $dataArr['updated_user'] = Auth::user()->id;
        $rs = ProductCate::create($dataArr);
        $id = $rs->id;

        $this->storeMeta( $id, 0, $dataArr);

        Session::flash('message', 'Tạo mới danh mục thành công');

        return redirect()->route('product-cate.index');
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
        $detail = ProductCate::find($id);

        $meta = (object) [];
        if ( $detail->meta_id > 0){
            $meta = MetaData::find( $detail->meta_id );
        }

        return view('backend.product-cate.edit', compact( 'detail', 'meta'));
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
            'slug' => 'required',
            'phi_dich_vu' => 'numeric'
        ],
        [
            'name.required' => 'Bạn chưa nhập tên danh mục',
            'slug.required' => 'Bạn chưa nhập slug',
            'phi_dich_vu.numeric' => 'Vui lòng nhập phí dịch vụ hợp lệ',
        ]);

        $dataArr['bg_color'] = $dataArr['bg_color'] != '' ? $dataArr['bg_color'] : '#EE484F';

        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);
        
        if($dataArr['icon_url'] && $dataArr['icon_name']){
            
            $tmp = explode('/', $dataArr['icon_url']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('gfamily.upload_path').$dataArr['icon_url'], config('gfamily.upload_path').$destionation);
            
            $dataArr['icon_url'] = $destionation;
        }  
        if($dataArr['icon_km'] && $dataArr['image_name_km']){
            
            $tmp = explode('/', $dataArr['icon_km']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('gfamily.upload_path').$dataArr['icon_km'], config('gfamily.upload_path').$destionation);
            
            $dataArr['icon_km'] = $destionation;
        } 
        if($dataArr['banner_menu'] && $dataArr['banner_name']){
            
            $tmp = explode('/', $dataArr['banner_menu']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('gfamily.upload_path').$dataArr['banner_menu'], config('gfamily.upload_path').$destionation);
            
            $dataArr['banner_menu'] = $destionation;            
        }
        if($dataArr['icon_mau'] && $dataArr['image_name_mau']){
            
            $tmp = explode('/', $dataArr['icon_mau']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('gfamily.upload_path').$dataArr['icon_mau'], config('gfamily.upload_path').$destionation);
            
            $dataArr['icon_mau'] = $destionation;
        }  
        

        $dataArr['updated_user'] = Auth::user()->id;
        $dataArr['is_hot'] = isset($dataArr['is_hot']) ? 1 : 0;    
        $dataArr['menu_ngang'] = isset($dataArr['menu_ngang']) ? 1 : 0;    
        $dataArr['menu_doc'] = isset($dataArr['menu_doc']) ? 1 : 0;    
        $dataArr['is_hover'] = isset($dataArr['is_hover']) ? 1 : 0;    

        $model = ProductCate::find($dataArr['id']);
        $model->update($dataArr);

        $this->storeMeta( $dataArr['id'], $dataArr['meta_id'], $dataArr);

        Session::flash('message', 'Cập nhật danh mục thành công');

        return redirect()->route('product-cate.edit', $dataArr['id']);
    }
    public function storeMeta( $id, $meta_id, $dataArr ){
       
        $arrData = [ 'title' => $dataArr['meta_title'], 'description' => $dataArr['meta_description'], 'keywords'=> $dataArr['meta_keywords'], 'custom_text' => $dataArr['custom_text'], 'updated_user' => Auth::user()->id ];
        if( $meta_id == 0){
            $arrData['created_user'] = Auth::user()->id;            
            $rs = MetaData::create( $arrData );
            $meta_id = $rs->id;
            
            $modelSp = ProductCate::find( $id );
            $modelSp->meta_id = $meta_id;
            $modelSp->save();
        }else {
            $model = MetaData::find($meta_id);           
            $model->update( $arrData );
        }              
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
        $model = ProductCate::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa danh mục thành công');
        return redirect()->route('product-cate.index');
    }

    public function destroyThuocTinh($id)
    {
        // delete
        $model = HoverInfo::find($id);
        $parent_id = $model->parent_id;
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa danh mục thành công');
        return redirect()->route('product-cate.list-thuoc-tinh', ['parent_id' => $parent_id]);
    }
}
