<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBrandController extends Controller
{
    public function index(){
    	return view('admin.brand.index');
    }

    public function add(){
    	return view('admin.brand.add');
    }
}
