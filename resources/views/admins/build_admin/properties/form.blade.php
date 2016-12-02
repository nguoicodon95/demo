@extends('admins.build_admin._master')
@section('titleName', $property->exists ? 'Sửa loại tài sản "{{ $property->name }}"' : 'Thêm mới loại tài sản')

@section('content')
	<div class="page-content">
		<div class="page-head">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Create new property</h1>
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
							<span class="caption-subject font-green-sharp bold uppercase">Edit property</span>
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
									<form action="{{ $property->exists ? route('properties.update', $property->id) : route('properties.store') }}" method="POST">
										{{ csrf_field() }}
										{{ method_field($property->exists ? 'PUT' : 'POST') }}
										<div class="location ">
											<div class="clearfix"></div>
											<div class="col-sm-6">
												<label for="properties-name" >
													<span>Tên loại tài sản</span>
												</label>
												<input autofocus="true" autocomplete="off" 
														class="input input-block input-jumbo lys-address-form__input"
														id="properties-name" name="name" type="text" 
														placeholder="" value="{{ $property->exists ? $property->name : old('name') }}" v-model="name">

												@if ($errors->has('name'))
													<span class="help-block error">
														{{ trans($errors->first('name')) }}
													</span>
												@endif
											</div>
					
											<div class="col-sm-6">
												<label for="properties-label" >
													<span>Slug</span>
												</label>
												<input autofocus="true" autocomplete="off" 
														class="input input-block input-jumbo lys-address-form__input"
														id="properties-label" name="slug" type="text" 
														placeholder=""
														value="@if( $property->exists ){{ $property->slug }}@else@{{ $data.name | slugify }}@endif">
												
												@if ($errors->has('slug'))
													<span class="help-block error">
														{{ trans($errors->first('slug')) }}
													</span>
												@endif
											</div>
											
											<div class="clearfix"></div>
											<div class="col-sm-12">
												<label for="properties-description" >
													<span>Mô tả về loại tài sản này</span>
												</label>
												<input autofocus="true" autocomplete="off" 
														class="input input-block input-jumbo lys-address-form__input"
														id="properties-description" name="description" type="text" 
														placeholder="Mô tả ..." value="{{ $property->exists ? $property->description : old('description') }}">
											</div>

											<div class="clearfix"></div>
											<div align="center" style="margin-top: 30px;">
												<input type="reset" class="btn btn-default" value="Làm mới">
												<button class="btn btn-primary">{{ $property->exists ? 'Cập nhật' : 'Thêm' }}</button>
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
@stop

@push('css-style')
	<style>
		.alert {
			border-radius: 0;
		}
	</style>
@endpush


@push('js-include')
@endpush

@push('js-script')

@endpush