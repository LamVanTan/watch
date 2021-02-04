
	<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="{{route('watch.index.index')}}">Trang chủ</a></span> / <span>Hoàn tất đơn hàng</span></p>
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
								<h3>Mua Hàng</h3>
							</div>
							<div class="process text-center active">
								<p><span><img src="{{$publicUrl}}/images/tick.gif" width="80px"></span></p>
								<h3>Đặt Hàng</h3>
							</div>
							<div class="process text-center active">
								<p><span><img src="{{$publicUrl}}/images/tick.gif" width="80px"></span></p>
								<h3>Hoàn Tất Đơn Hàng</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-10 offset-sm-1 text-center">
						<span><img src="{{$publicUrl}}/images/ship.gif" width="100px"></span>
						<h2 class="mb-4">Cảm ơn bạn đã mua hàng, đơn đặt hàng của bạn đã hoàn tất</h2>
						<p>
							<a href="{{route('watch.index.index')}}"class="btn btn-primary btn-outline-primary">Trang chủ</a>
							<a href="{{route('watch.index.index')}}"class="btn btn-primary btn-outline-primary"><i class="icon-shopping-cart"></i> Tiếp tục mua sắm</a>
						</p>
					</div>
				</div>
			</div>
		</div>
