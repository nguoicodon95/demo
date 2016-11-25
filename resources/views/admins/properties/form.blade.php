@extends('admins.master')

    @section('titleName', $property->exists ? 'Sửa loại tài sản "{{ $property->name }}"' : 'Thêm mới tiện ích')

    @section('content')
        <div class="content">
            <div class="container-fluid">
                
                <!-- @include('admins.host._shared.action') -->
                <slug></slug>

                <template id="property_tp">
	                <div>
	                    <div class="fresh-table full-color-orange">
			                <div class="pull-left">
			                	<a href="{{ route('properties.index') }}" class="btn btn-success">
			                		<i class="ti-back-left"></i> Quay lại
			                	</a>
			                </div>
			                @if($property->exists)
								<div class="pull-right">
				                	<a href="{{ route('properties.create') }}" class="btn btn-success">
				                		<i class="ti-plus"></i> Thêm mới
				                	</a>
				                </div>
			                @endif
		                    <div class="clearfix"></div>
		                    <div class="card" style="margin-top: 50px; padding: 50px;">
		                    	<h1 style="margin: 0 0 20px; text-align: center"></h1>
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
			                                        class="input input-block input-jumbo lys-address-form__input lys-invalid"
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
			                                        class="input input-block input-jumbo lys-address-form__input lys-invalid"
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
	            </template>
            </div>
        </div>
    @stop