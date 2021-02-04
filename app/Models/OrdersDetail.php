<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrdersDetail extends Model
{
    protected $table = 'orders_detail';
    protected $primaryKey = 'order_detail_id';

    public function orders()
    {
        return $this->belongsTo('App\Models\Orders','order_id');
    }


    public function products(){
        return $this->belongsTo('App\Models\products', 'products_id');
    }

    
    public function addItemOrderDetail($data){
        return DB::table('orders_detail')->insertGetId($data);
    }


}
