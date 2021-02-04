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
          <p class="grid-header">Sản Phẩm</p>

          @if(Session::has('msg'))
              <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
          @endif
          <div class="item-wrapper">
            <div class="table-responsive">
               <table class="table table-hover table-bordered">
                        <thead>
                          <tr>
                            <th>Mã</th>
                            <th>Tên</th>
                            <th>Hình ảnh</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thông số kỹ thuất</th>
                            <th>trạng thái</th>
                            <th>Ngày nhập</th>
                            <th>Danh Mục</th>
                            <th>Giảm giá</th>
                            <th>Thương hiệu</th>
                            <th>Chức năng</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($listProducts as $itemProduct)
                            @php
                              $products_id = $itemProduct->products_id;
                              $products_name = $itemProduct->products_name;
                              $products_price = $itemProduct->products_price;
                              $products_quantity = $itemProduct->products_quantity;
                              $products_detail = $itemProduct->products_detail;
                              $products_origin = $itemProduct->products_origin;
                              $products_diameter = $itemProduct->products_diameter;
                              $products_thickness = $itemProduct->products_thickness;
                              $products_bracelet = $itemProduct->products_bracelet;
                              $products_case = $itemProduct->products_case;
                              $products_crystal = $itemProduct->products_crystal;
                              $products_machine = $itemProduct->products_machine;
                              $products_datetime = $itemProduct->products_datetime;
                              $products_status = $itemProduct->products_status;
                              if($products_status == 1){
                                 $class = 'badge badge-success';
                                 $text = 'Show';
                              }else{
                                 $class = 'badge badge-danger';
                                 $text = 'Hide';
                              }

                              $sale_id = $itemProduct->sale_id;
                              if($sale_id == ""){
                                $sale_name = "";
                              }else{
                                $sale_name = $itemProduct->sale->sale_percent;
                              }
                              $category = $itemProduct->category->cat_name;
                            
                            @endphp
                          <tr>
                            <td>{{$products_id}}</td>
                            <td>{{$products_name}}</td>
                            <td>
                              @php $dem = 1; @endphp
                             <div class="slider-img">
                              @foreach($itemProduct->images as $img) 
                                 
                                <a href="#slide-{{$products_id}}-{{$dem}}">{{$dem}}</a>
                                @php $dem++; @endphp
                                @endforeach

                                <div class="slides-img">
                                  @php $i = 1; @endphp
                                  @foreach($itemProduct->images as $img)
                                    @php
                                      $filename = $img->images_name;
                                      $urlPic = '/storage/app/public/files/'.$filename; 
                                    @endphp
                                  <div id="slide-{{$products_id}}-{{$i}}">
                                    <img src="{{$urlPic}}" alt="" style="width: 120px; height:120px;">
                                  </div>
                                  @php $i++; @endphp
                                  @endforeach
                                </div>
                              </div>
                            </td>
                    
                            <td>{{number_format($products_price,0,',','.')}} VND</td>
                            <td>{{$products_quantity}}</td>
                            <td>
                                <table class="table table-primary" >
                                  <tr>
                                    <td>Xuất xứ</td>
                                    <td>{{$products_origin}}</td>
                                  </tr>
                                  <tr>
                                    <td>Đường kính</td>
                                    <td>{{$products_diameter}}</td>
                                  </tr>
                                  <tr>
                                    <td>Độ dày</td>
                                    <td>{{$products_thickness}}</td>
                                  </tr>
                                  <tr>
                                    <td>Dây</td>
                                    <td>{{$products_bracelet}}</td>
                                  </tr>
                                  <tr>
                                    <td>Vỏ</td>
                                    <td>{{$products_case}}</td>
                                  </tr>
                                  <tr>
                                    <td>Kính</td>
                                    <td>{{$products_crystal}}</td>
                                  </tr>
                                  <tr>
                                    <td>Bộ máy</td>
                                    <td>{{$products_machine}}</td>
                                  </tr>
                                </table>
                            </td>
                            <td><label class="{{$class}}">{{$text}}</label></td>
                           
                            <td>{{$products_datetime}}</td>
                            <td>{{$category}}</td>
                            <td class="text-danger"> {{$sale_name}}% <i class="mdi mdi-arrow-down"></i></td>
                            <td>Channel</td>
                           <td>
                              <a href="{{route('admin.products.edit',$products_id)}}" class="btn btn-success has-icon btn-sm">
                                <i class="mdi mdi-wrench"></i>Sửa
                              </a>
                              <a href="{{route('admin.products.delete',$products_id)}}" class="btn btn-danger has-icon btn-sm">
                                <i class="mdi mdi-close-circle"></i>Xóa
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
                      {{$listProducts->links('vendor.pagination.simple-tailwind')}}
                  </div>
              </div>
          </div>
          </div>
        </div>
    </div>
<style type="text/css">
* {
  box-sizing: border-box;
}

.slider-img {
  width: 110px;
  text-align: center;
  overflow: hidden;
}

.slides-img {
  display: flex;
  overflow-x: auto;
  
  border-radius: 5px;
  
  scroll-behavior: smooth;
  
  -webkit-overflow-scrolling: touch;
  scroll-snap-points-x: repeat(200px);
  scroll-snap-type: mandatory;
}
.slides-img::-webkit-scrollbar {
  width: 0px;
  height: 0px;
}
.slides-img::-webkit-scrollbar-thumb {
  background: black;
  border-radius: 10px;
}
.slides-img::-webkit-scrollbar-track {
  background: transparent;
}
.slides-img > div {
  flex-shrink: 0;
  width: 122px;
  height: 120px;
  border-radius: 10px;
  background: #eee;
  transform-origin: center center;
  transform: scale(1);
  transition: transform 0.5s;
  position: relative;
  
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 100px;
}
.slides-img > div:target {
  transform: scale(0.8);
}


.slider-img > a {
  display: inline-flex;
  width: 1.5rem;
  height: 1.5rem;
  background: white;
  text-decoration: none;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  margin: 0 0 0.5rem 0;
  position: relative;
}
.slider-img > a:active {
  top: 1px;
}
.slider-img > a:focus {
  background: #000;
}

/* Don't need button navigation */
@supports (scroll-snap-type) {
  .slider-img > a {
    display: none;
  }
}

</style>
@endsection()