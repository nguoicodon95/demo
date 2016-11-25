@extends('admins.master')

    <?php $step_two = true; ?>
    @section('titleName')
        Your listings
    @stop

    @section('content')
        <div class="content">
            <div class="container-fluid">
                @include('admins.host._shared.action')
                <titles link="{{ route('host.photos', $data_Room->id) }}" 
                            back="{{ route('host.description', $data_Room->id) }}"></titles>
            </div>
        </div>

        <template id="titles_tp">
            <div class="row">
                <div class="col-md-6">
                    <validator name="validatelocationform">
                        <form action="" method="POST" id="titles-form">
                            {{ csrf_field() }}

                            <div style="margin-bottom: 24px;">
                                <div class="panel-title">
                                    <h3>Name your place</h3>
                                </div>
                                <div class="row">
                                    <div class="location col-sm-12">
                                        <input autofocus="true"
                                                class="input input-block input-jumbo lys-summary-form__texterea"
                                                id="title" name="title" autocomplete="off" 
                                                v-validate:street="[ 'required' ]" 
                                                :classes="{invalid: 'lys-invalid', valid: ''}"
                                                value="{{ isset($data_Room) ? $data_Room->title : '' }}">
                                        <strong>
                                            <span class="lys-input__remaining-char-count text-muted text-small">50</span>
                                        </strong>
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
                            <a v-if="$validatelocationform.valid" 
                                href="@{{ link }}" 
                                class="pull-right btn btn-large btn-progress-next btn-large__next-btn pull-right-md btn-primary"
                                onclick="event.preventDefault();
                                        document.getElementById('titles-form').submit();">
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
        <style>
            .lys-summary-form__texterea {
                -webkit-border-radius: 3px; */
                -moz-border-radius: 3px;
                border-radius: 3px;
                border: solid 1px #dce0e0;
                padding: 20px;
                resize: none;
                outline: 0 solid transparent;

                overflow: hidden;
                font-size: 18px;
                height: auto;
            }

            .lys-input__remaining-char-count {
                position: absolute;
                top: 8px;
                right: 23px;
                line-height: 1;
                font-size: 12px;
            }
        </style>
    @endpush

    @push('js')
        <script>
            $(document).ready(function() {
                countChar();
                $('#title').keyup(countChar);
            });
            function countChar() {
                var text_max = 50;
                $('.lys-input__remaining-char-count').html(text_max);
                var text_length = $('#title').val().length;
                var text_remaining = text_max - text_length;
                $('.lys-input__remaining-char-count').html(text_remaining);
            }
        </script>
    @endpush