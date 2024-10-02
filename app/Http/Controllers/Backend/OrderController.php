<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Models\Orders;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Product;
use DB;
use Mail;
class OrderController extends Controller
{
    protected $list_status = [
        0 => 'Chờ xử lý',
        1 => 'Đang giao hàng',    
        3 => 'Đã hoàn thành',
        4 => 'Đã huỷ'    
      ];

    public function index(Request $request){     
        $arrSearch['status'] = $status = isset($request->status) ? $request->status : -1;
        $arrSearch['date_from'] = $date_from = isset($request->date_from) && $request->date_from !='' ? $request->date_from : date('d-m-Y');
        $arrSearch['date_to'] = $date_to = isset($request->date_to) && $request->date_to !='' ? $request->date_to : date('d-m-Y');
        $arrSearch['name'] = $name = isset($request->name) && trim($request->name) != '' ? trim($request->name) : '';       


        $arrSearch['time_type'] = $time_type = $request->time_type ? $request->time_type : 1;       

        $use_df_default =  date('d/m/Y', time());
        $arrSearch['created_at_from'] = $created_at_from = $request->created_at_from ? $request->created_at_from : $use_df_default;
        $arrSearch['created_at_to'] = $created_at_to = $request->created_at_to ? $request->created_at_to : $created_at_from;
        $arrSearch['month'] = $month = $request->month ?? date('m');
        $arrSearch['year'] = $year = $request->year ?? date('Y'); ;
        $mindate = "$year-$month-01";
        $maxdate = date("Y-m-t", strtotime($mindate));
      
        $created_at_from_format = $created_at_to_format = null;

        $query = Orders::whereRaw('1');
        if( $status > -1){
            $query->where('status', $status);
        }

        if($time_type == 1){ // theo thangs
            $arrSearch['created_at_from'] = $created_at_from = $created_at = date('d/m/Y', strtotime($mindate));
            $arrSearch['created_at_to'] = $created_at_to = date('d/m/Y', strtotime($maxdate));

            $query->where('created_at','>=', $mindate);
            $query->where('created_at', '<=', $maxdate);

        }elseif($time_type == 2){ // theo khoang ngay
            $arrSearch['created_at_from'] = $created_at_from = $created_at = $request->created_at_from ? $request->created_at_from : date('d/m/Y', time());
            $arrSearch['created_at_to'] = $created_at_to = $request->created_at_to ? $request->created_at_to : $created_at_from;

            if($created_at_from){
                $arrSearch['created_at_from'] = $created_at_from;
                $tmpDate = explode('/', $created_at_from);
                $created_at_from_format = $tmpDate[2].'-'.$tmpDate[1].'-'.$tmpDate[0];
                $query->where('created_at','>=', $created_at_from_format);              
            }
            if($created_at_to){
                $arrSearch['created_at_to'] = $created_at_to;
                $tmpDate = explode('/', $created_at_to);
                $created_at_to_format = $tmpDate[2].'-'.$tmpDate[1].'-'.$tmpDate[0];
                if($created_at_to_format < $created_at_from_format){
                    $arrSearch['created_at_to'] = $created_at_from;
                    $created_at_to_format = $created_at_from_format;
                }
                $query->where('created_at', '<=', $created_at_to_format);               
            }
            
        }else{
            $arrSearch['created_at_from'] = $created_at_from = $arrSearch['created_at_to'] = $created_at_to = $created_at = $request->created_at_from ? $request->created_at_from : date('d/m/Y', time());

            $tmpDate = explode('/', $created_at_from);
            $created_at_from_format = $tmpDate[2].'-'.$tmpDate[1].'-'.$tmpDate[0];
            $query->where('created_at','=', $created_at_from_format);           
           
        }
       
        if( $name != '' ){            
            $query->whereRaw(" ( email LIKE '%".$name."%' ) OR ( full_name LIKE '%".$name."%' )");
        }
        $orders = $query->orderBy('orders.id', 'DESC')->paginate(20);
        $list_status = $this->list_status;
       
        return view('backend.order.index', compact('orders', 'list_status', 'time_type', 'arrSearch', 'month', 'year'));
    }


    public function orderDetail(Request $request, $order_id)
    {
        $order = Orders::find($order_id);
        $order_detail = OrderDetail::where('order_id', $order_id)->get();
       
        $list_status = $this->list_status;
        $arrSearch['status'] = $request->status;
        $arrSearch['name'] = $request->name;
        $arrSearch['date_from'] = $request->date_from;
        $arrSearch['date_to'] = $request->date_to;

        return view('backend.order.detail', compact('order', 'order_detail', 'list_status', 's'));
    }

    public function orderDetailDelete(Request $request)
    {
        $order_id = $request->order_id;
        $order_detail_id = $request->order_detail_id;

        $order = Orders::find($order_id);
        $order_detail = OrderDetail::find($order_detail_id);

        $order->tien_thanh_toan -= $order_detail->tong_tien;
        $order->tong_tien       -= $order_detail->tong_tien;
        $order->save();

        OrderDetail::destroy($order_detail_id);
        return 'success';
    }

    public function update(Request $request){
        $status_id   = $request->status_id;
        $order_id    = $request->order_id;
        $customer_id = $request->customer_id;

        Orders::where('id', $order_id)->update([
            'status' => $status_id
        ]);
        //get customer to send mail
        $customer = Customer::find($customer_id);
        $order = Orders::find($order_id);
        $method_id = $order->method_id;
        //check to choose which mail will be sent

        switch ($status_id) {
            case "1":
                /*Mail::send('frontend.email.ready',
                    [
                        'customer' => $customer,
                        'order'    => $order
                    ],
                    function($message) use ($customer, $method_id) {
                        $message->subject('Cảm ơn bạn đã đặt hàng tại iCho.vn');
                        $message->to($customer->email);
                        $message->from('gfamily.vn@gmail.com', 'iCho.vn');
                        $message->sender('gfamily.vn@gmail.com', 'iCho.vn');
                });*/
                break;
            case "3":
                $orderDetail = OrderDetail::where('order_id', $order_id)->get();
                foreach($orderDetail as $detail){
                    $product_id = $detail->product_id;                    
                    $so_luong = $detail->so_luong;
                    $modelProduct = Product::find($product_id);
                    $so_luong_ton =  $modelProduct->so_luong_ton - $so_luong;
                    $so_luong_ton  = $so_luong_ton > 0 ? $so_luong_ton : 0;
                    $modelProduct->update(['so_luong_ton' => $so_luong_ton]);
                }
                /*Mail::send('frontend.email.thanks',
                    [],
                    function($message) use ($customer) {
                        $message->subject('Cảm ơn bạn đã đặt hàng tại Icho.vn');
                        $message->to($customer->email);
                        $message->from('gfamily.vn@gmail.com', 'gfamily.vn');
                        $message->sender('gfamily.vn@gmail.com', 'gfamily.vn');
                });*/
                break;            
            case "4":

                break;
            default:

                break;
        }
        // Mail::send('frontend.email.cart',
        //     [
        //         'customer'          => $customer,
        //         'order'             => $getOrder,
        //         'arrProductInfo'    => $arrProductInfo
        //     ],
        //     function($message) use ($email) {
        //         $message->subject('Đơn đặt hàng tại Icho.vn');
        //         $message->to($email);
        //         $message->from('gfamily.vn@gmail.com', 'gfamily.vn');
        //         $message->sender('gfamily.vn@gmail.com', 'gfamily.vn');
        // });
        return 'success';
    }
}
