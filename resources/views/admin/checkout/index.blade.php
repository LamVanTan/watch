@extends('templates.admin.master')
@section('main-content') 
	<div class="grid">  
		<a href="{{route('admin.products.add')}}">   
			<div class="btn btn-success has-icon">
				<i class="mdi mdi-basket-fill"></i>Thêm 
			</div>
		</a>   
    </div>
	<div class="col-lg-12">
        <div class="grid">
          <p class="grid-header">Đơn Hàng</p>

          @if(Session::has('msg'))
              <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
          @endif
          <div class="item-wrapper">
            <div class="table-responsive">
               <table class="table table-hover table-bordered">
                        <thead>
                          <tr>
                            <th>Mã</th>
                            <th>Tên người mua</th>
                            <th>Địa chỉ</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Phương thức thanh toán</th>
                            <th>Ngày đặt</th>
                            <th>Nội dung</th>
                            <th>Chức năng</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($listOrder as $item)
                          @php
                             if($item->order_status == 0)
                              {
                                 $order_status = "Xác nhận đơn hàng";
                                 $label = "badge badge-warning";
                              }
                              elseif($item->order_status == 1)
                              {
                                 $order_status = "Lấy hàng";
                                 $label = "badge badge-info";
                              }
                              elseif($item->order_status == 2)
                              {
                                 $order_status = "Vận chuyển";
                                 $label = "badge badge-secondary";
                              }
                              elseif($item->order_status == 3)
                              {
                                 $order_status = "Giao hàng";
                                $label = "badge badge-dark";
                              }
                              elseif($item->order_status == 4){
                                 $order_status = " Thành công";
                                $label = "badge badge-success";
                              }
                              elseif($item->order_status == 5){
                                 $order_status = "Hủy đơn hàng";
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
                            <td class=" status" >
                            <label class='{{$label}} mt-2' 
                              onclick='checkout({{$item->order_id}},{{$item->order_status}})'>
                              {{$order_status}}
                            </label>
                            </td>
                            <td class="text-success">{{$order_method}}</td>
                            <td>{{$dateCheckout}}</td>
                            <td>{{$item->order_content}}</td>
                            
                           <td>
                              <a href="#" class="btn btn-success has-icon btn-sm detailOrder-{{$item->order_id}}">
                                <i class="mdi mdi-dots-horizontal"></i>Xem chi tiết
                              </a>
                          </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>


            </div>

            <div class="row" style="margin-top: 2%"> 
              <div class="col-sm-12" style="text-align: right;">
                  <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                     {{$listOrder->links('vendor.pagination.bootstrap-4')}}
                  </div>
              </div>
          </div>
          </div>
        </div>
    </div>


@foreach($listOrder as $item)
  @php
    if($item->order_status == 0)
    {
       $order_status = "Xác nhận đơn hàng";
     
    }
    elseif($item->order_status == 1)
    {
       $order_status = "Lấy hàng";
      
    }
    elseif($item->order_status == 2)
    {
       $order_status = "Vận chuyển";
      
    }
    elseif($item->order_status == 3)
    {
       $order_status = "Giao hàng";
      
    }
    elseif($item->order_status == 4){
       $order_status = " Thành công";
      
    }
    elseif($item->order_status == 5){
       $order_status = "Hủy đơn hàng";
       
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
    <div class="modal-dialog modal-dialog-centered modal-lg " >
      <div class="modal-content bg-light">     
        <!-- Modal Header -->
        <div class="modal-header ">
          <h4 class="modal-title ">Chi tiết đơn hàng</h4>
          <button type="button" class="close" data-dismiss="modal" id="close-{{$item->order_id}}">
          &times;</button>
        </div>
        <!-- Modal body -->
        
            <div class="modal-body "> 
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="grid-title"><i class="mdi mdi-map-marker-radius text-warning"></i> <span class="text-warning">Địa chỉ giao hàng:</span>{{$item->order_address}}</h2>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h2 class="grid-title "><span class="text-info">Mã đơn hàng :</span>  {{$item->order_code}} </h2>
                        
                    </div>

                    <div class="col-md-6">
                        <h2 class="grid-title "> <span class="text-warning">Ngày đặt :</span> {{$dateCheckout}}</h2>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h2 class="grid-title"> <span class="text-success">Tên người đặt :</span>: {{$item->users->fullname}}</h2>
                        
                    </div>

                    <div class="col-md-6">
                        <h2 class="grid-title"><span class="text-danger">Số điện thoại :</span> {{$item->users->phone}} </h2>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h2 class="grid-title"> <span class="text-dark">Trang thái :</span> {{$order_status}} </h2>
                        
                    </div>

                    <div class="col-md-6">
                        <h2 class="grid-title"> <span class="text-primary"> Thanh toán :</span>{{$order_method}}</h2>
                        
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
                                $urlPic = '/storage/app/public/files/'.$img; 
                                
                                
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


<script type="text/javascript">

  var readtime1 =  window.setInterval(update1,15000);
  var update1 = function getStatus(){
    $.ajax({
          url:'{{route("ajax-status")}}', 
          method:"GET",
          data:{
            "_token":'{{ csrf_token() }}',
            
          },
          success: function(data){
            var i = 0; // phai jquery khai bao bien ri ko?đung roi no giong javascipt
             $("tr.item").each(function() {
               $(this).find(".status ").html(data[i]);
               i++;
              });
          }
    });
    }

  function checkout(order_id,order_status){
    $.ajax({
          url:'{{route("ajax-status-checkout")}}', 
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

  $(document).ready(function() {
     $(".detailOrder-{{$item->order_id}}").click(function(){
        
        $("#detailOrder-{{$item->order_id}}").show(function(){
          $("#close-{{$item->order_id}}").click(function(){
            $("#detailOrder-{{$item->order_id}}").hide(300);
          });
        });
        
     });
  });
  
</script>
@endforeach



@endsection()