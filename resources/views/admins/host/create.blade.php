@extends('admins.master')
@section('titleName')
    Your listings
@stop
@section('content')
<div class="content">
    <div class="container-fluid">
        
        @include('admins.host._shared.action')

        <div class="row cronjob" id="cronjob">
            <div class="col-md-4">
		        <div class="card form-stack" id="step-1" data-target="step-1" data-complete="false">
		            <div class="header">
		                <p class="category">Bước 1</p>
		                <h4 class="title">Bắt đầu từ cơ bản</h4>
		            </div>
		            <div class="content">
		                Phòng ngủ, phòng tắm, tiện nghi và nhiểu chức năng khác
		                <hr>
						<?php
		                	if(Session::has('host')) {
								$host = Session::get('host');
								if(isset($host['room_type']['room']) && $host['room_type']['room'] == false) {
									$next = route('host.kindroom', ($data_Room != '') ? $data_Room->id : '' );
								}else {
									if(isset($host['bedroom']['bedroom']) && $host['bedroom']['bedroom'] == false) {
										$next = route('host.bedrooms', ($data_Room != '') ? $data_Room->id : '');
									}else {
										if(isset($host['bathrooms']['bathrooms']) && $host['bathrooms']['bathrooms'] == false) {
											$next = route('host.bathrooms', ($data_Room != '') ? $data_Room->id : '');
										} else {
											$next = route('host.location', ($data_Room != '') ? $data_Room->id : '');
										}
									}
								}
							}
						?>
		                <a href="{{ isset($next) ? $next : route('host.kindroom', ($data_Room != '') ? $data_Room->id : '') }}" 
		                	class="btn {{ (isset($data_Room) && $data_Room != '' && !is_null($data_Room->process) && $data_Room->process->step_one['completed'] == 100) ? 'btn-change' : 'btn-primary' }} btn-custom" 
		                	id="submit-step-1">{{ (isset($data_Room) && $data_Room != '' && !is_null($data_Room->process) && $data_Room->process->step_one['completed'] == 100) ? 'Chỉnh sửa' : 'Làm tiếp' }}
                        </a>
                        @if(isset($data_Room) && ($data_Room != '' && !is_null($data_Room->process) && $data_Room->process->step_one['completed'] == 100) )
	                        <span class="ti-check completed pull-right"></span>
		                @endif
		            </div>
		        </div>
		    </div>
		    
		    <div class="col-md-4">
		        <div class="card form-stack" id="step-2" data-target="step-2" data-complete="false">
		            <div class="header">
		                <p class="category">Bước 2</p>
		                <h4 class="title">Thiết lập các cảnh</h4>
		            </div>
		            <div class="content">
		                Giường, phòng tắm, tiện nghi, và nhiểu chức năng khác
		                <hr>
		                @if($data_Room != '' && !is_null($data_Room->process))
		                	@if($data_Room->process->step_one['completed'] == 100)
								<a href="{{ isset($next) ? $next : route('host.highlights', $data_Room->id) }}" 
				                	class="btn {{ (isset($process_two) && $process_two > 95) ? 'btn-change' : 'btn-primary' }} btn-custom" 
				                	id="submit-step-2">{{ (isset($process_two) && $process_two > 95) ? 'Chỉnh sửa' : 'Làm tiếp' }}
		                        </a>
		                        @if(isset($process_two) && $process_two > 95 )
			                        <span class="ti-check completed pull-right"></span>
				                @endif
			                @endif
		                @endif
		            </div>
		        </div>
		    </div>
		    
		    <div class="col-md-4">
		        <div class="card form-stack" id="step-3" data-target="step-3" data-complete="false">
		            <div class="header">
		                <p class="category">Bước 3</p>
		                <h4 class="title">Hãy sẵn sàng cho khách</h4>
		            </div>
		            <div class="content">
		                Giá, lịch, cài đặt đặt phòng
		                <hr>
		                @if(isset($process_two) && $process_two > 95)
		                	@if($data_Room->process->step_one['completed'] == 100 && isset($process_two) && $process_two > 95)
								<a href="{{ isset($next) ? $next : route('host.experience', $data_Room->id) }}" 
				                	class="btn {{ (isset($process_three) && $process_three > 95) ? 'btn-change' : 'btn-primary' }} btn-custom" 
				                	id="submit-step-3">{{ (isset($process_three) && $process_three > 95) ? 'Chỉnh sửa' : 'Làm tiếp' }}
		                        </a>
		                        @if( isset($process_three) && $process_three > 95 )
			                        <span class="ti-check completed pull-right"></span>
				                @endif
			                @endif
		                @endif
		            </div>
		        </div>
		    </div>
		    <div class="clearfix"></div>
		    @if($data_Room != '' && !is_null($data_Room->process))
			    <?php (int) $complete = $data_Room->process->step_one['completed'] + isset($process_two) ? $process_two : 0 + isset($process_three) ? $process_three : 0; ?>
			    @if($complete > 97)
			    <div class="col-md-12">
				    <a href="{{ route('host.post.active', $data_Room->id) }}" 
				        	class="btn btn-primary"
				        	onclick="event.preventDefault();
	                                document.getElementById('active-form').submit();">Công bố danh sách</a>
			        <form action="{{ route('host.post.active', $data_Room->id) }}" method="POST" style="display:none" id="active-form">
			        	{{ csrf_field() }}
			        </form>
			    </div>
			    @endif
		    @endif
        </div>
    </div>
</div>
@stop

@push('css')
	<style>
		.completed {
			background: #00a699;
			padding: 4px;
			border-radius: 50%;
			color: #FFF;
			font-size: 1.5em;
			width: 35px;
			text-align: center;
			height: 35px;
		}

		.btn-change {
			border-color: #00a699;
		}
	</style>
@endpush