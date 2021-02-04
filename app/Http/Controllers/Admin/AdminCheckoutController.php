<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;
use App\Models\User;
use App\Models\Orders;
use App\Models\OrdersDetail;
use Carbon\Carbon;
class AdminCheckoutController extends Controller
{
	public function __construct(Orders $order,OrdersDetail $orderdetail,Products $product,User $user){
        $this->order = $order;
        $this->orderdetail = $orderdetail;
        $this->product = $product;
        $this->user = $user;
    }

    public function index(){
        // Carbon::setLocale('vi');
        // $timeLocal = Carbon::now();
    	$listOrder = $this->order->getListOrder();
        
        $orderdetail = OrdersDetail::all();
        $products = Products::all();
    	return view('admin.checkout.index',compact('listOrder','orderdetail','products'));
    }

    public function ajaxcheckout(Request $request){
        $order_id = $request->order_id;
        $order_status = $request->order_status;

        if($order_status == 0)
        {
            $order_status = 1;
        }
        else if($order_status == 1)
        {
            $order_status = 2;
        }
        else if($order_status == 2)
        {
            $order_status = 3;
        }
        else if($order_status == 3)
        {
            $order_status = 4;
        }
        // else if ($order_status == 6)
        // {
        //     $order_status = 6;
        // }

        $data = [
                    'order_status'=>$order_status
                ];
        $resultStatus = $this->order->updateOrder($data,$order_id);
        if($resultStatus){
            $showStatus = $this->order->getItemAjaxStatus($order_id);
            $result_order_status = $showStatus->order_status;
            if($result_order_status == 0)
            {
                 $order_status = "Xác nhận đơn hàng";
                 $label = "badge badge-warning";
            }
            else if($result_order_status == 1)
            {
                 $order_status = "Lấy hàng";
                 $label = "badge badge-info";
            }
            else if($result_order_status == 2)
            {
                 $order_status = "Vận chuyển";
                 $label = "badge badge-secondary";
            }
            else if($result_order_status == 3)
            {
                 $order_status = "Giao hàng";
                 $label = "badge badge-dark";

            }
            elseif($result_order_status == 4){
                 $order_status = " Thành công";
                 $label = "badge badge-success";
            }
            elseif($result_order_status == 5){
                 $order_status = "Hủy đơn hàng";
                 $label = "badge badge-danger";
            }

            
                echo "<label class='{$label} mt-2' 
                        onclick='checkout({$showStatus->order_id}, {$showStatus->order_status})'>
                        {$order_status}
                    </label>";
            

        }
    }


    public function status(){
        $status = $this->order->status();
        $arr = array();
        foreach($status as $item){
           if($item->order_status == 0)
            {
                 $order_status = "Xác nhận đơn hàng";
                 $label = "badge badge-warning";

            }
            else if($item->order_status == 1)
            {
                 $order_status = "Lấy hàng";
                 $label = "badge badge-info";
            }
            else if($item->order_status == 2)
            {
                 $order_status = "Vận chuyển";
                 $label = "badge badge-secondary";
            }
            else if($item->order_status == 3)
            {
                 $order_status = "Giao hàng";
                 $label = "badge badge-light";

            }else if($item->order_status == 4){
                $order_status = "Thành công";
                $label = "badge badge-success";
            }else if($item->order_status == 5){
                $order_status = "Đã hủy đơn hàng";
                $label = "badge badge-danger";  
            }

            
            $arr[] = "<label class='{$label} p-2' onclick='checkout({$item->order_id}, 
                {$item->order_status})'>{$order_status}</label>";
           
        }
        return $arr;
    }
}
