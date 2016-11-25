@extends('admins.master')
    <?php  $step_one = true; ?>

    @section('titleName')
        Your listings
    @stop

    @section('content')
        <div class="content">
            <div class="container-fluid">
                @include('admins.host._shared.action')
                 <?php
                    if ($data_Room != '' && (isset($data_Room)) && (!empty($data_Room)) ) {
                        $bathroom_count = $data_Room->bathroom_count;
                    } elseif ( isset($storeBathroom) && ($storeBathroom != null) && (isset($storeBathroom['bathroom_count'])) && (isset($storeBathroom['bathroom_count'])) ) {
                        $bathroom_count = $storeBathroom['bathroom_count'];
                    } else {
                        $bathroom_count = 1;
                    }
                ?>
                <bathrooms 
                    link="{{ route('host.location', $data_Room != '' ? $data_Room->id : '')}}" 
                    back="{{ route('host.bedrooms', $data_Room != '' ? $data_Room->id : '')}}" 
                    count_bathroom="{{ $bathroom_count }}"></bathrooms>
                
            </div>
        </div>

        <template id="bathroom-choose">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ ($data_Room != '') ? route('host.edit.bathrooms', $data_Room->id) : route('host.post.bathrooms') }}" method="POST" id="bathroom-form">
                        {{ csrf_field() }}
                        {{ method_field(($data_Room != '') ? 'PUT' : 'POST') }}
                        <input type="hidden" name="_link" value="@{{ link }}">
                        <div style="margin-bottom: 24px;">
                            <div class="panel-title">
                                <h3>How many bathrooms?</h3>
                            </div>
                            <div class="kind">
                                <div class="increment-btn no-padding">
                                    <div class="increment-btn btn-group no-border-bottom-radius">
                                        <div class="text-gray btn increment-jumbo increment-btn__label increment-btn__label--with-increment-btns" tabindex="0" role="textbox">
                                            <div class="increment-btn__border-container-label text-truncated">
                                                <span class="text-muted"><span>@{{ count_bathroom }} bathroom@{{ (count_bathroom > 1) ? 's' : '' }}</span></span>
                                                <input type="hidden" value="@{{ count_bathroom }}" name="bathroom_count">
                                            </div>
                                        </div>
                                        <button type="button" @click="updateBathroomDecrement" :disabled="diasableMin" class="btn btn-jumbo increment-btn__decrementer"></button>
                                        <button type="button" @click="updateBathroomIncrement" :disabled="diasableMax" class="btn btn-jumbo increment-btn__incrementer"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="property">
                            <div class="block-radio-button">
                                <label class="btn btn-block block-radio_panel" for="room-type-private">
                                    <div class="no-margin-h">
                                        <div class="ib pull-left">
                                            <span>Private</span>
                                        </div>
                                        <div class="ib pull-right">
                                            <input id="room-type-private" type="radio" name="bathroom_type" value="private" class="pointer-input">
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </label>
                            </div>
                            <div class="block-radio-button">
                                <label class="btn btn-block block-radio_panel" for="room-type-shared">
                                    <div class="no-margin-h">
                                        <div class="ib pull-left">
                                            <span>Shared</span>
                                        </div>
                                        <div class="ib pull-right">
                                            <input id="room-type-shared" type="radio" name="bathroom_type" value="shared" class="pointer-input">
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </label>
                            </div>
                        </div> -->
                    </form>
                    <hr>
                    <div>
                        <a href="@{{ back }}" class="back-process">
                            <i class="ti-arrow-left"></i>
                            <span>Back</span>
                        </a>
                        <a class="pull-right btn btn-large btn-progress-next btn-large__next-btn pull-right-md btn-primary" 
                            href="@{{ link }}"
                            onclick="event.preventDefault();
                                        document.getElementById('bathroom-form').submit();">
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
                                            <span>Guests will rent the entire place. Includes in-law units.The number and type of beds you have determines how many guests can stay comfortably.</span>
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
