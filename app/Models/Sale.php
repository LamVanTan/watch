<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Sale extends Model
{
    
    protected $table = 'sale';
    protected $primaryKey = 'sale_id';

    public function products()
    {
        return $this->hasMany('App\Models\Products','sale_id');
    }

    public function getListSale(){
    	return Sale::orderBy('sale_id','DESC')->paginate(5);
    }

    public function addItemSale($data){
        return DB::table('sale')->insert($data);
    }

    public function getItemSale($sale_id){
        return $this->findOrFail($sale_id);
    }

    public function editItemSale($data,$sale_id){
        return DB::table('sale')
        ->where('sale_id',$sale_id)
        ->update($data);
    }

    public function deleteItemSale($sale_id){
        return DB::table('sale')
        ->where('sale_id',$sale_id)
        ->delete();
    }

    public function addIteSaleCode($data){
        return DB::table('sale')->insert($data);
    }

    public function itemCodeSale($code){
        return DB::table('sale')->where('sale_code',$code)->first();
    }

    public function deleteSaleCode($sale_id){
        return DB::table('sale')
        ->where('sale_id',$sale_id)
        ->delete();
    }
}
