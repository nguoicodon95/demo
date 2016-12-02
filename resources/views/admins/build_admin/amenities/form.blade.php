@extends('admins.build_admin._master')
@section('titleName', $amen->exists ? 'Sửa tiện ích' : 'Thêm mới tiện ích')

@section('content')
	<div class="page-content">
		<div class="page-head">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Create new amenities</h1>
			</div>
			<!-- END PAGE TITLE -->
		</div>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="javascript:;">Home</a><i class="fa fa-circle"></i>
			</li>
			<li class="active">
				Tiện ích
			</li>
		</ul>
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PORTLET-->
				<div class="portlet light form-fit">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-layers font-dark"></i>
							<span class="caption-subject font-green-sharp bold uppercase">Edit amenities</span>
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
									<form action="{{ $amen->exists ? route('amenities.update', $amen->id) : route('amenities.store') }}" method="POST">
										{{ csrf_field() }}
										{{ method_field($amen->exists ? 'PUT' : 'POST') }}
										<div class="location ">
											<div class="clearfix"></div>
											<div class="col-md-12">
												<div>
													<h3 style="margin-top: 0">Loại tiện nghi?</h3>
												</div>
												<div class="kind">
													<div class="block-radio-button">
														<label class="btn btn-block block-radio_panel" for="types_amenities_normal" style="margin-bottom: 0">
															<div class="no-margin-h">
																<div class="ib pull-left">
																	<span>Tiện nghi thông thường</span>
																</div>
																<div class="ib pull-right">
																	<input id="types_amenities_normal" type="radio" name="types" value="normal" class="pointer-input" {{ $amen->exists ? ($amen->types == 'normal' ? 'checked' : '') : (old('types') == 'normal' ? 'checked' : 'checked') }}>
																</div>
																<div class="clearfix"></div>
															</div>
														</label>
													</div>
													<div class="block-radio-button">
														<label class="btn btn-block block-radio_panel" for="types_amenities_safery" style="margin-bottom: 0; margin-top: 0">
															<div class="no-margin-h">
																<div class="ib pull-left">
																	<span>Tiện nghi an toàn</span>
																</div>
																<div class="ib pull-right">
																	<input id="types_amenities_safery" type="radio" name="types" value="safety" class="pointer-input" {{ $amen->exists ? ($amen->types == 'safety' ? 'checked' : '') : (old('types') == 'safery' ? 'checked' : '') }}>
																</div>
																<div class="clearfix"></div>
															</div>
														</label>
													</div>
													<div class="block-radio-button">
														<label class="btn btn-block block-radio_panel" for="types_amenities_location" style="margin-bottom: 0; margin-top: 0">
															<div class="no-margin-h">
																<div class="ib pull-left">
																	<span>Vị trí thích hợp</span>
																</div>
																<div class="ib pull-right">
																	<input id="types_amenities_location" type="radio" name="types" value="location" class="pointer-input" {{ $amen->exists ? ($amen->types == 'location' ? 'checked' : '') : (old('types') == 'location' ? 'checked' : '') }}>
																</div>
																<div class="clearfix"></div>
															</div>
														</label>
													</div>
													<div class="block-radio-button">
														<label class="btn btn-block block-radio_panel" for="types_amenities_special" style="margin-bottom: 0; margin-top: 0">
															<div class="no-margin-h">
																<div class="ib pull-left">
																	<span>Tiện nghi nổi bật</span>
																</div>
																<div class="ib pull-right">
																	<input id="types_amenities_special" type="radio" name="types" value="special" class="pointer-input" {{ $amen->exists ? ($amen->types == 'special' ? 'checked' : '') : (old('types') == 'special' ? 'checked' : '') }}>
																</div>
																<div class="clearfix"></div>
															</div>
														</label>
													</div>
													<div class="block-radio-button">
														<label class="btn btn-block block-radio_panel" for="types_amenities_space" style="margin-bottom: 0; margin-top: 0">
															<div class="no-margin-h">
																<div class="ib pull-left">
																	<span>Không gian tốt</span>
																</div>
																<div class="ib pull-right">
																	<input id="types_amenities_space" type="radio" name="types" value="space_place" class="pointer-input" {{ $amen->exists ? ($amen->types == 'space_place' ? 'checked' : '') : (old('types') == 'space_place' ? 'checked' : '') }}>
																</div>
																<div class="clearfix"></div>
															</div>
														</label>
													</div>
													<div class="block-radio-button">
														<label class="btn btn-block block-radio_panel" for="types_amenities_rules" style="margin-bottom: 0; margin-top: 0">
															<div class="no-margin-h">
																<div class="ib pull-left">
																	<span>Quy tắc</span>
																</div>
																<div class="ib pull-right">
																	<input id="types_amenities_rules" type="radio" name="types" value="rules" class="pointer-input" {{ $amen->exists ? ($amen->types == 'rules' ? 'checked' : '') : (old('types') == 'rules' ? 'checked' : '') }}>
																</div>
																<div class="clearfix"></div>
															</div>
														</label>
													</div>
												</div>
												@if ($errors->has('types'))
													<span class="help-block error">
														{{ trans($errors->first('types')) }}
													</span>
												@endif
											</div>
											<div class="clearfix"></div>
											<div class="col-sm-6">
												<label for="amenities-name" >
													<span>Tên tiện ích</span>
												</label>
												<input autofocus="true" autocomplete="off" 
														class="input input-block input-jumbo lys-address-form__input"
														id="amenities-name" name="name" type="text" 
														placeholder="" value="{{ $amen->exists ? $amen->name : old('name') }}">

												@if ($errors->has('name'))
													<span class="help-block error">
														{{ trans($errors->first('name')) }}
													</span>
												@endif
											</div>

											<div class="col-sm-6">
												<label for="amenities-label" >
													<span>Tên hiển thị</span>
												</label>
												<input autofocus="true" autocomplete="off" 
														class="input input-block input-jumbo lys-address-form__input"
														id="amenities-label" name="label" type="text" 
														placeholder="" value="{{ $amen->exists ? $amen->label : old('label') }}">
											</div>
											
											<div class="clearfix"></div>
											<div class="col-sm-6">
												<label for="amenities-description" >
													<span>Mô tả về tiện ích này</span>
												</label>
												<input autofocus="true" autocomplete="off" 
														class="input input-block input-jumbo lys-address-form__input"
														id="amenities-description" name="description" type="text" 
														placeholder="Mô tả ..." value="{{ $amen->exists ? $amen->description : old('description') }}">
											</div>

											<div class="col-sm-6">
												<label for="amenities-icon" class="text-gray text-normal">
													<span>Icon</span>
												</label>
												<input autofocus="true" autocomplete="off" 
														class="input input-block input-jumbo lys-address-form__input icp icp-glyphs" 
														id="amenities-icon" name="icon" type="text" 
														placeholder="icon" value="{{ $amen->exists ? $amen->icon : old('icon') }}">
											</div>

											<div class="clearfix"></div>
											<div align="center" class="form-group last" style="margin-top: 30px;">
												<input type="reset" class="btn btn-default" value="Làm mới">
												<button class="btn btn-primary">{{ $amen->exists ? 'Cập nhật' : 'Thêm' }}</button>
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