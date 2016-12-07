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
            <locations-around room-id={{ $room_ID }}></locations-around>
        </div>

        <template id="locations_around">
            <div class="row">
                <div class="portlet light form-fit">
                    <div class="portlet-body">
                        <div class="col-md-12">
                            <div class="field" v-for="item in list">
                                <div class="locations alert alert-success">
                                    <button type="button" aria-hidden="true" @click="deleteLocations(item.id)" class="close">×</button>
                                    <img v-bind:src="item.marker_icon" alt="" style="display: inline-block;">
                                    <span  style="display: inline-block; font-size: 18px; margin-left: 15px;">
                                        @{{ item.location_name }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <validator name="validatelocationform">
                                <form action="" method="POST" id="locations-around-form">
                                    {{ csrf_field() }}
                                    <div style="margin-bottom: 24px;">
                                        <div class="panel-title">
                                            <h3>Thêm địa điểm gần khu vực của bạn</h3>
                                        </div>
                                        <div class="row" id="address">
                                            <div class="location col-sm-12">
                                                <label for="get-location-address" >
                                                    <span>Tên địa điểm</span>
                                                </label>
                                                <input autofocus="true" autocomplete="off" 
                                                        class="input input-block input-jumbo lys-address-form__input"
                                                        name="location_name" type="text" 
                                                        placeholder="Tên địa điểm">
                                                
                                            </div>
                                            <div class="location col-sm-12">
                                                <label for="get-location-address" >
                                                    <span>Vị trí</span>
                                                </label>
                                                <input autofocus="true" autocomplete="off" 
                                                        class="input input-block input-jumbo lys-address-form__input"
                                                        id="get-location-address" name="street" type="text" 
                                                        placeholder="House name/number + street/road" 
                                                        :classes="{invalid: 'lys-invalid', valid: ''}"
                                                        v-validate:street="[ 'required' ]">
                                                
                                            </div>
                                            <div class="location col-sm-12">
                                                <label for="marker_icon" >
                                                    <span>Icon</span>
                                                </label>
                                                <input autocomplete="off" 
                                                        class="input input-block input-jumbo lys-address-form__input"
                                                        id="marker_icon" name="marker_icon" type="file" 
                                                        placeholder="House name/number + street/road" >
                                                
                                            </div>

                                            <input type="hidden" id="street_number" name="street_number">
                                            <input type="hidden" id="route" name="route">
                                            <input type="hidden" id="locality" name="locality">

                                            <input class="input input-block input-jumbo lys-address-form__input" 
                                                    id="administrative_area_level_1" name="city" type="hidden" 
                                                    autocomplete="off">

                                            <input type="hidden" name="latitude" id="latitude">
                                            <input type="hidden" name="country" id="country">
                                            <input type="hidden" name="longitude" id="longitude">

                                            <input class="input input-block input-jumbo" 
                                                    id="administrative_area_level_2" 
                                                    name="state" type="hidden" autocomplete="off">

                                            <input class="input input-block input-jumbo" 
                                                    id="postal_code" name="zipcode" type="hidden" 
                                                    autocomplete="off">
                                            <div class="clearfix"></div>
                                        </div>

                                    </div>
                                </form>
                                <hr>
                                <div>
                                    <a href="#" v-if="$validatelocationform.valid"
                                        @click="createLocations"
                                        class="pull-right btn btn-large btn-progress-next btn-large__next-btn pull-right-md btn-primary">
                                        <div class="btn-progress-next__text">
                                            <span>Thêm</span>
                                        </div>
                                    </a>
                                    <a href="{{ route('host.checkin', $room_ID) }}"
                                        class="pull-right btn btn-large btn-progress-next btn-large__next-btn pull-right-md btn-primary">
                                        <div class="btn-progress-next__text">
                                            <span>Đi tiếp</span>
                                        </div>
                                    </a>
                                </div>
                            </validator>
                        </div>
                
                        <div class="col-md-5">
                            <div id="map"></div>
                            <style>
                            
                            #map {
                                height: 300px;
                                top: 73px;
                                width: 85%;
                                margin: 65px auto;
                            }
                            
                            </style>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </template>
    @stop

    
    @push('js-include')
    @endpush

    
    @push('js-script')
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9nTLsQJhpaViKu0aXR2HhzPYrMDfIn30&libraries=places"></script>
        <script src="{{ asset('dist/js/location.js') }}"></script>
        <script>
            LocationMap.init()
        </script>
    @endpush