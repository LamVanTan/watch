
				@foreach($listItemProductAll as $itemProductsSale)
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
				