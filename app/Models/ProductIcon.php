<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProductIcon extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'product_icon';	

	 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'icon_id', 'display_order'];

    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    public function icon(){
        return $this->belongsTo('App\Models\Icons', 'icon_id');
    }
    
}
