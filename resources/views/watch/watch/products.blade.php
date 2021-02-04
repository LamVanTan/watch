@extends('templates.watch.master')
@section('main-content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="{{route('watch.index.index')}}">Trang chủ</a></span> / <span>Sản phẩm</span></p>
            </div>
        </div>
    </div>
</div>
<div class="colorlib-product">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                <h2>View All Products</h2>
            </div>
        </div>
        <div class="row row-pb-md">
            @foreach($listProductsCat as $item)
            @php
            $products_id = $item->products_id;
            $products_name = $item->products_name;
            $products_price = $item->products_price;
            $img = $item->images[0]->images_name;
            $sale_id = $item->sale_id;
            if($sale_id != null){
	            $sale_percent = $item->sale->sale_percent;
	            $Giam = '-';
	            $phanTram = '%';
	            $classPrice = "sale";
	            $priceSale = $products_price - ($products_price * ($sale_percent/100));
	            $products_price = number_format($products_price,0,',','.').' VND';
            }else{
	            $sale_percent = '';
	            $Giam = '';
	            $phanTram = '';
	            $classPrice = "item_price";
	            $priceSale = $products_price;
	            $products_price = '';
            }
            $urlPic = 'http://localhost/appwatch/storage/app/public/files/'.$img; 
            $slug = Str::slug($products_name);
            $urlSingle = route('watch.watch.single',[ $slug, $products_id]);
            @endphp
            <div class="col-lg-3 mb-4 text-center ">
                <div class="product-entry border hover-products">
                    <span class="float-left sale-products">{{$Giam}}{{$sale_percent}}{{$phanTram}}</span>
                    <a href="{{$urlSingle}}" class="prod-img">
                    <img src="{{$urlPic}}" class="img-fluid zoom" alt="Free html5 bootstrap 4 template" style="height: 200px;">
                    </a>
                    <div class="desc">
                        <h2><a href="{{$urlSingle}}">{{$products_name}}</a></h2>
                        <span class="{{$classPrice}}">
                        {{$products_price}} 
                        </span>
                        <span class="price">{{number_format($priceSale,0,',','.')}} VND
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="w-100"></div>
        </div>
        <div class="row">
              
              <div class="col-md-12" >
                  <div class=" " id="">
                      {{$listProductsCat->links('vendor.pagination.bootstrap-4')}}
                  </div>
              </div>
          </div>
        
    </div>
</div>
@endsection()