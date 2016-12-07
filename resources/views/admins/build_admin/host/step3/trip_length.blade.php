@extends('admins.build_admin._master')
@section('titleName', 'Your listings')

    @section('content')
        <div class="page-content">
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Cài đặt host</h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD -->
            <!-- BEGIN PAGE BREADCRUMB -->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="javascript:;">Home</a><i class="fa fa-circle"></i>
                </li>
                <li class="active">
                    Host
                </li>
            </ul>

            <triplength link="{{ route('host.booking', $data_Room->id) }}"
                        count_min={{ isset($trip_min) && $trip_min != '' ? $trip_min : 0 }}
                        count_max={{ isset($trip_max) && $trip_max != '' ? $trip_max : 0 }}></triplength>
        </div>

        <template id="trip-length">
            <div class="row">
                <div class="col-md-6">
                    <div class="portlet light form-fit">
                        <div class="portlet-body">
                            <div class="col-md-12">
                                <form action="" method="POST" id="triplength-form">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_link" value="@{{ link }}">
                                    <div style="margin-bottom: 24px;">
                                        <div class="">
                                            <label class="h4">Chiều dài chuyến đi</label>
                                            <p class="alert alert-danger" v-if="!success">@{{ error }}</p>
                                        </div>
                                        <div class="kind">
                                            <div class="increment-btn no-padding">
                                                <label for="">Đêm tối thiểu</label>
                                                <div class="increment-btn btn-group no-border-bottom-radius">
                                                    <div class="text-gray btn increment-jumbo increment-btn__label increment-btn__label--with-increment-btns" tabindex="0" role="textbox">
                                                        <div class="increment-btn__border-container-label text-truncated">
                                                            <span class="text-muted"><span>Tối thiểu @{{ count_min }} đêm</span></span>
                                                            <input type="hidden" value="@{{ count_min }}" name="min_trip_length">
                                                        </div>
                                                    </div>
                                                    <button type="button" @click="updateMinNightDecrement" :disabled="diasableMin" class="btn btn-jumbo increment-btn__decrementer"></button>
                                                    <button type="button" @click="updateMinNightIncrement" :disabled="diasableMaxofMin" class="btn btn-jumbo increment-btn__incrementer"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kind mar-top-15">
                                            <div class="increment-btn no-padding">
                                                <label for="">Đêm tối đa</label>
                                                <div class="increment-btn btn-group no-border-bottom-radius">
                                                    <div class="text-gray btn increment-jumbo increment-btn__label increment-btn__label--with-increment-btns" tabindex="0" role="textbox">
                                                        <div class="increment-btn__border-container-label text-truncated">
                                                            <span class="text-muted"><span>Tối đa @{{ count_max }} đêm</span></span>
                                                            <input type="hidden" value="@{{ count_max }}" name="max_trip_length">
                                                        </div>
                                                    </div>
                                                    <button type="button" @click="updateMaxNightDecrement" :disabled="diasableMinofMax" class="btn btn-jumbo increment-btn__decrementer"></button>
                                                    <button type="button" @click="updateMaxNightIncrement" :disabled="diasableMax" class="btn btn-jumbo increment-btn__incrementer"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <a href="@{{ link }}" v-if="success"
                            onclick="event.preventDefault();
                                    document.getElementById('triplength-form').submit();"
                            class="pull-right btn btn-large btn-progress-next btn-large__next-btn pull-right-md btn-primary" >
                            <div class="btn-progress-next__text">
                                <span>Done</span>
                            </div>
                        </a>
                    </div>
                </div>
               
                <div class="col-md-5">
                    
                </div>
            </div>
        </template>
    @stop

    @push('css-style')
        <link rel="stylesheet" href="{{ asset('admins/assets/css/datepicker.css') }}">
        <style>
            label {
                color: #484848;
            }
            .ui-corner-all {
                display: none;
            }
            .ui-selecting { background: #CCC !important; }
            .btn-group>.btn:first-child:not(:last-child):not(.dropdown-toggle) {
                border: 1px solid #e5e5e5;
            }
            /*.ui-selected { background: #000 !important; color: white; }*/
        </style>
    @endpush

    @push('js')
        <script src="{{ asset('admins/assets/js/jquery-ui-1.11.1.js') }}"></script>
        <script src="{{ asset('admins/assets/js/jquery-ui.multidatespicker.js') }}"></script>
        <script>
            $(function() {
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1;
                var y = today.getFullYear();
                $('#calendar').multiDatesPicker({
                    numberOfMonths: [1,3],
                    defaultDate: y+'-'+mm+'-'+dd,
                    minDate: 0,
                    maxDate: 90,
                    altField: '#dateJson',
                    dateFormat: 'yy-mm-dd',
                });
            });
        </script>
        <script>
            $( "#calendar" ).selectable({
                filter: "td",
            });
        </script>
    @endpush