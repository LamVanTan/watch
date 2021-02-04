<?php

namespace App\Http\Controllers\Watch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cart;
use App\Models\Products;
use Session;
class CartController extends Controller
{
    public function __construct(cart $cart,Products $product){
		$this->cart = $cart;
		$this->product = $product;
	}

    public function cart(){

    	$listCart = session()->get('cart');
        return view('watch.watch.cart_view',compact('listCart'));
    }

    public function addCart(Request $request){
       	
        $quantity = $request->quantity;
        $id_products = $request->id_products;
        //dd($quantity);
        $itemProductCart = $this->product->getItemProductSingle($id_products);
        $quantity_products = $itemProductCart->products_quantity;
        
        $this->cart->add($id_products,$itemProductCart,$quantity,$quantity_products);
        $listCart = session()->get('cart');
       //dd($listCart);
       
        return view('watch.watch.cart',compact('listCart'));
        
        
    }

    public function changeQty(Request $request){
         $id_products =  $request->id_products;
         $quantity = $request->quantity;
         $itemProductCart = $this->product->getItemProductSingle($id_products);
         $quantity_products = $itemProductCart->products_quantity;
         $this->cart->changeQuantity($id_products,$quantity,$quantity_products,$itemProductCart);
         $listCart = session()->get('cart');
         
         return view('watch.watch.cart',compact('listCart'));
    }

    public function removeCart(Request $request){
        $id_products =  $request->id_products;
        $this->cart->remove($id_products);
        $listCart = session()->get('cart');
        return view('watch.watch.cart',compact('listCart'));
    }
}
