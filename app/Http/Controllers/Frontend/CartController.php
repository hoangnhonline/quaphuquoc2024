<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ProductCate;
use App\Models\Cate;
use App\Models\Product;
use App\Models\ProductImg;
use App\Models\City;
use App\Models\Orders;
use App\Models\OrderDetail;
use App\Models\Customer;
use Helper, File, Session, Auth;
use Mail;

class CartController extends Controller
{

    public static $loaiSp = [];
    public static $loaiSpArrKey = [];


    /**
    * Session products define array [ id => quantity ]
    *
    */

    public function __construct(){
        // Session::put('cart', [
        //     '1' => 2,
        //     '3' => 3
        // ]);
        // Session::put('login', true);
        // Session::put('userId', 1);
        // Session::forget('login');
        // Session::forget('userId');

    }
    public function index(Request $request)
    {
        if ( Session::has('cart') && Session::get('cart') ) {
        $cart = Session::get('cart');
        $productIdArr = array_keys($cart);
        $arrProductInfo = Product::whereIn('product.id', $productIdArr)
                            ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')
                            ->select('product_img.image_url', 'product.*')->get();
        
        $seo['title'] = $seo['description'] = $seo['keywords'] = "Giỏ hàng";
        // dd($cart);
        return view('frontend.cart.index', compact('arrProductInfo', 'cart', 'seo'));
        } else {
            $seo['title'] = $seo['description'] = $seo['keywords'] = "Giỏ hàng";
            return view('frontend.cart.index',compact('seo'));
        }
    }

    public function update(Request $request)
    {
        $listProduct = Session::get('cart');
        if($request->quantity) {
            $listProduct[$request->id] = $request->quantity;
        } else {
            unset($listProduct[$request->id]);
        }
        Session::put('cart', $listProduct);
        return 'sucess';
    }

    public function addProduct(Request $request)
    {
        $product_id = $request->product_id;
        $amount = $request->amount ?? 1;
        $cart = Session::get('cart');
        
        if(!empty($cart[$product_id])) {
            $cart[$product_id]['amount'] += $amount;            
        } else {
            $detailProduct = Product::find($product_id);
            $price = $detailProduct->is_sale && $detailProduct->price_sale > 0 ? $detailProduct->price_sale : $detailProduct->price;

            $cart[$product_id]['amount'] = $amount;
            $cart[$product_id]['name'] = $detailProduct->name;
            $cart[$product_id]['price'] = $price;
            $cart[$product_id]['slug'] = $detailProduct->slug;
            $cart[$product_id]['image_url'] = $detailProduct->thumbnail->image_url;       

        }        
        
        $cart[$product_id]['total_price'] = $cart[$product_id]['amount']*$cart[$product_id]['price'];
        
        Session::put('cart', $cart);

        return 'success';
    }
    public function removeProduct(Request $request)
    {
        $product_id = $request->product_id;
        $cart = Session::get('cart');
      
        if(!empty($cart[$product_id])) {
            unset($cart[$product_id]);
        }

        Session::put('cart', $cart);

        return 'success';
    }

    public function checkout(Request $request)
    {
        if ( Session::has('cart') && Session::get('cart') )  {
            $cart = Session::get('cart');
            $listCity = City::orderBy('display_order')->get();

            $seo['title'] = $seo['description'] = $seo['keywords'] ='Thanh Toán';
            return view('frontend.cart.checkout', compact('seo', 'listCity', 'cart'));

        } else {
            return redirect()->route('cart');;
        }
    }

    public function storeOrder(Request $request)
    {
        $dataArr = $request->all();

        $this->validate($request,[
            'full_name' => 'required',
            'phone' => 'required',
            'email' => 'email',
            'city_id' => 'required',
            'address' => 'required',
        ],
        [
            'full_name' => 'Vui lòng nhập họ tên',
            'phone' => 'Vui lòng nhập số điện thoại',
            'email.email' => 'Email không hợp lệ',
            'city_id.required' => 'Vui lòng chọn tỉnh/thành',
            'address.required' => 'Vui lòng nhập địa chỉ',
        ]);

        $cart = Session::get('cart');
        if(!$cart){
            return redirect()->route('home');
        }
        // foreach lấy tổng tiền, tổng sản phẩm....
        $totalPrice=0;
        $totalAmount=0;
        foreach ($cart as $product_id => $product) {
            $totalPrice += $product['total_price'];
            $totalAmount += $product['amount'];
        }
        ///
        $order['tong_tien'] = $totalPrice;
        $order['tong_sp'] = $totalAmount;
        $order['giam_gia'] = 0;        
        $order['customer_id'] = 0;
        $order['status'] = 0;
        $order['coupon_id'] = 0; 
        $order['city_id']  = isset($dataArr['city_id']) ? $dataArr['city_id']: null;
        $order['district_id']  = isset($dataArr['district_id']) ? $dataArr['district_id'] : null;
        $order['ward_id']  = isset($dataArr['ward_id']) ? $dataArr['ward_id']: null;
        $order['address']  = $dataArr['address'] ?? null;        
        $order['full_name']  = $dataArr['full_name'];
        $order['email']  = $dataArr['email'] ?? null;
        $order['phone']  = $dataArr['phone'];
        $order['address_type']  = 1;
        $order['method_id'] = $dataArr['method_id'];

        // check if ho chi minh free else 150k

        $order['phi_giao_hang'] = 0;
        $order['phi_cod'] = 0;
        //$order['service_fee'] = Session::get('totalServiceFee') ? Session::get('totalServiceFee') : 0;
        $order['service_fee'] = 0;
        
        $order['tong_tien'] = $order['tien_thanh_toan'] = $order['tong_tien'] + $order['phi_giao_hang'] + $order['service_fee'] + $order['phi_cod'];
       
       // $city_id = isset($vangLaiArr['city_id']) ? $vangLaiArr['city_id'] :  $customer->city_id;
       // $arrDate = Helper::calDayDelivery( $city_id );
        
       // $order['ngay_giao_du_kien'] = implode(" - ", $arrDate);


        $rsOrder = Orders::create($order);

        $order_id = $rsOrder->id;

        $orderDetail['order_id'] = $order_id;
       
        foreach ($cart as $product_id => $product) {            
            # code...
            $orderDetail['product_id']        = $product_id;
            $orderDetail['so_luong']     = $product['amount'];
            $orderDetail['don_gia']      = $product['price'];
            $orderDetail['tong_tien']    = $product['total_price'];
            //$orderDetail['so_dich_vu']    = isset($service_fee[$product->id]) ? $service_fee[$product->id]['so_luong'] : 0;
            $orderDetail['so_dich_vu']    =  0;
            //$orderDetail['don_gia_dich_vu']    = isset($service_fee[$product->id]) ? $service_fee[$product->id]['don_gia_dich_vu'] : 0;
            $orderDetail['don_gia_dich_vu']    = 0;
            //$orderDetail['tong_dich_vu']    = isset($service_fee[$product->id]) ? $service_fee[$product->id]['fee'] : 0;
            $orderDetail['tong_dich_vu']    = 0;
            OrderDetail::create($orderDetail); 
           
        }
        $emailArr = ['mystogan1307@gmail.com', 'hoangnhonline@gmail.com'];
        $email = isset($dataArr['email']) ? $dataArr['email'] : null;
        if($email){
            $emailArr = array_merge([$email], $emailArr);
        }
        //send email
        $order_id =str_pad($order_id, 6, "0", STR_PAD_LEFT);
        //$emailArr = [];
       // dd($emailArr);
         if(!empty($emailArr)){
             Mail::send('frontend.email.cart',
                 [
                    'dataArr'          => $dataArr,
                    'order'             => $rsOrder,
                    'cart'              => $cart,          
                    'order_id' => $order_id,
                 ],
                function($message) use ($emailArr, $order_id) {
                    $message->subject('Xác nhận đơn hàng hàng #'.$order_id);
                    $message->to($emailArr);
                    $message->from('chodacsandanang@gmail.com', 'Chợ Đặc Sản Đà Nẵng');
                    $message->sender('chodacsandanang@gmail.com', 'Chợ Đặc Sản Đà Nẵng');
            });
        }
        
        return redirect(route('cart.thanh-cong'));

    }

    public function success(Request $request){

        $getlistProduct = Session::get('cart');
        $is_vanglai = Session::get('is_vanglai') ? Session::get('is_vanglai') : 0;
        
        $vangLaiArr = Session::get('vanglai');
        if(empty($getlistProduct)) {
            return redirect()->route('home');
        }
        $customer_id = Session::get('userId');

        $customer = Customer::find($customer_id);
        $vangLaiArr = Session::get('vanglai');
        // $city_id = $is_vanglai == 1 && isset($vangLaiArr['city_id']) ? $vangLaiArr['city_id'] : $customer->city_id;
        // $arrDate = Helper::calDayDelivery( $city_id );

        $order_id = Session::get('order_id');
        $order_id =str_pad($order_id, 6, "0", STR_PAD_LEFT);
        Session::put('cart', []);
        Session::put('order_id', '');
        Session::forget('is_vanglai');
        Session::forget('vanglai');
        //Session::forget('service_fee');
        //Session::forget('totalServiceFee');
        Session::forget('event_id');
        Session::forget('order_id');

        $seo['title'] = $seo['description'] = $seo['keywords'] = "Đặt hàng thành công";

        return view('frontend.cart.success', compact('order_id', 'customer', 'seo', 'is_vanglai', 'vangLaiArr'));
    }

    public function deleteAll(){
        Session::put('cart', []);
        return redirect()->route('cart');
    }
}

