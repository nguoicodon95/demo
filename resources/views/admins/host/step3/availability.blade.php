@extends('admins.master')
    <?php $step_three = true; ?>

    @section('titleName')
        Your listings
    @stop

    @section('content')
        <div class="content">
            <div class="container-fluid">
                @include('admins.host._shared.action')
                
                <availability link="{{ route('host.booking', $data_Room->id) }}"></availability>
                
            </div>
        </div>

        <template id="availability_tp">
            <div class="row">
                <div class="col-md-6">
                    <form action="" method="POST" id="availability-form">
                        {{ csrf_field() }}
                        <input type="hidden" name="_link" value="@{{ link }}">
                        <div style="margin-bottom: 24px;">
                            <div class="panel-title">
                                <h3>Có hiệu lực</h3>
                            </div>
                            <div class="kind">
                                <div class="property">
                                    <label for="house-type" class="h4 text-gray text-normal">
                                        <span>Thông báo trước</span>
                                    </label>
                                    <div class="select select-block select-jumbo">
                                        <select id="house-type" name="advance_notice" v-model="advance_notice">
                                            <option value="0" {{ isset($advance_notice) && !empty($advance_notice) && $advance_notice == 0 ? 'selected' : '' }}>Cùng ngày</option>
                                            <option value="{{1*24}}" {{ isset($advance_notice) && !empty($advance_notice) && $advance_notice == (1*24) ? 'selected' : '' }}>1 ngày</option>
                                            <option value="{{2*24}}" {{ isset($advance_notice) && !empty($advance_notice) && $advance_notice == (2*24) ? 'selected' : '' }}>2 ngày</option>
                                            <option value="{{3*24}}" {{ isset($advance_notice) && !empty($advance_notice) && $advance_notice == (3*24) ? 'selected' : '' }}>3 ngày</option>
                                            <option value="{{7*24}}" {{ isset($advance_notice) && !empty($advance_notice) && $advance_notice == (7*24) ? 'selected' : '' }}>7 ngày</option>
                                        </select>
                                        <p v-if="advance_notice_label">
                                            Ví dụ, 1 thông báo trước ngày có nghĩa là khách không thể đặt và đến cùng một ngày. Bạn sẽ luôn nhận được thông báo trước 24 giờ.
                                        </p>
                                    </div>
                                </div>
                                <div class="property" v-if="!advance_notice_label">
                                    <label for="house-type" class="h4 text-gray text-normal">
                                        <span>Khách đặt trước</span>
                                    </label>
                                    <div class="select select-block select-jumbo">
                                        <select id="house-type" name="booking_lead_time">
                                            @for( $i = 6; $i <= 24; $i++ )
                                            <option value="{{ $i }}" {{ isset($booking_lead_time) && !empty($booking_lead_time) && $booking_lead_time == $i ? 'selected' : '' }}>{{ $i }}:00</option>
                                            @endfor
                                        </select>
                                        <p>
                                            Khách có thể đặt trong cùng một ngày họ đến nơi. Đây là một lựa chọn tốt nếu bạn muốn cung cấp đặt phòng vào phút cuối.
                                        </p>
                                    </div>
                                </div>
                                <div class="property">
                                    <label for="house-type" class="h4 text-gray text-normal">
                                        <span>Thời gian chuẩn bị</span>
                                    </label>
                                    <div class="select select-block select-jumbo">
                                        <select id="house-type" name="preparation_time">
                                            <option value="0" {{ isset($preparation_time) && !empty($preparation_time) && $preparation_time == 0 ? 'selected' : '' }}>Không có thời gian chuẩn bị</option>
                                            <option value="{{1*24}}" {{ isset($preparation_time) && !empty($preparation_time) && $preparation_time == (1*24) ? 'selected' : '' }}>1 ngày</option>
                                            <option value="{{2*24}}" {{ isset($preparation_time) && !empty($preparation_time) && $preparation_time == (2*24) ? 'selected' : '' }}>2 ngày</option>
                                        </select>
                                        <p>
                                            Nếu bạn cần thời gian để chuẩn bị, chặn một ngày hoặc 2 giữa đặt phòng.
                                        </p>
                                    </div>
                                </div>
                                <div class="property">
                                    <label for="house-type" class="h4 text-gray text-normal">
                                        <span>Cửa sổ đặt chỗ</span>
                                    </label>
                                    <div class="select select-block select-jumbo">
                                        <select id="house-type" name="booking_window" v-model="booking_window">
                                            <option value="0" {{ isset($booking_window) && !empty($booking_window) && $booking_window == 0 ? 'selected' : '' }}>Bất cứ lúc nào</option>
                                            <option value="{{3*30}}" {{ isset($booking_window) && !empty($booking_window) && $booking_window == (3*30) ? 'selected' : '' }}>3 tháng</option>
                                            <option value="{{6*30}}" {{ isset($booking_window) && !empty($booking_window) && $booking_window == (6*30) ? 'selected' : '' }}>6 tháng</option>
                                            <option value="{{1*365}}" {{ isset($booking_window) && !empty($booking_window) && $booking_window == (1*365) ? 'selected' : '' }}>1 năm</option>
                                        </select>
                                        <p v-if="booking_window_label">
                                            Khách có thể đặt bất kỳ thời gian trong tương lai.
                                        </p>
                                        <p v-if="!booking_window_label">
                                            Bạn sẽ không nhận đặt phòng ở ngoài xa hơn cửa sổ bạn chọn.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div>
                        <a href="@{{ link }}" 
                            onclick="event.preventDefault();
                                    document.getElementById('availability-form').submit();"
                            class="pull-right btn btn-large btn-progress-next btn-large__next-btn pull-right-md btn-primary" >
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
            </div>
        </template>
    @stop

    @push('css')
        <link rel="stylesheet" href="{{ asset('admins/assets/css/datepicker.css') }}">
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