<template id="location-find">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light form-fit">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="locations">
                                <div class="kind">
                                    <div class="increment-btn no-padding">
                                        <div class="row" id="address">
                                            <div class="location col-sm-12 field">
                                                <label for="get-location-address" class="h4 text-gray text-normal">
                                                    <span>Street Address</span>
                                                </label>
                                                <input autofocus="true" autocomplete="off" 
                                                        class="input input-block input-jumbo lys-address-form__input"
                                                        id="get-location-address" name="street" type="text" 
                                                        placeholder="House name/number + street/road" 
                                                        value="{{ ($data_Room != '') ? $data_Room->place_room->street : '' }}">
                                                
                                            </div>

                                            <input type="hidden" id="street_number" name="street_number" value="{{ ($data_Room != '') ? $data_Room->place_room->street_number : '' }}">
                                            <input type="hidden" id="route" name="route" value="{{ ($data_Room != '') ? $data_Room->place_room->route : '' }}">
                                            <input type="hidden" id="locality" name="locality" value="{{ ($data_Room != '') ? $data_Room->place_room->locality : '' }}">

                                            <div class="location col-sm-6 field">
                                                <label for="address-form-field-city" >
                                                    <span>City</span>
                                                </label>
                                                <input class="input input-block input-jumbo lys-address-form__input" 
                                                        id="administrative_area_level_1" name="city" type="text" 
                                                        autocomplete="off"
                                                        value="{{ ($data_Room != '') ? $data_Room->place_room->street : '' }}">
                                            </div>

                                            <input type="hidden" name="latitude" id="latitude" value="{{ ($data_Room != '') ? $data_Room->place_room->latitude : '' }}">
                                            <input type="hidden" name="country" id="country" value="{{ ($data_Room != '') ? $data_Room->place_room->country : '' }}">
                                            <input type="hidden" name="longitude" id="longitude" value="{{ ($data_Room != '') ? $data_Room->place_room->longitude : '' }}">

                                            <div class="location col-sm-6 field">
                                                <label for="address-form-field-state" >
                                                    <span>State</span>
                                                </label>
                                                <input class="input input-block input-jumbo" 
                                                        id="administrative_area_level_2" 
                                                        name="state" type="text" autocomplete="off" value="{{ ($data_Room != '') ? $data_Room->place_room->state : '' }}">
                                            </div>

                                            <div class="location col-sm-6 field">
                                                <label for="address-form-field-code" >
                                                    <span>Zip Code</span>
                                                </label>
                                                <input class="input input-block input-jumbo" 
                                                        id="postal_code" name="zipcode" type="text" 
                                                        autocomplete="off" value="{{ ($data_Room != '') ? $data_Room->place_room->zipcode : '' }}">
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div id="map"></div>
                            <style>
                            #map {
                                height: 300px;
                                width: 100%;
                            }
                            </style>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customs style form  -->
    <style>
        .btn {
            border: 1px solid rgba(0, 0, 0, 0.19);
        }
        .locations .increment-btn {
            max-width: 485px;
        }
    </style>
</template>

    