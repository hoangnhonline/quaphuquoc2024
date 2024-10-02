<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ThuocTinh extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'thuoc_tinh';	

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
    protected $fillable = ['name', 'alias', 'status', 'parent_id', 'loai_thuoc_tinh_id','display_order', 'created_user', 'updated_user'];

    public function thuocTinh()
    {
        return $this->hasMany('App\Models\ThuocTinh', 'parent_id');
    }
}
