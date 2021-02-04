<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Images extends Model
{
   
    protected $table = 'images';
    protected $primaryKey = 'images_id';

	public function products()
	{
	    return $this->belongsTo('App\Models\Products','products_id');
	}

    public function addImages($data){
    	return DB::table('images')->insert($data); 
    }

    public function editImages($data,$idPic){
        return DB::table('images')
        ->where('images_id',$idPic)
        ->update($data);
    }

    public function deleteItemPicture($idPic){
        return DB::table('images')
        ->where('images_id',$idPic)
        ->delete();
    }
}
