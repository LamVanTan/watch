@extends('templates.watch.master')
@section('main-content')	<!--start-breadcrumbs-->
<div id="cart">
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="bread"><span><a href="{{route('watch.index.index')}}">Trang chủ</a></span> / <span>Chi tiết sản phẩm</span></p>
                </div>
            </div>
        </div>
    </div>
    @php
    if($itemProductSingle->sale_id != null){
        $sale_percent = $itemProductSingle->sale->sale_percent;
        $products_price = $itemProductSingle->products_price;
        $classPrice = "sale";
        $priceSale = $products_price - ($products_price * ($sale_percent/100));
        $products_price = number_format($products_price,0,',','.').' VND';
        $giam = '-';
        $phantram = '%';
    }else{
        $sale_percent ='';
        $priceSale = $itemProductSingle->products_price;
        $products_price = '';
        $giam = '';
        $phantram = '';
        $classPrice = '';
    }
    @endphp
    <div class="colorlib-product ">
        <div class="container">
            <div class="row row-pb-lg product-detail-wrap">
                <div class="col-sm-6">
                    <div class="owl-carousel">
                        @foreach($itemProductSingle->images as $img)
                        @php
                        $filename = $img->images_name;
                        $urlPic = 'http://localhost/appwatch/storage/app/public/files/'.$filename; 
                        @endphp
                        <div class="item">
                            <div class="product-entry border" style="">
                                <a href="#" class="prod-img">
                                <img src="{{$urlPic}}" class="img-fluid" alt="Free html5 bootstrap 4 template"  >
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-5">
                    <div class="product-desc">
                        <h3>Đồng Hồ {{$itemProductSingle->products_name}}</h3>
                        <p class="price">
                            <span class="{{$classPrice}}" style="display: inline;" >
                            {{$products_price}} 
                            </span>
                            <a class=" ml-5 text-warning " style="font-size: 20px;">{{$giam}}{{$sale_percent}}{{$phantram}}</a> 
                            <span>
                            {{number_format($priceSale,0,',','.')}} VND
                            </span> 
                            <span class="rate">
                            <i class="icon-star-full"></i>
                            <i class="icon-star-full"></i>
                            <i class="icon-star-full"></i>
                            <i class="icon-star-full"></i>
                            <i class="icon-star-half"></i>
                            (74 Rating)
                            </span>
                        <div class="block-26 mb-4" >
                            <h4 style="display: inline !important;">Giới Tính:&nbsp;&nbsp;</h4>
                            @foreach($category_single as $item)
                            @php
                            $cat_name = $item->cat_name;
                            $cat_parent = $item->cat_id;
                            $cat_id = $itemProductSingle->category->cat_parent_id;
                            if($cat_parent == $cat_id){
                            $cat = $item->cat_name;
                            @endphp
                            <b style="display: inline !important;">{{$cat}}</b>
                            @php
                            }
                            @endphp
                            @endforeach
                        </div>
                        <div class="block-26 mb-4" style="display: inline !important;">
                            <h4 style="display: inline !important;">Thương Hiệu:&nbsp;&nbsp;</h4>
                            <b style="display: inline !important;">{{$itemProductSingle->category->cat_name}}</b>
                        </div>
                        </p>
                        <table class="table " >
                            <tr>
                                <td>Xuất xứ</td>
                                <td>{{$itemProductSingle->products_origin}}</td>
                            </tr>
                            <tr>
                                <td>Đường kính</td>
                                <td>{{$itemProductSingle->products_diameter}}</td>
                            </tr>
                            <tr>
                                <td>Độ dày</td>
                                <td>{{$itemProductSingle->products_thickness}}</td>
                            </tr>
                            <tr>
                                <td>Dây</td>
                                <td>{{$itemProductSingle->products_bracelet}}</td>
                            </tr>
                            <tr>
                                <td>Vỏ</td>
                                <td>{{$itemProductSingle->products_case}}</td>
                            </tr>
                            <tr>
                                <td>Kính</td>
                                <td>{{$itemProductSingle->products_crystal}}</td>
                            </tr>
                            <tr>
                                <td>Bộ máy</td>
                                <td>{{$itemProductSingle->products_machine}}</td>
                            </tr>
                        </table>
                        @php $id_products = $itemProductSingle->products_id @endphp
                        <div class="input-group mb-4">
                            <input type="number" id="quantity" name="quantity" class="form-control input-number" value="1"  placeholder="1">
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <p class="addtocart">
                                    <button type="submit" onclick="addCart({{$id_products}},{{$itemProductSingle->products_quantity}})" class="btn btn-primary btn-addtocart">
                                    <i class="icon-shopping-cart" style="display: inline"></i> Thêm vào giỏ</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-md-12 pills">
                            <div class="bd-example bd-example-tabs">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Thông tin của sản phẩm</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab" aria-controls="pills-review" aria-expanded="true">Đánh giá</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane border fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                                        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
                                        <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
                                        <ul>
                                            <li>The Big Oxmox advised her not to do so</li>
                                            <li>Because there were thousands of bad Commas</li>
                                            <li>Wild Question Marks and devious Semikoli</li>
                                            <li>She packed her seven versalia</li>
                                            <li>tial into the belt and made herself on the way.</li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane border fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h3 class="head">23 Đánh giá</h3>
                                                <div class="review">
                                                    <div class="user-img" style="background-image: url(images/person1.jpg)"></div>
                                                    <div class="desc">
                                                        <h4>
                                                            <span class="text-left">Jacob Webb</span>
                                                            <span class="text-right">14 March 2018</span>
                                                        </h4>
                                                        <p class="star">
                                                            <span>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-half"></i>
                                                            <i class="icon-star-empty"></i>
                                                            </span>
                                                            <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                                                        </p>
                                                        <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                                                    </div>
                                                </div>
                                                <div class="review">
                                                    <div class="user-img" style="background-image: url(images/person2.jpg)"></div>
                                                    <div class="desc">
                                                        <h4>
                                                            <span class="text-left">Jacob Webb</span>
                                                            <span class="text-right">14 March 2018</span>
                                                        </h4>
                                                        <p class="star">
                                                            <span>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-half"></i>
                                                            <i class="icon-star-empty"></i>
                                                            </span>
                                                            <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                                                        </p>
                                                        <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                                                    </div>
                                                </div>
                                                <div class="review">
                                                    <div class="user-img" style="background-image: url(images/person3.jpg)"></div>
                                                    <div class="desc">
                                                        <h4>
                                                            <span class="text-left">Jacob Webb</span>
                                                            <span class="text-right">14 March 2018</span>
                                                        </h4>
                                                        <p class="star">
                                                            <span>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-half"></i>
                                                            <i class="icon-star-empty"></i>
                                                            </span>
                                                            <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                                                        </p>
                                                        <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="rating-wrap">
                                                    <h3 class="head">Xem đánh giá</h3>
                                                    <div class="wrap">
                                                        <p class="star">
                                                            <span>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-full"></i>
                                                            (98%)
                                                            </span>
                                                            <span>20 Reviews</span>
                                                        </p>
                                                        <p class="star">
                                                            <span>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-empty"></i>
                                                            (85%)
                                                            </span>
                                                            <span>10 Reviews</span>
                                                        </p>
                                                        <p class="star">
                                                            <span>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-empty"></i>
                                                            <i class="icon-star-empty"></i>
                                                            (70%)
                                                            </span>
                                                            <span>5 Reviews</span>
                                                        </p>
                                                        <p class="star">
                                                            <span>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-empty"></i>
                                                            <i class="icon-star-empty"></i>
                                                            <i class="icon-star-empty"></i>
                                                            (10%)
                                                            </span>
                                                            <span>0 Reviews</span>
                                                        </p>
                                                        <p class="star">
                                                            <span>
                                                            <i class="icon-star-full"></i>
                                                            <i class="icon-star-empty"></i>
                                                            <i class="icon-star-empty"></i>
                                                            <i class="icon-star-empty"></i>
                                                            <i class="icon-star-empty"></i>
                                                            (0%)
                                                            </span>
                                                            <span>0 Reviews</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row mt-2" style="background-color: #fafafa;border:1px solid lightgray" >
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <span class="text-left">Đánh giá sao</span>
                                                            <div class="form-field">
                                                                <select name="people" id="people" class="form-control">
                                                                    <option value="5">5 sao</option>
                                                                    <option value="4">4 sao</option>
                                                                    <option value="3">3 sao</option>
                                                                    <option value="2">2 sao</option>
                                                                    <option value="1">1 sao</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <span class="text-left">Tên đầy đủ</span>
                                                            <input name="text"  class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <span class="text-left">Email</span>
                                                            <input name="email"  class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <span class="text-left">Nội dung</span>
                                                            <textarea name="content" rows="5" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 text-center">
                                                        <p><button type="submit" class="btn btn-primary">Đánh giá</button></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    function addCart(id_products,products_quantity){
    	var  quantity = $("#quantity").val();

        if( quantity < 1 ){
            swal( { title: "Giá trị nhập vào không được nhỏ hơn 1",
                    text: "Mong bạn điền thông tin lại",
                    icon: "warning",
                    buttons: false,
                    timer: 1500,

            });
        }
        else if(quantity > products_quantity){
            swal( { title: "Giá trị nhập vào quá lớn",
                    text: "Số lượng phù hợp là nhỏ hơn hoặc bằng : "+products_quantity,
                    icon: "warning",
                    buttons: false,
                    timer: 1500,

            });
        }
        else{
        	swal({
        	  title: "Bạn có muốn thêm sản phẩm vào giỏ không",
        	  // text: "",
        	  icon: "warning",
        	  buttons: true,
        	  dangerMode: true,
        	})
        	.then((willDelete) => {
        	  if (willDelete) {
        	    swal("Sản phẩm được thêm vào giỏ", {
        	      icon: "success", 
        	    });
        	    $.ajax({
                  url:'{{route("watch.watch.add-cart")}}', 
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
        	
        	  } else {
        	    swal("Sản phẩm chưa được thêm vào giỏ");
        	  }
        	});
        
    	}
    }
    
    	
</script>
@endsection()