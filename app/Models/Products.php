<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Products extends Model
{
     protected $table = 'products';
    protected $primaryKey = 'products_id';
    // protected $fillable = ['products_name'];
    // public $timestamps = false;
    
    // Mối quan hệ
    public function images()
    {
        return $this->hasMany('App\Models\Images','products_id');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category','cat_id');
    }

    public function sale(){
        return $this->belongsTo('App\Models\Sale', 'sale_id');
    }

    public function orderdetails()
    {
        return $this->hasMany('App\Models\OrdersDetail','products_id');
    }


    //admin
    public function getListProducts(){
        return Products::orderBy('products_id','desc')->simplePaginate(5);
    }
    
    
    public function addItemProducts($data){
        return DB::table('products')->insertGetId($data); 
    }

    public function getItemProduct($id){
        return Products::find($id);
    }

    public function editItemProducts($data,$products_id){
        return DB::table('products')
        ->where('products_id',$products_id)
        ->update($data);
    }


    public function deleteItemProduct($products_id){
        return DB::table('products')
        ->where('products_id',$products_id)
        ->delete();
    }


    //giao dien public
    //
    public function getListItemProductsSale(){
        // return DB::table('products')
        // ->whereNotNull('sale_id')
        // ->get();
        return Products::whereNotNull('sale_id')
        ->orderBy('products_id', 'desc')
        ->take(20)
        ->get();
    }

    public function getListItemProductsAll(){
        return Products::orderBy('products_id','desc')->get();
    }
    public function getItemProductSingle($products_id){
        return Products::where('products_id',$products_id)
        ->first();
    }


    public function getListProductsCat($cat_id){
        return Products::where('cat_id',$cat_id)->paginate(8);  
    }

    public function getlistItemSearch($nameProduct){
        return Products::where('products_name','like',"%$nameProduct%")->take(5)->get();
    }

    

}
