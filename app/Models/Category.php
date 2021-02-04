<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Category extends Model
{
   
    protected $table = 'category';
    protected $primaryKey = 'cat_id';

    public function products()
    {
        return $this->hasMany('App\Models\Products','cat_id');
    }

    //admin index, add,
    public function getListItem(){
    	return DB::table('category')->orderBy('cat_id','desc')->get();
    }

    //post add
    Public function addCategory($data){
    	return DB::table('category')->insert($data);
    }

    public function getItemEdit($cat_id){
    	return $this->findOrFail($cat_id);
    }

    public function editCategory($data,$cat_id){
    	return DB::table('category')
    	->where('cat_id',$cat_id)
        ->update($data);
    }

    public function deleteCategory($cat_id){
    	return DB::table('category')
        ->where('cat_id',$cat_id)
        ->delete();
    }

    public function getItemAjaxStatus($cat_id){
        return $this->findOrFail($cat_id);
    }



    //giao dien public single
    public function getListCategory(){
        return Category::all();
    }
}
