<?php

namespace App\Http\Controllers\Watch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class IndexController extends Controller
{
	public function __construct(Products $product){
		$this->product = $product;
	}
    public function index(){
    	
    	$listItemProductSale = $this->product->getListItemProductsSale();
    	return view('watch.index.index',compact('listItemProductSale'));
    }


    public function shopAll(){
    	$listItemProductAll = $this->product->getListItemProductsAll();
    	return view('watch.index.shopall',compact('listItemProductAll'));
    }
}

