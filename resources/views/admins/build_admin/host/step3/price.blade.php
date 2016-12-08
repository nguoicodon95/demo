@extends('admins.build_admin._master')
@section('titleName', 'Your listings')


    @section('content')
        <div class="page-content">
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Cài đặt host</h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD -->
            <!-- BEGIN PAGE BREADCRUMB -->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="javascript:;">Home</a><i class="fa fa-circle"></i>
                </li>
                <li class="active">
                    Host
                </li>
            </ul>

            <price link="{{ route('host.addpricing', $data_Room->id) }}"  min-price={{ $min_price }}  max-price={{ $max_price }}
                    back="{{ route('admin.room.create', $data_Room->id) }}"></price>
        </div>

        <template id="price_tp">
            <div class="row">
                <div class="col-md-6">
                    <div class="portlet light form-fit">
                        <div class="portlet-body">
                            <div class="col-md-12">
                                <validator name="validatepriceform">
                                    <form action="" method="POST" id="price-form">
                                        {{ csrf_field() }}
                                        <div class="row" id="address">
                                            @if($pricing_mode != 1 )
                                            <div class="location col-sm-12">
                                                <label for="min-price" >
                                                    <span>Mức giá tối thiểu</span>
                                                </label>
                                                <div class="col-md-8 row">
                                                    <input autofocus="true" autocomplete="off" 
                                                        class="input input-block input-jumbo lys-address-form__input"
                                                        id="min-price" name="min_price" type="number" 
                                                        placeholder=""
                                                        v-validate:minprice="{ required: true, max: 222192000, min: 50000 }" 
                                                        :classes="{invalid: 'lys-invalid', valid: ''}"
                                                        v-model="minPrice">
                                                    <p class="text-label" v-if="$validatepriceform.minprice.max">Giá quá cao. Tối đa là <sup>₫</sup>222192000</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="cur text-muted">
                                                        VNĐ / Mỗi đêm
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="clearfix"></div>

                                            <div class="location col-sm-12">
                                                <label for="max-price" >
                                                    <span>Mức giá tối đa</span>
                                                </label>
                                                <div class="col-md-8 row">
                                                    <input autofocus="true" autocomplete="off" 
                                                        class="input input-block input-jumbo lys-address-form__input"
                                                        id="max-price" name="max_price" type="number" 
                                                        placeholder=""
                                                        v-validate:maxprice="{ required: true, max: 222192000, min: 50000 }" 
                                                        :classes="{invalid: 'lys-invalid', valid: ''}"
                                                        v-model="maxPrice">
                                                    <p class="text-label" v-if="$validatepriceform.maxprice.max">Giá quá cao. Tối đa là <sup>₫</sup>222192000</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="cur text-muted">
                                                        VNĐ / Mỗi đêm
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="clearfix"></div>
                                            @endif                            
                                            <div class="location col-sm-12">
                                                @if($pricing_mode == 1)
                                                <p class="text-label">Giá cơ sở của bạn là tỷ lệ hàng đêm mặc định của bạn</p>
                                                @else
                                                <h4>Thiết lập mặc định giá hàng đêm</h4>
                                                <p>Để đặt được hơn 4 tháng đi, du khách sẽ thấy mức giá này.</p>
                                                @endif
                                                <label for="base-price" >
                                                    <span>Giá cơ sở</span>
                                                </label>
                                                <div class="col-md-8 row">
                                                    <input autofocus="true" autocomplete="off" 
                                                        class="input input-block input-jumbo lys-address-form__input"
                                                        id="base-price" name="base_price" type="number" 
                                                        placeholder=""  value="{{ !empty($base_price) ? $base_price : 0 }}"  
                                                        v-validate:baseprice="{ required: true, max: 222192000, min: 50000 }" 
                                                        :classes="{invalid: 'lys-invalid', valid: ''}"
                                                        >
                                                    <p class="text-label" v-if="$validatepriceform.maxprice.max">Giá quá cao. Tối đa là <sup>₫</sup>222192000</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="cur text-muted">
                                                        VNĐ / Mỗi đêm
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="clearfix"></div>

                                            <div class="property col-md-8">
                                                <label for="house-type" class="h4 text-gray text-normal">
                                                    <span>Tiền tệ</span>
                                                </label>
                                                <div class="select select-block select-jumbo">
                                                    <select id="house-type" name="currency">
                                                        <option value="0" disabled="">Select one</option>
                                                        <option selected="" value="1">VNĐ</option>
                                                        <option value="2">USD</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="clearfix"></div>
                                        </div>
                                    </form>
                                    <hr>
                                    <div>
                                        <a href="@{{ back }}"  class="back-process">
                                            <i class="ti-arrow-left"></i>
                                            <span>Back</span>
                                        </a>
                                        <a v-if="$validatepriceform.valid && success" href="@{{ link }}"
                                            onclick="event.preventDefault();
                                                    document.getElementById('price-form').submit();"
                                            class="pull-right btn btn-large btn-progress-next btn-large__next-btn pull-right-md btn-primary" >
                                            <div class="btn-progress-next__text">
                                                <span>Next</span>
                                            </div>
                                        </a>
                                    </div>
                                </validator>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
               
                <div class="col-md-5">
                    <div class="help-panel-container">
                        <div class="hide-sm help-panel panel">
                            <div class="panel-body">
                                <div class="help-panel__bulb-img space-2"></div>
                                <div class="help-panel__text">
                                    <div>
                                        <p>
                                            <span>Providing the essentials helps guests feel at home in your place</span>
                                        </p>
                                        <p>
                                            <span>Some hosts provide breakfast, or just coffee and tea. None of these things are required, but sometimes they add a nice touch to help guests feel welcome.</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    @stop

    @push('css')
        <style>
            label {
                color: #484848;
            }
            .cur {
                padding: 20px 0;
                margin-top: 3px;
            }
            .text-label {
                padding: 25px 0 0;
            }
        </style>
    @endpush