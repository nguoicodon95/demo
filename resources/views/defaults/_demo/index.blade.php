@extends('defaults.homepage._master')

@push('css-rel')
<link rel="stylesheet" href="{{ asset('assets/css/datepicker.css') }}" type="text/css">
@endpush

@push('css-style')
<style media="screen">
    .room-col {
        height: 369px;
    }
    .local-name {
        position: absolute;
        bottom: 0;
        color: #ffffff;
        z-index: 999;
        right: 20px;
        font-size: 20px;
    }
</style>
@endpush

@push('js-include')
<script type="text/javascript" src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/moment-with-locales.min.js') }}"></script>
@endpush

@push('js-script')
<script>
    $(".input-daterange").datepicker({startDate: new Date()});
    /* Setting background top */
    $('.hero-image').css({
        'background': 'url(/assets/img/background_top.jpg) no-repeat center center',
        'height': '500px',
    });
</script>
@endpush

@section('container')
<div id="page-canvas">
    <div id="page-content">
        <!--Hero Image-->
        <section class="hero-image search-filter-middle height-500">
            <div class="inner">
                <div class="container">
                    <!-- <h1>Tìm nơi bạn muốn đến</h1> -->
                    <div class="search-bar horizontal">
                        <div class="header-form-bottom hide-sm">
                            <div class="SearchForm">
                                <form action="/" method="get">
                                    <div class="searchForm-input-wrapper pull-left">
                                        <div class="searchForm_location">
                                            <div class="input-location">
                                                <label class="input-placeholder-group locationInput_label">
                                                    <span class="input-placeholder-label screen-reader-only">Bạn đến đâu?</span>
                                                    <input class="LocationInput input-normal" name="location" id="location" type="text" placeholder="Bạn đến đâu?" autocomplete="off">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="searchForm_dates input-daterange" data-date-format="dd.mm.yyyy">
                                            <div class="dates_input">
                                                <div class="input-date">
                                                    <label class="DateInput_label" for="startd_date">Thời gian đến</label>
                                                    <input class="DateInput_input flatpickr" id="date-from" name="date-from" type="text" name="start_date" value="" placeholder="Thời gian đến" autocomplete="off" maxlength="10">
                                                    <div class="DateInput_display-text DateInput__display-text--focused">Thời gian đến</div>
                                                </div>
                                                <div class="dateArrow">
                                                    <svg viewBox="0 0 1000 1000">
                                                    <path d="M694.4 242.4l249.1 249.1c11 11 11 21 0 32L694.4 772.7c-5 5-10 7-16 7s-11-2-16-7c-11-11-11-21 0-32l210.1-210.1H67.1c-13 0-23-10-23-23s10-23 23-23h805.4L662.4 274.5c-21-21.1 11-53.1 32-32.1z"></path>
                                                </svg>
                                            </div>
                                            <div class="input-date">
                                                <label class="DateInput_label" for="startDate">Thời gian đi</label>
                                                <input class="DateInput_input flatpickr" id="date-to" name="date-to" type="text" value="" placeholder="Thời gian đi" autocomplete="off" maxlength="10">
                                                <div class="DateInput_display-text DateInput__display-text--focused">Thời gian đi</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="searchForm_guests">
                                        <span class="screen-reader-only">
                                            <span>1 người</span>
                                        </span>
                                        <div class="select select-large">
                                            <select name="guests">
                                                @for($i = 1; $i < 17; $i++)
                                                <option value="{{ $i }}">{{ $i }} Người</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="searchForm_submit">
                                    <button class="btn btn-primary btn-small">Tìm kiếm</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        <!-- /.main-search -->
                    </div>
                    <!-- /.search-bar -->
                </div>
            </div>
            <div class="background background-visible">
                <img src="/assets/img/background_top.jpg" alt="i Stay here">
            </div>
        </section>
        <!--end Hero Image-->

        <!--Why Us-->
        <section id="why-us" class="block background-color-white">
            <div class="container">
                <header><h2>Why Us?</h2></header>
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="feature-box">
                            <i class="fa fa-thumbs-up"></i>
                            <div class="description">
                                <h3>Lorem ipsum dolor </h3>
                                <p>
                                    Praesent tempor a erat in iaculis. Phasellus vitae libero libero. Vestibulum ante
                                    ipsum primis in faucibus orci luctus et ultrices posuere cubilia
                                </p>
                            </div>
                        </div>
                        <!--/.feature-box-->
                    </div>
                    <!--/.col-md-4-->
                    <div class="col-md-4 col-sm-4">
                        <div class="feature-box">
                            <i class="fa fa-folder"></i>
                            <div class="description">
                                <h3>Etiam vehicula felis a ipsum</h3>
                                <p>
                                    Pellentesque nisl quam, aliquet sed velit eu, varius condimentum nunc.
                                    Nunc vulputate turpis ut erat egestas, vitae rutrum sapien varius.
                                </p>
                            </div>
                        </div>
                        <!--/.feature-box-->
                    </div>
                    <!--/.col-md-4-->
                    <div class="col-md-4 col-sm-4">
                        <div class="feature-box">
                            <i class="fa fa-money"></i>
                            <div class="description">
                                <h3>Donec dolor justo, volutpat </h3>
                                <p>
                                    Maecenas quis ipsum lectus. Fusce molestie, metus ut consequat pulvinar,
                                    ipsum quam condimentum leo, sit amet auctor lacus nulla at felis.
                                </p>
                            </div>
                        </div>
                        <!--/.feature-box-->
                    </div>
                    <!--/.col-md-4-->
                </div>
                <!--/.row-->
            </div>
            <!--/.container-->
        </section>
        <!--end Why Us-->

        <!--Last Minute-->
        <section class="block equal-height background-color-white">
            <div class="container">
                <header><h2>Last Minute</h2></header>
                <div class="row">
                    @if($items->count())
                        @foreach($items as $item)
                            <?php
                                $link = '#';
                                $info = false;
                                $class = '';
                                switch ($item['types']) {
                                    case 'location':
                                        $link = route('client.room', $item['id']);
                                        break;
                                    
                                    case 'room':
                                        $link = route('room.detail', $item['id']);
                                        $class = 'room-col';
                                        $info = true;
                                        break;
                                    
                                    default:
                                        $link = route('room.detail', $item['id']);
                                        break;
                                }
                            ?>
                            <div class="{{ !is_null($item['config']) ? $item['config']->width : 'col-md-3'  }} col-sm-4 col-xs-6">
                                <div class="item {{ $class }}">
                                    <div class="image">
                                        <a href="{{ $link }}" target="_blank">
                                            <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" height="{{ $info == true ? '175' : '369' }}">
                                            @if(isset($info) && $info == false )
                                            <h3 class="local-name">{{ $item['name'] }}</h3>
                                            @endif
                                        </a>
                                    </div>
                                    @if(isset($info) && $info == true )
                                    <div class="wrapper">
                                        <a href="">
                                            <h3>{{ $item['name'] }}</h3>
                                        </a>
                                        <figure>{{ $item['place'] }}</figure>
                                        <div class="price">{{ isset($item['price']) ? _formatPrice($item['price']) : '' }}</div>
                                        <div class="info">
                                            <div class="rating stars-hidden" data-rating="4"></div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                    
                </div>
                <!--/.row-->
            </div>
            <!--./container-->
        </section>
        <!--end Last Minute-->

        <!--Partners-->
        <section id="partners" class="block">
            <div class="container">
                <header><h2>Partners</h2></header>
                <div class="logos">
                    <div class="logo"><a href="#"><img src="assets/img/logo-partner-01.png" alt=""></a></div>
                    <div class="logo"><a href="#"><img src="assets/img/logo-partner-02.png" alt=""></a></div>
                    <div class="logo"><a href="#"><img src="assets/img/logo-partner-03.png" alt=""></a></div>
                    <div class="logo"><a href="#"><img src="assets/img/logo-partner-04.png" alt=""></a></div>
                    <div class="logo"><a href="#"><img src="assets/img/logo-partner-05.png" alt=""></a></div>
                </div>
            </div>
            <!--/.container-->
        </section>
        <!--end Partners-->
    </div>
</div>
@stop        