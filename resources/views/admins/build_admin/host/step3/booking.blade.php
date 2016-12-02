@extends('admins.master')
    <?php $step_three = true; ?>

    @section('titleName')
        Your listings
    @stop

    @section('content')
        <div class="content">
            <div class="container-fluid">
                @include('admins.host._shared.action')
                
                <question link="{{ route('host.pricing_mode', $data_Room->id) }}" 
                            back="{{ route('host.occupancy', $data_Room->id) }}"></question>
                
            </div>
        </div>

        <template id="experience-question">
            <div class="row">
                <div class="col-md-6">
                    <form action="" method="POST" id="experience-form">
                        {{ csrf_field() }}
                        <div style="margin-bottom: 24px;">
                            <div class="panel-title">
                                <h3>Your settings?</h3>
                            </div>
                            <ul class="booking-settings">
                                <li class="row">
                                    <div class="col-md-8">
                                        <p class="caption"><span>Lịch</span></p>
                                        <p class="note">Khách có thể đặt bắt đầu {{ $calendar }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('host.calendar', $data_Room->id) }}" class="btn btn-lg">Change</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                                <li class="row">
                                    <div class="col-md-8">
                                        <p class="caption"><span>Chiều dài chuyến đi</span></p>
                                        <div class="note">
                                            <p>
                                                @if(isset($booking) && $booking != '')
                                                    {{ $booking->min_trip_length == 0 ? 'Không thiết lập tối thiểu' : 'Tối thiểu '. $booking->min_trip_length .' đêm' }}
                                                @endif
                                            </p>
                                            <p>
                                                @if(isset($booking) && $booking != '')
                                                    {{ $booking->max_trip_length == 0 ? 'Không thiết lập tối đa' : 'Tối đa '. $booking->max_trip_length .' đêm' }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('host.triplength', $data_Room->id) }}" class="btn btn-lg">Change</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                                <li class="row">
                                    <div class="col-md-8">
                                        <p class="caption"><span>Hiệu lực</span></p>
                                        <div class="note">
                                            <p>
                                                @if(isset($booking) && $booking != '')
                                                    @if( $booking->advance_notice != '')
                                                        {{ $booking->advance_notice == 0 ? 'Cùng ngày đặt phòng' : 'Thông báo trước '. $booking->advance_notice/24 .' ngày' }}
                                                    @endif
                                                @endif
                                            </p>
                                            <p>
                                                @if(isset($booking) && $booking != '')
                                                    @if( $booking->preparation_time != '')
                                                        {{ $booking->advance_notice == 0 ? 'Không có thời gian chuẩn bị' : 'Thời gian chuẩn bị '. $booking->advance_notice/24 .' ngày' }}
                                                    @endif
                                                @endif
                                            </p>
                                            <p>
                                                @if(isset($booking) && $booking != '')
                                                    @if( $booking->booking_window != '' && $booking->booking_window < 365)
                                                        {{ $booking->booking_window == 0 ? 'Khách có thể đặt bất cứ ngày nào' : 'Sau '. $booking->booking_window/30 .' tháng' }}
                                                    @else
                                                        {{ 'Sau '. $booking->booking_window/365 .' năm' }}
                                                    @endif
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('host.availability', $data_Room->id) }}" class="btn btn-lg">Change</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                            </ul>
                        </div>
                    </form>
                    <hr>
                    <div>
                        <a href="@{{ back }}"  class="back-process">
                            <i class="ti-arrow-left"></i>
                            <span>Back</span>
                        </a>
                        <a href="@{{ link }}" 
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