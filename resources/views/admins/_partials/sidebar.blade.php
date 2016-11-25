<div class="nav-side-menu">
    <div class="brand">Logo</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">
                <li>
                    <a href="{{ route('admin.home') }}">
                        <i class="fa fa-dashboard fa-lg"></i> Trang chủ
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.room') }}">
                        <i class="ti-home"></i> Phòng
                    </a>
                </li>
                <li>
                    <a href="{{ route('amenities.index') }}">
                        <i class="ti-view-list-alt"></i> Tiện nghi
                    </a>
                </li>
                <li>
                    <a href="{{ route('spaces.index') }}">
                        <i class="ti-text"></i> Không gian
                    </a>
                </li>
                <li>
                    <a href="{{ route('properties.index') }}">
                        <i class="ti-pencil-alt2"></i> Tài sản
                    </a>
                </li>
                <li>
                    <a href="{{ route('kinds.index') }}">
                        <i class="ti-map"></i> Loại phòng
                    </a>
                </li>
                <li>
                    <a href="{{ route('bed_types.index') }}">
                        <i class="ti-bell"></i> Loại giường ngủ
                    </a>
                </li>
                <li>
                    <a href="{{ route('locations.index') }}">
                        <i class="ti-map-alt"></i> Địa điểm, vị trí
                    </a>
                </li>

                <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                    <a href="#"><i class="fa fa-gift fa-lg"></i> UI Elements <span class="arrow"></span></a>
                    <ul class="sub-menu collapse" id="products">
                        <li class="active"><a href="#">CSS3 Animation</a></li>
                        <li><a href="#">General</a></li>
                    </ul>
                </li>

                 <li>
                      <a href="#">
                            <i class="fa fa-users fa-lg"></i> Users
                      </a>
                </li>
                <li  data-toggle="collapse" data-target="#setting" class="collapsed ">
                    <a href="#"><i class="fa fa-cog fa-lg"></i> Cấu hình <span class="arrow"></span></a>
                    <ul class="sub-menu collapse" id="setting">
                        <li><a href="{{ route('settings.interface') }}">Giao diện</a></li>
                    </ul>
                </li>
            </ul>
     </div>
</div>