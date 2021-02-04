@extends('templates.admin.master')
@section('main-content')
<div class="col-lg-12 equel-grid">
                <div class="grid">
                  <p class="grid-header">Thêm Chương Trình Khuyến Mãi</p>
                  <div class="grid-body">
                    <div class="item-wrapper">
                      <form action="{{route('admin.sale.add')}}" method="post">
                        @csrf
                        <div class="form-group row showcase_row_area">
                          <div class="col-md-3 showcase_text_area">
                            <label for="inputEmail10">Nội dung</label>
                          </div>
                          <div class="col-md-9 showcase_content_area">
                            <input type="text" class="form-control" placeholder="Nhập nội dung vào đây" name="name">
                          </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                          <div class="col-md-3 showcase_text_area">
                            <label for="inputEmail10">Phần trăm</label>
                          </div>
                          <div class="col-md-9 showcase_content_area">
                            <input type="number" class="form-control" placeholder="Nhập số lương % vào đây" name="percent">
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
                            <label for="inputEmail10">Ngày bắt đầu</label>
                          </div>
                          <div class="col-md-9 showcase_content_area">
                            <input type="date" class="form-control"  name="date_start">
                          </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                          <div class="col-md-3 showcase_text_area">
                            <label for="inputEmail10">Ngày kết thúc</label>
                          </div>
                          <div class="col-md-9 showcase_content_area">
                            <input type="date" class="form-control"  name="date_end">
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


@endsection()

