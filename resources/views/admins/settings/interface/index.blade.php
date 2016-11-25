@extends('admins.master')
@section('titleName', 'Cấu hình giao diện')
@section('content')
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">
					<ul class="list-group">
						<li class="list-group-item">
							<span class="badge">14</span>
							<a href="{{ route('settings.interface', [ 'form' => 'locations' ]) }}"> Địa điểm </a>
						</li>
						<li class="list-group-item">
							<span class="badge">14</span>
							<a href="{{ route('settings.interface', [ 'form' => 'host' ]) }}"> Phòng </a>
						</li>
					</ul>
				</div>
				<div class="col-md-8">
					<ul class="list-group">
					@foreach($rows as $row)
						@if(!in_array($row->id, $all_id))
						<li class="list-group-item">
							<a href="{{ route('settings.locations_ins', [ 'id' => $row->id, 'form' => $form]) }}" class="badge"><span>Hiển thị</span></a>
							<span>{{ $row->name . $row->title }}</span>
						</li>
						@endif
					@endforeach
					</ul>
				</div>
			</div>
			<div class="row" id="sortable">
				@foreach($items as $item)
					<div class="{{ !is_null($item['config']) ? $item['config']->width : 'col-md-4'  }} ui-state-default" id='item-<?php echo $item['key'] ?>'>
						<div class="zone" zone-url="{{ asset($item['image']) }}">
							<div class="zone-container">
								<div class="zone-contrast">
									<div class="zone-name">
										<strong>{{ $item['name'] }}</strong>
									</div>
								</div>
							</div>
						</div>
						<div class="cog">
							<span>Cấu hình: </span>
							<input {{ !is_null($item['config']) && $item['config']->width == 'col-md-8' ? 'checked' : ''  }} data-key="{{ $item['key'] }}" type="radio" onchange="changeWith()" name="width_{{ $item['id'] }}" value="col-md-8"> 66.6%
							<input {{ !is_null($item['config']) && $item['config']->width == 'col-md-6' ? 'checked' : ''  }} data-key="{{ $item['key'] }}" type="radio" onchange="changeWith()" name="width_{{ $item['id'] }}" value="col-md-6"> 50%
							<input {{ !is_null($item['config']) && $item['config']->width == 'col-md-4' ? 'checked' : ''  }} data-key="{{ $item['key'] }}" type="radio" onchange="changeWith()" name="width_{{ $item['id'] }}" value="col-md-4"> 33.3%
							<input {{ !is_null($item['config']) && $item['config']->width == 'col-md-3' ? 'checked' : ''  }} data-key="{{ $item['key'] }}" type="radio" onchange="changeWith()" name="width_{{ $item['id'] }}" value="col-md-3"> 25%
						</div>
						<form action="{{ route('settings.delete_elem', $item['key']) }}" method="POST">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<button class="btn btn-remove" style="position: absolute; top: 5px; right: 20px;">X</button>
						</form>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@stop

@push('css')
	<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
	<style>
		.zone {
		    height: 344px;
		    background-color: #f5f5f5;
		    overflow: hidden;
		    box-shadow: inset 10px 10px 50px rgba(0, 0, 0, 0.44);
		}
		.zone .zone-container {
		    width: 100%;
		    height: 100%;
		    display: table;
		    position: relative;
		    -webkit-backface-visibility: hidden;
		    backface-visibility: hidden;
		}
		.zone a, .zone strong {
		    color: #FFF;
		}
		.cog {
			padding: 10px;
			border: 1px solid #484848;
			margin-bottom: 25px;
		}
		.cog span, .cog input {
			vertical-align: middle;
		}
	</style>
@endpush

@push('js')
	<script src="{{ asset('admins/assets/js/jquery.ui.js') }}"></script>
	<script>
			$(document).ready(function () {
			    $('#sortable').sortable({
			        stop: function (event, ui) {
				        var data = $(this).sortable('serialize');
			           	$.ajax({
				            data: { '_token': $('meta[name="csrf-token"]').attr('content'), 'data': data },
				            type: 'POST',
				            url: '{{ route("settings.position") }}',
				            success:function(result) {
						    }
				        });
					}
			    });
			});
		
		function changeWith() {
	    	var value = event.target.value;
			var key = event.target.getAttribute('data-key');
			$.ajax({
	            data: { '_token': $('meta[name="csrf-token"]').attr('content'), 'id': key, 'value': value },
	            type: 'POST',
	            url: '{{ route("settings.config") }}',
	            success:function(result) {
	            	window.location.reload();
			    }
	        });
		}

		$( "#sortable" ).disableSelection();
		
	</script>
	<script>
		$('.zone').each(function(index, el) {
			var zoneBackground = $(el).attr('zone-url');
			$(el).css({
				'background-image': 'url('+ zoneBackground +')',
				'background-size': 'cover',
				'background-repeat': 'no-repeat',
				'background-position': 'center center',
				'position': 'relative'
			});
		});
	</script>
@endpush