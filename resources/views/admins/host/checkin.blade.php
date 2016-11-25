@extends('admins.master')
@section('titleName')
    Your listings
@stop
@section('content')
<div class="content">
    <div class="container-fluid">
        @include('admins.host._shared.action')
		<checkin></checkin>
    </div>
</div>
<template id="checkin_tp">
	<div>
		<div class="col-md-12">
            <form action="" method="POST" id="check-in-form">
            {{ csrf_field() }}
			<div class="property">
				<label for="select-time" class="h4 text-gray text-normal">
					<span>Check-in window</span>
				</label>
				<div class="row">
					<div class="select select-block select-jumbo col-md-4">
						<select v-model="selectTime" 
								id="select-time" 
								name="check-in-time-select" 
								style="height: auto; padding-top: 10px; padding-bottom: 10px;">
							<option value="0" disabled="">Select a time</option>
							<option value="Flexible">Flexible</option>
							@for($i=8; $i <= 25; $i++)
								<option value="{{ $i }}" {{ isset($check_in->check_in_time_select) && $check_in->check_in_time_select == $i ? 'selected' : ($i==15 ? 'selected' : '') }}>{{ $i < 10 ? 0 : '' }}{{ $i >= 25 ? 1 : $i }}:00 {{ $i >= 25 ? '(Ngày tiếp theo)' : '' }}</option>
							@endfor
						</select>
					</div>
					<label for="check-in-time-ends-select" class="col-md-1 label-middle">to</label>
					<div class="select select-block select-jumbo col-md-4">
						<select v-model="selectEndsTime" 
								v-bind:disabled="selectTime == 'Flexible'" 
								id="check-in-time-ends-select" 
								name="check-in-time-ends-select" 
								style="height: auto; padding-top: 10px; padding-bottom: 10px;">
							
							<option selected="" value="0" disabled="">Select a time</option>
							<option v-bind:selected="{{ isset($check_in->check_in_time_ends_select) && $check_in->check_in_time_ends_select == 'Flexible' }} || selectTime == 'Flexible' || selectTime == 25" 
									value="Flexible">Flexible</option>
							@for($i=9; $i < 27; $i++)
								<?php $h = ($i == 25) ? 1 : ( ($i == 26) ? 2 : $i );?>
								<option v-bind:disabled="selectTime >= {{ $i-1 }}"
										value="{{ $i }}" 
										v-bind:selected="{{ isset($check_in->check_in_time_ends_select) && $check_in->check_in_time_ends_select == $i }} || selectTime == {{ $i-2 }}"
										>{{ $i < 10 || $i > 24 ? 0 : '' }}{{ $h }}:00 {{ $i >= 25 ? '(Ngày tiếp theo)' : '' }}</option>
							@endfor
						</select>
					</div>
				</div>
			</div>
			<div class="property">
				<label for="checkout" class="h4 text-gray text-normal">
					<span>Checkout</span>
				</label>
				<div class="row">
					<div class="select select-block select-jumbo col-md-4">
						<select id="checkout" 
								name="check_out" 
								style="height: auto; padding-top: 10px; padding-bottom: 10px;">
							<option selected="" value="0" disabled="">Select a time</option>
							@for($i=1; $i <= 24; $i++)
								<option value="{{ $i }}" {{ isset($check_out) && $check_out == $i ? 'selected' : '' }}>{{ $i < 10 ? 0 : '' }}{{ $i }}:00</option>
							@endfor
						</select>
					</div>
				</div>
			</div>
			</form>
			<hr>
			<div>
				<a href="#"
                    onclick="event.preventDefault();
                                document.getElementById('check-in-form').submit();"
					class="pull-right btn btn-large btn-progress-next btn-large__next-btn pull-right-md btn-primary">
					<div class="btn-progress-next__text">
						<span>Cập nhật</span>
					</div>
				</a>
			</div>
		</div>
	</div>
</template>
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
		.label-middle {
		    padding-top: 11px;
		    font-size: 18px;
		    text-align: center;
		}
	</style>
@endpush