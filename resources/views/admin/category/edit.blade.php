@extends('templates.admin.master')
@section('main-content')
<div class="col-lg-12 equel-grid">
                <div class="grid">
                  <p class="grid-header">Sửa danh mục</p>
                  <div class="grid-body">
                    <div class="item-wrapper">
                       @php
                          $cat_id = $result->cat_id;
                          $cat_name = $result->cat_name;
                          $cat_status = $result->cat_status;
                          
                        @endphp
                      <form action="{{route('admin.category.edit',$cat_id)}}" method="post">
                        @csrf
                        <div class="form-group row showcase_row_area">
                          <div class="col-md-3 showcase_text_area">
                            <label for="inputEmail10">Tên</label>
                          </div>

                          <div class="col-md-9 showcase_content_area">
                            <input type="text" name="name_cat" class="form-control"  value="{{$cat_name}}">
                          </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                          <div class="col-md-3 showcase_text_area">
                            <label for="inputEmail4">Trạng thái</label>
                          </div>

                          <div class="col-md-9 showcase_content_area">
                            <div class="form-check-inline">
                                <label >
                                  <input type="radio" value="1" name="status" 
                                  class=" form-check-input"
                                  @if($cat_status == 1) 
                                    checked="" 
                                  @endif >Hiện
                                </label>
                              </div>

                              <div class="form-check-inline">
                                <label >
                                  <input type="radio" value="0" name="status" 
                                  class=" form-check-input"
                                  @if($cat_status == 0) 
                                    checked=""
                                  @endif>Ẩn
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
                              @foreach($resultParent as $item) 
                                @php
                                  $cat_id_parent = $item->cat_id;
                                  $cat_name_parent = $item->cat_name
                                @endphp                                    
                                 
                                <option value="{{$cat_id_parent}}" 
                                  @if( $cat_id_parent == $cat_id) 
                                    selected=""
                                  @endif >
                                  {{str_repeat(' => ',$item->level).$cat_name_parent}}
                                </option>
                                option
                              @endforeach
                            </select>
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