@extends('admins.master')
    <?php  $step_one = true; ?>

    @section('titleName')
        Your listings
    @stop

    @section('content')
        <div class="content">
            <div class="container-fluid">
                @include('admins.host._shared.action')
                <rooms link="{{ route('host.bedrooms', $data_Room != '' ? $data_Room->id : '') }}" back="{{ route('admin.room.create', $data_Room != '' ? $data_Room->id : '') }}"></rooms>
            </div>
        </div>
        <template id="room-choose">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ ($data_Room != '') ? route('host.edit.kindroom', $data_Room->id) : route('host.post.kindroom') }}" method="POST" id="room-type-form">
                        {{ csrf_field() }}
                        {{ method_field(($data_Room != '') ? 'PUT' : 'POST') }}
                        <input type="hidden" name="_link" value="@{{ link }}">
                        <div>
                            <div class="panel-title">
                                <h3>What kind of place are you listing?</h3>
                            </div>
                            <div class="kind">
                                @if($kinds->count() > 0)
                                    @foreach($kinds as $kind)
                                        <div class="block-radio-button">
                                            <label class="btn btn-block block-radio_panel" for="{{ $kind->slug }}">
                                                <div class="no-margin-h">
                                                    <i class="pull-left icon {{ $kind->icon }} icon-with-label"></i>
                                                    <div class="ib pull-left">
                                                        <span>{{ $kind->name }}</span>
                                                    </div>
                                                    <div class="ib pull-right">
                                                        <input id="{{ $kind->slug }}"
                                                                type="radio"
                                                                {{  
                                                                    ($data_Room != '') && (isset($data_Room)) && (!empty($data_Room)) && ($data_Room->kind_room_id == $kind->id) ? 'checked=checked' : 
                                                                    ($storage_room != null) && (isset($storage_room['kind_room_id'])) && ($storage_room['kind_room_id'] == $kind->id) ? 'checked=checked' : null 
                                                                }} 
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
                            @if($errors->has('kind_room_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('kind_room_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="property">
                            <label for="house-type" class="h4 text-gray text-normal">
                                <span>What type of property is this?</span>
                            </label>
                            <div class="select select-block select-jumbo">
                                <select id="house-type" name="property_type_id">
                                    <option selected="" value="0" disabled="">Select one</option>
                                    @if($properties->count() > 0)
                                        @foreach($properties as $p)
                                            <option value="{{ $p->id }}"{{ 
                                                ($data_Room != '') && (isset($data_Room)) && (!empty($data_Room)) && ($data_Room->property_type_id == $p->id) ? ' selected=selected' : 
                                                ($storage_room != null) && (isset($storage_room['property_type_id'])) && ($storage_room['property_type_id'] == $p->id) ? ' selected=selected' : null 
                                            }}>{{ $p->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div>
                        <a href="@{{ back }}" class="back-process">
                            <i class="ti-arrow-left"></i>
                            <span>Back</span>
                        </a>
                        <a v-if="success" href="@{{ link }}"
                            class="pull-right btn btn-large btn-progress-next btn-large__next-btn pull-right-md btn-primary"
                            onclick="event.preventDefault();
                                        document.getElementById('room-type-form').submit();">
                            <div class="btn-progress-next__text">
                                <span>Next</span>
                            </div>
                        </a>
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
                                            <span>Guests will rent the entire place. Includes in-law units.</span>
                                        </p>
                                        <p>
                                            <span class="help-panel__title">
                                                <span>Private room</span>
                                                <br>
                                            </span>
                                            <span>Guests share some spaces but they’ll have their own private room for sleeping.</span>
                                        </p>
                                        <p>
                                            <span class="help-panel__title">
                                                <span>Shared room</span>
                                                <br>
                                            </span>
                                            <span>Guests don’t have a room to themselves.</span>
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
        </style>
    @endpush