@extends('admins.master')

    @section('titleName', $space->exists ? 'Sửa tiện ích' : 'Thêm mới tiện ích')

    @section('content')
        <div class="content">
            <div class="container-fluid">
                
                <!-- @include('admins.host._shared.action') -->
                
                <div class="">
                    <div class="fresh-table full-color-orange">
		                <div class="pull-left">
		                	<a href="{{ route('spaces.index') }}" class="btn btn-success">
		                		<i class="ti-back-left"></i> Quay lại
		                	</a>
		                </div>
		                @if($space->exists)
							<div class="pull-right">
			                	<a href="{{ route('spaces.create') }}" class="btn btn-success">
			                		<i class="ti-plus"></i> Thêm mới
			                	</a>
			                </div>
		                @endif
	                    <div class="clearfix"></div>
	                    <div class="card" style="margin-top: 50px; padding: 50px;">
	                    	<h1 style="margin: 0 0 20px; text-align: center"></h1>
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
		                                        class="input input-block input-jumbo lys-address-form__input lys-invalid"
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
		                                        class="form-control input input-block input-jumbo lys-address-form__input icp icp-glyphs" 
		                                        id="spaces-icon" name="icon" type="text" 
		                                        placeholder="icon" value="{{ $space->exists ? $space->icon : old('icon') }}">
			                        </div>

				                    <div class="clearfix"></div>
	                                <div align="center" style="margin-top: 30px;">
	                                	<input type="reset" class="btn btn-default" value="Làm mới">
	                                	<button class="btn btn-primary">{{ $space->exists ? 'Cập nhật' : 'Thêm' }}</button>
	                                </div>
	                            </div>
	                    	</form>
	                    </div>
	                </div>
                </div>
            </div>
        </div>
    @stop


    @push('js')
		<script src="{{ asset('admins/assets/js/jquery-1.10.2.js') }}" type="text/javascript"></script>		<script src="{{ asset('admins/assets/js/fontawesome-iconpicker.js') }}"></script>
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