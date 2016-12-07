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
            <question link="{{ route('host.booking', $data_Room->id) }}" 
                    back="{{ route('host.occupancy', $data_Room->id) }}"></question>
        </div>

        <template id="experience-question">
            <div class="row">
                <div class="portlet light form-fit">
                    <div class="portlet-body">
                        <div class="col-md-6">
                            <form action="" method="POST" id="calendar-form">
                                {{ csrf_field() }}
                                <div id="calendar" class="box" style="margin-top: 60px;"></div>
                                <input type="hidden" id="dateJson" name="calendar">
                            </form>
                            <hr>
                            <div>
                                <a href="@{{ link }}" 
                                    class="pull-right btn btn-large btn-progress-next btn-large__next-btn pull-right-md btn-primary"
                                    onclick="event.preventDefault();
                                                document.getElementById('calendar-form').submit();">
                                    <div class="btn-progress-next__text">
                                        <span>Done</span>
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
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </template>
    @stop

    @push('css-include')
        <link rel="stylesheet" href="{{ asset('admins/assets/css/datepicker.css') }}">
    @endpush

    @push('css-style')
        <style>
            label {
                color: #484848;
            }
            .ui-corner-all {
                display: none;
            }
            .ui-selecting { background: #CCC !important; }
            /*.ui-selected { background: #000 !important; color: white; }*/
        </style>
    @endpush

    @push('js-include')
        <script src="{{ asset('admins/assets/js/jquery-ui-1.11.1.js') }}"></script>
        <script src="{{ asset('admins/assets/js/jquery-ui.multidatespicker.js') }}"></script>
    @endpush
    @push('js-script')
        <script>
            $(function() {
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1;
                var y = today.getFullYear();
                var dates = $.parseJSON('{!! $dates !!}');
                
                if(dates == '' ){
                    dates = [today.setDate(dd), today.setDate(dd+1), today.setDate(dd+2)]
                }
                $('#calendar').multiDatesPicker({
                    numberOfMonths: [1,3],
                    defaultDate: y+'-'+mm+'-'+dd,
                    minDate: 0,
                    maxDate: 90,
                    altField: '#dateJson',
                    dateFormat: 'yy-mm-dd',
                    addDates: dates
                });
            });
        </script>
        <script>
            $( "#calendar" ).selectable({
                filter: "td",
            });
        </script>
    @endpush