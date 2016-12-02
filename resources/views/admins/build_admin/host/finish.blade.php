@extends('admins.master')
@section('titleName')
    Your listings
@stop
@section('content')
<div class="content">
    <div class="container-fluid">
        
        @include('admins.host._shared.action')

        <div class="row cronjob" id="cronjob">
            <div class="col-md-12" align="center">
            	<div class="job">
			        <a href="{{ route('host.post.active', $room_ID) }}" 
			        	class="btn btn-primary"
			        	onclick="event.preventDefault();
                                document.getElementById('active-form').submit();">Công bố danh sách</a>
			        <a href="" class="btn btn-primary">Xem phòng</a>
			        <form action="{{ route('host.post.active', $room_ID) }}" method="POST" style="display:none" id="active-form">
			        	{{ csrf_field() }}
			        </form>
            	</div>
		    </div>
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