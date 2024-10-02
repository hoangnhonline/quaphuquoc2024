<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CustomerNotification extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer_notification';	

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
    protected $fillable = ['customer_id', 'content', 'status', 'seen_at', 'type', 'event_url', 'created_user', 'updated_user', 'order_id'];

    public static function countMessOrderCustomer($customer_id, $order_id){
        return CustomerNotification::where(['order_id' => $order_id, 'customer_id' => $customer_id])->count();        
    }

}
