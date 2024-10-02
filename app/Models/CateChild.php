<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CateChild extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cate_child';	

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
    protected $fillable = ['cate_id', 'name', 'slug', 'alias', 'parent_id', 'bg_color', 'is_hot', 'status', 'icon_url', 'display_order', 'description', 'home_style', 'meta_id', 'created_user', 'updated_user', 'menu_ngang', 'menu_doc'];

    public function cate()
    {
        return $this->belongTo('App\Models\Cate', 'cate_id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'cate_child_id');
    }

    public function banners()
    {
        return $this->hasMany('App\Models\Banner', 'object_id')->where('object_type', 2);
    }
}
