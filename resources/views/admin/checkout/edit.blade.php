@extends('templates.admin.master')
@section('main-content')
<div class="col-lg-12 equel-grid">
                <div class="grid">
                  <p class="grid-header">Sửa sản phẩm</p>
                  @if(Session::has('msg'))
                      <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
                  @endif
                  <div class="grid-body">
                    <div class="item-wrapper">
                      <form action="{{route('admin.products.edit',$itemProducts->products_id)}}" 
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                           <div class="col-lg-7 equel-grid">
                              
                                  <div class="grid-body">
                                     <div class="item-wrapper">
                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="inputEmail10">Tên</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control"  placeholder="Tên " name="name" value="{{$itemProducts->products_name}}">
                                          </div>
                                        </div>
                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="inputEmail4">Giá</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="number" class="form-control" placeholder="Giá " name="price" value="{{$itemProducts->products_price}}">
                                          </div>
                                        </div>
                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label>Số lượng</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control"  placeholder="Số lượng " name="quantity" value="{{$itemProducts->products_quantity}}">
                                          </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label>Trạng thái</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <div class="form-check-inline">
                                                <label >
                                                  <input type="radio" value="1" name="status" 
                                                  class=" form-check-input"
                                                  @if($itemProducts->products_status == 1) 
                                                    checked="" 
                                                  @endif 
                                                  >hiện
                                                </label>
                                              </div>

                                              <div class="form-check-inline">
                                                <label >
                                                  <input type="radio" value="0" name="status" 
                                                  class=" form-check-input"
                                                  @if($itemProducts->products_status == 0) 
                                                    checked=""
                                                  @endif
                                                  >ẩn
                                                </label>
                                              </div> 
                                          </div>
                                        </div>

                                         <div class=" orm-group row showcase_row_area ">
                                          <div class="col-md-3 showcase_text_area">
                                            <label>File Upload</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <div class="custom-file">
                                              <input type="file" class="custom-file-input" id="customFile" multiple="multiple" name="photos[]">
                                              <label class="custom-file-label" for="customFile">Chọn file</label>
                                            </div>
                                            @php $dem = 1; @endphp
                                             <div class="slider-img" style="margin-top: 5%">
                                              @foreach($itemProducts->images as $img) 
                                                 
                                                <a href="#slide-{{$itemProducts->products_id}}-{{$dem}}">{{$dem}}</a>
                                                @php $dem++; @endphp
                                                @endforeach

                                                <div class="slides-img">
                                                  @php $i = 1; @endphp
                                                  @foreach($itemProducts->images as $img)
                                                    @php
                                                      $filename = $img->images_name;
                                                      $urlPic = '/storage/app/public/files/'.$filename; 
                                                    @endphp
                                                    
                                                  <div id="slide-{{$itemProducts->products_id}}-{{$i}}"> 
                                                    
                                                    <img src="{{$urlPic}}" alt="" style="width:170px; height:200px;">
                                                    <span class="img-edit-delete">
                                                      <a href="javascript:void(0)" 
                                                        class="editimg-{{$i}}">
                                                        <span class="mdi mdi-wrench link-icon"></span>
                                                      </a>

                                                      <a href="{{route('admin.products.deletepicture',$img->images_id)}}">
                                                        <span class="mdi mdi-delete link-icon"></span>
                                                      </a>
                                                    </span>
                                                  </div>
                                                  @php $i++; @endphp
                                                  @endforeach
                                                </div>
                                              </div>
                                          </div>
                                        </div>

                                        
                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-4 showcase_text_area">
                                            <label for="inputEmail10">Khuyến mãi </label>
                                          </div>
                                          <div class="col-md-8 showcase_content_area">
                                             <input type="checkbox" id="changeSale" 
                                             name="sale_id">
                                          </div>
                                        </div>
                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="">Giảm giá</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <select name="sale_id" class="custom-select sale" disabled="">
                                             <option value="" selected="">số lượng giá giảm %</option>
                                             @php $Products_sale = $itemProducts->sale_id @endphp
                                             @foreach($listSale as $item)
                                             @php $sale_id = $item->sale_id @endphp
                                             
                                               <option value="{{$item->sale_id}}"
                                                  @if($Products_sale == $sale_id)
                                                    selected =""
                                                  @endif
                                                >
                                                {{$item->sale_name}}
                                               </option>
                                             @endforeach
                                            </select>
                                          </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label >Danh mục</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <select name="parent_id" class="custom-select ">
                                              @php  $products_cat = $itemProducts->cat_id @endphp
                                             @foreach($resultParent as $item) 
                                                @php
                                                  $cat_id_parent = $item->cat_id;
                                                  $cat_name_parent = $item->cat_name
                                                @endphp                                    
                                                 
                                                <option value="{{$cat_id_parent}}" 
                                                  @if( $cat_id_parent == $products_cat) 
                                                    selected=""
                                                  @endif >
                                                  {{str_repeat(' => ',$item->level).$cat_name_parent}}
                                                </option>
                                                option
                                              @endforeach
                                            </select>
                                          </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="inputEmail10">Ngày Nhập</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                             <input type="date" value="{{$itemProducts->products_datetime}}" class="form-control" name="product_date">

                                          </div>
                                        </div>


                                      </div>
                                  </div>
                                
                            </div>
                            <div class="col-lg-5 equel-grid">           
                                      <div class="grid-body">
                                        <div class="item-wrapper">
                                         <b>Thông số kỹ thuật</b><hr>

                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="">Xuất xứ</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control"  placeholder="Xuất xứ " name="origin" value="{{$itemProducts->products_origin}}">
                                          </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="">Đường kính</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control"  placeholder="Đường kính " name="diameter" value="{{$itemProducts->products_diameter}}">
                                          </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="">Độ dày</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control"  placeholder="Độ dày" name="thickness" value="{{$itemProducts->products_thickness}}">
                                          </div>
                                        </div>
                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="inputEmail5">Dây</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control"  placeholder="Dây" name="bracelet" value="{{$itemProducts->products_bracelet}}">
                                          </div>
                                        </div>
                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="">Vỏ</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control"  placeholder="Vỏ" name="case" value="{{$itemProducts->products_case}}">
                                          </div>
                                        </div>
                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="inputEmail5">Kính</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control"  placeholder="Kính" name="crystal" value="{{$itemProducts->products_crystal}}">
                                          </div>
                                        </div>
                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="">Bộ máy</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control"  placeholder="Bộ máy" name="machine" value="{{$itemProducts->products_machine}}">
                                          </div>
                                        </div>
                                        </div>
                                      </div>         
                               </div>
                        </div>
                        
                        <div class="row">
                           <div class="col-lg-12 equel-grid">
                                  <div class="grid-body">
                                     <div class="item-wrapper">
                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-1 showcase_text_area">
                                            <label for="">Nội Dung</label>
                                          </div>
                                          <div class="col-md-12 showcase_content_area">
                                            <textarea class="form-control" rows="50"  
                                            name="detail" id="summernote-editor">{{$itemProducts->products_detail}}
                                            </textarea>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                              </div>
                         <button type="reset" class="btn btn-success has-icon">
                          <i class="mdi mdi mdi-autorenew"></i>Làm mới
                        </button>
                        <button type="submit" class="btn btn-primary has-icon">
                        	<i class="mdi mdi-arrow-right-bold-hexagon-outline"></i>Sửa
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
  </div>
 
<!-- form sua hinh -->
@php $i = 1; @endphp
@foreach($itemProducts->images as $img) 
  @php 
     $filename = $img->images_name;
     $urlPic = '/storage/app/public/files/'.$filename; 
  @endphp
<div class="modal" id="login-{{$i}}">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content">     
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Sửa </h4>
          <button type="button" class="close" data-dismiss="modal" id="close-{{$i}}">&times;</button>
        </div>    
        <!-- Modal body -->
        <div class="modal-body " style="text-align: center;">
          
          <img src="{{$urlPic}}" alt="" style="width:200px; height:200px;">
          <form action="{{route('admin.products.editpicture',$img->images_id)}}" method="post" enctype="multipart/form-data">
            @csrf
             <div class=" row bg-secondary p-5">
                <div class="col-md-3 showcase_text_area">
                  <label>Sửa file ảnh</label>
                </div>
                <div class="col-md-9 showcase_content_area">
                   <div class="custom-file">
                      <input type="file" name="upfile" class="custom-file-input edit-img" id="customFile">
                      <label class="custom-file-label" for="customFile" style="text-align: left;"></label>
                    </div>
                </div>
                  <div class="col-md-12 " style="margin-top: 30px;">
                    <button type="reset" class="btn btn-success float-left m-1">
                          <i class="mdi mdi mdi-autorenew"></i>Làm mới
                        </button>
                        <button type="submit" class="btn btn-primary float-left m-1">
                          <i class="mdi mdi-arrow-right-bold-hexagon-outline"></i>Sửa
                        </button>
                  </div>
                </div>
          </form>
        </div>  
      </div>
    </div>
</div>
@php $i++; @endphp
@endforeach

@php $i = 1; @endphp
@foreach($itemProducts->images as $img) 
<script type="text/javascript">
   $(document).ready(function() {
     $(".editimg-<?php echo $i; ?>").click(function(){
        
        $("#login-<?php echo $i; ?>").show(function(){
          $("#close-<?php echo $i; ?>").click(function(){
            $("#login-<?php echo $i; ?>").hide(300);
          });
        });
        
     });
  });

   // Add the following code if you want the name of the file appear on select

</script>
@php $i++; @endphp
@endforeach
          
        <!-- summernote config -->
 
<style type="text/css">
  .img-edit-delete{
      position: absolute;
     
    }
    .img-edit-delete{
      font-size: 25px;     

    }
    .img-edit-delete a{
      position: relative;
      left:90px;
      bottom: 110px;
    }
    
    * {
      box-sizing: border-box;
    }

    .slider-img {
      width: 250px;
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
      width: 260px;
      height: 260px;
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
      transform: scale(1);
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
<script> 
$(document).ready(function(){ 
$(".edit-img").on("change", function() {
  var file = $(this).val().split("\\").pop();
  var Name = file.slice(0, 3);
  
  var duoi = $(this).val().split(".").pop();
  var fileName = Name+'.'+duoi
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
  });

  $(document).ready(function(){
     $("#changeSale").change(function(){
         if($(this).is(":checked"))
         {
              $(".sale").removeAttr('disabled');
              $(".sale").attr('style','background:white');
              $(".sale").attr('style','color:black');
         }
         else{
             $(".sale").attr('disabled','');
         }
     });
  });
   
 </script>

@endsection()

