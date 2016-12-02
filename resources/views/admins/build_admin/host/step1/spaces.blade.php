@extends('admins.master')
    <?php  $step_one = true; ?>

    @section('titleName')
        Your listings
    @stop

    @section('content')
        <div class="content">
            <div class="container-fluid">
                @include('admins.host._shared.action')
                
                <spaces link="{{ route('host.spaces', $data_Room != '' ? $data_Room->id : '') }}" 
                        back="{{ route('host.amenities', $data_Room != '' ? $data_Room->id : '') }}"></spaces>
                
            </div>
        </div>

        <template id="spaces-choose">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ ($data_Room != '') ? route('host.edit.spaces', $data_Room->id) : route('host.post.spaces', $room_ID) }}" method="POST" id="spaces-form">
                        {{ csrf_field() }}
                        {{ method_field(($data_Room != '') ? 'PUT' : 'POST') }}
                        <input type="hidden" name="_link" value="@{{ link }}">
                    
                        <div style="margin-bottom: 24px;">
                            <div class="panel-title">
                                <h3>What spaces can guests use?</h3>
                            </div>
                            <div class="kind ">
                                @if($spaces->count() >0)
                                    @foreach($spaces as $s)
                                        <div class="space-5 amenity-item">
                                            <input id="{{ str_slug($s->name) }}" 
                                                type="checkbox" class="col-sm-1" 
                                                value="{{ $s->id }}" name="spaces_id[]"
                                                {{ $data_Room != '' && $data_Room->spaces->contains($s->id) ? 'checked=checked' : '' }}>
                                            <div class="pull-left col-sm-11">
                                                <label for="{{ str_slug($s->name) }}">
                                                    <span>{{ $s->name }}</span>
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
                                        document.getElementById('spaces-form').submit();">
                            <div class="btn-progress-next__text">
                                <span>Hoàn thành</span>
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