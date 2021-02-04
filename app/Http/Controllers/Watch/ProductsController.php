<?php

namespace App\Http\Controllers\Watch;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Products;
use App\Models\Category;
use App\Models\User;
use App\Models\Orders;
use App\Models\OrdersDetail;
use App\Models\Sale;
use Mail;
use Carbon\Carbon;

class ProductsController extends Controller
{
    public function __construct(Products $product, Category $cat, User $user, Orders $orders,OrdersDetail $ordersdetail, Sale $sale){
        $this->product = $product;
        $this->cat = $cat;
        $this->user = $user;
        $this->orders =$orders;
        $this->ordersdetail = $ordersdetail;
        $this->sale = $sale;
        
    }
    public function products($slug,$cat_id){
        $listProductsCat = $this->product->getListProductsCat($cat_id);
    	return view('watch.watch.products',compact('listProductsCat'));
    }

    public function single($slug,$products_id){
        $category_single = $this->cat->getListCategory();
        $itemProductSingle = $this->product->getItemProductSingle($products_id);
    	return view('watch.watch.single',compact('itemProductSingle','category_single'));
    }

    

    public function checkout(){
       
    	return view('watch.watch.checkout');
    }


    //ajax đặt hàng
    public function postcheckout(Request $request){
        $content = $request->content;
        $mail_to = Auth::user()->email;
        $user_id = Auth::user()->id;
        $fullname = Auth::user()->fullname;
        $methodPayment = $request->payment;
        //dd($methodPayment);

        if($methodPayment == "paypal"){
            $methodPayment = 2;
            $order_status = 1;

        }else{
            $methodPayment = 1;
            $order_status = 0;
        }
         
        $listCart = session()->get('cart');

        $address = $request->address;

        $total = 0;
            foreach ($listCart as $product) {
               $total = $total + $product['totalPirce'];
               
            }
            $sale =  session()->get('sale');
            if($sale){
                $totalPirce = $total - ($total*$sale)/100;
            }else{
                $totalPirce = $total;
            }
            
            Carbon::setLocale('vi'); // hiển thị ngôn ngữ tiếng việt.
            $date_Now = Carbon::now();
            $order_code = strtoupper(substr(md5(microtime()), rand(0, 26), 5));
            $dataOrder = [
                            'id'                =>  $user_id,
                            'order_address'     =>  $address,
                            'order_total_money' =>  $totalPirce,
                            'order_status'      =>  $order_status,
                            'order_method'      =>  $methodPayment,
                            'order_datetime'    =>  $date_Now,
                            'order_content'     =>  $content,
                            'order_code'        =>  $order_code

                        ];
            //dd($dataOrder);
            $order_id = $this->orders->addItemOrder($dataOrder);
            if($order_id){
                foreach ($listCart as $product){
                    $products_id = $product['id_products'];
                    $order_quantity = $product['quantity'];
                    //$orders_discount = $product['sale'];
                    $data = [
                                'order_id'  =>  $order_id,
                                'products_id'   =>  $products_id,
                                'order_detail_quantity' =>  $order_quantity,
                                'order_discount'    =>  0
                            ];
                    $order_detail = $this->ordersdetail->addItemOrderDetail($data);
                }
                if($order_detail){
                        $sale_code = strtoupper(substr(md5(microtime()), rand(0, 26), 5));
                        $data = [
                                    'sale_name' =>  'Mã Giảm Giá Cho Khách Hàng',
                                    'sale_percent'  =>  5,
                                    'sale_status'   =>  1,
                                    'sale_code'     =>  $sale_code
                                ];
                        $add_code_sale = $this->sale->addIteSaleCode($data);
                        if($add_code_sale){
                            $data =[
                                        'header' => 'Đơn hàng thành công',
                                        'slot' => 'Chúc mừng bạn đặt hàng thành công, Đơn hàng của bạn sẽ về trong 3-5 ngày tới.',
                                        'subcopy' => 'Đây là mã giảm giá cho lần mua sắp tới mong bạn áp dụng để nhận nhiều ưu đãi của của hàng chúng tôi  :  '.$sale_code,
                                        'footer'=>'!'
                                    ];
                            Mail::send('vendor.mail.html.layout', $data, function($message) use($mail_to,$fullname){
                                $message->to($mail_to, $fullname)->subject('Đặt hàng thành công');
                                $message->from('lamvantan03@mail',"Watch luxry");
                            });
                            
                        }
                }
            }
        
        session()->forget(['cart','sale']);
        return view('watch.watch.order-complete');
    }

//giảm giá ajax
    public function discount(Request $request){
        $code = $request->code;
        $itemCodeSale = $this->sale->itemCodeSale($code);
         if($itemCodeSale){   
            $sale_percent = $itemCodeSale->sale_percent;
            $sale_id = $itemCodeSale->sale_id;
            session()->put('sale',$sale_percent);    
            $sale = session()->get('sale');
            $listCart = session()->get('cart'); 

            $delSaleCode = $this->sale->deleteSaleCode($sale_id);
           
                echo "<span>Giảm Giá:</span> 
                      <span>{$sale} %</span>";
                //return view('watch.watch.cart','listCart');
            }
            else
            {
                $sale = session()->get('sale');
                if($sale) 
                {
                    $sale = $sale;
                    echo "<span>Giảm Giá:</span> 
                      <span>{$sale} % <script>alert('Mã đã được áp dụng');</script> </span>";
                }
                else
                {
                    $sale = '';
                    echo "<span>Giảm Giá:</span> 
                      <span>{$sale} <script>alert('Mã đã được áp dụng');</script> </span>";
                }
                 
                
                
            }
            
         
     }

//tìm kiếm ajax
    public function search(Request $request){
        $nameProduct = $request->name;
        $listNameProduct = $this->product->getlistItemSearch($nameProduct);
        foreach ($listNameProduct as $item) {
            $img = $item->images[0]->images_name;
            $urlPic = '/storage/app/public/files/'.$img; 
            $slug = Str::slug($item->products_name);
            $urlSingle = route('watch.watch.single',[ $slug, $item->products_id]);
            // echo "<a href ='{$urlSingle}'>
            //         <div class='row p-2' '>
            //             <div class='col-sm-5 col-md-3'><img src='{$urlPic}' style='width:60px; height:60px;' ></div>
            //             <div class='col-sm-7 col-md-9'>{$item->products_name}</div>
            //         </div>
            //     </a>
            //     ";
            echo "<div class='alert  alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                     <strong>
                     <a href ='{$urlSingle}' style='font-size:12px'>
                     <img src='{$urlPic}' style='width:40px; height:40px;' >
                     {$item->products_name}
                     </a>
                     </strong>
                </div>";
        }
        
    }

//phan đơn hàng mua người dùng
    public function purchase_menu(){
        $user_id = Auth::user()->id;
        //echo $user_id;
        $listCheckoutCus = $this->orders->listCheckoutCus($user_id);
        $orderdetail = OrdersDetail::all();
        $products = Products::all();
        return view('watch.watch.purchase_menu',compact('listCheckoutCus','orderdetail','products'));
    }

//phần đơn hàng mua xử lý ajax
    public function checkoutCustomer(Request $request){
        $order_id = $request->order_id;
        $order_status = $request->order_status;

        if($order_status == 6){
            $order_status = 0;
        }

        $data = [
                    'order_status'=>$order_status
                ];

        //dd($data);
        $resultStatus = $this->orders->updateOrder($data,$order_id);
        //dd($resultStatus);

        if($resultStatus){
            $showStatus = $this->orders->getItemAjaxStatus($order_id);
            $result_order_status = $showStatus->order_status;
            if($result_order_status == 0)
            {
                 $order_status = "Chờ Xác nhận";
                 $label = "badge badge-warning";

            }
            else if($result_order_status == 1)
            {
                 $order_status = "Đã xác nhận";
                 $label = "badge badge-info";
            }
            else if($result_order_status == 2)
            {
                 $order_status = "Đang giao hàng";
                 $label = "badge badge-secondary";
            }
            else if($result_order_status == 3)
            {
                 $order_status = "Nhận hàng";
                 $label = "badge badge-light";

            }else if($result_order_status == 4){
                $order_status = "Thành công";
                $label = "badge badge-success";
            }else if($result_order_status == 5){
                $order_status = "Đã hủy đơn hàng";
                $label = "badge badge-danger";
                
            }

            echo "{$order_status}";
        }
    }


    // 
    public function status(){
        $status = $this->orders->status();
        $arr = array();
        foreach($status as $item){
           if($item->order_status == 0)
            {
                 $order_status = "Chờ Xác nhận";
                 $label = "badge badge-warning";

            }
            else if($item->order_status == 1)
            {
                 $order_status = "Đã xác nhận";
                 $label = "badge badge-info";
            }
            else if($item->order_status == 2)
            {
                 $order_status = "Đang giao hàng";
                 $label = "badge badge-secondary";
            }
            else if($item->order_status == 3)
            {
                 $order_status = "Nhận hàng";
                 $label = "badge badge-light";

            }else if($item->order_status == 4){
                $order_status = "Thành công";
                $label = "badge badge-success";
            }else if($item->order_status == 5){
                $order_status = "Đã hủy đơn hàng";
                $label = "badge badge-danger";  
            }

            if($item->order_status == 3){
                $orderstatus = 4;
                $arr[] = "<label class='{$label} p-2' 
                            onclick='checkoutCustomer({$item->order_id}, {$orderstatus})'>
                            {$order_status}
                         </label>";
            }else{
                $arr[] = "<label class='{$label} p-2'>{$order_status}</label>";
            }
        }
        return $arr;
    }


    public function getsearch(){
        return view('watch.watch.search');
    }


    public function payment(Request $request){
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        //$vnp_Returnurl = "http://localhost/vnpay_php/vnpay_return.php";
        $vnp_TmnCode = "Y4U88XFK";//Mã website tại VNPAY 
        $vnp_HashSecret = "DTHXNFNBUMNKFKQOZVHTXUXNUQUUXMTV"; //Chuỗi bí mật
        $vnp_ReturnUrl = route('payment-vnpay');

        $vnp_TxnRef = $request->order_id;//Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_desc;
        $vnp_OrderType = $request->order_type;
        $vnp_Amount = $request->amount * 100;
        $vnp_Locale = $request->language;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $vnp_BankCode = $request->bank_code;
        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,   
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_TxnRef" => $vnp_TxnRef,    
        );
        ksort($inputData);
        // if(isset($vnp_BankCode) && $vnp_BankCode != ''){
        //     //$inputData
        // }
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash('sha256',$vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect()->to($vnp_Url);
    }

    public function getpayment(Request $request){
        $data = $request->all();
        //dd($data);
        $vnp_SecureHash = $data['vnp_SecureHash'];
        $vnp_HashSecret = "DTHXNFNBUMNKFKQOZVHTXUXNUQUUXMTV";
        $inputData = array();
        foreach ($_GET as $key => $value) {
            $inputData[$key] = $value;
        }
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . $key . "=" . $value;
            } else {
                $hashData = $hashData . $key . "=" . $value;
                $i = 1;
            }
        }

        $secureHash = hash('sha256',$vnp_HashSecret . $hashData);
    
        
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                echo "GD Thanh cong";
            } else {
                echo "GD Khong thanh cong";
            }
        } else {
            echo "Chu ky khong hop le";
        }
    }
}


