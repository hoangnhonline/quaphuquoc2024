<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Icons extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'icons';	

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
    protected $fillable = ['image_url', 'content', 'status', 'display_order'];
    
}