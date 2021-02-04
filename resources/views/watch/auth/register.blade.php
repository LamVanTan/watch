@extends('templates.watch.master')
@section('main-content')
<!--start-breadcrumbs-->
<div class="breadcrumbs">
   <div class="container">
      <div class="row">
         <div class="col">
            <p class="bread"><span><a href="{{route('watch.index.index')}}">Trang Chủ</a></span> / <span>Đăng Ký</span></p>
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
      <form action="{{route('watch.auth.register')}}" method="POST" class="contact-form">
         @csrf
         <div class="row">
            <div class="col-md-7">
               <div class="contact-wrap">
                  <h3>Đăng Ký</h3>
                  @if ($errors->any())
	                <div class="alert alert-danger">
	                    <ul>
	                        @foreach ($errors->all() as $error)
	                            <li>{{ $error }}</li>
	                        @endforeach
	                    </ul>
	                </div>
	            @endif
				@if(Session::has('msg'))
	              <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
	      		@endif
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label for="email">Tên đầy đủ</label>
                           <input type="text" class="form-control" placeholder="Nhập tên của bạn" name="fullname">
                        </div>
                     </div>
                     <div class="w-100"></div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="companyname">Tỉnh/Thành (*)</label>
                           <input type="text" id="companyname" class="form-control" placeholder="Tỉnh/Thành" name="city">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="fname">Quận/Huyện (*)</label>
                           <input type="text" id="address" class="form-control" placeholder="Quận/Huyện" name="district">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="fname">Xã/Ấp/Phường (*)</label>
                           <input type="text" id="address" class="form-control" placeholder="Xã/Ấp" name="wards">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="fname">Địa chỉ nhà (*)</label>
                           <input type="text" id="address" class="form-control" placeholder="Địa chỉ nhà..." name="village">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="stateprovince">Ngày sinh (*)</label>
                           <input type="date" id="fname" class="form-control" placeholder="State Province" name="birthday">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="Phone">Số điện thoại (*)</label>
                           <input type="text"  class="form-control" placeholder="số điện thoại" name="phone">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <div class="radio">
                              <label for="Phone">Giới tính </label><br>
                              <label><input value="1" type="radio" name="gender" checked=""> Nam </label>
                              &nbsp;&nbsp;
                              <label><input value="0" type="radio" name="gender"> Nữ </label>
                           </div>
                        </div>
                     </div>
                     <div class="w-100"></div>
                  </div>
               </div>
            </div>
            <div class="col-md-5">
               <div class="contact-wrap">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="email">Tên đăng nhập (*)</label>
                        <input type="text"  class="form-control" placeholder="Email" name="email">
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group">
                        <label for="email">Mật khẩu</label>
                        <input type="password" class="form-control" placeholder="Mật khẩu" name="password">
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group">
                        <label for="email">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="resetpassword">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row ">
               <div class="col-sm-12 mt-3">
                  <div class="form-group">
                     <input type="submit" value="Đăng ký" class="btn btn-primary">
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
</div>
@endsection