@extends('templates.watch.master')
@section('main-content')
	<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="{{route('watch.index.index')}}">Trang chủ</a></span> / <span>Đơn mua</span></p>
					</div>
				</div>
			</div>
	</div>

	<div class="row">
				<div class="col-sm-10 offset-sm-1 text-center">
					<span><img src="{{$publicUrl}}/images/purchase.gif" width="100px"></span>
					<h2 class="mb-4">Cảm ơn bạn đã mua hàng, đây là tất cả đơn hàng của bạn</h2>
					<p>
						<a href="{{route('watch.index.index')}}"class="btn btn-primary btn-outline-primary"><i class="icon-shopping-cart"></i> Tiếp tục mua sắm</a>
					</p>
				</div>
			</div>

	<div class="colorlib-product">
		<div class="container">
			<div class="row row-pb-lg">			
				<div class="col-md-12">
                    <div class="table-responsive">
               		<table class="table table-hover table-bordered" style="font-weight:510">
                        <thead>
                          <tr style="background-color: #88c8bc;">
                            <th>Mã</th>
                            <th>Tên người mua</th>
                            <th>Địa chỉ</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Phương thức thanh toán</th>
                            <th>Ngày đặt</th>
                            
                            <th >Chức năng</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($listCheckoutCus as $item)
                        	@php
                             if($item->order_status == 0)
                              {
                                   $order_status = "Chờ Xác nhận";
                                   $label = "badge badge-warning";

                              }
                              else if($item->order_status == 1)
                              {
                                   $order_status = "Đã xác nhận";
                                   $label = "badge badge-info";
                              }
                              else if($item->order_status == 2)
                              {
                                   $order_status = "Đang giao hàng";
                                   $label = "badge badge-secondary";
                              }
                              else if($item->order_status == 3)
                              {
                                   $order_status = "Nhận hàng";
                                   $label = "badge badge-light";

                              }else if($item->order_status == 4){
                                  $order_status = "Thành công";
                                  $label = "badge badge-success";
                              }else if($item->order_status == 5){
                                  $order_status = "Đã hủy đơn hàng";
                                  $label = "badge badge-danger";  
                              }

                              if($item->order_method == 1)
                              {
                                  $order_method = "Thanh toán khi giao hàng";
                              }
                              else
                              {
                                  $order_method = "Thanh toán online";
                              }

                              $dateCheckout = date('H:i:s d-m-Y', strtotime($item->order_datetime));

                          @endphp
                          <tr class="item">
                            <td>{{$item->order_code}}</td>
                            <td>{{$item->users->fullname}}</td>
                            <td>{{$item->order_address}}</td>
                            <td>{{number_format($item->order_total_money,0,',','.')}} VND</td>
                            <td class="status">
                              <label class='{{$label}} p-2 checkout-{{$item->order_id}}' 
                                 @if($item->order_status == 3)
                                 @php $orderstatus = 4; @endphp
                                  onclick='checkoutCustomer({{$item->order_id}}, {{$orderstatus}})' @endif>
                                  {{$order_status}}
                              </label>
                            </td>
                            <td class="text-success">{{$order_method}}</td>
                            <td>{{$dateCheckout}}</td>
                            
                            
                           <td>
                              <label class="badge badge-warning p-2" 
                              		 onclick="detailOrder1({{$item->order_id}})">
                               Xem chi tiết
                              </label>
                              @if($item->order_status == 0) 
                               	 @php $orderstatus = 5 @endphp
                                 <label class="badge badge-danger p-2" 
                             			onclick="checkoutCustomer({{$item->order_id}},{{$orderstatus}})">
                                Hủy đơn hàng
                              </label>
                              </a>

                              @elseif($item->order_status == 5)
                              @php $orderstatus = 6 @endphp
                              <label class="badge badge-dark p-2" 
                              onclick="checkoutCustomer({{$item->order_id}}, {{$orderstatus}})">
                               Mua hàng
                              </label>
                              @endif
                          </td>
                          </tr>
                        @endforeach
                        </tbody>
                    </table>
           			</div>
           			 <div class="row" style="margin-top: 2%"> 
		              <div class="col-sm-12" style="text-align: right;">
		                  <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
		                     {{$listCheckoutCus->links('vendor.pagination.bootstrap-4')}}
		                  </div>
		              </div>
		          </div>
				</div>
			</div>
		</div>
	</div>

@foreach($listCheckoutCus as $item)
    	@php
          if($item->order_status == 0)
          {
             $order_status = "Chờ xác nhận";
             
          }
          elseif($item->order_status == 1)
          {
             $order_status = "Đã xác nhận";
             
          }
          elseif($item->order_status == 2)
          {
             $order_status = "Đang giao hàng";
             
          }
          elseif($item->order_status == 3)
          {
             $order_status = "Nhận hàng";
             
          }
          elseif($item->order_status == 4)
          {
            $order_status = "Thành công";
            
          }

          elseif($item->order_status == 5)
          {
            $order_status = "Đã hủy đơn";
            
          }


          if($item->order_method == 1)
          {
              $order_method = "Thanh toán khi giao hàng";
          }
          else
          {
              $order_method = "Thanh toán online";
          }

          $dateCheckout = date('H:i:s d-m-Y', strtotime($item->order_datetime));

      @endphp
<div class="modal " id="detailOrder-{{$item->order_id}}">
    <div class="modal-dialog modal-lg " >
      <div class="modal-content">     
        <!-- Modal Header -->
        <div class="modal-header ">
          <h4 class="modal-title ">Chi tiết đơn mua hàng </h4>
          <button type="button" class="close" data-dismiss="modal" id="close-{{$item->order_id}}">
          &times;</button>
        </div>
        <!-- Modal body -->
        
            <div class="modal-body "> 
                <div class="row">
                    <div class="col-md-6">
                       
                        <p class="grid-title "><span class="text-info">Mã đơn hàng :</span> <b>{{$item->order_code}}</b>   </p>
                    </div>

                    <div class="col-md-6">
                        <p class="grid-title float-right"> <span class="text-danger">Trang thái :</span>
                        	<b>{{$order_status}}</b>
                        </p>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        
                         <p class="grid-title"> <span class="text-warning">Địa chỉ giao hàng:</span>
                         	<b>{{$item->order_address}}</b>
                         </p>
                    </div>
                </div>

                <div class="row">

                	<div class="col-md-4">
                        <p class="grid-title"><span class="text-success">Tên người đặt :</span> 
                        	<b>{{$item->users->fullname}}</b>
                        </p>
                    </div>

                    <div class="col-md-4">
                    	<p class="grid-title float-right"> <span class="text-warning">Ngày đặt :</span>
                    		<b>{{$dateCheckout}}</b>
                    	</p>
                        
                    </div>



                    <div class="col-md-4">
                        <p class="grid-title float-right"><span class="text-danger">Số điện thoại :</span>
                        	<b>{{$item->users->phone}}</b>
                        </p>
                        
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-12">
                        <p class="grid-title"> <span class="text-primary"> Thanh toán :</span>
                        	<b>{{$order_method}}</b>
                        </p>
                        
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="table-responsive">
               <table class="table table-bordered table-primary">
                        <thead>
                          <tr>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Giá</th>
                            <th>giảm giá</th>
                            <th>Giá đã giảm</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                          </tr>
                        </thead>
                        <tbody>
                         @php
                          $sumPrice =  0;
                        @endphp
                        @foreach($orderdetail as $orderItem)
                          @if($item->order_id == $orderItem->order_id)
                            @foreach($products as $items)
                              @if($items->products_id == $orderItem->products_id)
                               @php 
                                $img = $items->images[0]->images_name;
                                $urlPic = 'http://localhost/appwatch/storage/app/public/files/'.$img; 
                                
                                
                                if($items->sale_id != null){
                                  $sale_percent = $items->sale->sale_percent;
                                  $priceSale = $items->products_price - ($items->products_price * ($sale_percent/100));

                                }else{
                                  $sale_percent = "Không giảm";
                                  $priceSale = $items->products_price;
                                }
                                $total = $priceSale * $orderItem->order_detail_quantity;
                                $sumPrice = $sumPrice + $total;
                               @endphp
                            <tr>
                              <td>{{$items->products_id}}</td>
                              <td>{{$items->products_name}}</td>
                              <td><img src="{{$urlPic}}" style="height: 50px;"></td>
                              <td>{{number_format($items->products_price,0,',','.')}} VND</td>
                              <td class="text-danger"> {{$sale_percent}}% <i class="mdi mdi-arrow-down"></i></td>
                              <td>{{number_format($priceSale,0,',','.')}}</td>
                              <td>{{$orderItem->order_detail_quantity}}</td>
                              <td>{{number_format($total,0,',','.')}} VND</td>
                            </tr>
                              @endif
                            @endforeach
                          @endif
                        @endforeach
                        <tr>
                            <td >Tổng Tiền</td>
                            
                            <td colspan="5">{{number_format($sumPrice,0,',','.')}} VND</td>
                          </tr>
                        </tbody>
                      </table>

            </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css" media="screen">
	b{
		font-size: 14px;
		font-weight: bold;
	}
</style>
<script type="text/javascript">
  var readtime =  window.setInterval('update()',16000);
  var update = function getStatus(){
    $.ajax({
          url:'{{route("ajax-status-time")}}', 
          method:"GET",
          data:{
            "_token":'{{ csrf_token() }}',      
          },
          success: function(data){
            var i = 0; // phai jquery khai bao bien ri ko?đung roi no giong javascipt
             $("tr.item").each(function() {
               $(this).find(".status").html(data[i]);
                i++;
              });
          }
    });
    }

    

  	function checkoutCustomer(order_id,order_status){
    $.ajax({
          url:'{{route("ajax-status-checkoutCustomer")}}', 
          method:"POST",
          data:{
            "_token":'{{ csrf_token() }}',
            "order_id":order_id,
            "order_status":order_status
          },
          success: function(data){
             var status = '.checkout-'+order_id;
             $(status).html(data);
            //alert(data);
          }
    });
  	}

     function detailOrder1(order_id){
        $("#detailOrder-"+order_id).show(function(){
          $("#close-"+order_id).click(function(){
            $("#detailOrder-"+order_id).hide(300);
          });
        });
    }
  
</script>
@endforeach
@endsection()