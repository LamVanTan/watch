@extends('templates.watch.master')
@section('main-content')
<!--start-breadcrumbs-->
<div class="breadcrumbs">
   <div class="container">
      <div class="row">
         <div class="col">
            <p class="bread"><span><a href="{{route('watch.index.index')}}">Trang Chủ</a></span> / <span>Đăng Nhập</span></p>
         </div>
      </div>
   </div>
</div>
<!--end-breadcrumbs-->
<!--account-starts-->
<div id="colorlib-contact">
   <div class="container">
      <div class="row">
         <div class="col-sm-12">
            <h3>Contact Information</h3>
            <div class="row contact-info-wrap">
               <div class="col-md-3">
                  <p><span><i class="icon-location"></i></span> 198 West 21th Street, <br> Suite 721 New York NY 10016</p>
               </div>
               <div class="col-md-3">
                  <p><span><i class="icon-phone3"></i></span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
               </div>
               <div class="col-md-3">
                  <p><span><i class="icon-paperplane"></i></span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
               </div>
               <div class="col-md-3">
                  <p><span><i class="icon-globe"></i></span> <a href="#">yoursite.com</a></p>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6">
            <div class="contact-wrap">
               <h3>Đăng nhập</h3>
               @if(Session::has('msg'))
               <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
               @endif
               <form action="{{route('watch.auth.login')}}" method="POST" class="contact-form">
                  <div class="row">
                     @csrf
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label for="email">Email</label>
                           <input type="text" class="form-control" placeholder="Your email address" name="username">
                        </div>
                     </div>
                     <div class="w-100"></div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label for="email">Password</label>
                           <input type="password" class="form-control" placeholder="Your email Password" name="password">
                        </div>
                     </div>
                     <div class="w-100"></div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <input type="submit" value="Đăng Nhập" class="btn btn-primary">
                        </div>
                     </div>
                     <div class="col-sm-6">
                       <a href="#" onclick="resetPassword();">Quên mật khẩu!</a>   
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <div class="col-md-6">
            <p>Tạo một tài khoản Bằng cách tạo tài khoản với cửa hàng của chúng tôi, bạn sẽ có thể thực hiện quy trình thanh toán nhanh hơn, lưu trữ nhiều địa chỉ giao hàng, xem và theo dõi đơn đặt hàng trong tài khoản của bạn và hơn thế nữa.</p>
            <a href="{{route('watch.auth.register')}}" class="btn btn-primary">Đăng ký tài khoản</a>	
         </div>
      </div>
   </div>
</div>

<!-- modal doi pass -->
 <div class="modal resetPassword"  style="background-color:#88c8bc ;" >
    <div class="modal-dialog modal-dialog-centered " >
      <div class="modal-content bg-light">     
        <!-- Modal Header -->
        <div class="modal-header ">
          <h4 class="modal-title ">Quên mật khẩu</h4>
          <button type="button" class="close" data-dismiss="modal" id="close">
          &times;</button>
        </div>
        <!-- Modal body -->
        <form action="{{route('watch.auth.Forgot_password')}}" method="post">
         @csrf
            <div class="modal-body "> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="companyname" class="text-dark">Email(*)</label>
                            <input type="email" class="form-control" placeholder="Nhập địa chỉ email của bạn" name="email">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                        </div>
                    </div>
                 </div>
              </div>
          </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    function resetPassword(){
        $(".resetPassword").show(function(){
          $("#close").click(function(){
            $(".resetPassword").hide(300);
          });
        });
    }
</script>
@endsection