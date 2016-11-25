@extends('admins.master')
    <?php  $step_one = true; ?>
    @section('titleName')
        Your listings
    @stop

    @section('content')
        <div class="content">
            <div class="container-fluid">
                @include('admins.host._shared.action')
                
                <amenities link="{{ route('host.spaces', $data_Room != '' ? $data_Room->id : '') }}" 
                            back="{{ route('host.location', $data_Room != '' ? $data_Room->id : '') }}"></amenities>
                
            </div>
        </div>

        <template id="amenities-choose">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ ($data_Room != '') ? route('host.edit.amenities', $data_Room->id) : route('host.post.amenities', $room_ID) }}" method="POST" id="amenities-form">
                        {{ csrf_field() }}
                        {{ method_field(($data_Room != '') ? 'PUT' : 'POST') }}
                        <div style="margin-bottom: 24px;">
                            <div class="panel-title">
                                <h3>What amenities do you offer?</h3>
                            </div>
                            <div class="kind">
                                @if($amenities_normal->count() > 0)
                                    @foreach($amenities_normal as $am)
                                        <div class="space-5 amenity-item">
                                            <input id="amenities-for-{{ $am->id }}" type="checkbox" 
                                                    class="col-sm-1" value="{{ $am->id }}" 
                                                    name="amenities_id[]"
                                                    {{ $data_Room != '' && $data_Room->amenities->contains($am->id) ? 'checked=checked' : '' }}>
                                            <div class="pull-left col-sm-11">
                                                <label for="amenities-for-{{ $am->id }}">
                                                    <span>{{ $am->name }}</span>
                                                </label>
                                                <span>&nbsp;</span>
                                                @if(!is_null($am->description))
                                                    <div class="text-muted">{{ $am->description }}</div>
                                                @endif
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="clearfix"></div>
                            </div>
                            <div class="kind">
                                <h4>Tiện nghi an toàn</h4>
                                @if($amenities_safety->count() > 0)
                                    @foreach($amenities_safety as $am)
                                        <div class="space-5 amenity-item">
                                            <input id="amenities-for-{{ $am->id }}" type="checkbox" 
                                                    class="col-sm-1" value="{{ $am->id }}" 
                                                    name="amenities_id[]"
                                                    {{ $data_Room != '' && $data_Room->amenities->contains($am->id) ? 'checked=checked' : '' }}>
                                            <div class="pull-left col-sm-11">
                                                <label for="amenities-for-{{ $am->id }}">
                                                    <span>{{ $am->name }}</span>
                                                </label>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    @endforeach
                                @endif
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
                        <a href="@{{ link }}" 
                            class="pull-right btn btn-large btn-progress-next btn-large__next-btn pull-right-md btn-primary"
                            onclick="event.preventDefault();
                                        document.getElementById('amenities-form').submit();">
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
        </style>
    @endpush