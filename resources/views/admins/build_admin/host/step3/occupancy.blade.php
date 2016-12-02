@extends('admins.master')
    <?php $step_three = true; ?>

    @section('titleName')
        Your listings
    @stop

    @section('content')
        <div class="content">
            <div class="container-fluid">
                @include('admins.host._shared.action')
                
                <question link="{{ route('host.booking', $data_Room->id) }}" 
                            back="{{ route('host.experience', $data_Room->id) }}"></question>
                
            </div>
        </div>

        <template id="experience-question">
            <div class="row">
                <div class="col-md-6">
                    <form action="" method="POST" id="occupancy-form">
                        {{ csrf_field() }}
                        <div style="margin-bottom: 24px;">
                            <div class="panel-title">
                                <h3>Bạn muốn có khách thường xuyên như thế nào?</h3>
                            </div>
                            <div class="block-radio-button">
                                <label class="btn btn-block block-radio_panel" for="aw-true">
                                    <div class="no-margin-h">
                                        <div class="ib pull-left">
                                            <span>Càng nhiều càng tốt</span>
                                        </div>
                                        <div class="ib pull-right">
                                            <input id="aw-true"
                                                    type="radio" {{ isset($occupancy) && $occupancy == 'as_often_as_possible' ? 'checked' : '' }}
                                                    name="occupancy_question" value="as_often_as_possible" 
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
                                            <span>Bán thời gian</span>
                                        </div>
                                        <div class="ib pull-right">
                                            <input id="aw-false"
                                                    type="radio" {{ isset($occupancy) && $occupancy == 'part_time' ? 'checked' : '' }}
                                                    name="occupancy_question" value="part_time" 
                                                    class="pointer-input" v-model="answer">
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </label>
                            </div>
                            <div class="block-radio-button">
                                <label class="btn btn-block block-radio_panel" for="aw-nor" style="margin-top: 0">
                                    <div class="no-margin-h">
                                        <div class="ib pull-left">
                                            <span>Không chắc chắn</span>
                                        </div>
                                        <div class="ib pull-right">
                                            <input id="aw-nor"
                                                    type="radio" {{ isset($occupancy) && $occupancy == 'not_sure_yet' ? 'checked' : '' }}
                                                    name="occupancy_question" value="not_sure_yet" 
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
                            class="pull-right btn btn-large btn-progress-next btn-large__next-btn pull-right-md btn-primary"
                            onclick="event.preventDefault();
                                        document.getElementById('occupancy-form').submit();">
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