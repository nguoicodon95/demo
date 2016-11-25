@extends('admins.master')
    <?php $step_two = true; ?>
    @section('titleName')
        Your listings
    @stop

    @section('content')
        <div class="content">
            <div class="container-fluid">
                @include('admins.host._shared.action')
                <highlights link="{{ route('host.description', $data_Room->id) }}" 
                            back="{{ route('admin.room.create', $data_Room->id) }}"></highlights>
            </div>
        </div>

        <template id="highlights_tp">
            <div class="row">
                <div class="col-md-6">
                    <validator name="validatelocationform">
                        <form method="POST" id="highlight-form">
                            {{ csrf_field() }}
                            <div style="margin-bottom: 24px;">
                                <div class="panel-title">
                                    <h3>Start building your description</h3>
                                </div>
                                <div class="row">
                                    <div class="clearfix"></div>
                                    <div class="location package_desc col-sm-12">
                                        <div class="panel-body">
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
                                    </div>

                                    <div class="location package_desc col-sm-12" style="margin-top: 24px">
                                        <div class="panel-body">
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
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="panel-title">
                                        <p class="">My place is good for</p>
                                    </div>
                                    <div class="kind">
                                        @if(isset($amenities_spaces) && $amenities_spaces->count() > 0)
                                            @foreach($amenities_spaces as $am_space)
                                        <div class="space-5 amenity-item">
                                            <input id="amenities-for-{{ $am_space->id }}" type="checkbox" 
                                                    class="col-sm-1" value="{{ $am_space->id }}" 
                                                    name="amenities_id[]" {{ $data_Room != '' && $data_Room->amenities->contains($am_space->id) ? 'checked=checked' : '' }}>
                                            <div class="pull-left col-sm-11">
                                                <label for="amenities-for-{{ $am_space->id }}">
                                                    <span>{{ $am_space->name }}</span>
                                                </label>
                                                <span>&nbsp;</span>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                            @endforeach
                                        @endif
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <hr>
                        <div>
                            <a href="@{{ back }}"  class="back-process">
                                <i class="ti-arrow-left"></i>
                                <span>Back</span>
                            </a>
                            <a href="@{{ link }}" 
                                class="pull-right btn btn-large btn-progress-next btn-large__next-btn pull-right-md btn-primary"
                                onclick="event.preventDefault();
                                        document.getElementById('highlight-form').submit();">
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
                </div>
            </div>
        </template>
    @stop

    @push('css')
        <link href="{{ asset('admins/assets/css/select2.css') }}" rel="stylesheet" />
        <style>
            .package_desc {
                border: 1px solid #c4c4c4;
                -webkit-border-radius: 2px;
                -moz-border-radius: 2px;
                border-radius: 2px;
                background-color: #fff;
            }

            .panel-body {
                border-top: 0;
            }
            p {
                font-size: 18px;
                line-height: 1.4em;
                color: #484848;
            }
        </style>
    @endpush
    
    @push('js')
        <script src="{{ asset('admins/assets/js/select2.js') }}"></script>
        <script>
            $("#place-close, #place-highlights").select2({
              tags: true
            });
        </script>
    @endpush