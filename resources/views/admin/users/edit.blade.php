@extends('templates.admin.master')
@section('main-content')
<div class="col-lg-12 equel-grid">
                <div class="grid">
                  <p class="grid-header">Sửa người dùng</p>
                  @if(Session::has('msg'))
                      <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
                  @endif
                  <div class="grid-body">
                    <div class="item-wrapper">
                      <form action="{{route('admin.users.edit',[$itemUsers->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                           <div class="col-lg-7 equel-grid">
                                  <div class="grid-body">
                                     <div class="item-wrapper">
                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label>Tên người dùng</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control"  placeholder="Nhập tên vào đây" name="fullname" value="{{$itemUsers->fullname}}">
                                          </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label>Địa chỉ</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control" placeholder="Nhập địa chỉ" name="address" value="{{$itemUsers->address}}">
                                          </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label>Số điện thoại</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control"  placeholder="Nhập số điện thoại" name="phone" value="{{$itemUsers->phone}}">
                                          </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label>Giới tính</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <div class="form-check-inline">
                                                <label>
                                                  <input type="radio" value="1" name="gender" 
                                                  class=" form-check-input" 
                                                  @if($itemUsers->gender == 1) checked="" @endif>Nam
                                                </label>
                                              </div>

                                              <div class="form-check-inline">
                                                <label>
                                                  <input type="radio" value="0" name="gender" 
                                                  class=" form-check-input" @if($itemUsers->gender == 0) checked="" @endif>Nữ
                                                </label>
                                              </div> 
                                          </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label>Ngày sinh</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                             <input type="date" class="form-control" name="birthday" value="{{$itemUsers->birthday}}">
                                          </div>
                                        </div>


                                      </div>
                                  </div>
                            </div>
                            <div class="col-lg-5 equel-grid">           
                                      <div class="grid-body">
                                        <div class="item-wrapper">
                                         
                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label>Email</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="text" class="form-control"  placeholder="Nhập email của vào đây" name="email" value="{{$itemUsers->email}}">
                                          </div>
                                        </div>
                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label >Thay đổi mật khẩu</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                             <input type="checkbox" id="changePassword" name="checkboxpass">
                                          </div>
                                        </div>

                                        <div class="form-group row showcase_row_area password-new" hidden="">
                                          <div class="col-md-3 showcase_text_area">
                                            <label>Password</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <input type="password" class="form-control password "  placeholder="Nhập mật khẩu mới vào đây" name="password" disabled="">
                                          </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                          <div class="col-md-3 showcase_text_area">
                                            <label>Phân quyền</label>
                                          </div>
                                          <div class="col-md-9 showcase_content_area">
                                            <select name="permission" class="custom-select">
                                             <option value="" selected="">--> Phân quyền <--</option>
                                              <option value="0" @if($itemUsers->permission == 0) selected @endif>Người dùng</option>
                                              <option value="1" @if($itemUsers->permission == 1) selected @endif>Nhân viên</option>
                                              <option value="2" @if($itemUsers->permission == 2) selected @endif >Quản lý</option>
                                            </select>
                                          </div>
                                        </div>
                                        
                               </div>
                        </div>
                     </div>
                    </div>
                         <button type="reset" class="btn btn-success has-icon">
                          <i class="mdi mdi mdi-autorenew"></i>Làm Mới
                        </button>
                        <button type="submit" class="btn btn-primary has-icon">
                          <i class="mdi mdi-arrow-right-bold-hexagon-outline"></i>Sửa
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
  </div>
  

   <script>  
    $(document).ready(function(){
       $("#changePassword").change(function(){
           if($(this).is(":checked"))
           {
                $(".password-new").removeAttr('hidden');
                $(".password").removeAttr('disabled');
                $(".password").attr('style','background:white');
                $(".password").attr('style','color:black');
           }
           else{
               $(".password-new").attr('hidden','');
               $(".password").attr('disabled','');
               
           }
       });
    });
   
 </script>
@endsection()

