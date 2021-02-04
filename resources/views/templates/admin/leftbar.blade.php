   <!-- partial -->
    <div class="page-body">
      <!-- partial:partials/_sidebar.html -->
      <div class="sidebar">
        <div class="user-profile">
          <div class="display-avatar animated-avatar">
            <img class="profile-img img-lg rounded-circle" src="{{$adminUrl}}/images/profile/male/image_1.png" alt="profile image">
          </div>
          <div class="info-wrapper">
            <p class="user-name">
                
                  @if(Auth::check())
                    @php
                      $fullname = Auth::user()->fullname; 
                    @endphp 
                  @else 
                    @php
                      $fullname = "";
                    @endphp
                    
                  @endif 
                  {{$fullname}}
             </p>
            <h6 class="display-income">
              @if(Auth::check())
                    @php
                      $email = Auth::user()->email; 
                    @endphp 
                  @else 
                    @php
                      $email = "";
                    @endphp
                    
                  @endif 
                  {{$email}}</h6>
          </div>
        </div>
        <ul class="navigation-menu">
          <li class="nav-category-divider">Chính</li>
          <li>
            <a href="{{route('admin.index.index')}}">
              <span class="link-title">Bảng điều khiển</span>
              <i class="mdi mdi-gauge link-icon"></i>
            </a>
          </li>

           <li>
            <a href="{{route('admin.category.index')}}">
              <span class="link-title">Danh mục</span>
              <i class="mdi mdi-format-list-bulleted link-icon"></i>
            </a>
           </li>

          <li>
            <a href="{{route('admin.sale.index')}}">
              <span class="link-title">Chương trình khuyến mãi</span>
              <i class="mdi mdi-buffer link-icon"></i>
            </a>
          </li>

           <li>
            <a href="{{route('admin.products.index')}}">
              <span class="link-title">Sản phẩm</span>
              <i class="mdi mdi-gauge link-icon"></i>
            </a>
          </li>
          <li>
            <a href="{{route('admin.checkout.index')}}">
              <span class="link-title">Đơn đặt hàng</span>
              <i class="mdi mdi-flower-tulip-outline link-icon"></i>
            </a>
          </li>
          
          <li>
            <a href="{{route('admin.users.index')}}">
              <span class="link-title">Người dùng</span>
              <i class="mdi mdi-account-card-details link-icon"></i>
            </a>
          </li>
          
         
        </ul>
       
      </div>
      <!-- partial -->
      <div class="page-content-wrapper">
        @yield('main-content')
        <!-- content viewport ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="row">
            <div class="col-sm-6 text-center text-sm-right order-sm-1">
              <ul class="text-gray">
                <li><a href="#">Terms of use</a></li>
                <li><a href="#">Privacy Policy</a></li>
              </ul>
            </div>
            <div class="col-sm-6 text-center text-sm-left mt-3 mt-sm-0">
              <small class="text-muted d-block">Copyright © 2019 <a href="http://www.uxcandy.co" target="_blank">UXCANDY</a>. All rights reserved</small>
              <small class="text-gray mt-2">Handcrafted With <i class="mdi mdi-heart text-danger"></i></small>
            </div>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- page content ends -->
    </div>
    <!--page body ends -->