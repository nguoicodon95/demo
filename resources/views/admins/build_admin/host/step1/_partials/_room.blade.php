<template id="room-choose">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light form-fit">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="kind field">
                                <label for="house-type" class="h4 text-gray text-normal">
                                    <span>Khách sẽ thuê</span>
                                </label>
                                <div class="clearfix"></div>
                                @if($kinds->count() > 0)
                                    @foreach($kinds as $key => $kind)
                                        <div class="block-radio-button">
                                            <label class="btn btn-block block-radio_panel" for="{{ $kind->slug }}">
                                                <div class="no-margin-h">
                                                    <i class="pull-left icon {{ $kind->icon }} icon-with-label"></i>
                                                    <div class="ib pull-left">
                                                        <span>{{ $kind->name }}</span>
                                                    </div>
                                                    <div class="ib pull-right">
                                                        <input id="{{ $kind->slug }}" 
                                                                type="radio" {{ (($data_Room != '') && $data_Room->kind_room_id == $kind->id ) ? 'checked' : ($key == 0) ? 'checked' : '' }} 
                                                                name="kind_room_id" value="{{ $kind->id }}" 
                                                                class="pointer-input" v-model="roomtype">
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            
                            <div class="property">
                                <label for="house-type" class="h4 text-gray text-normal">
                                    <span>Loại tài sản</span>
                                </label>
                                <div class="select select-block select-jumbo field">
                                    <select id="house-type" name="property_type_id">
                                        <option selected="" value="0" disabled="">Chọn loại tài sản</option>
                                        @if($properties->count() > 0)
                                            @foreach($properties as $p)
                                                <option value="{{ $p->id }}" {{ (($data_Room != '') && $data_Room->property_type_id == $p->id ) ? 'selected' : '' }}>{{ $p->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
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
                                                    <span class="help-panel__title">
                                                        <span>Entire place</span>
                                                        <br>
                                                    </span>
                                                    <span>Du khách sẽ thuê toàn bộ nơi. Bao gồm các đơn vị trong-pháp luật.</span>
                                                </p>
                                                <p>
                                                    <span class="help-panel__title">
                                                        <span>Private room</span>
                                                        <br>
                                                    </span>
                                                    <span>Khách dùng chung một số không gian, nhưng họ sẽ có phòng riêng của mình để ngủ.</span>
                                                </p>
                                                <p>
                                                    <span class="help-panel__title">
                                                        <span>Shared room</span>
                                                        <br>
                                                    </span>
                                                    <span>Khách không có phòng riêng.</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customs style form  -->
    <style>
        .icon-shared {
            font-size: 19px;
        }

        .icon-private {
            margin-right: 27px;
            margin-left: 3px;
        }

        .icon-house {
            margin-right: 27px;
        }
        .icon {
            margin-top: 4px;
        }
        .block-radio-button {
            display: block; 
        }
        .help-panel-container .help-panel {
            margin: 15px;
        }
        .kind {
            margin: 0 0 15px;
        }
    </style>
</template>