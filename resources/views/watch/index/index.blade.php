@extends('templates.watch.master')
@section('main-content')
<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url({{$publicUrl}}/images/bnr-1.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-sm-6 offset-sm-3 text-center slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url({{$publicUrl}}/images/bnr-2.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-sm-6 offset-sm-3 text-center slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url({{$publicUrl}}/images/bnr-3.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-sm-6 offset-sm-3 text-center slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>
<div class="colorlib-product">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
						<h2>BÁN CHẠY NHẤT</h2>
					</div>
				</div>
				<div class="row row-pb-md" id="shop">
				@foreach($listItemProductSale as $itemProductsSale)
					@php
						$products_id = $itemProductsSale->products_id;
						$products_name = $itemProductsSale->products_name;
						$products_price = $itemProductsSale->products_price;
						$img = $itemProductsSale->images[0]->images_name;
						$sale_id = $itemProductsSale->sale_id;
						if($sale_id != null){
							$sale_percent = $itemProductsSale->sale->sale_percent;
							$Giam = '-';
							$phanTram = '%';
							$class ="srch";
							$classPrice = "sale";

							$priceSale = $products_price - ($products_price * ($sale_percent/100));

						}else{
							$sale_percent = '';
							$Giam = '';
							$phanTram = '';
							$class = '';
							$classPrice = "item_price";
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
								    	{{number_format($products_price,0,',','.')}} VND
								</span>
								<span class="price">{{number_format($priceSale,0,',','.')}} VND
								</span>
							</div>
						</div>
					</div>
					
					
					
				
				@endforeach
				<div class="w-100"></div>	
				</div>
				<div class="row  row-pb-md" >
					<div class="col-md-12 text-center">
						<p><a href="#" class="btn btn-primary btn-lg" onclick="shopAll();">Shop All Products</a></p>
					</div>
				</div>
			</div>
		</div>

 <script type="text/javascript">
    function shopAll(){
    	
    	$.ajax({
              url:'{{route("watch.index.shopAll")}}', 
              method:"POST",
              data:{
                "_token":'{{ csrf_token() }}',
              },
              success: function(data){
                 var status = '#shop';
                 $(status).html(data);
                //alert(data);
            	}
            });
    }
</script>

@endsection()