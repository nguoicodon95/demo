@extends('admins.build_admin._master')
@section('titleName', 'Your listings')
    
@section('content')
<div class="page-content">
	<div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Tạo host mới</h1>
        </div>
        <!-- END PAGE TITLE -->
    </div>
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="javascript:;">Home</a><i class="fa fa-circle"></i>
        </li>
        <li class="active">
            Tạo host mới
        </li>
    </ul>

    <div class="row">
		<div class="col-md-12">
			<div class="portlet light form-fit">
				<div class="portlet-body">
					<div class="col-md-4">
						<div class="header">
							<p class="category">Bước 1</p>
							<h4 class="title">Bắt đầu từ cơ bản</h4>
						</div>
						<div class="content"> Phòng ngủ, phòng tắm, tiện nghi và nhiểu chức năng khác
							<hr>
						</div>
						<a href="{{ isset($next) ? $next : route('host.basic', ($data_Room != '') ? $data_Room->id : '') }}" 
							class="btn btn-primary"
							id="submit-step-1">{{ (isset($data_Room) && $data_Room != '' && !is_null($data_Room->process) && $data_Room->process->step_one == 1) ? 'Chỉnh sửa' : 'Bắt đầu' }}
						</a>
						@if(isset($data_Room) && ($data_Room != '' && !is_null($data_Room->process) && $data_Room->process->step_one == 1) )
							<span class="icon-check completed pull-right"></span>
						@endif
					</div>
					<div class="col-md-4">
						<div class="header">
							<p class="category">Bước 2</p>
							<h4 class="title">Thiết lập các cảnh</h4>
						</div>
						<div class="content"> Giường, phòng tắm, tiện nghi, và nhiểu chức năng khác
							<hr>
							@if($data_Room != '' && !is_null($data_Room->process))
								@if($data_Room->process->step_one == 1)
									<a href="{{ route('host.setting', ($data_Room != '') ? $data_Room->id : '')  }}" 
										class="btn btn-primary" 
										id="submit-step-2">{{ $data_Room->process->step_two == 1 ? 'Chỉnh sửa' : 'Làm tiếp' }}
									</a>
									@if($data_Room->process->step_two == 1 )
										<span class="icon-check completed pull-right"></span>
									@endif
								@endif
							@endif
						</div>
					</div>
					<div class="col-md-4">
						<div class="header">
							<p class="category">Bước 3</p>
							<h4 class="title">Hãy sẵn sàng cho khách</h4>
						</div>
						<div class="content"> Giá, lịch, cài đặt đặt phòng
							<hr>
							@if($data_Room != '' && !is_null($data_Room->process))
								@if($data_Room->process->step_two == 1)
									<a href="{{ route('host.booking', ($data_Room != '') ? $data_Room->id : '') }}" 
										class="btn btn-primary" 
										id="submit-step-3">{{ (isset($process_three) && $process_three > 95) ? 'Chỉnh sửa' : 'Làm tiếp' }}
									</a>
									@if( $data_Room->process->step_two == 1 )
										<span class="ti-check completed pull-right"></span>
									@endif
								@endif
							@endif
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
        </div>
    </div>
</div>
@stop

@push('css-style')
	<style>
		.portlet.light .portlet-body {
			padding-bottom: 8px;
		}
	</style>
@endpush