@extends('admins.build_admin._master')
@section('titleName', $space->exists ? 'Sửa tiện ích' : 'Thêm mới tiện ích')

@section('content')
	<div class="page-content">
		<div class="page-head">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Create new space amenities</h1>
			</div>
			<!-- END PAGE TITLE -->
		</div>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="javascript:;">Home</a><i class="fa fa-circle"></i>
			</li>
			<li class="active">
				Tiện nghi không gian
			</li>
		</ul>
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PORTLET-->
				<div class="portlet light form-fit">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-layers font-dark"></i>
							<span class="caption-subject font-green-sharp bold uppercase">Edit space</span>
							<span class="caption-helper"></span>
						</div>
						<div class="tools">
							<a href="javascript:;" class="reload" data-original-title="" title=""></a>
							<a href="javascript:;" class="collapse" data-original-title="" title=""></a>
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
									<form action="{{ $space->exists ? route('spaces.update', $space->id) : route('spaces.store') }}" method="POST">
										{{ csrf_field() }}
										{{ method_field($space->exists ? 'PUT' : 'POST') }}
										<div class="location ">
											<div class="clearfix"></div>
											<div class="col-sm-6">
												<label for="spaces-name" >
													<span>Tên tiện ích</span>
												</label>
												<input autofocus="true" autocomplete="off" 
														class="input input-block input-jumbo lys-address-form__input"
														id="spaces-name" name="name" type="text" 
														placeholder="" value="{{ $space->exists ? $space->name : old('name') }}">

												@if ($errors->has('name'))
													<span class="help-block error">
														{{ trans($errors->first('name')) }}
													</span>
												@endif
											</div>

											<div class="col-sm-6">
												<label for="spaces-label" >
													<span>Tên hiển thị</span>
												</label>
												<input autofocus="true" autocomplete="off" 
														class="input input-block input-jumbo lys-address-form__input"
														id="spaces-label" name="label" type="text" 
														placeholder="" value="{{ $space->exists ? $space->label : old('label') }}">
											</div>
											
											<div class="clearfix"></div>
											<div class="col-sm-6">
												<label for="spaces-description" >
													<span>Mô tả về tiện ích này</span>
												</label>
												<input autofocus="true" autocomplete="off" 
														class="input input-block input-jumbo lys-address-form__input"
														id="spaces-description" name="description" type="text" 
														placeholder="Mô tả ..." value="{{ $space->exists ? $space->description : old('description') }}">
											</div>

											<div class=" col-sm-6">
												<label for="spaces-icon" class="text-gray text-normal">
													<span>Icon</span>
												</label>
												<input autofocus="true" autocomplete="off" 
														class="input input-block input-jumbo lys-address-form__input icp icp-glyphs" 
														id="spaces-icon" name="icon" type="text" 
														placeholder="icon" value="{{ $space->exists ? $space->icon : old('icon') }}">
											</div>

											<div class="clearfix"></div>
											<div align="center" class="form-group last" style="margin-top: 30px;">
												<input type="reset" class="btn btn-default" value="Làm mới">
												<button class="btn btn-primary">{{ $space->exists ? 'Cập nhật' : 'Thêm' }}</button>
											</div>
											<div class="clearfix"></div>
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
@stop

@push('css-style')
	<style>
		.alert {
			border-radius: 0;
		}
	</style>
@endpush


@push('js-include')
	<script src="{{ asset('admins/assets/js/fontawesome-iconpicker.js') }}"></script>
@endpush

@push('js-script')
	<script>
		$(function() {
			$('.icp-glyphs').iconpicker({
				title: 'Chọn icon',
				icons: ['lock', 'later', 'sampoo',
					'wifi', 'washer', 'wash', 'tv', 
					'swim', 'shared', 'bed', 'pets', 
					'kitchen', 'internet', 'house', 'healting',
					'guest', 'dryer', 'breakfast', 'private', 'bedroom'],
				iconBaseClass: 'icon',
				iconComponentBaseClass: 'icon',
				iconClassPrefix: 'icon-'
			});
		});
	</script>
@endpush