@extends('admins.master')
    <?php  $step_one = true; ?>

    @section('titleName')
        Your listings
    @stop

    @section('content')
        <div class="content">
            <div class="container-fluid">
                @include('admins.host._shared.action')
                <locations link="{{ route('host.amenities', $data_Room != '' ? $data_Room->id : '') }}" 
                            back="{{ route('host.bathrooms', $data_Room != '' ? $data_Room->id : '') }}"></locations>
            </div>
        </div>

        <template id="location-find">
            <div class="row">
                <div class="col-md-6">
                    <validator name="validatelocationform">
                        <form action="{{ ($data_Room != '') ? route('host.edit.location', $data_Room->id) : route('host.post.location') }}" method="POST" id="location-form">
                            {{ csrf_field() }}
                            {{ method_field(($data_Room != '') ? 'PUT' : 'POST') }}
                            <!-- <input type="hidden" name="_link" value="@{{ link }}"> -->
                            <div style="margin-bottom: 24px;">
                                <div class="panel-title">
                                    <h3>Where’s your place located?</h3>
                                </div>
                                <div class="row" id="address">
                                    <div class="location col-sm-12">
                                        <label for="get-location-address" >
                                            <span>Street Address</span>
                                        </label>
                                        <input autofocus="true" autocomplete="off" 
                                                class="input input-block input-jumbo lys-address-form__input"
                                                id="get-location-address" name="street" type="text" 
                                                placeholder="House name/number + street/road" 
                                                v-validate:street="[ 'required' ]" 
                                                :classes="{invalid: 'lys-invalid', valid: ''}"
                                                value="{{ $data_Room != '' ? $data_Room->place_room->street : '' }}">
                                        
                                    </div>

                                    <input type="hidden" id="street_number" name="street_number" value="{{ $data_Room != '' ? $data_Room->place_room->street_number : '' }}">
                                    <input type="hidden" id="route" name="route" value="{{ $data_Room != '' ? $data_Room->place_room->route : '' }}">
                                    <input type="hidden" id="locality" name="locality" value="{{ $data_Room != '' ? $data_Room->place_room->locality : '' }}">

                                    <div class="location col-sm-6">
                                        <label for="address-form-field-city" >
                                            <span>City</span>
                                        </label>
                                        <input class="input input-block input-jumbo lys-address-form__input" 
                                                id="administrative_area_level_1" name="city" type="text" 
                                                autocomplete="off"
                                                value="{{ $data_Room != '' ? $data_Room->place_room->city : '' }}">
                                    </div>

                                    <input type="hidden" name="latitude" id="latitude" value="{{ $data_Room != '' ? $data_Room->place_room->latitude : '' }}">
                                    <input type="hidden" name="country" id="country" value="{{ $data_Room != '' ? $data_Room->place_room->country : '' }}">
                                    <input type="hidden" name="longitude" id="longitude" value="{{ $data_Room != '' ? $data_Room->place_room->longitude : '' }}">

                                    <div class="location col-sm-6">
                                        <label for="address-form-field-state" >
                                            <span>State</span>
                                        </label>
                                        <input class="input input-block input-jumbo" 
                                                id="administrative_area_level_2" 
                                                name="state" type="text" autocomplete="off" value="{{ $data_Room != '' ? $data_Room->place_room->state : '' }}">
                                    </div>

                                    <div class="location col-sm-6">
                                        <label for="address-form-field-code" >
                                            <span>Zip Code</span>
                                        </label>
                                        <input class="input input-block input-jumbo" 
                                                id="postal_code" name="zipcode" type="text" 
                                                autocomplete="off" value="{{ $data_Room != '' ? $data_Room->place_room->zipcode : '' }}">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                            </div>
                        </form>
                        <hr>
                        <div>
                            <a href="@{{ back }}"  class="back-process">
                                <i class="ti-arrow-left"></i>
                                <span>Back</span>
                            </a>
                            <a v-if="$validatelocationform.valid" 
                                href="@{{ link }}" 
                                class="pull-right btn btn-large btn-progress-next btn-large__next-btn pull-right-md btn-primary"
                                onclick="event.preventDefault();
                                        document.getElementById('location-form').submit();">
                                <div class="btn-progress-next__text">
                                    <span>Next</span>
                                </div>
                            </a>
                        </div>
                    </validator>
                </div>
               
                <div class="col-md-5">
                    <!-- <div class="help-panel-container">
                        <div class="hide-sm help-panel panel">
                            <div class="panel-body">
                                <div class="help-panel__bulb-img space-2"></div>
                                <div class="help-panel__text">
                                    <div>
                                        <p>
                                            <span>Your exact address will only be shared with confirmed guests.</span>
                                        </p>
                                        <div class="tip-address-img"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div id="map"></div>
                    <style>
                     
                      #map {
                        height: 300px;
                        top: 73px;
                        width: 85%;
                        margin: 65px auto;
                        border-radius: 23px;
                      }
                      
                    </style>
                </div>
            </div>
        </template>
    @stop

    
    @push('js')
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9nTLsQJhpaViKu0aXR2HhzPYrMDfIn30&libraries=places"></script>
        <script src="{{ asset('js/location.js') }}"></script>
    @endpush