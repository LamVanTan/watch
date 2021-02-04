@extends('templates.watch.master')
@section('main-content')
<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="{{route('watch.index.index')}}">Trang chủ</a></span> / <span>Liên hệ</span></p>
					</div>
				</div>
			</div>
		</div>


		<div id="colorlib-contact">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h3>Thông tin liên hệ</h3>
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
							<h3>Liên Hệ</h3>
							@if(Session::has('msg'))
				                <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
				            @endif
							<form action="{{route('watch.contact.contact')}}" method="post" class="contact-form">
								@csrf
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="fname">Tên</label>
											<input type="text" id="fname" class="form-control" placeholder="Tên của bạn" name="name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="lname">Họ</label>
											<input type="text" id="lname" class="form-control" placeholder="Your lastname" name="lastname">
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="email">Email</label>
											<input type="text" id="email" class="form-control" placeholder="Your email address" name="email">
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="subject">Tiêu đề</label>
											<input type="text" id="subject" class="form-control" placeholder="Your subject of this message" name="subject">
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="message">Nội dung</label>
											<textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Say something about us" ></textarea>
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<input type="submit" value="Send Message" class="btn btn-primary">
										</div>
									</div>
								</div>
							</form>		
						</div>
					</div>
					<div class="col-md-6">
						<div id="map" class="colorlib-map"></div>		
					</div>
				</div>
			</div>
		</div>
@endsection()