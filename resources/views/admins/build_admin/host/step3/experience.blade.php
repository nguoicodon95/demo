@extends('admins.master')
    <?php $step_three = true; ?>

    @section('titleName')
        Your listings
    @stop

    @section('content')
        <div class="content">
            <div class="container-fluid">
                @include('admins.host._shared.action')
                
                <question link="{{ route('host.occupancy', $data_Room->id) }}" 
                            back="{{ route('admin.room.create', $data_Room->id) }}"></question>
                
            </div>
        </div>

        <template id="experience-question">
            <div class="row">
                <div class="col-md-6">
                    <form action="" method="POST" id="experience-form">
                        {{ csrf_field() }}
                        <div style="margin-bottom: 24px;">
                            <div class="panel-title">
                                <h3>Bạn đã thuê vị trí của bạn trước?</h3>
                            </div>
                            <div class="block-radio-button">
                                <label class="btn btn-block block-radio_panel" for="aw-true">
                                    <div class="no-margin-h">
                                        <div class="ib pull-left">
                                            <span>Tôi có</span>
                                        </div>
                                        <div class="ib pull-right">
                                            <input id="aw-true"
                                                    type="radio"
                                                    name="experience_question" value="1" {{ isset($experience) && $experience == 1 ? 'checked' : '' }}
                                                    class="pointer-input" v-model="answer">
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </label>
                            </div>
                            <div class="block-radio-button">
                                <label class="btn btn-block block-radio_panel" for="aw-false" style="margin-top: 0">
                                    <div class="no-margin-h">
                                        <div class="ib pull-left">
                                            <span>Tôi mới đến này</span>
                                        </div>
                                        <div class="ib pull-right">
                                            <input id="aw-false"
                                                    type="radio"
                                                    name="experience_question" value="0" {{ isset($experience) && $experience == 0 ? 'checked' : '' }}
                                                    class="pointer-input" v-model="answer">
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div>
                        <a href="@{{ back }}"  class="back-process">
                            <i class="ti-arrow-left"></i>
                            <span>Back</span>
                        </a>
                        <a v-if="success" href="@{{ link }}"
                            onclick="event.preventDefault();
                                    document.getElementById('experience-form').submit();"
                            class="pull-right btn btn-large btn-progress-next btn-large__next-btn pull-right-md btn-primary" >
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