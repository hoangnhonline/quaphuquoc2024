<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ArticlesCateParent extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'articles_cate_parent';	

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
    protected $fillable = ['name', 'slug', 'alias', 'is_hot', 'status', 'display_order', 'description', 'meta_title', 'meta_description', 'meta_keywords', 'custom_text', 'image_url'];

    public function cates()
    {
        return $this->hasMany('App\Models\ArticlesCate', 'parent_id');
    }
    public function articles()
    {
        return $this->hasMany('App\Models\Articles', 'parent_id');
    }
}
