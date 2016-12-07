<template id="highlights_tp">
    <div class="row">
        <div class="col-md-12">
            <div class="location package_desc col-sm-12">
                <label for="place-close">Vị trí của tôi là gần</label>
                <select multiple class="input input-block input-jumbo lys-address-form__input"
                        id="place-close" name="place_close[]">
                    @if(isset($data_Room) && !is_null($data_Room->place_close))
                        @foreach($data_Room->place_close as $place_close)
                            <option value="{{ $place_close }}" selected="true">{{ $place_close }}</option>
                        @endforeach
                        @if(isset($amenities_location) && $amenities_location->count() > 0)
                            @foreach($amenities_location as $am_lc)
                                @if(!in_array($am_lc->name, $data_Room->place_close))
                                <option value="{{ $am_lc->name }}">{{ $am_lc->name }}</option>
                                @endif
                            @endforeach
                        @endif
                    @else
                        @if(isset($amenities_location) && $amenities_location->count() > 0)
                            @foreach($amenities_location as $am_lc)
                                <option value="{{ $am_lc->name }}">{{ $am_lc->name }}</option>
                            @endforeach
                        @endif
                    @endif
                </select>
            </div>

            <div class="location package_desc col-sm-12" style="margin-top: 24px">
                <label for="place-highlights">Bạn sẽ yêu nơi tôi vì</label>
                <select multiple class="input input-block input-jumbo lys-address-form__input"
                        id="place-highlights" name="space_special[]">
                    @if(isset($data_Room) && !is_null($data_Room->space_special))
                        @foreach($data_Room->space_special as $space_special)
                            <option value="{{ $space_special }}" selected="true">{{ $space_special }}</option>
                        @endforeach
                        @if(isset($amenities_special) && $amenities_special->count() > 0)
                            @foreach($amenities_special as $am_special)
                                @if(!in_array($am_special->name, $data_Room->space_special))
                                <option value="{{ $am_special->name }}">{{ $am_special->name }}</option>
                                @endif
                            @endforeach
                        @endif
                    @else
                        @if(isset($amenities_special) && $amenities_special->count() > 0)
                            @foreach($amenities_special as $am_special)
                                <option value="{{ $am_special->name }}">{{ $am_special->name }}</option>
                            @endforeach
                        @endif
                    @endif
                </select>
            </div>
            <div class="clearfix"></div>
            <div class="kind">
                <div class="increment-btn no-padding field">
                    <label class="h4 text-gray text-normal mar-top-25 mar-bot-25">
                        <span>Vị trí thích hợp cho</span>
                    </label>
                    @if(isset($amenities_spaces) && $amenities_spaces->count() > 0)
                        @foreach($amenities_spaces as $am_space)
                            <div class="space-5 amenity-item">
                                <input id="amenities-for-{{ $am_space->id }}" type="checkbox" 
                                    class="" value="{{ $am_space->id }}" 
                                    name="amenities_id[]">
                                <div class="pull-right col-sm-11">
                                    <label for="amenities-for-{{ $am_space->id }}">
                                        <span class="text-muted">{{ $am_space->name }}</span>
                                    </label>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        @endforeach
                    @endif
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
        .kind .space-5 {
            margin-bottom: 10px;
        }
    </style>
</template>