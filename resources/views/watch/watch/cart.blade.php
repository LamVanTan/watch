<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="{{route('watch.index.index')}}">Trang chủ</a></span> / <span>Giỏ hàng</span></p>
            </div>
        </div>
    </div>
</div>
<div class="colorlib-product ab">
    <div class="container">
        @if($listCart)
        <div class="row row-pb-lg">
            <div class="col-sm-10 offset-md-1">
                <div class="process-wrap">
                    <div class="process text-center active">
                        <p><span><img src="{{$publicUrl}}/images/tick.gif" width="80px"></span></p>
                        <h3>Mua hàng</h3>
                    </div>
                    <div class="process text-center ">
                        <p><span>02</span></p>
                        <h3>Đặt Hàng</h3>
                    </div>
                    <div class="process text-center">
                        <p><span>03</span></p>
                        <h3>Hoàn tất đơn hàng</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-pb-lg">
            <div class="col-md-12">
                <div class="product-name d-flex">
                    <div class="one-forth text-left px-4">
                        <span>Tên sản phẩm</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Giá</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Số lượng</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Tổng Tiền</span>
                    </div>
                    <div class="one-eight text-center px-4">
                        <span>Xóa</span>
                    </div>
                </div>
                @php $totalPrice = 0; @endphp
                @foreach($listCart as $product)
                @php 
                    $filename = $product['images'];
                    $urlPic = 'http://localhost/appwatch/storage/app/public/files/'.$filename;
                    if(isset($product['sale'])){
                    $products_price = $product['price'];
                    $classPrice = "sale";
                    $priceSale = $product['pricediscount'];
                    $products_price = number_format($products_price,0,',','.').' VND';
                    }else{
                    $products_price = '';
                    $priceSale = $product['price'];
                    $classPrice = "";
                    }
                    $totalPrice = $totalPrice + $product['totalPirce'] ;
                @endphp
                <div class="product-cart d-flex cart-list">
                    <div class="one-forth">
                        <div class="product-img" style="background-image: url({{$urlPic}}">
                        </div>
                        <div class="display-tc">
                            <h3>{{$product['name']}}</h3>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="sale">{{$products_price}}</span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price">{{number_format($priceSale,0,',','.')}} VND</span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <input type="number" 
                                onchange="changeQty( {{ $product['id_products'] }} )"   
                                class="form-control input-number text-center Qty-{{$product['id_products']}}" 
                                value="{{$product['quantity']}}">
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price">{{number_format($product['totalPirce'],0,',','.')}} VND</span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc remove">
                            <a href="javascript:void(0)" 
                                onclick="remove({{$product['id_products']}})" class="closed"></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="row row-pb-lg">
            <div class="col-md-12">
                <div class="total-wrap">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row form-group">
                               
                                <div class="col-sm-9">
                                    <input type="text" name="quantity" class="form-control input-number saleCode" placeholder="Nhập Mã Giảm Giá">
                                </div>
                                <div class="col-sm-3">
                                    <input type="submit" value="Áp dụng phiếu giảm giá" class="btn btn-primary" onclick="saleCode()">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 text-center">
                            <div class="total">
                                <div class="sub" style="color: black;">
                                    <p><span>Thành Tiền:</span> 
                                        <span>
                                        {{number_format($totalPrice,0,',','.')}} VND
                                        </span>
                                    </p>
                                    <p id="code"><span>Giảm Giá:</span> 
                                        <span>@if(session()->get('sale')) {{session()->get('sale')}} %	@endif</span>
                                    </p>
                                </div>
                                <div class="grand-total">
                                    <p><span>
                                        <strong style="color: black">Tổng Tiền:</strong>
                                        </span> 
                                        <span>
                                        @php 
                                        $sale = session()->get('sale');
                                        if($sale) {
                                        $totalPriceSale = ($totalPrice) - (($totalPrice*$sale) /100); 
                                        }else{
                                        $totalPriceSale  = $totalPrice;
                                        }
                                        @endphp
                                        {{number_format($totalPriceSale,0,',','.')}} VND
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-pb-lg">
            <div class="col-md-12">
                <div class="grand-total float-right">
                    <a href="{{route('watch.watch.checkout')}}" class="btn btn-primary text-light" >Mua Hàng</a>
                </div>
            </div>
        </div>
        @else
        <div class="row row-pb-lg">
            <div class="col-md-10 offset-md-1">
                <div class="process-wrap">
                    <div class=" text-center">
                        <p><span>Giỏ Hàng Trống</span></p>
                        <h3><a href="{{route('watch.index.index')}}">Mua Hàng Ngay</a></h3>
                    </div>
                </div>
            </div>
        </div>
        @endif	
    </div>
</div>
<script type="text/javascript">
    function changeQty(id_products){
    
    	var quantityChange = '.Qty-'+id_products;
    	var quantity = $(quantityChange).val();
    	//alert(id_products);
    	 	$.ajax({
              url:'{{route("watch.watch.changeQty-ajax")}}', 
              method:"POST",
              data:{
                "_token":'{{ csrf_token() }}',
                "id_products":id_products,
                "quantity":quantity
              },
              success: function(data){
                 var status = '#cart';
                 $(status).html(data);
                //alert(data);
            	}
            });
    
    }
    
       
         function remove(id_products){
         	swal({
    	       title: "Xóa sản phẩm",
    	  
    	       icon: 'error',
    	       buttons: true,
    	       dangerMode: true,
    	})
    	.then((willDelete) => {
    	  if (willDelete) {
    	    swal("Sản phẩm đã được xóa", {
    	      icon: "success", 
    	    });
    	    $.ajax({
              url:'{{route("watch.watch.remove-ajax")}}', 
              method:"POST",
              data:{
                "_token":'{{ csrf_token() }}',
                "id_products":id_products,
                
              },
              success: function(data){
                 var status = '#cart';
                 $(status).html(data);
                //alert(data);
              }
            });
    	  } else {
    	    swal("Sản phẩm chưa được xóa");
    	  }
    	});
           
         }
    
         function saleCode(){
         	var code = $('.saleCode').val();
         	$.ajax({
              url:'{{route("watch.watch.discount")}}', 
              method:"POST",
              data:{
                "_token":'{{ csrf_token() }}',
                "code":code,
              },
              success: function(data){
                 var status = '#code';
                 $(status).html(data);
                //alert(data);
            	}
            });
         }
          
</script>