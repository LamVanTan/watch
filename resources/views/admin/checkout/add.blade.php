@extends('templates.admin.master')
@section('main-content')
<div class="col-lg-12 equel-grid">
                <div class="grid">
                  <p class="grid-header">Thêm sản phẩm</p>
                  @if(Session::has('msg'))
                      <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
                  @endif
                  <div class="grid-body">
                    <div class="item-wrapper">
                      <form action="{{route('admin.products.add')}}" method="post" enctype="multipart/form-data">
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
                                            <input type="text" class="form-control"  placeholder="Nhập tên vào đây" name="name">
                                          </div>
                                        </div>
                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="inputEmail4">Giá</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="number" class="form-control" placeholder="Nhập giá vào đây" name="price">
                                          </div>
                                        </div>
                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label>Số lượng</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control"  placeholder="Nhập số lượng vào đây" name="quantity">
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
                                                  >Hiện
                                                </label>
                                              </div>

                                              <div class="form-check-inline">
                                                <label >
                                                  <input type="radio" value="0" name="status" 
                                                  class=" form-check-input"
                                                  >Ẩn
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
                                          </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="inputEmail10">Khuyến mãi</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
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
                                             <option value="" selected="">Số lượng giảm %</option>
                                             
                                             @foreach($listSale as $item)
                                             
                                               <option value="{{$item->sale_id}}">
                                                {{$item->sale_percent}}%
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
                                             @php category($listParentId) @endphp
                                            </select>
                                          </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="inputEmail10">Ngày Nhập</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                             <input type="date" class="form-control" name="product_date">
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
                                            <input type="text" class="form-control"  placeholder="Nhập xuất xứ vào đây" name="origin">
                                          </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="">Đường kính</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control"  placeholder="Nhập dường kính vào đây" name="diameter">
                                          </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="">Độ dày</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control"  placeholder="Nhập độ dày vào đây" name="thickness">
                                          </div>
                                        </div>
                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="inputEmail5">Dây</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control"  placeholder="Nhập dây vào đây" name="bracelet">
                                          </div>
                                        </div>
                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="">Vỏ</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control"  placeholder="Nhập vỏ vào đây" name="case">
                                          </div>
                                        </div>
                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="inputEmail5">Kính</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control"  placeholder="Nhập kính vào đây" name="crystal">
                                          </div>
                                        </div>
                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label for="">Bộ máy</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control"  placeholder="Nhập bộ máy vào đây" name="machine">
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
                                            name="detail" id="summernote-editor"></textarea>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                              </div>

                         <button type="reset" class="btn btn-success has-icon">
                          <i class="mdi mdi mdi-autorenew"></i>Reload
                        </button>
                        <button type="submit" class="btn btn-primary has-icon">
                        	<i class="mdi mdi-arrow-right-bold-hexagon-outline"></i>Add
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
  </div>
                  <!-- summernote config -->


    <script>  
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

