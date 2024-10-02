<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product';

     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ma_sp', 'name', 'name_extend', 'alias', 'alias_extend', 'slug', 'slug_extend', 'thumbnail_id', 'is_hot', 'is_sale', 'price', 'price_sale', 'parent_id', 'cate_id', 'mo_ta', 'sp_phukien', 'xuat_xu', 'khuyen_mai', 'chi_tiet', 'bao_hanh', 'so_luong_ton', 'sale_percent', 'so_luong_ban', 'status', 'created_user', 'updated_user', 'meta_id', 'views', 'so_lan_mua', 'sp_tuongtu', 'display_order', 'is_primary', 'name_primary', 'color_id','can_nang', 'chieu_dai', 'chieu_cao', 'chieu_rong', 'con_hang', 'khe_ram', 'pro_style', 'image_pro', 'is_event','so_luong_tam', 'cate_child_id', 'thuonghieu_id', 'dung_tich', 'trong_luong', 'huong_dan', 'bao_quan', 'thanh_phan'];
    
    public function prices()
    {
        return $this->hasMany('App\Models\ProductPrice', 'product_id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductImg', 'product_id');
    }

    public function icons()
    {
        return $this->hasMany('App\Models\ProductIcon', 'product_id');
    }
    public function meta()
    {
        return $this->belongsTo('App\Models\MetaData', 'meta_id');
    }
    public function thuonghieu()
    {
        return $this->belongsTo('App\Models\ThuongHieu', 'thuonghieu_id');
    }
    public function thumbnail()
    {
        return $this->belongsTo('App\Models\ProductImg', 'thumbnail_id', 'id');
    }
    public function productCate(){
        return $this->belongsTo('App\Models\ProductCate', 'parent_id');
    }

    public function cate(){
        return $this->belongsTo('App\Models\Cate', 'cate_id');
    }
    public function cateChild(){
        return $this->belongsTo('App\Models\CateChild', 'cate_child_id');
    }
}