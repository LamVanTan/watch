@extends('templates.admin.master')
@section('main-content') 
	<div class="grid">  
		<a href="{{route('admin.category.add')}}">   
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
                    <th>Tên danh mục</th>
                    <th>Trạng thái</th>
                    <th>Chức năng</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($resultParent as $item) 
                    @php
                      $cat_id = $item->cat_id;
                      $cat_name = $item->cat_name;
                      $cat_status = $item->cat_status;
                     
                      if($cat_status == 1){
                        $background = 'badge badge-success';
                        $show = 'show';
                      }else{
                        $background = 'badge badge-danger';
                        $show = 'hide';
                      }

                    @endphp

                  <tr>
                    <td>{{$cat_id}}</td>
                    
                    <td>@for($i=0;$i<$item->level; $i++)
                          <i class="mdi mdi-arrow-right-bold-hexagon-outline" ></i>
                        @endfor
                        {{$item->cat_name}}</td>
                    
                    <td class="abc-{{$cat_id}}">
                      <label class="{{$background}} ab" title="{{$cat_id.'-'.$cat_status}}">{{$show}}</label>
                      
                    </td>
                    <td>
                    	<a href="{{route('admin.category.edit',$cat_id)}}" class="btn btn-success has-icon btn-sm">
                    		<i class="mdi mdi-wrench"></i>Sửa
                    	</a>
                    	<a href="{{route('admin.category.delete',$cat_id)}}" class="btn btn-danger has-icon btn-sm">
                    		<i class="mdi mdi-close-circle"></i>Xóa
                    	</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            
          </div>
        </div>
    </div>
    <script type="text/javascript">
  $(document).ready(function(){   
      $(document).on('click','td .ab ',function(e){
        //function(e) huy bo thuoc tinh cua herf cua the a
        e.preventDefault();
        var cat_id = $(this).prop('title').split('-')[0];
        var cat_status = $(this).prop('title').split('-')[1];
        fetch_data(cat_id,cat_status);    
      });
      function fetch_data(cat_id,cat_status){
        
        //alert(url);
        $.ajax({
          url:'{{route("ajax-status-post")}}', 
          method:"POST",
          data:{
            "_token":'{{ csrf_token() }}',
            "cat_id":cat_id,
            "cat_status":cat_status
          },
          success: function(data){
             var status = '.abc-'+cat_id;
             $(status).html(data);
            //alert(data);
          }
        });
      } 
  });
</script>
@endsection()