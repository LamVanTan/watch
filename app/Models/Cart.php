<?php

namespace App\Models;

use Illuminate\Support\Facades\Session;

class cart
{
    public function add($id_products, $itemProductCart,$quantity,$quantity_products)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id_products])){
            $sale = $itemProductCart->sale_id;
            if($quantity > $quantity_products){       
                //dd($sale);
               if($sale){
                    $cart[$id_products]['quantity'] = $quantity_products;
                    $cart[$id_products]['totalPirce'] =  ($cart[$id_products]['pricediscount'] * $cart[$id_products]['quantity'] ) ;
                }else{
                    $cart[$id_products]['quantity'] = $quantity_products;
                    $cart[$id_products]['totalPirce'] = $cart[$id_products]['quantity'] * $cart[$id_products]['price'];
                }
                
                session()->put('cart',$cart);
            }
          
            else{
               
                if($sale){
                    $cart[$id_products]['quantity'] += $quantity;
                    $cart[$id_products]['totalPirce'] = ($cart[$id_products]['pricediscount'] * $cart[$id_products]['quantity'] );
                }else{
                    $cart[$id_products]['quantity'] += $quantity;
                    $cart[$id_products]['totalPirce'] = $cart[$id_products]['quantity'] * $cart[$id_products]['price'];
                }
                
                session()->put('cart',$cart);
            }
            
            
            
        }else{
            $sale = $itemProductCart->sale_id;
            if($quantity > $quantity_products){
                
                //dd($sale);
               if($sale){
                    $cart[$id_products] = [
                        'id_products'   =>  $id_products,
                        'name'          =>  $itemProductCart->products_name,
                        'price'         =>  $itemProductCart->products_price,
                        'pricediscount' =>  (($itemProductCart->products_price) - 
                                            (($itemProductCart->sale->sale_percent * 
                                            $itemProductCart->products_price)/100)),
                        'quantity'      =>  $quantity_products,
                        'sale'          =>  $itemProductCart->sale->sale_percent,
                        'images'        =>  $itemProductCart->images[0]->images_name,
                        'totalPirce'    =>  (($quantity * ($itemProductCart->products_price)) - 
                                            (($itemProductCart->products_price) * 
                                            $itemProductCart->sale->sale_percent/100)),
                    ];
                }else{
                    $cart[$id_products] = [
                        'id_products'   =>  $id_products,
                        'name'          =>  $itemProductCart->products_name,
                        'pricediscount' =>  $itemProductCart->products_price,
                        'price'         =>  $itemProductCart->products_price,
                        'quantity'      =>  $quantity_products,
                        'sale'          =>  0,
                        'images'        =>  $itemProductCart->images[0]->images_name,
                        'totalPirce'    =>  $quantity * $itemProductCart->products_price,
                    ];
                }
            }else{
                
                if($sale){
                    $cart[$id_products] = [
                        'id_products'   =>  $id_products,
                        'name'          =>  $itemProductCart->products_name,
                        'price'         =>  $itemProductCart->products_price,
                        'pricediscount' =>  (($itemProductCart->products_price) - 
                                            (($itemProductCart->sale->sale_percent * 
                                            $itemProductCart->products_price)/100)),
                        'quantity'      =>  $quantity,
                        'sale'          =>  $itemProductCart->sale->sale_percent,
                        'images'        =>  $itemProductCart->images[0]->images_name,
                        'totalPirce'    =>  ( $quantity * ($itemProductCart->products_price) - 
                            (
                            (($itemProductCart->products_price) * $quantity)*$itemProductCart->sale->sale_percent/100)),
                    ];
                }else{
                    $cart[$id_products] = [
                        'id_products'   =>  $id_products,
                        'name'          =>  $itemProductCart->products_name,
                        'price'         =>  $itemProductCart->products_price,
                        'pricediscount' =>  $itemProductCart->products_price,
                        'quantity'      =>  $quantity,
                        'sale'          =>  0,
                        'images'        =>  $itemProductCart->images[0]->images_name,
                        'totalPirce'    =>  $quantity * $itemProductCart->products_price,
                    ];
                } 
                
            }
           session()->put('cart',$cart);
           
        }
    }
   
    public function changeQuantity($id_products, $quantity,$quantity_products,$itemProductCart)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id_products])){

            if($quantity > $quantity_products){
                $sale = $itemProductCart->sale_id;
               if($sale){
                    $cart[$id_products]['quantity'] = $quantity_products;
                    $cart[$id_products]['totalPirce'] =  (($cart[$id_products]['price'] * $cart[$id_products]['quantity'] ) - ((($cart[$id_products]['price'] * $cart[$id_products]['quantity'] )* $cart[$id_products]['sale'])/100));
                }else{
                    $cart[$id_products]['quantity'] = $quantity_products;
                    $cart[$id_products]['totalPirce'] = $cart[$id_products]['quantity'] * $cart[$id_products]['price'];
                }
                
            }elseif($quantity < 1){
                $sale = $itemProductCart->sale_id;
                if($sale){
                    $cart[$id_products]['quantity'] = 1;
                    $cart[$id_products]['totalPirce'] =  (($cart[$id_products]['price'] * $cart[$id_products]['quantity'] ) - ((($cart[$id_products]['price'] * $cart[$id_products]['quantity'] )* $cart[$id_products]['sale'])/100));
                }else{
                    $cart[$id_products]['quantity'] = 1;
                    $cart[$id_products]['totalPirce'] = $cart[$id_products]['quantity'] * $cart[$id_products]['price'];
                }
                
                
            }else{
                $sale = $itemProductCart->sale_id;
                if($sale){
                    $cart[$id_products]['quantity'] = $quantity;
                    $cart[$id_products]['totalPirce'] =  (($cart[$id_products]['price'] * $cart[$id_products]['quantity'] ) - ((($cart[$id_products]['price'] * $cart[$id_products]['quantity'] )* $cart[$id_products]['sale'])/100));
                }else{
                    $cart[$id_products]['quantity'] = $quantity;
                    $cart[$id_products]['totalPirce'] = $cart[$id_products]['quantity'] * $cart[$id_products]['price'];
                }
                
            } 
                
              session()->put('cart',$cart);   
            
        }
    }
   
    public function remove($id_products)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id_products])){
            unset($cart[$id_products]);
            session()->put('cart', $cart);
        }
    }
   
}