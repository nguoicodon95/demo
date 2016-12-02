<div class="row">
	<div class="col-lg-3 col-sm-6">
		<div class="card">
			<div class="content">
				<div class="footer">
					<div class="stats">
						<a href="{{ route('admin.room.create') }}"><i class="ti-marker-alt"></i> Add new listings</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-sm-6">
		<div class="card">
			<div class="content">
				<div class="footer">
					<div class="stats">
						<i class="ti-calendar"></i> Last day
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-sm-6">
		<div class="card">
			<div class="content">
				<div class="footer">
					<div class="stats">
						<i class="ti-timer"></i> In the last hour
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-sm-6">
		<div class="card">
			<div class="content">
				<div class="footer">
					<div class="stats">
						<i class="ti-reload"></i> Updated now
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@if(!isset($process_display) && isset($data_Room) && ($data_Room != '') && !is_null($data_Room->process))
	@if($data_Room->process->step_one['completed'] == 100 && isset($step_one) && $step_one == true)
<nav class="navbar navbar-customs">
  <div class="">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li {{ \Request::route()->getName() == 'host.kindroom' ? 'class=active' : '' }}><a href="{{ route('host.kindroom', isset($data_Room) && ($data_Room != '') ? $data_Room->id : '') }}">Loại địa điểm</a></li>
        <li {{ \Request::route()->getName() == 'host.bedrooms' ? 'class=active' : '' }}><a href="{{ route('host.bedrooms', isset($data_Room) && $data_Room != '' ? $data_Room->id : '') }}">Phòng ngủ</a></li>
        <li {{ \Request::route()->getName() == 'host.bathrooms' ? 'class=active' : '' }}><a href="{{ route('host.bathrooms', isset($data_Room) && $data_Room != '' ? $data_Room->id : '') }}">Phòng tắm</a></li>
        <li {{ \Request::route()->getName() == 'host.location' ? 'class=active' : '' }}><a href="{{ route('host.location', isset($data_Room) && $data_Room != '' ? $data_Room->id : '')}}">Vị trí - địa điểm</a></li>
        <li {{ \Request::route()->getName() == 'host.amenities' ? 'class=active' : '' }}><a href="{{ route('host.amenities', isset($data_Room) && $data_Room != '' ? $data_Room->id : '') }}">Tiện nghi</a></li>
        <li {{ \Request::route()->getName() == 'host.spaces' ? 'class=active' : '' }}><a href="{{ route('host.spaces', isset($data_Room) && $data_Room != '' ? $data_Room->id : '') }}">Không gian</a></li>
      </ul>
     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="progress">
  <div class="progress-bar progress-bar-success" 
  		role="progressbar" 
  		aria-valuenow="0" 
  		aria-valuemin="0" 
  		aria-valuemax="100" 
  		style="width: {{ !is_null($data_Room->process) ? $data_Room->process->step_one['completed'] : 3}}%">
    <span class="sr-only"></span>
  </div>
</div>
<a href="{{ route('admin.room.create', isset($data_Room) && $data_Room != '' ? $data_Room->id : '') }}" class="btn btn-default pull-right">Lưu và quay lại</a>
	@endif

	@if(isset($process_two) && $process_two >= 75 && isset($step_two) && $step_two == true)
  <nav class="navbar navbar-customs">
    <div class="">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav tab-4">
          <li {{ \Request::route()->getName() == 'host.highlights' ? 'class=active' : '' }}><a href="{{ route('host.highlights', isset($data_Room) && ($data_Room != '') ? $data_Room->id : '') }}">Điểm nổi bật</a></li>
          <li {{ \Request::route()->getName() == 'host.description' ? 'class=active' : '' }}><a href="{{ route('host.description', isset($data_Room) && $data_Room != '' ? $data_Room->id : '') }}">Giới thiệu</a></li>
          <li {{ \Request::route()->getName() == 'host.title' ? 'class=active' : '' }}><a href="{{ route('host.title', isset($data_Room) && $data_Room != '' ? $data_Room->id : '') }}">Tiêu đề</a></li>
          <li {{ \Request::route()->getName() == 'host.photos' ? 'class=active' : '' }}><a href="{{ route('host.photos', isset($data_Room) && $data_Room != '' ? $data_Room->id : '') }}">Hình ảnh</a></li>
        </ul>
       
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <div class="progress">
    <div class="progress-bar progress-bar-success" 
    		role="progressbar" 
    		aria-valuenow="0" 
    		aria-valuemin="0" 
    		aria-valuemax="100" 
    		style="width: {{ isset($process_two) && $process_two >= 75 ? $process_two : 3}}%">
      <span class="sr-only"></span>
    </div>
  </div>
  <a href="{{ route('admin.room.create', isset($data_Room) && $data_Room != '' ? $data_Room->id : '') }}" class="btn btn-default pull-right">Lưu và quay lại</a>
  <div class="clearfix"></div>
	@endif
	@if(isset($process_three) && $process_three > 95 && isset($step_three) && $step_three == true)
  <nav class="navbar navbar-customs">
    <div class="">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav tab-8">
          <li {{ \Request::route()->getName() == 'host.experience' ? 'class=active' : '' }}><a href="{{ route('host.experience', isset($data_Room) && ($data_Room != '') ? $data_Room->id : '') }}">Câu hỏi 1</a></li>
          <li {{ \Request::route()->getName() == 'host.occupancy' ? 'class=active' : '' }}><a href="{{ route('host.occupancy', isset($data_Room) && $data_Room != '' ? $data_Room->id : '') }}">Câu hỏi 2</a></li>
          <li {{ \Request::route()->getName() == 'host.booking' ? 'class=active' : '' }}><a href="{{ route('host.booking', isset($data_Room) && $data_Room != '' ? $data_Room->id : '') }}">Cài đặt</a></li>
          <li {{ \Request::route()->getName() == 'host.pricing_mode' ? 'class=active' : '' }}><a href="{{ route('host.pricing_mode', isset($data_Room) && $data_Room != '' ? $data_Room->id : '') }}">Cài đặt giá</a></li>
          <li {{ \Request::route()->getName() == 'host.price' ? 'class=active' : '' }}><a href="{{ route('host.price', isset($data_Room) && $data_Room != '' ? $data_Room->id : '') }}">Giá</a></li>
          <li {{ \Request::route()->getName() == 'host.addpricing' ? 'class=active' : '' }}><a href="{{ route('host.addpricing', isset($data_Room) && $data_Room != '' ? $data_Room->id : '') }}">Giá bổ sung</a></li>
          <li {{ \Request::route()->getName() == 'host.rules' ? 'class=active' : '' }}><a href="{{ route('host.rules', isset($data_Room) && $data_Room != '' ? $data_Room->id : '') }}">Quy tắc</a></li>
          <li {{ \Request::route()->getName() == 'host.locations_around' ? 'class=active' : '' }}><a href="{{ route('host.locations_around', isset($data_Room) && $data_Room != '' ? $data_Room->id : '') }}">Vị trí thuận lợi</a></li>
        </ul>
       
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <div class="progress">
    <div class="progress-bar progress-bar-success" 
        role="progressbar" 
        aria-valuenow="0" 
        aria-valuemin="0" 
        aria-valuemax="100" 
        style="width: {{ isset($process_three) && $process_three >= 75 ? $process_three : 3}}%">
      <span class="sr-only"></span>
    </div>
  </div>
  <a href="{{ route('admin.room.create', isset($data_Room) && $data_Room != '' ? $data_Room->id : '') }}" class="btn btn-default pull-right">Lưu và quay lại</a>
  <div class="clearfix"></div>
  @endif
@endif

<style>
	.progress {
		height: 5px;
	}
	.progress-bar-success {
	    background-color: #00a699;
	}
	.navbar-customs {
		background: #fafafa;
		min-height: 50px;
	}

	.navbar-customs ul li {
		border-right: 1px solid #dce0e0;
	}
	.navbar-customs .navbar-nav > li > a {
	    line-height: 0;
	    margin: 10px 0px;
	    padding: 15px 15px;
	    color: #484848;
      white-space: nowrap;
      overflow: hidden;
      -o-text-overflow: ellipsis;
      text-overflow: ellipsis;
	}
	.navbar-customs .navbar-nav {
		width: 100%;
	}
	.navbar-customs .navbar-nav li {
		width: 16.66666667%;
	}

	.navbar-customs .navbar-nav li.active {
		background: #dce0e0;
	}

  .navbar-customs .tab-4 li {
    width: 25%;
  }

	.navbar-customs .tab-8 li {
		width: {{100/8}}%;
	}
</style>