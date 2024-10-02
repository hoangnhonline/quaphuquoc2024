<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCate;
use App\Models\CateChild;
use App\Models\Icons;
use App\Models\Cate;
use App\Models\Color;
use App\Models\ProductImg;
use App\Models\ProductIcon;
use App\Models\ThuongHieu;
use App\Models\MetaData;

use Helper, File, Session, Auth, Hash, URL, Image;

class ProductController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {

        $arrSearch['status'] = $status = isset($request->status) ? $request->status : 1;
        $arrSearch['is_hot'] = $is_hot = isset($request->is_hot) ? $request->is_hot : null;
        $arrSearch['is_sale'] = $is_sale = isset($request->is_sale) ? $request->is_sale : null;
        $arrSearch['parent_id'] = $parent_id = isset($request->parent_id) ? $request->parent_id : null;
        $arrSearch['cate_id'] = $cate_id = isset($request->cate_id) ? $request->cate_id : null;

        $arrSearch['het_hang'] = $het_hang = isset($request->het_hang) ? $request->het_hang : null;
        
        $arrSearch['name'] = $name = isset($request->name) && trim($request->name) != '' ? trim($request->name) : '';
        
        $query = Product::where('product.status', $status);
        if( $is_hot ){
            $query->where('product.is_hot', $is_hot);
        }
        if( $is_sale ){
            $query->where('product.is_sale', $is_sale);
        }
        if( $parent_id ){
            $query->where('product.parent_id', $parent_id);
        }
        if( $cate_id ){
            $query->where('product.cate_id', $cate_id);
        }
        if( $het_hang ){
            $query->where('product.so_luong_ton', 0);
        }
       
        if( $name != ''){
            $query->where('product.name', 'LIKE', '%'.$name.'%');           
        }
        $query->join('users', 'users.id', '=', 'product.created_user');
        $query->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id');        
        $query->orderBy('product.id', 'desc');
        $items = $query->select(['product_img.image_url','product.*','product.id as product_id', 'full_name' , 'product.created_at as time_created', 'users.full_name'])
        ->paginate(50);   

        $loaiSpArr = ProductCate::all();  
        if( $parent_id ){
            $cateArr = Cate::where('parent_id', $parent_id)->orderBy('display_order', 'desc')->get();
        }else{
            $cateArr = (object) [];
        }
        if( $cate_id ){
            $cateChildArr = CateChild::where('cate_id', $cate_id)->orderBy('display_order', 'desc')->get();
        }else{
            $cateChildArr = (object) [];
        }
        $thuonghieuList = ThuongHieu::all();
        return view('backend.product.index', compact( 'items', 'arrSearch', 'loaiSpArr', 'cateArr', 'cateChildArr', 'thuonghieuList'));
    }
    public function short(Request $request)
    {
        
        $arrSearch['status'] = $status = isset($request->status) ? $request->status : 1;
        $arrSearch['parent_id'] = $parent_id = isset($request->parent_id) ? $request->parent_id : null;
        $arrSearch['cate_id'] = $cate_id = isset($request->cate_id) ? $request->cate_id : null;
        $arrSearch['name'] = $name = isset($request->name) && trim($request->name) != '' ? trim($request->name) : '';
        
        $query = Product::where('product.status', $status);
        if( $parent_id ){
            $query->where('product.parent_id', $parent_id);
        }
        if( $cate_id ){
            $query->where('product.cate_id', $cate_id);
        }
        if( $name != ''){
            $query->where('product.name', 'LIKE', '%'.$name.'%');
            $query->orWhere('name_extend', 'LIKE', '%'.$name.'%');
        }        
        $query->orderBy('product.id', 'desc');
        $items = $query->select(['product.*','product.id as product_id' , 'product.created_at as time_created'])
        ->paginate(50);

        $loaiSpArr = ProductCate::all();  
        if( $parent_id ){
            $cateArr = Cate::where('parent_id', $parent_id)->orderBy('display_order', 'desc')->get();
        }else{
            $cateArr = (object) [];
        }

        return view('backend.product.short', compact( 'items', 'arrSearch', 'loaiSpArr', 'cateArr'));
    }
    public function spTuongThich(Request $request){
        
        $id = $request->id;
        
        $detail = Product::find($id);

        $loaiSpArr = ProductCate::all();  
        
        $tmpArr = SpTuongThich::where('sp_1', $id)->get();
        
        $spSelected = $productArr = [];
        $str_sp_bo_mach_chinh = $str_sp_bo_vi_xu_ly = $str_sp_card_man_hinh = $str_sp_bo_nho = $str_sp_nguon = $str_sp_case = "";
        if( $tmpArr->count() > 0){
            foreach ($tmpArr as $value) {
                $spSelected[$value->cate_id][] = $value->sp_2;
                $productArr[$value->sp_2] = Product::find($value->sp_2);
                if($value->cate_id == 31){
                    $str_sp_bo_mach_chinh .= $value->sp_2.",";
                }
                if($value->cate_id == 32){
                    $str_sp_bo_vi_xu_ly .= $value->sp_2.",";
                }
                if($value->cate_id == 35){
                    $str_sp_bo_nho .= $value->sp_2.",";
                }
                if($value->cate_id == 85){
                    $str_sp_card_man_hinh .= $value->sp_2.",";
                }
                if($value->cate_id == 85){
                    $str_sp_card_man_hinh .= $value->sp_2.",";
                }
                if($value->cate_id == 33){
                    $str_sp_nguon .= $value->sp_2.",";
                }
                if($value->cate_id == 89){
                    $str_sp_case .= $value->sp_2.",";
                }
            }
        }

        $cateArr = Cate::where('parent_id', 7)->orderBy('display_order', 'desc')->get();
        
        return view('backend.product.tuong-thich', compact( 'detail', 'loaiSpArr', 'cateArr', 'spSelected', 'productArr', 'str_sp_bo_mach_chinh','str_sp_bo_vi_xu_ly', 'str_sp_card_man_hinh', 'str_sp_bo_nho', 'str_sp_case', 'str_sp_nguon'));   
    }
    public function ajaxSearch(Request $request){    
        $search_type = $request->search_type;
        $arrSearch['parent_id'] = $parent_id = isset($request->parent_id) ? $request->parent_id : -1;
        $arrSearch['cate_id'] = $cate_id = isset($request->cate_id) ? $request->cate_id : -1;
        $arrSearch['name'] = $name = isset($request->name) && trim($request->name) != '' ? trim($request->name) : '';
        
        $query = Product::whereRaw('1');
        
        if( $parent_id ){
            $query->where('product.parent_id', $parent_id);
        }
        if( $cate_id ){
            $query->where('product.cate_id', $cate_id);
        }
        if( $name != ''){
            $query->where('product.name', 'LIKE', '%'.$name.'%');
            $query->orWhere('name_extend', 'LIKE', '%'.$name.'%');
        }
        $query->join('users', 'users.id', '=', 'product.created_user');
        $query->join('product_cate', 'product_cate.id', '=', 'product.parent_id');
        $query->join('cate', 'cate.id', '=', 'product.cate_id');
        $query->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id');        
        $query->orderBy('product.id', 'desc');
        $items = $query->select(['product_img.image_url','product.*','product.id as product_id', 'full_name' , 'product.created_at as time_created', 'users.full_name', 'product_cate.name as ten_loai', 'cate.name as ten_cate'])
        ->paginate(1000);

        $loaiSpArr = ProductCate::all();  
        if( $parent_id ){
            $cateArr = Cate::where('parent_id', $parent_id)->orderBy('display_order', 'desc')->get();
        }else{
            $cateArr = (object) [];
        }

        return view('backend.product.content-search', compact( 'items', 'arrSearch', 'loaiSpArr', 'cateArr', 'search_type'));
    }

    public function ajaxSearchTuongThich(Request $request){    
        $search_type = $request->search_type;
        $arrSearch['parent_id'] = $parent_id = 7;
        $arrSearch['cate_id'] = $cate_id = isset($request->cate_id) ? $request->cate_id : -1;
        $arrSearch['name'] = $name = isset($request->name) && trim($request->name) != '' ? trim($request->name) : '';
        
        $query = Product::whereRaw('1');
        
        
        $query->where('product.parent_id', 7);
        
        if( $cate_id ){
            $query->where('product.cate_id', $cate_id);
        }
        if( $name != ''){
            $query->where('product.name', 'LIKE', '%'.$name.'%');
            $query->orWhere('name_extend', 'LIKE', '%'.$name.'%');
        }
        $query->join('users', 'users.id', '=', 'product.created_user');
        $query->join('product_cate', 'product_cate.id', '=', 'product.parent_id');
        $query->join('cate', 'cate.id', '=', 'product.cate_id');
        $query->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id');        
        $query->orderBy('product.id', 'desc');
        $items = $query->select(['product_img.image_url','product.*','product.id as product_id', 'full_name' , 'product.created_at as time_created', 'users.full_name', 'product_cate.name as ten_loai', 'cate.name as ten_cate'])
        ->paginate(1000);

        $loaiSpArr = ProductCate::all();  
        if( $parent_id ){
            $cateArr = Cate::where('parent_id', $parent_id)->orderBy('display_order', 'desc')->get();
        }else{
            $cateArr = (object) [];
        }

        return view('backend.product.tuong-thich.content-search-tuong-thich', compact( 'items', 'arrSearch', 'loaiSpArr', 'cateArr', 'search_type', 'cate_id'));
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {
        $parent_id = $request->parent_id ? $request->parent_id : null;
        $cate_id = $request->cate_id ? $request->cate_id : null;
        $cateArr = $cateChildArr = $loaiThuocTinhArr = (object) [];
        $thuonghieuList = ThuongHieu::all();
        $iconList = Icons::all();
        $thuocTinhArr = [];
        $loaiSpArr = ProductCate::all();
        
        if( $parent_id ){            
            $cateArr = Cate::where('parent_id', $parent_id)->select('id', 'name')->orderBy('display_order', 'desc')->get();
        }

        if( $cate_id ){            
            $cateChildArr = CateChild::where('cate_id', $cate_id)->select('id', 'name')->orderBy('display_order', 'desc')->get();
        }
        $colorArr = Color::all();
    
        return view('backend.product.create', compact('loaiSpArr', 'cateArr', 'colorArr', 'parent_id', 'cate_id', 'cateChildArr', 'iconList', 'thuonghieuList'));
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
            'parent_id' => 'required',
            'name' => 'required',        
            'price' => 'required',            
        ],
        [
            'parent_id.required' => 'Bạn chưa chọn danh mục cha',
            'name.required' => 'Bạn chưa nhập tên sản phẩm',                 
            'price.required' => 'Bạn chưa nhập giá',
            
        ]);

        $dataArr['is_primary'] = isset($dataArr['is_primary']) ? 1 : 0;
        $dataArr['is_hot'] = isset($dataArr['is_hot']) ? 1 : 0;
        $dataArr['is_sale'] = isset($dataArr['is_sale']) ? 1 : 0;        
        
        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);
        $dataArr['slug'] = str_slug($dataArr['name'], '-');
        $dataArr['price'] =(int) str_replace(',', '', $dataArr['price']);
        $dataArr['price_sale'] =(int) str_replace(',', '', $dataArr['price_sale']);
        $dataArr['status'] = 1;

        $dataArr['created_user'] = Auth::user()->id;

        $dataArr['updated_user'] = Auth::user()->id;


        $rs = Product::create($dataArr);

        $product_id = $rs->id;
        if(isset($dataArr['icon_id'])){
            foreach($dataArr['icon_id'] as $k => $icon_id){
                $detailIcon = Icons::find($icon_id);
                ProductIcon::create([
                    'product_id' => $product_id,
                    'icon_id' => $icon_id,
                    'display_order' => $detailIcon->display_order
                ]);
            }
        }
     
        $this->storeImage( $product_id, $dataArr);
        $this->storeMeta($product_id, 0, $dataArr);
        Session::flash('message', 'Tạo mới sản phẩm thành công');

        return redirect()->route('product.index', ['parent_id' => $dataArr['parent_id'], 'cate_id' => $dataArr['cate_id']]);
    }
    public function storeImage($product_id, $dataArr)
    {
        #Xoa het hinh cu
        ProductImg::where('product_id', $product_id)->delete();
        //process new image
        foreach ($dataArr['image_tmp_url'] ?? [] as $k => $image_url) {
            $origin_img = public_path() . $image_url;
            if ($image_url) {
                $img = Image::make($origin_img);
                $w_img = $img->width();
                $h_img = $img->height();
                $tmpArrImg = explode('/', $origin_img);
                $new_img = config('gfamily.upload_thumbs_path') . end($tmpArrImg);
                if ($w_img / $h_img > 540 / 600) {
                    Image::make($origin_img)->resize(null, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->crop(540, 600)->save($new_img);
                } else {
                    Image::make($origin_img)->resize(540, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->crop(540, 600)->save($new_img);
                }
                $rs = ProductImg::create(['product_id' => $product_id, 'image_url' => $image_url, 'display_order' => 1, 'locale' => app()->getLocale()]);
                if (isset($dataArr['thumbnail_img']) && ($dataArr['thumbnail_img'] == $image_url)) {
                    $tour = Product::find($product_id);
                    $tour->thumbnail_id = $rs->id;
                    $tour->save();
                };
            }
        }
    }
    public function storeMeta( $id, $meta_id, $dataArr ){
       
        $arrData = ['title' => $dataArr['meta_title'], 'description' => $dataArr['meta_description'], 'keywords'=> $dataArr['meta_keywords'], 'custom_text' => $dataArr['custom_text'], 'updated_user' => Auth::user()->id];
        if( $meta_id == 0){
            $arrData['created_user'] = Auth::user()->id;
            //var_dump(MetaData::create( $arrData ));die;
            $rs = MetaData::create( $arrData );
            $meta_id = $rs->id;
            //var_dump($meta_id);die;
            $modelSp = Product::find( $id );
            $modelSp->meta_id = $meta_id;
            $modelSp->save();
        }else {
            $model = MetaData::find($meta_id);           
            $model->update( $arrData );
        }              
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
        $hinhArr = (object) [];
        $detail = Product::find($id);
        $hinhArr = ProductImg::where('product_id', $id)->pluck('image_url', 'id'); 
        $iconList = Icons::all();
        $loaiSpArr = ProductCate::all();        
        $parent_id = $detail->parent_id;             
        $cateArr = Cate::where('parent_id', $parent_id)->select('id', 'name')->orderBy('display_order', 'desc')->get();
        $meta = (object) [];
        if ( $detail->meta_id > 0){
            $meta = MetaData::find( $detail->meta_id );
        }    
        if( $detail->cate_id ){
            $cateChildArr = CateChild::where('cate_id', $detail->cate_id)->orderBy('display_order', 'desc')->get();
        }else{
            $cateChildArr = (object) [];
        }    
        $icons = $detail->icons;
        $iconArr = [];
        if($icons){
            foreach($icons as $icon){
                $iconArr[] = $icon->icon_id;
            }
        }
        $thuonghieuList = ThuongHieu::all();
        return view('backend.product.edit', compact( 'detail', 'hinhArr', 'loaiSpArr', 'cateArr', 'meta', 'cateChildArr', 'iconList', 'iconArr', 'thuonghieuList'));
    }
    public function ajaxDetail(Request $request)
    {       
        $id = $request->id;
        $detail = Product::find($id);
        return view('backend.product.ajax-detail', compact( 'detail' ));
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
            'parent_id' => 'required',
            'name' => 'required',     
            'price' => 'required',            
        ],
        [
            'parent_id.required' => 'Bạn chưa chọn danh mục cha',
            'name.required' => 'Bạn chưa nhập tên sản phẩm',            
            'price.required' => 'Bạn chưa nhập giá',
            
        ]);

        $dataArr['is_primary'] = isset($dataArr['is_primary']) ? 1 : 0;
        $dataArr['is_hot'] = isset($dataArr['is_hot']) ? 1 : 0;
        $dataArr['is_sale'] = isset($dataArr['is_sale']) ? 1 : 0; 
        $dataArr['slug'] = str_slug($dataArr['name'], '-');
        $dataArr['alias'] = str_slug($dataArr['name'], ' ');
        $dataArr['price'] =(int) str_replace(',', '', $dataArr['price']);
        $dataArr['price_sale'] =(int) str_replace(',', '', $dataArr['price_sale']);
        $dataArr['updated_user'] = Auth::user()->id;
        //echo "<pre>";
       
        $model = Product::find($dataArr['id']);

        $model->update($dataArr);
        
        $product_id = $dataArr['id'];
        ProductIcon::where('product_id', $product_id)->delete();
        if(isset($dataArr['icon_id'])){
            foreach($dataArr['icon_id'] as $k => $icon_id){
                $detailIcon = Icons::find($icon_id);
                ProductIcon::create([
                    'product_id' => $product_id,
                    'icon_id' => $icon_id,
                    'display_order' => $detailIcon->display_order
                ]);
            }
        }

        $this->storeMeta( $product_id, $dataArr['meta_id'], $dataArr);
        $this->storeImage( $product_id, $dataArr);

        Session::flash('message', 'Chỉnh sửa sản phẩm thành công');

        return redirect()->route('product.index', ['parent_id' => $dataArr['parent_id'], 'cate_id' => $dataArr['cate_id']]);
        
    }
    public function ajaxSaveInfo(Request $request){
        
        $dataArr = $request->all();

        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);
        
        $dataArr['updated_user'] = Auth::user()->id;
        
        $model = Product::find($dataArr['id']);

        $model->update($dataArr);
        
        $product_id = $dataArr['id'];        

        Session::flash('message', 'Chỉnh sửa sản phẩm thành công');

    }
    public function storeSoSanh($sp_1, $soSanhArr){
        Compare::where('sp_1', $sp_1)->delete();              
        Compare::where('sp_2', $sp_1)->delete();  
        if( !empty($soSanhArr)){
            foreach( $soSanhArr as $sp_2){
                if( $sp_2 > 0){
                    $check1 = Compare::where('sp_1', $sp_1)->where('sp_2', $sp_2)->first();
                    $check2 = Compare::where('sp_1', $sp_2)->where('sp_2', $sp_1)->first();
                    if( !$check1 && !$check2){
                        Compare::create(['sp_1' => $sp_1, 'sp_2' => $sp_2]);
                    }
                }
            }
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
        $model = Product::find($id);        
        $model->update(['status' => 0]);
        ProductImg::where('product_id', $id)->update(['status' => 0]);  
        // redirect
        Session::flash('message', 'Xóa sản phẩm thành công');        
        return redirect(URL::previous());
        
    }
}
