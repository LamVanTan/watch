@extends('templates.admin.master')
@section('main-content')
<div class="col-lg-12 equel-grid">
                <div class="grid">
                  <p class="grid-header">Sửa chương trình khuyến mãi</p>
                  <div class="grid-body">
                    <div class="item-wrapper">
                       @php
                          $sale_id = $itemSale->sale_id;
                          $sale_name = $itemSale->sale_name;
                          $sale_status = $itemSale->sale_status;
                          $sale_date_start = $itemSale->sale_date_start;
                          $sale_date_end = $itemSale->sale_date_end;
                          $sale_percent = $itemSale->sale_percent;
                          
                        @endphp
                      <form action="{{route('admin.sale.edit',$sale_id)}}" method="post">
                        @csrf
                        <div class="form-group row showcase_row_area">
                          <div class="col-md-3 showcase_text_area">
                            <label for="inputEmail10">Nội dung</label>
                          </div>

                          <div class="col-md-9 showcase_content_area">
                            <input type="text" name="sale_name" class="form-control"  value="{{$sale_name}}">
                          </div>
                        </div>

                        <div class="form-group row showcase_row_area">
                          <div class="col-md-3 showcase_text_area">
                            <label for="inputEmail10">Số lượng chiết khấu</label>
                          </div>

                          <div class="col-md-9 showcase_content_area">
                            <input type="number" name="sale_percent" class="form-control"  value="{{$sale_percent}}">
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
                                  @if($sale_status == 1) 
                                    checked="" 
                                  @endif >Hiện
                                </label>
                              </div>

                              <div class="form-check-inline">
                                <label >
                                  <input type="radio" value="0" name="status" 
                                  class=" form-check-input"
                                  @if($sale_status == 0) 
                                    checked=""
                                  @endif>Ẩn
                                </label>
                              </div> 
                          </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                          <div class="col-md-3 showcase_text_area">
                            <label for="inputEmail10">Ngày bắt đầu</label>
                          </div>

                          <div class="col-md-9 showcase_content_area">
                            <input type="text" name="sale_date_start" class="form-control"  value="{{$sale_date_start}}">
                          </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                          <div class="col-md-3 showcase_text_area">
                            <label for="inputEmail10">Ngày kết thúc</label>
                          </div>

                          <div class="col-md-9 showcase_content_area">
                            <input type="text" name="sale_date_end" class="form-control"  value="{{$sale_date_end}}">
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

@endsection()