@extends('admins.master')
    <?php $step_three = true; ?>

    @section('titleName')
        Your listings
    @stop

    @section('content')
        <div class="content">
            <div class="container-fluid">
                @include('admins.host._shared.action')
                
                <question link="{{ route('host.price', $data_Room->id) }}" 
                            back="{{ route('host.pricing_mode', $data_Room->id) }}"></question>
                
            </div>
        </div>

        <template id="experience-question">
            <div class="row">
                <div class="col-md-6">
                    <form action="" method="POST" id="pricing-mode-form">
                        {{ csrf_field() }}
                        <div style="margin-bottom: 24px;">
                            <div class="panel-title">
                                <h3>Làm thế nào để bạn muốn thiết lập giá của bạn?</h3>
                            </div>
                            <div class="block-radio-button-row">
                                <label class=" btn-block block-radio_panel" for="pricing-change">
                                    <div class="no-margin-h">
                                        <div class="ib pull-left w-90">
                                            <div class="pull-left icon-position">
                                                <i class="choose-pricing-mode__icon--smart"></i>
                                            </div>
                                            <div class="pull-left text-mode-choose">
                                                <span>Giá điều chỉnh theo yêu cầu</span>
                                                <div class="help-panel__text">
                                                    <span>
                                                        Thiết lập một giá cơ sở và một phạm vi giá. Bạn nói giá thông minh để tự động điều chỉnh giá của bạn dựa trên các thiết lập của bạn.
                                                    </span>
                                                </div>
                                                <div class="mode-chooser__recommended">
                                                    <span>KHUYẾN CÁO</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ib pull-right">
                                            <input id="pricing-change"
                                                    type="radio"
                                                    name="pricing_mode" value="2" class="pointer-input"
                                                    v-model="answer" {{ isset($pricing_mode) && !empty($pricing_mode) && $pricing_mode == 2 ? 'checked' : '' }}>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </label>
                            </div>
                            <div class="block-radio-button-row">
                                <label class="btn-block block-radio_panel" for="pricing-fixed" style="margin-top: 0">
                                    <div class="no-margin-h">
                                        <div class="ib pull-left w-90">
                                            <div class="pull-left icon-position">
                                            <i class="choose-pricing-mode__icon--fixed"></i>
                                            </div>
                                            <div class="pull-right text-mode-choose">
                                                <span>Giá cố định</span>
                                                <div class="help-panel__text">
                                                    <span>
                                                        Thiết lập một giá cơ sở. Airbnb cung cấp cho bạn lời khuyên giá mà bạn có thể chấp nhận hoặc bỏ qua.
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ib pull-right">
                                            <input id="pricing-fixed"
                                                    type="radio"
                                                    name="pricing_mode" value="1" class="pointer-input"
                                                    v-model="answer" {{ isset($pricing_mode) && !empty($pricing_mode) && $pricing_mode == 1 ? 'checked' : '' }}>
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
                                    document.getElementById('pricing-mode-form').submit();"
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

            .icon-position {
                position: absolute;
            }
            .text-mode-choose {
                padding-left: 62px; text-align: left; padding-right: 10px;
            }
            .help-panel__text {
                text-align: justify;
            }
            .w-90 {
                width: 90%;
            }
            .ib input[type=radio] {
                top: 35px;
            }
            .mode-chooser__recommended {
                text-transform: uppercase;
                padding: 4px 8px;
                display: inline-block;
                background-color: #f5f5f5;
                margin-top: 8px;
                font-size: 12px;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                border-radius: 3px;
            }
        </style>
    @endpush