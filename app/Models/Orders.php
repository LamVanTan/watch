<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Orders extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';

    public function orderdetails()
    {
        return $this->hasOne('App\Models\OrdersDetail','order_id');
    }

    public function users(){
        return $this->belongsTo('App\Models\User','id');
    }


    public function addItemOrder($data){
        return DB::table('orders')->insertGetId($data);
    }

    public function getListOrder(){
    	return Orders::orderBy('order_id','desc')->paginate(5);
    }


    public function updateOrder($data,$order_id){
        return DB::table('orders')
        ->where('order_id', $order_id)
        ->update($data);
    }


    public function getItemAjaxStatus($order_id){
        return DB::table('orders')
        ->where('order_id',$order_id)
        ->first();
    }




    //public 
    //
    public function listCheckoutCus($user_id){
        return Orders::where('id',$user_id)
        ->orderBy('order_id','desc')
        ->paginate(5);
    }


    public function status(){
        return DB::table('orders')
        ->select('order_status','order_id')
        ->orderBy('order_id','desc')
        ->get();
    }
}
