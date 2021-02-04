@extends('templates.admin.master')
@section('main-content') 
	<div class="grid">  
		<a href="{{route('admin.sale.add')}}">   
			<div class="btn btn-success has-icon">
				<i class="mdi mdi-basket-fill"></i>Thêm
			</div>
		</a>   
    </div>
	<div class="col-lg-12">
        <div class="grid">
          <p class="grid-header">Danh mục</p>

          @if(Session::has('msg'))
              <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
          @endif
          <div class="item-wrapper">
            <div class="table-responsive">
              <table class="table info-table table-striped table-bordered ">
                <thead>
                  <tr>
                    <th>Mã</th>
                    <th>Nội dung khuyến mãi</th>
                    <th>Phần trăm chiết khấu</th>
                    <th>Trạng thái</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Chức năng</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($listSale as $item) 
                    @php
                      $sale_id = $item->sale_id;
                      $sale_name = $item->sale_name;
                      $sale_status = $item->sale_status;
                      $sale_percent = $item->sale_percent;
                      $sale_date_start = $item->sale_date_start;
                      $sale_date_end = $item->sale_date_end;
                      if($sale_status == 1){
                        $class = 'badge badge-success';
                        $text = 'show';
                      }else{
                        $class = 'badge badge-danger';
                        $text = 'hide';
                      }

                    @endphp

                  <tr>
                    <td>{{$sale_id}}</td>
                    
                    <td>{{$sale_name}}</td>
                    <td>{{$sale_percent}}%</td>
                    <td><label class="{{$class}}">{{$text}}</label></td>
                    <td>{{$sale_date_start}}</td>
                    <td>{{$sale_date_end}}</td>
                  
                    <td>
                    	<a href="{{route('admin.sale.edit',$sale_id)}}" class="btn btn-success has-icon btn-sm">
                    		<i class="mdi mdi-wrench"></i>Sửa
                    	</a>
                    	<a href="{{route('admin.sale.delete',$sale_id)}}" class="btn btn-danger has-icon btn-sm">
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
                      {{$listSale->links('vendor.pagination.bootstrap-4')}}
                  </div>
              </div>
          </div>
          </div>
        </div>
    </div>
    <script type="text/javascript">
  // $(document).ready(function(){   
  //     $(document).on('click','td .ab ',function(e){
  //       //function(e) huy bo thuoc tinh cua herf cua the a
  //       e.preventDefault();
  //       var sale_id = $(this).prop('title').split('-')[0];
  //       var sale_status = $(this).prop('title').split('-')[1];
  //       fetch_data(sale_id,sale_status);    
  //     });
  //     function fetch_data(sale_id,sale_status){
        
  //       //alert(url);
  //       $.ajax({
  //         url:'{{route("ajax-status-post")}}', 
  //         method:"POST",
  //         data:{
  //           "_token":'{{ csrf_token() }}',
  //           "sale_id":sale_id,
  //           "sale_status":sale_status
  //         },
  //         success: function(data){
  //            var status = '.abc-'+sale_id;
  //            $(status).html(data);
  //           //alert(data);
  //         }
  //       });
  //     } 
  // });
</script>
@endsection()