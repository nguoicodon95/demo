@extends('defaults._master')

@push('css-rel')
<link rel="stylesheet" href="{{ asset('assets/css/datepicker.css') }}" type="text/css">
@endpush

@push('css-style')
        <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/style.css') }}">
<style media="screen">
    .field .icon-private {
        padding: 0 0 0 5px;
    }
    .field .icon-healting {
        padding-left: 9px;
        padding-right: 4px;
    }
</style>
@endpush

@push('js-include')
<script type="text/javascript" src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('dist/js/single-room.js') }}"></script>
<script src="{{ asset('dist/js/jquery.grids.js') }}"></script>
<script src="{{ asset('dist/js/jquery.mapit.js') }}"></script>
<script src="{{ asset('dist/js/carosel.js') }}"></script>
@endpush

@push('js-script')
<script>
    var photo;
    $.ajax({
        url: '{{ route("client.photo", $room->id) }}',
        type: 'GET',
    })
    .done(function(result) {
        if(result.length > 1){
            $('#gallery').imagesGrid({
                images: result
            });
        }
    })
    .fail(function() {
        console.log("Whoop! Get photo fails.");
    });
</script>
<script>
    $(".input-daterange").datepicker({startDate: new Date()});
</script>
@endpush

@section('container')
<section id="main-container">
    <div class="subnav section-titles hide-md">
        <div class="container">
            <ul class="subnav-list">
                <li>
                    <a href="#photos" class="subnav-item active">
                        Photos
                    </a>
                </li>
                <li>
                    <a href="#summary" class="subnav-item">
                        About this listing
                    </a>
                </li>
                <li>
                    <a href="#reviews" class="subnav-item">
                        Reviews
                    </a>
                </li>
                <li>
                    <a href="#host" class="subnav-item">
                        The Host
                    </a>
                </li>
                <li>
                    <a href="#location" class="subnav-item">
                        Location
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div id="photos">
        <div class="image-cover-proshow">
            <div class="proshow">
                <div class="img-box" id="cover-show" url-background="{{ asset($photo_cover) }}">
                </div>
            </div>
        </div>
    </div>
    <div id="nav-anchor"></div>
    <div id="summary" class="info-body">
        <div class="info-best">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="head-panel">
                            <div class="col-md-3">
                                <div class="member">
                                    <div class="avatar">
                                        <?php $img = 'https://flipagram.com/assets/resources/img/fg-avatar-anonymous-user-retina.png'; ?>
                                        <img src=" {{ !is_null($room->member->avatar) ? $room->member->avatar : $img }}" class="img-circle">
                                    </div>
                                    <div class="name address">
                                        <span>{{ $room->member->first_name . ' ' . $room->member->last_name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="room-panel-header">
                                    <h1>{{ $room->title }}</h1>
                                    <div class="address room-partials">
                                        <span>{{ ($room->place_room->locality != '' ? $room->place_room->locality : $room->place_room->state) .', '. $room->place_room->city .', '.$room->place_room->country }}</span>
                                        <div class="rating" data-rating="4">
                                            <span class="fa fa-caret-down"></span>
                                            <span>10 reviews</span>
                                        </div>
                                    </div>
                                    <div class="features">
                                        <div class="col-md-3">
                                            <div class="row">
                                                <span class="icon-size-em {{ $room->kind->icon }}"></span>
                                                <p>{{ $room->kind->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row">
                                                <span class="icon-size-em icon-guest"></span>
                                                <p>{{ $room->count_guest }} Người</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row">
                                                <span class="icon-size-em icon-bedroom"></span>
                                                <p>{{ $room->bedroom_count }} Phòng ngủ</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row">
                                                <span class="icon-size-em icon-bed"></span>
                                                <p>{{ $room->count_bed }} Giường ngủ</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 hidden-xs">
                        <div class="booking-container" id="booking">
                            <div class="booking-form">
                                <div class="booking-header">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="price-amount">
                                                <span class="price-hd">{{ number_format($room->room_setting->base_price) }} <sup>đ</sup></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="pull-right">
                                                <div class="payment-period">
                                                    <span>Mỗi đêm</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div>
                                    <div class="booking-panel">
                                        <form action="" method="POST">
                                            <div class="booking-ip">
                                                <div class="row row-customs">
                                                    <div class="col-md-9 col-customs input-daterange">
                                                        <div class="row row-customs">
                                                            <div class="col-sm-6 col-customs">
                                                                <label for="checkin_date">Check In</label>
                                                                <input type="text" id="checkin_date" placeholder="mm/dd/yyyy" class="flatpickr" data-mindate=today autocomplete="off">
                                                            </div>
                                                            <div class="col-sm-6 col-customs">
                                                                <label for="checkout_date">Check Out</label>
                                                                <input type="text" id="checkout_date" placeholder="mm/dd/yyyy" class="flatpickr" data-mindate="today" autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-customs">
                                                        <div class="select select-block">
                                                            <label for="guest-select">
                                                                Khách
                                                            </label>
                                                            <select name="guests" class="guest-select" id="guest-select" data-prefill="1">
                                                                <option value="1">1 </option>
                                                                <option value="2">2 </option>
                                                                <option value="3">3 </option>
                                                                <option value="4">4 </option>
                                                                <option value="5">5 </option>
                                                                <option value="6">6 </option>
                                                                <option value="7">7 </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="col-md-12 no-space ">
                                                <button class="btn btn-default btn-customs btn-customs-primary">Đặt chỗ này</button>
                                            </div>
                                            <div class="clearfix"></div>
                                            <p class="leaf"></p>
                                        </form>
                                    </div>
                                    
                                    <div class="panel-favorite">
                                        <div class="col-md-12 sp_lab">
                                            <a href="" class="btn btn-customs btn-default">
                                                <i class="fa fa-heart-o"></i>
                                                <span>Lưu vào dang sách yêu thích</span>
                                            </a>
                                            <p class="leaf">12961 du khách đã lưu nơi này</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="social">
                                        <div class="col-md-4 btn btn-default btn-customs-social facebook">
                                            Facebook
                                        </div>
                                        <div class="col-md-4 btn btn-default btn-customs-social twitter">
                                            Twitter
                                        </div>
                                        <div class="col-md-4 btn btn-default btn-customs-social google">
                                            Google +
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
        <div class="info-features">
            <div class="container">
                <div class="col-md-8">
                    <div class="col-details">
                        <div class="space-top-fix">
                            <div class="about-listing">
                                <h4>Về căn phòng</h4>
                                <p>
                                    {{ $room->description }}
                                </p>
                                <div class="contact-link">
                                    <a href=""><strong>Liên hệ chúng tôi</strong></a>
                                </div>
                            </div>
                            <hr>
                            <div class="box-features row">
                                <div class="col-md-3 title-name">
                                    <span>Không gian</span>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="line">
                                                <span>Số lượng tối đa:</span>
                                                <span> </span>
                                                <strong>{{ $room->count_guest }}</strong>
                                            </div>
                                            <div class="line">
                                                <span>Phòng tắm:</span>
                                                <span> </span>
                                                <strong>{{ $room->bathroom_count }}</strong>
                                            </div>
                                            <div class="line">
                                                <span>Phòng ngủ:</span>
                                                <span> </span>
                                                <strong>{{ $room->bedroom_count }}</strong>
                                            </div>
                                            <div class="line">
                                                <span>Giường ngủ:</span>
                                                <span> </span>
                                                <strong>{{ $room->count_bed }}</strong>
                                            </div>
                                            <div class="line contact-link">
                                                <a id="view-rules"><strong>Xem quy định</strong></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="line">
                                                <span>Check In:</span>
                                                <span> </span>
                                                <strong>{{ isset($check_in) ? $check_in : 'Bất cứ lúc nào sau 15:00' }}</strong>
                                            </div>
                                            @if(!is_null($check_out) && isset($check_out) && !empty($check_out))
                                            <div class="line">
                                                <span>Check Out:</span>
                                                <span> </span>
                                                <strong>{{ $check_out }}:00</strong>
                                            </div>
                                            @endif
                                            <div class="line">
                                                <span>Loại tài sản:</span>
                                                <span> </span>
                                                <strong>{{ $room->property->name }}</strong>
                                            </div>
                                            <div class="line">
                                                <span>Loại phòng:</span>
                                                <span> </span>
                                                <strong>{{ $room->kind->name }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <hr>
                            
                            <div class="box-features row">
                                <div class="col-md-3 title-name">
                                    <span>Tiện nghi</span>
                                </div>
                                <div class="col-md-9">
                                    <div class="expandable row">
                                        @foreach($room->amenities->where('types', 'normal')->take(4) as $amenitie)
                                        <div class="col-md-6">
                                            <div class="field">
                                                <span>
                                                    <i class="icon {{ $amenitie->icon }}"></i>
                                                    <span>&nbsp;&nbsp;</span>
                                                </span>
                                                <span class="title-icon">{{ $amenitie->name }}</span>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="col-md-6">
                                            <div class="line"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="line contact-link">
                                                <a style="cursor: pointer"><strong>+ Xem nhiều</strong></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="expandable-more row">
                                        @foreach( $amenities as $amenitie )
                                            @if($room->amenities->contains($amenitie->id))
                                                <div class="col-md-6">
                                                    <div class="field">
                                                        <span>
                                                            <i class="icon {{ $amenitie->icon }}"></i>
                                                            <span>&nbsp;&nbsp;</span>
                                                        </span>
                                                        <span class="title-icon">{{ $amenitie->name }}</span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-6">
                                                    <div class="field">
                                                        <span class="under-link">{{ $amenitie->name }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <hr>

                            <div class="box-features row">
                                <div class="col-md-3 title-name">
                                    <span>Giá</span>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <!-- <div class="col-md-6">
                                            <div class="line">
                                                <span>Thêm người:</span>
                                                <span> </span>
                                                <strong>Miễn phí</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="line">
                                                <span>Phí vệ sinh:</span>
                                                <span> </span>
                                                <strong>100.000 <sup>đ</sup></strong>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="line">
                                                <span>Tiền đặt cọc:</span>
                                                <span> </span>
                                                <strong>1750.000 <sup>đ</sup></strong>
                                            </div>
                                        </div> -->
                                        @if(isset($weekly_discount) && !empty($weekly_discount))
                                        <div class="col-md-6">
                                            <div class="line">
                                                <span>Giảm giá hàng tuần:</span>
                                                <span> </span>
                                                <strong>{{ $weekly_discount }}%</strong>
                                            </div>
                                        </div>
                                        @endif
                                        @if(isset($monthly_discount) && !empty($monthly_discount))
                                        <div class="col-md-6">
                                            <div class="line">
                                                <span>Giảm giá hàng tháng:</span>
                                                <span> </span>
                                                <strong>{{ $monthly_discount }}%</strong>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <hr>

                            <div class="box-features row">
                                <div class="col-md-3 title-name">
                                    <span>Mô tả</span>
                                </div>
                                <div class="col-md-9">
                                    <div class="description-co">
                                        <div class="body">
                                            {{ $room->description }}
                                        </div>
                                    </div>
                                    <div class="line contact-link" id="s-desc">
                                        <a style="cursor: pointer"><strong>+ Xem nhiều</strong></a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <hr>

                            <div class="box-features row" id="rules">
                                <div class="col-md-3 title-name">
                                    <span>Quy định</span>
                                </div>
                                <div class="col-md-9">
                                    <div class="rules-co">
                                        <div class="body">
                                        @if($rules->count() > 0)
                                            @foreach($rules as $_rules)
                                            <div class="line">
                                                {{ $_rules->name }}
                                            </div>
                                            @endforeach
                                            <div class="line">
                                                @if(isset($check_in) && !empty($check_in))
                                                <span>Kiểm tra trong thời gian là</span>
                                                <span>{{ $check_in }}</span>
                                                @endif
                                            </div>
                                            @if(count($rules_settings) > 0)
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <hr>
                                                    </div>
                                                </div>
                                                @foreach($rules_settings as $_rules_setting)
                                                <div class="line">
                                                    {{ $_rules_setting }}
                                                </div>
                                                @endforeach
                                            @endif
                                        @endif
                                        </div>
                                    </div>
                                    <div class="line contact-link" id="s-rules">
                                        <a style="cursor: pointer"><strong>+ Xem nhiều</strong></a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <hr>
                            <div class="box-features row">
                                <div class="col-md-3 title-name">
                                    <span>Các tính năng an toàn</span>
                                </div>
                                <div class="col-md-9">
                                    <div class="safety-features">
                                        <div class="body row">
                                        @foreach($room->amenities->where('types', 'safety')->take(4) as $safety)
                                            <div class="line col-md-6">
                                                {{ $safety->name }}
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <hr>
                            <div class="box-features row">
                                <div class="col-md-3 title-name">
                                    <span>Khả dụng</span>
                                </div>
                                <div class="col-md-9">
                                    <div class="safety-features">
                                        <div class="body row">
                                            <div class="line col-md-6">
                                                <span>Lưu trú tối thiểu {{ $availability <= 1 ? 1 : $availability }} đêm</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <hr>
                            <div class="box-gallery">
                                <div id="gallery"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="review" id="reviews">
        <div class="container">
            <div class="col-md-8">
                <!-- <div class="panel-body">
                    <div class="no-reviews">
                        <h3>No Reviews Yet</h3>
                        <p class="leaf">
                            Stay here and you could give this host their first review!
                        </p>
                    </div>
                </div> -->
                <div class="comments-container">
                    <div class="space-top-fix">
                        <div class="raiting">
                            <h4>24 reviews</h4>
                            <div class="rating" data-rating="4"></div>
                        </div>
                        <hr>
                        <div class="reviews-box">
                            <ul id="comments-list" class="comments-list">
                                <li>
                                    <div class="comment-main-level">
                                        <div class="col-md-2 member">
                                            <div class="comment-avatar">
                                                <img src="http://i9.photobucket.com/albums/a88/creaticode/avatar_1_zps8e1c80cd.jpg" alt="">
                                            </div>
                                            <div>
                                                <span>Kin</span>
                                            </div>
                                        </div>
                                        <!-- Contenedor del Comentario -->
                                        <div class="col-md-10">
                                            <div class="comment-box" user="kin" id="kin">
                                                <div class="comment-content">
                                                    <div>
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                    </div>
                                                </div>
                                                <div class="comment-head">
                                                    <div class="line contact-link" id="kin-more">
                                                        <a style="cursor: pointer"><strong>+ Xem nhiều</strong></a>
                                                    </div>
                                                    <div class="footer-cm">
                                                        <span>Hace 20 minutos</span>
                                                    </div>
                                                    <div class="footer-cm helpful">
                                                        <button class="btn btn-default btn-small helpful-btn">
                                                            <i class="fa fa-thumbs-o-up"></i>
                                                            <div class="helpful-text">Helpful</div>
                                                            <div class="helpful-count helpful-count-regular">
                                                                <div>1</div>
                                                            </div>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Respuestas de los comentarios -->
                                    <ul class="comments-list reply-list">
                                        <li>
                                            <div class="comment-sub-level">
                                                <div class="col-md-2 member">
                                                    <div class="comment-avatar">
                                                        <img src="http://i9.photobucket.com/albums/a88/creaticode/avatar_2_zps7de12f8b.jpg" alt="">
                                                    </div>
                                                    <div>
                                                        <span>Carlos</span>
                                                    </div>
                                                </div>
                                                <!-- Contenedor del Comentario -->
                                                <div class="col-md-10">
                                                    <div class="comment-box" user="carlos" id="carlos">
                                                        <div class="comment-content">
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
                                                        </div>
                                                        <div class="comment-head">
                                                            <div class="footer-cm">
                                                                <span>Hace 20 minutos</span>
                                                            </div>
                                                            <div class="footer-cm helpful">
                                                                <button class="btn btn-default btn-small helpful-btn">
                                                                    <i class="fa fa-thumbs-o-up"></i>
                                                                    <div class="helpful-text">Helpful</div>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="comment-main-level">
                                        <div class="col-md-2 member">
                                            <div class="comment-avatar">
                                                <img src="http://i9.photobucket.com/albums/a88/creaticode/avatar_2_zps7de12f8b.jpg" alt="">
                                            </div>
                                            <div>
                                                <span>Culer</span>
                                            </div>
                                        </div>
                                        <!-- Contenedor del Comentario -->
                                        <div class="col-md-10">
                                            <div class="comment-box" user="culer" id="culer">
                                                <div class="comment-content">
                                                    <div>
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                    </div>
                                                </div>
                                                <div class="comment-head">
                                                    <div class="line contact-link" id="culer-more">
                                                        <a style="cursor: pointer"><strong>+ Xem nhiều</strong></a>
                                                    </div>
                                                    <div class="footer-cm">
                                                        <span>Hace 20 minutos</span>
                                                    </div>
                                                    <div class="footer-cm helpful">
                                                        <button class="btn btn-default btn-small helpful-btn">
                                                            <i class="fa fa-thumbs-o-up"></i>
                                                            <div class="helpful-text">Helpful</div>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="comment-main-level">
                                        <div class="col-md-2 member">
                                            <div class="comment-avatar">
                                                <img src="http://i9.photobucket.com/albums/a88/creaticode/avatar_1_zps8e1c80cd.jpg" alt="">
                                            </div>
                                            <div>
                                                <span>Heath</span>
                                            </div>
                                        </div>
                                        <!-- Contenedor del Comentario -->
                                        <div class="col-md-10">
                                            <div class="comment-box" user="heath" id="heath">
                                                <div class="comment-content">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
                                                </div>
                                                <div class="comment-head">
                                                    <div class="line contact-link" id="heath-more">
                                                        <a style="cursor: pointer"><strong>+ Xem nhiều</strong></a>
                                                    </div>
                                                    <div class="footer-cm">
                                                        <span>Hace 20 minutos</span>
                                                    </div>
                                                    <div class="footer-cm helpful">
                                                        <button class="btn btn-default btn-small helpful-btn">
                                                            <i class="fa fa-thumbs-o-up"></i>
                                                            <div class="helpful-text">Helpful</div>
                                                            <div class="helpful-count helpful-count-regular">
                                                                <div>1</div>
                                                            </div>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="comment-main-level">
                                        <div class="col-md-2 member">
                                            <div class="comment-avatar">
                                                <img src="http://i9.photobucket.com/albums/a88/creaticode/avatar_2_zps7de12f8b.jpg" alt="">
                                            </div>
                                            <div>
                                                <span>Kay</span>
                                            </div>
                                        </div>
                                        <!-- Contenedor del Comentario -->
                                        <div class="col-md-10">
                                            <div class="comment-box" user="kay" id="kay">
                                                <div class="comment-content">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
                                                </div>
                                                <div class="comment-head">
                                                    <div class="line contact-link" id="kay-more">
                                                        <a style="cursor: pointer"><strong>+ Xem nhiều</strong></a>
                                                    </div>
                                                    <div class="footer-cm">
                                                        <span>Hace 20 minutos</span>
                                                    </div>
                                                    <div class="footer-cm helpful">
                                                        <button class="btn btn-default btn-small helpful-btn">
                                                            <i class="fa fa-thumbs-o-up"></i>
                                                            <div class="helpful-text">Helpful</div>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-lg-9 col-md-offset-3 no-space">
                                <div class="pagination pagination-responsive">
                                    <ul class="list-unstyled">
                                        <li class="active">
                                            <a href="#" data-prevent-default="true">1</a>
                                        </li>
                                        <li class="">
                                            <a href="#" data-prevent-default="true">2</a>
                                        </li>
                                        <li class="">
                                            <a href="#" data-prevent-default="true">3</a>
                                        </li>
                                        <li class="next next_page">
                                            <a href="#" data-prevent-default="true">
                                                <span class="screen-reader-only">
                                                    <span>Next</span>
                                                </span><i class="fa fa-caret-right">
                                                </i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="host" class="u-host">
        <div class="info-features">
            <div class="container">
                <div class="col-md-8">
                    <div class="box-features">
                        <div class="space-top-fix">
                            <h4>Chủ Host</h4>
                            <hr>
                            <div class="col-md-3 title-name">
                                <div class="member">
                                    <div class="avatar">
                                        <img src="http://tophinhanhdep.net/wp-content/uploads/2016/01/avatar-naruto.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="boss">
                                    <h3>Kim cookies</h3>
                                    <label>Da Nang, Vietnam · Member since July 2016</label>
                                </div>
                                <div class="host-co">
                                    <div class="body">
                                        <p>The large sunroom ò the communal area há tưo pools, one for children and one for adult, with a large palm trê on a central island. Both pools are open from mid-June to mid-September.</p>
                                        <p>The large sunroom ò the communal area há tưo pools, one for children and one for adult, with a large palm trê on a central island. Both pools are open from mid-June to mid-September.</p>
                                        <p>The large sunroom ò the communal area há tưo pools, one for children and one for adult, with a large palm trê on a central island. Both pools are open from mid-June to mid-September.</p>
                                        <p>The large sunroom ò the communal area há tưo pools, one for children and one for adult, with a large palm trê on a central island. Both pools are open from mid-June to mid-September.</p>
                                        <p>The large sunroom ò the communal area há tưo pools, one for children and one for adult, with a large palm trê on a central island. Both pools are open from mid-June to mid-September.</p>
                                        <p>The large sunroom ò the communal area há tưo pools, one for children and one for adult, with a large palm trê on a central island. Both pools are open from mid-June to mid-September.</p>
                                        <p>The large sunroom ò the communal area há tưo pools, one for children and one for adult, with a large palm trê on a central island. Both pools are open from mid-June to mid-September.</p>
                                    </div>
                                    <div class="bottom-fill"></div>
                                </div>
                                <div class="line contact-link" id="s-host">
                                    <a style="cursor: pointer"><strong>+ Xem nhiều</strong></a>
                                </div>
                                <div class="line-15">
                                    <button type="button" class="btn btn-customs-primary btn-small">
                                        <span>Contact Host</span>
                                    </button>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="location">
        <div class="container">
            <div class="col-md-7">
                <div class="row">
                    <div id="map_canvas"></div>
                </div>
            </div>
            <script>
                var around_locations;
                $.ajax({
                    url: '{{ route("client.arounds", $room->id) }}',
                    type: 'GET',
                    async: false,
                })
                .done(function(result) {
                    around_locations = result;
                })
                .fail(function() {
                    console.log("Whoop! Không có vị trí nào xung quanh khu vực của bạn.");
                });
                var locations = {
                    latitude:    {{ $room->place_room->latitude }},
                    longitude:   {{ $room->place_room->longitude }},
                    marker: {
                        latitude:   {{ $room->place_room->latitude }},
                        longitude:  {{ $room->place_room->longitude }},
                        icon:           '/templates/icon/trans.gif',
                        title:          '{{ $room->title }}',
                        open:           false,
                        center:         true
                    },
                    address: '<h2>{{ $room->title }}</h2>\
                                <p>{{ ($room->place_room->locality != '' ? $room->place_room->locality : $room->place_room->state) .', '. $room->place_room->city .', '.$room->place_room->country }}</p>',
                    locations: around_locations,
                    origins: around_locations
                }

            </script>
            <div class="col-md-5">
                <nav>
                    <ul class="vertical">
                        <li><strong>Điểm đến thuận lợi từ vị trí của chúng tôi</strong></li>
                        @if(count($locations_around) > 0 )
                            @foreach($locations_around as $k => $v)
                        <li><a onclick="javascript:$('#map_canvas').trigger('route', {{ $k }})">{{ $v->location_name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </nav>
            </div>
            <div class="clearfix"></div>
            
            <h4>Các địa điểm tương tự</h4>
            <section class="center slider">
                
            </section>
        </div>
    </div>
</section>
@stop        