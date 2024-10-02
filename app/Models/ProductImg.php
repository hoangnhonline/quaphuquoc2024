<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProductImg extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'product_img';	

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
    protected $fillable = ['product_id', 'image_url', 'display_order', 'status'];

    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    
}
