@extends('templates.watch.master')
@section('main-content')
<div id="order-complete">
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="{{route('watch.index.index')}}">Trang chủ</a></span> /<span>
                    Đặt hàng</span>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="colorlib-product">
    <div class="container">
        <div class="row row-pb-lg">
            <div class="col-sm-10 offset-md-1">
                <div class="process-wrap">
                    <div class="process text-center active">
                        <p><span><img src="{{$publicUrl}}/images/tick.gif" width="80px"></span></p>
                        <h3>Mua hàng</h3>
                    </div>
                    <div class="process text-center active">
                        <p><span><img src="{{$publicUrl}}/images/tick.gif" width="80px"></span></p>
                        <h3>Đặt Hàng</h3>
                    </div>
                    <div class="process text-center">
                        <p><span>03</span></p>
                        <h3>Hoàn tất đơn hàng</h3>
                    </div>
                </div>
            </div>
        </div>
        
            @php
                if(Auth::check()){
                    $address = Auth::user()->address;
                    $fullname = Auth::user()->fullname;
                    $phone = Auth::user()->phone;
                    $birthday = Auth::user()->birthday;
                    $gender = Auth::user()->gender;
                    $email = Auth::user()->email;
                }
            @endphp
            
            <div class="row">
                <div class="col-lg-6">
                    <h2>Đơn Hàng</h2>
                    <div class="row">

                         <div class="col-md-12">
                            <div class="form-group">
                            	<label for="country">Địa chỉ Giao hàng (*)</label>
                                <input type="text" id="address" class="form-control" placeholder="Địa chỉ giao hàng" name="address" value="{{$address}}">
                            </div>
                            </div>
                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="companyname">Thay đổi địa chỉ</label>
                                <input type="checkbox" onclick="addressCheckout();"  >
                            </div>
                        </div>
                         <div class="modal diachi" >
                            <div class="modal-dialog modal-dialog-centered ">
                              <div class="modal-content">     
                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Địa chỉ giao hàng</h4>
                                  <button type="button" class="close" data-dismiss="modal" id="close">
                                  &times;</button>
                                </div>
                                <!-- Modal body -->
                                <form >
                                    <div class="modal-body "> 
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="companyname">Tỉnh/Thành (*)</label>
                                                    <input type="text" id="companyname" class="form-control" placeholder="Tỉnh/Thành" name="city">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fname">Quận/Huyện (*)</label>
                                                    <input type="text" class="form-control" placeholder="Quận/Huyện" name="district">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fname">Xã/Ấp/Phường (*)</label>
                                                    <input type="text" class="form-control" placeholder="Xã/Ấp" name="wards">
                                                </div>
                                            </div>
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fname">Địa chỉ nhà (*)</label>
                                                    <input type="text" class="form-control" placeholder="Địa chỉ nhà..." name="village">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Thay đổi địa chỉ</button>
                                                </div>
                                            </div>
                                         </div>
                                      </div>
                                  </form>
                                </div>
                            </div>
                        </div>

                            
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fname">Tên đầy đủ (*)</label>
                                <input type="text" id="fname" class="form-control" placeholder="Tên" name="first_name" value="{{$fullname}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Phone">Số điện thoại (*)</label>
                                <input type="text"  class="form-control" placeholder="số điện thoại" name="phone" value="{{$phone}}">
                            </div>
                        </div>
                     
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stateprovince">Ngày sinh (*)</label>
                                <input type="date" id="fname" class="form-control" placeholder="State Province" name="date" value="{{$birthday}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email (*)</label>
                                <input type="text" id="email" class="form-control" placeholder="Email" name="email" value="{{$email}}">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="radio">
                                    <label for="Phone">Giới tính </label><br>
                                    <label>
                                        <input value="1" type="radio" name="gender" @if($gender == 1) checked="" @endif> Nam </label>
                                    &nbsp;&nbsp;
                                    <label><input value="0" type="radio" name="gender" @if($gender == 0) checked="" @endif> Nữ </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="lname">Ghi chú đặt hàng</label>
                                <textarea name="content" class="form-control content" ></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="cart-detail">
                                <h2>Sản phẩm</h2>
                                @php 
                                $listCart = session()->get('cart');
                                if($listCart){
                                $totalPrice = 0;
                                @endphp
                                <ul>
                                    <li>
                                        <ul>
                                            @foreach($listCart as $product)
                                            @php 
                                            $totalPrice = $totalPrice + $product['totalPirce'];
                                            @endphp
                                            <li style="">
                                                <span> {{$product['name']}} </span>
                                                <span >{{number_format($product['pricediscount'],0,',','.')}}VND x {{$product['quantity']}}  {{number_format($product['totalPirce'],0,',','.')}}VND</span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li><span>Giảm giá</span> 
                                        <span>
                                        @if(session()->get('sale'))	
                                        {{session()->get('sale')}} %	
                                        @endif</span>
                                    </li>
                                    <li><span style="width: 80px !important;">Tổng Tiền</span> 
                                        <span  style="width: 240px !important; padding-left: 120px ">@php 
                                        if($sale = session()->get('sale')) {
                                        $totalPriceSale = ($totalPrice) - (($totalPrice*$sale) /100); 
                                        }else{
                                        $totalPriceSale  = $totalPrice;
                                        } 
                                        @endphp
                                        {{number_format($totalPriceSale,0,',','.')}} VND</span>
                                    </li>
                                </ul>
                                @php }else{ @endphp
                                <ul>
                                    <li>
                                        <ul>
                                            <li style="">
                                                <span>  </span>
                                                <span ></span>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><span>Phí vận chuyển</span> <span>$0.00</span></li>
                                    <li><span style="width: 80px !important;">Tổng Tiền</span> 
                                        <span  style="width: 240px !important; padding-left: 120px "></span>
                                    </li>
                                </ul>
                                @php } $total = number_format(($totalPriceSale/23000),0,',','.'); @endphp
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="cart-detail">
                                <h2>Phương thức thanh toán</h2>
                                <div class="form-group"
                                    <div class="col-md-12">
                                        <div class="radio ">
                                            <label><input value="shipper" type="radio" name="payment" checked="">Trả khi nhận hàng</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio ">
                                            <label><input value="paypal" type="radio" name="payment">Thanh toán online</label><br>
                                            <form action="{{ route('watch.checkout.payment') }}" method="POST" >
                                                @csrf
                                                <input type="hidden" name="order_type" value="Thanh toán hóa đơn">
                                                <input type="hidden" name="order_id" value="{{ date('YmdHis') }}">
                                                <input type="hidden" name="amount" value="{{ $totalPriceSale }}">
                                                <input type="hidden" name="order_desc" value="Thanh toán đơn hàng">
                                                <input type="hidden" name="bank_code" value="">
                                                <input type="hidden" name="language" value="vn">
                                                <button type="submit" class="btn btn-block py-2 font-weight-bold border mb-4" id="vnpay">
                                                    <span class="text-danger">VN</span><span class="text-info">PAY</span>
                                                </button>
                                             </form>
                                           <div id="paypal-button-container"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""> Tôi đã đọc và chấp nhận các điều khoản và điều kiện</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p>
                                <button type="submit" class="btn btn-primary checkout" 
                                onclick="checkoutOrder()">Đặt hàng</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
</div>

</div>
 

<script
    src="https://www.paypal.com/sdk/js?client-id=AbEO67zfcwSprGjNUPms3P_xFokLKGStSyJmV7tVYReM3pUlRMwPcaq-D926UAL5UFZjs5gmge22QA98"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
</script>

<script type="text/javascript">

    function checkoutOrder(){
    $('.load').removeAttr('hidden');
        var address = $('#address').val(); 
        var payment = 'shipper';
        var content = $('.content').val();                  
        $.ajax({
          url:'{{route("watch.watch.checkout")}}', 
          method:"POST",
          data:{
            "_token":'{{ csrf_token() }}',
            "address":address,
            "payment":payment,
            "content":content,
          },
        success: function(data){
             var status = '#order-complete';
                $('.load').delay().fadeOut('fast');
                $(status).html(data);
            
        }
        });
    }
    document.querySelectorAll('input[name=payment]').forEach(function(el) {
            el.addEventListener('change', function(event) {

                // If PayPal is selected, show the PayPal button
                if (event.target.value === 'paypal') {
                    document.querySelector('#paypal-button-container').style.display = 'inline-block';
                    document.querySelector('#vnpay').style.display = 'inline-block';
                    document.querySelector('.checkout').style.display = 'none';

                    
                    paypal.Buttons({
                        createOrder: function(data, actions) {
                          return actions.order.create({
                            purchase_units: [{
                              amount: {
                                value: {{$total}},
                                currency: 'USD',
                              }
                            }]
                          });
                        },
                        onApprove: function(data, actions) {
                          // This function captures the funds from the transaction.
                          return actions.order.capture().then(function(details) {
                            $('.load').removeAttr('hidden');
                            //hiển thị một thông báo ra \
                            var address = $('#address').val();
                            //alert(address)
                            var payment = 'paypal';
                            var content = $('.content').val();
                        
                            $.ajax({
                                url:'{{route("watch.watch.checkout")}}', 
                                method:"POST",
                                data:{
                                "_token":'{{ csrf_token() }}',
                                "address":address,
                                "payment":payment,
                                "content":content,
                                },
                            success: function(data){
                                var status = '#order-complete';
                                $('.load').delay().fadeOut('fast');
                                $(status).html(data);  
                            }
                            });
                        
                        

                          });
                        }
                      }).render('#paypal-button-container');
                }

                // If Card is selected, show the standard continue button
                if (event.target.value === 'shipper') {
                    document.querySelector('#paypal-button-container').style.display = 'none';
                    document.querySelector('#vnpay').style.display = 'none';
                    document.querySelector('.checkout').style.display = 'inline-block';
                }
            });
        });
        // Hide Non-PayPal button by default
        document.querySelector('#paypal-button-container').style.display = 'none';
        document.querySelector('#vnpay').style.display = 'none';
       
    
      
     function addressCheckout(){
        $(".diachi").show(function(){
          $("#close").click(function(){
            $(".diachi").hide(300);
          });
        });
    }
</script>
@endsection()