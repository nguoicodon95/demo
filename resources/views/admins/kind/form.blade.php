@extends('admins.master')

    @section('titleName', $kind->exists ? 'Sửa tiện ích' : 'Thêm mới tiện ích')

    @section('content')
        <div class="content">
            <div class="container-fluid">
                
                <!-- @include('admins.host._shared.action') -->
                <kind></kind>
                <template id="kind_tp">
	                <div class="">
	                    <div class="fresh-table full-color-orange">
			                <div class="pull-left">
			                	<a href="{{ route('kinds.index') }}" class="btn btn-success">
			                		<i class="ti-back-left"></i> Quay lại
			                	</a>
			                </div>
			                @if($kind->exists)
								<div class="pull-right">
				                	<a href="{{ route('kinds.create') }}" class="btn btn-success">
				                		<i class="ti-plus"></i> Thêm mới
				                	</a>
				                </div>
			                @endif
		                    <div class="clearfix"></div>
		                    <div class="card" style="margin-top: 50px; padding: 50px;">
		                    	<h1 style="margin: 0 0 20px; text-align: center"></h1>
		                    	<form action="{{ $kind->exists ? route('kinds.update', $kind->id) : route('kinds.store') }}" method="POST">
		                    		{{ csrf_field() }}
		                    		{{ method_field($kind->exists ? 'PUT' : 'POST') }}
		                    		<div class="location ">
					                    <div class="clearfix"></div>
		                    			<div class="col-sm-6">
			                                <label for="kinds-name" >
			                                    <span>Tên tiện ích</span>
			                                </label>
			                                <input autofocus="true" autocomplete="off" 
			                                        class="input input-block input-jumbo lys-address-form__input lys-invalid"
			                                        id="kinds-name" name="name" type="text" 
			                                        placeholder="" value="{{ $kind->exists ? $kind->name : old('name') }}" v-model="name">

			                                @if ($errors->has('name'))
											    <span class="help-block error">
											        {{ trans($errors->first('name')) }}
											    </span>
											@endif
		                    			</div>

		                    			<div class="col-sm-6">
			                                <label for="kinds-label" >
			                                    <span>Slug</span>
			                                </label>
			                                <input autofocus="true" autocomplete="off" 
			                                        class="input input-block input-jumbo lys-address-form__input"
			                                        id="kinds-label" name="slug" type="text" 
			                                        placeholder="" value="@if( $kind->exists ){{ $kind->slug }}@else@{{ $data.name | slugify }}@endif"">
		                    			</div>
		                                
					                    <div class="clearfix"></div>
		                    			<div class="col-sm-6">
			                                <label for="kinds-description" >
			                                    <span>Mô tả về tiện ích này</span>
			                                </label>
			                                <input autofocus="true" autocomplete="off" 
			                                        class="input input-block input-jumbo lys-address-form__input"
			                                        id="kinds-description" name="description" type="text" 
			                                        placeholder="Mô tả ..." value="{{ $kind->exists ? $kind->description : old('description') }}">
		                    			</div>

		                                <div class=" col-sm-6">
				                            <label for="kinds-icon" class="text-gray text-normal">
				                                <span>Icon</span>
				                            </label>
			                                <input autofocus="true" autocomplete="off" 
			                                        class="form-control input input-block input-jumbo lys-address-form__input icp icp-glyphs" 
			                                        id="kinds-icon" name="icon" type="text" 
			                                        placeholder="icon" value="{{ $kind->exists ? $kind->icon : old('icon') }}">
				                        </div>

					                    <div class="clearfix"></div>
		                                <div align="center" style="margin-top: 30px;">
		                                	<input type="reset" class="btn btn-default" value="Làm mới">
		                                	<button class="btn btn-primary">{{ $kind->exists ? 'Cập nhật' : 'Thêm' }}</button>
		                                </div>
		                            </div>
		                    	</form>
		                    </div>
		                </div>
	                </div>
	            </template>
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