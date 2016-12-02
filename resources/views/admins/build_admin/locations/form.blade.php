@extends('admins.build_admin._master')

@section('titleName', $locations->exists ? 'Cập nhật địa điểm' : 'Thêm mới địa điểm')

@section('content')
	<locations-index></locations-index>
	<template id="locations_index">
		<style>
			.card label i {
				font-size: 22px;
			}
		</style>
		<div class="page-content">
			<div class="page-head">
				<!-- BEGIN PAGE TITLE -->
				<div class="page-title">
					<h1>Create new location</h1>
				</div>
				<!-- END PAGE TITLE -->
			</div>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="javascript:;">Home</a><i class="fa fa-circle"></i>
				</li>
				<li class="active">
					Locations
				</li>
			</ul>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<a href="{{ route('locations.create') }}" class="btn btn-default btn-sm">
									<i class="fa fa-globe"></i>
									create new location
								</a>
							</div>
							<div class="tools">
							</div>
						</div>
						<div class="portlet-body">
							<div id="map"></div>
							<div class="">
								<div class="fresh-table full-color-orange">
									<div class="card">
										@if (count($errors) > 0)
											<div class="alert alert-danger">
												<ul>
													@foreach ($errors->all() as $error)
														<li>{{ $error }}</li>
													@endforeach
												</ul>
											</div>
										@endif
										<form action="{{ $locations->exists ? route('locations.update', $locations->id) : route('locations.store') }}" id="locations" method="POST" enctype="multipart/form-data">
											{{ csrf_field() }}
											{{ method_field($locations->exists ? 'PUT' : 'POST') }}
											<div class="location ">
												<div class="clearfix"></div>
												<div class="location col-sm-12">
													<label for="get-location-address" >
														<span>Tên địa điểm</span>
													</label>
													<input autofocus="true" autocomplete="off" 
															class="input input-block input-jumbo lys-address-form__input"
															id="get-location-address" name="name" type="text" 
															placeholder="" 
															value="{{ $locations->exists ? $locations->name : old('name') }}" v-model="name">
												</div>
												<div class="location col-sm-12">
													<label for="slug" >
														<span>Slug</span>
													</label>
													<input autocomplete="off" 
															class="input input-block input-jumbo lys-address-form__input"
															id="slug" name="slug" type="text"
															value="@if( $locations->exists ){{ $locations->slug }}@else@{{ $data.name | slugify }}@endif">
												</div>

												<div class="location col-sm-6">
													<label for="address-form-field-city" >
														<span>Thành phố</span>
													</label>
													<input class="input input-block input-jumbo lys-address-form__input" 
															id="administrative_area_level_1" name="city" type="text" 
															autocomplete="off"
															value="{{ $locations->exists ? $locations->city : old('city') }}">
												</div>

												<input type="hidden" name="latitude" id="latitude" value="{{ $locations->exists ? $locations->latitude : old('latitude') }}">
												<input type="hidden" name="zipcode" id="postal_code" value="{{ $locations->exists ? $locations->zipcode : old('zipcode') }}">
												<input type="hidden" name="longitude" id="longitude" value="{{ $locations->exists ? $locations->longitude : old('longitude') }}">
												<input type="hidden" id="street_number" name="street_number" value="{{ $locations->exists ? $locations->street_number : old('street_number') }}">
												<input type="hidden" id="route" name="route" value="{{ $locations->exists ? $locations->route : old('route') }}">
												<input type="hidden" id="locality" name="locality" value="{{ $locations->exists ? $locations->locality : old('locality') }}">

												<div class="location col-sm-6">
													<label for="address-form-field-state" >
														<span>Tiểu bang</span>
													</label>
													<input class="input input-block input-jumbo" 
															id="administrative_area_level_2" 
															name="state" type="text" autocomplete="off" value="{{ $locations->exists ? $locations->state : old('state') }}">
												</div>

												<div class="location col-sm-6">
													<label for="address-form-field-code" >
														<span>Quê hương</span>
													</label>
													<input class="input input-block input-jumbo" 
															id="country" name="country" type="text" 
															autocomplete="off" value="{{ $locations->exists ? $locations->country : old('country') }}">
												</div>

												<div class="clearfix"></div>
												<div class="col-sm-12 space-5">
													<label for="locations-description" >
														<span>Mô tả về địa điểm này</span>
													</label>
													<textarea id="locations-description" name="description" class="input input-block input-jumbo lys-address-form__input" style="min-height: 165px">{{ $locations->exists ? $locations->description : old('description') }}</textarea>
												</div>
												<div class="clearfix"></div>

												<div class="form-group">
													<div class="col-md-6">
														<label class="control-label">
															<span>Hình ảnh</span>
														</label>
														<div class="clearfix"></div>
														<div class="select-media-box">
															<button type="button" class="btn blue show-add-media-popup">Choose image</button>
															<div class="clearfix"></div>
															<a title="" class="show-add-media-popup">
																<img src="{{ ($locations->exists && trim($locations->image != '')) ? $locations->image : '/admins/assets/img/no-image.png' }}" alt="Thumbnail" class="img-responsive">
															</a>
															<input type="hidden" name="image" value="{{ $locations->image or '' }}" class="input-file">
															<a title="" class="remove-image"><span>&nbsp;</span></a>
														</div>
													</div>
												</div>

												<div class="kind col-md-6">
													<div class="amenity-item">
														<input id="show-index" type="checkbox" 
																class="col-sm-1" value="1"
																{{ $locations->exists && $locations->show_index == 1 ? 'checked' : ( old('show_index') == 1  ? 'checked' : '') }}
																name="show_index" >
														<div class="col-sm-6">
															<label for="show-index" style="padding: 0">
																<span>Hiển thị trang chủ</span>
															</label>
														</div>
														<div class="clearfix"></div>
													</div>
													<div class="clearfix"></div>
												</div>
				
												<div class="clearfix"></div>
												<div align="center" style="margin-top: 30px;">
													<input type="reset" class="btn btn-default" value="Làm mới">
													<button class="btn btn-primary">{{ $locations->exists ? 'Cập nhật' : 'Thêm' }}</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>
		</div>
	</template>
@stop

@push('js-include')
	<script src="/admins/plugins/tinymce/tinymce.min.js"></script>
	<script src="/admins/plugins/tinymce/config.mce.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9nTLsQJhpaViKu0aXR2HhzPYrMDfIn30&libraries=places"></script>
	<script src="{{ asset('js/location.js') }}"></script>
@endpush

@push('css-style')
	<style>
		#map {
			width: 100%;
			height: 300px;
		}
	</style>
@endpush