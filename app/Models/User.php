<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email', 'password','permission',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function order(){
        return $this->hasMany('App\Models\Orders', 'id');
    }


    public function addRegister($data){
        return DB::table('users')->insert($data);
    }
    
    // public function addItemUser($data){
    //     return DB::table('users')->insertGetId($data);
    // }

    public function forgotPassword($data,$email){
        return DB::table('users')->where('email',$email)->update($data);
    }


    //admin
    public function addItemUsers($data){
        return DB::table('users')->insert($data);
    }
    
    public function getItemUsers($id){
        return  DB::table('users')
        ->where('id',$id)
        ->first();
    }
    public function getListUser(){
        return  DB::table('users')
        ->orderBy('id','desc')
        ->paginate(5);
    }

    public function editItemUsers($data,$id){
        return DB::table('users')->where('id',$id)->update($data);
    }

    public function deleteItemUsers($id){
        return DB::table('users')->where('id',$id)->delete();
    }
}
