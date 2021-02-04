<!DOCTYPE HTML>
<html>
    <head>
        <title>Watch Luxury</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Rokkitt:100,300,400,700" rel="stylesheet">
        <!-- Animate.css -->
        <link rel="stylesheet" href="{{$publicUrl}}/css/animate.css">
        <!-- Icomoon Icon Fonts-->
        <link rel="stylesheet" href="{{$publicUrl}}/css/icomoon.css">
        <!-- Ion Icon Fonts-->
        <link rel="stylesheet" href="{{$publicUrl}}/css/ionicons.min.css">
        <!-- Bootstrap  -->
        <link rel="stylesheet" href="{{$publicUrl}}/css/bootstrap.min.css">
        <!-- Magnific Popup -->
        <link rel="stylesheet" href="{{$publicUrl}}/css/magnific-popup.css">
        <!-- Flexslider  -->
        <link rel="stylesheet" href="{{$publicUrl}}/css/flexslider.css">
        <!-- Owl Carousel -->
        <link rel="stylesheet" href="{{$publicUrl}}/css/owl.carousel.min.css">
        <link rel="stylesheet" href="{{$publicUrl}}/css/owl.theme.default.min.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="{{$publicUrl}}/css/bootstrap-datepicker.css">
        <!-- Flaticons  -->
        <link rel="stylesheet" href="{{$publicUrl}}/fonts/flaticon/font/flaticon.css">
        <!-- Theme style  -->
        <link rel="stylesheet" href="{{$publicUrl}}/css/style.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <style type="text/css" media="screen">
            .sale{
            text-decoration: line-through;
            font-size: 15px !important;
            color: gray !important;
            }
            .hover-products:hover{
            border: 1px solid gray !important;
            }
            .sale-products{
            background: #88c8bc !important;
            }

            /* css load du lieu */
            .load{
                width: 100%;
                height: 100%;
                background: #fff;
                position: fixed;
                top: 0;
                left: 0;
                z-index: 100000000000;
                display: block;
                overflow: hidden;
            }
            .load img{
                width: 150px;
                height: 150px;
                position: absolute; 
                top: 50%;
                left: 50%;
                margin-top: -75px;
                margin-left: -75px;
            }
        </style>

    </head>
    <body>
        <div class="load" hidden>
            <img src="{{$publicUrl}}/images/load.gif">Vui lòng chờ trong giây lát....
        </div>
        <div class="colorlib-loader"></div>
        <div id="page">
        <nav class="colorlib-nav" role="navigation">
            <div class="top-menu">
                <div class="container" >
                    <div class="row">
                        <div class="col-sm-7 col-md-9">
                            <div id="colorlib-logo"><a href="index.html">Watch Luxury</a></div>
                        </div>
                        <div class="col-sm-5 col-md-3">
                            <form class="search-wrap">
                                <div class="form-group">
                                    <input type="search" onkeyup="search()" class="form-control search" placeholder="Search" id="searchProduct">
                                    <button class="btn btn-primary submit-search text-center" type="submit"><i class="icon-search"></i></button>
                                </div>
                                <div id="search" class="border-success " style="background-color: white"></div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-left menu-1">
                            <ul>
                                <li class="active"><a href="{{route('watch.index.index')}}">Trang Chủ</a></li>
                                @foreach($category as $item)
                                <li class="has-dropdown">
                                    <a href="#">{{$item->cat_name}}</a>
                                    
                                    <ul class="dropdown">
                                        @php 
                                        $menu_category = data_tree($category_parent,$item->cat_id);
                                        @endphp
                                        @foreach($menu_category as $menuItem)
                                        @php 	
                                        $cat_id = $menuItem->cat_id;	
                                        $cat_name = $menuItem->cat_name;
                                        $slug = Str::slug($cat_name);
                                        $url_cat = route('watch.watch.products',[$slug,$cat_id]);
                                        @endphp
                                        <li><a href="{{$url_cat}}">{{$menuItem->cat_name}}</a></li>
                                        @endforeach()
                                    </ul>
                                </li>
                                @endforeach()
                                <li><a href="{{route('watch.about.about')}}">Giới Thiệu</a></li>
                                <li><a href="{{route('watch.contact.contact')}}">Liên Hệ</a></li>
                                <li class="cart">
                                    <a href="{{route('watch.watch.cart')}}">
                                    <i class="icon-shopping-cart"></i>
                                    Cart [
                                    @php 
                                        $cart = session()->get('cart'); 
                                        $dem = 0; 
                                    @endphp
                                    @if(isset($cart))
                                        @foreach($cart as $itemCart)
                                        @php 
                                        $dem = $dem + 1; 
                                        @endphp
                                        @endforeach
                                    {{$dem}}
                                        @php $dem++; @endphp
                                    @else {{$dem}}
                                    @endif
                                    ]</a>
                                </li>
                                <li class="cart has-dropdown">
                                    @if(Auth::check())
                                       
                                            <a href="#">{{Auth::user()->fullname}} </a>
                                            <ul class="dropdown">
                                                <li>
                                                    <a href="{{route('watch.watch.purchase_menu')}}">Đơn Mua</a>
                                                </li>
                                                <li>
                                                    <a href="{{route('watch.auth.logout')}}">Đăng Xuất</a>
                                                </li>
                                               
                                            </ul>
                                        
                                    @else
                                    <a href="{{route('watch.auth.login')}}">Đăng Nhập</a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sale">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 offset-sm-2 text-center">
                            <div class="row">
                                <div class="owl-carousel2">
                                    <div class="item">
                                        <div class="col">
                                            <h3><a href="#">25% off (Almost) Everything! Use Code: Summer Sale</a></h3>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col">
                                            <h3><a href="#">Our biggest sale yet 50% off all summer shoes</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <style type="text/css" media="screen">
            #search{
            position: absolute;
            /* background-color: #f0f0f0; */
            width: 100%;
            z-index: 100;
            }
        </style>
        <script type="text/javascript">
            function search(){
            	var name = $('#searchProduct').val();
                if (name == '') {
                   $('#search').hide();
                }else{
                    $('#search').show();
                }
            	$.ajax({
                      url:'{{route("watch.watch.search")}}', 
                      method:"POST",
                      data:{
                        "_token":'{{ csrf_token() }}',
                        "name":name,
                      },
                      success: function(data){
                         var status = '#search';
                         $(status).html(data);
                        //alert(data);
                    	}
                    });
            }
        </script>