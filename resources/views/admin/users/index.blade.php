@extends('templates.admin.master')
@section('main-content') 
	<div class="grid">  
		<a href="{{route('admin.users.add')}}">   
			<div class="btn btn-success has-icon">
				<i class="mdi mdi-basket-fill"></i>Thêm
			</div>
		</a>   
    </div>
	<div class="col-lg-12">
        <div class="grid">
           @if(Session::has('msg'))
                <p style=" padding-left: 1%; color: green;">{{Session::get('msg')}}</p>
            @endif
          <p class="grid-header">Người dùng</p>
          <div class="item-wrapper">
            <div class="table-responsive">
              <table class="table info-table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Mã</th>
                    <th>Tên</th>
                    <th>email</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Phân quyền</th>
                    <th>Chức năng</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($listUser as $item)
                    @php 
                      if($item->gender == 0 ){
                        $gender = 'Nữ';
                      }else{
                        $gender = 'Nam';
                      }


                      if($item->permission == 0)
                      {
                        $permission = 'Người dùng';
                      }
                      elseif($item->permission == 1)
                      {
                        $permission = 'Nhân viên';
                      }
                      else
                      {
                        $permission = 'Quản lý';
                      }
                    @endphp
                  <tr>
                   <td>{{$item->id}}</td>
                    <td>{{$item->fullname}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->address}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$gender}}</td>
                    <td>{{$item->birthday}}</td>
                    <td>{{$permission}}</td>
                    <td>
                      <a href="{{route('admin.users.edit',[$item->id])}}" class="btn btn-success has-icon btn-sm">
                        <i class="mdi mdi-wrench"></i>Sửa
                      </a>
                      <a href="{{route('admin.users.delete',[$item->id])}}" class="btn btn-danger has-icon btn-sm">
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
@endsection()