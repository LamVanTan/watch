@extends('templates.admin.master')
@section('main-content')
<div class="col-lg-12 equel-grid">
                <div class="grid">
                  <p class="grid-header">Thêm danh mục</p>
                  <div class="grid-body">
                    <div class="item-wrapper">
                      <form action="{{route('admin.category.add')}}" method="post">
                        @csrf
                        <div class="form-group row showcase_row_area">
                          <div class="col-md-3 showcase_text_area">
                            <label for="inputEmail10">Tên</label>
                          </div>
                          <div class="col-md-9 showcase_content_area">
                            <input type="text" class="form-control" placeholder="Nhập tên danh mục vào đây" name="name">
                          </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                          <div class="col-md-3 showcase_text_area">
                            <label for="inputEmail4">Trang thái</label>
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

                        <div class="form-group row showcase_row_area">
                          <div class="col-md-3 showcase_text_area">
                            <label for="inputEmail10">Chọn danh mục cha</label>
                          </div>
                          <div class="col-md-9 showcase_content_area">
                             <input type="checkbox" id="changeParent" name="checkboxpass">
                          </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                          <div class="col-md-3 showcase_text_area">
                            <label for="inputEmail10">Danh mục cha</label>
                          </div>
                          <div class="col-md-9 showcase_content_area">
                            <select name="parent_id" class="custom-select parent" disabled>
                              @php category($listParentId) @endphp
                            </select>
                          </div>
                        </div>

                         <button type="reset" class="btn btn-success has-icon">
                          <i class="mdi mdi mdi-autorenew"></i>Làm mới
                        </button>
                        <button type="submit" class="btn btn-primary has-icon">
                        	<i class="mdi mdi-arrow-right-bold-hexagon-outline"></i>Thêm
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
                  <!-- summernote config -->

 <script>  
    $(document).ready(function(){
       $("#changeParent").change(function(){
           if($(this).is(":checked"))
           {
                $(".parent").removeAttr('disabled');
                $(".parent").attr('style','background:white');
                $(".parent").attr('style','color:black');
           }
           else{
               $(".parent").attr('disabled','');
           }
       });
    });
   
 </script>

@endsection()

