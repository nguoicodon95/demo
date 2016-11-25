@extends('defaults._master')

@push('css-rel')
<link rel="stylesheet" href="/assets/css/jquery.mCustomScrollbar.css" type="text/css">
@endpush
@push('css-style')
<style>
    .filter-row label {
        padding-left: 10px;
    }
</style>
@endpush

<?php $class_body = 'map-fullscreen navigation-off-canvas '; ?>

@section('container')        
<div id="page-canvas">
    <!--Off Canvas Navigation-->
    <nav class="off-canvas-navigation">
        <header>Navigation</header>
        <div class="main-navigation navigation-off-canvas"></div>
    </nav>
    <!--end Off Canvas Navigation-->
    <!--Page Content-->
    <div id="page-content">
        <!-- Map Canvas-->
        <div class="map-canvas list-solid">
            <!-- Map -->
            <div class="map">
                <div class="toggle-navigation">
                    <div class="icon">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                </div>
                <!--/.toggle-navigation-->
                <div id="map" class="has-parallax"></div>
            </div>
            <!-- end Map -->
            <!--Items List-->
            <div class="items-list">
                <div class="inner">
                    <div class="filter">
                        <form class="main-search" role="form" method="get" action="?">
                            {{-- csrf_field() --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Tiện ích</label>
                                        <select name="type[]" multiple title="All" data-live-search="true" id="type">
                                        <?php
                                            $optgroup = '';
                                            foreach ( $amenities as $d ) {
                                                $label = '';
                                                switch($d->types) {
                                                    case('normal'):
                                                        $label = 'Thông thường';
                                                    break;
                                                    case('safety'):
                                                        $label = 'An toàn';
                                                    break;
                                                    case('special'):
                                                        $label = 'Đặc biệt';
                                                    break;
                                                    case('space_place'):
                                                        $label = 'Không gian';
                                                    break;
                                                    break;
                                                    case('location'):
                                                        $label = 'Vị trí';
                                                    break;
                                                }

                                                if ( $d->types != $optgroup ) {
                                                    if ( $optgroup ) {
                                                        echo "</optgroup>";
                                                    }
                                                    echo "<optgroup label='{$label}'>";
                                                    $optgroup = $d->types;
                                                }
                                                echo "<option value='{$d->id}' >{$d->name}</option>";
                                            }
                                            echo "</optgroup>";
                                        ?>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!--/.col-md-6-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bedrooms">Phòng ngủ</label>
                                        <div class="input-group counter">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default updown" counter="down" type="button"><i class="fa fa-minus"></i></button>
                                            </span>
                                            <input type="number" class="form-control" id="bedrooms" name="bedrooms" placeholder="Any" min=0 max=16 value=0>
                                            <span class="input-group-btn">
                                                <button class="btn btn-default updown" counter="up" type="button"><i class="fa fa-plus"></i></button>
                                            </span>
                                        </div><!-- /input-group -->
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!--/.col-md-3-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bathrooms">Phòng tắm</label>
                                        <div class="input-group counter">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default updown" counter="down" type="button"><i class="fa fa-minus"></i></button>
                                            </span>
                                            <input type="number" class="form-control" id="bathrooms" name="bathrooms" placeholder="Any" min=0 max=16 value=0>
                                            <span class="input-group-btn">
                                                <button class="btn btn-default updown" counter="up" type="button"><i class="fa fa-plus"></i></button>
                                            </span>
                                        </div><!-- /input-group -->
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="clearfix"></div>
                                <div class="filter-row">
                                    <div class="form-group">
                                        <label class="col-md-12">
                                            <strong>Loại phòng</strong>
                                        </label>
                                        <div class="row-condensed">
                                            @foreach($kind as $k)
                                            <div class="col-middle-alt col-sm-4">
                                                <label class="checkbox facet-checkbox checkbox-rooms-type">
                                                    <div class="checkbox_label">
                                                        <span>{{ $k->name }}</span>
                                                    </div>
                                                    <div class="checkbox_input">
                                                        <input type="checkbox" name="kind[]" value="{{ $k->id }}">
                                                    </div>
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!--/.col-md-3-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Giá</label>
                                        <div class="ui-slider" id="price-slider" data-value-min="50000" data-value-max="25000000" data-value-type="price" data-currency=" đ" data-currency-placement="after">
                                            <div class="values clearfix">
                                                <input class="value-min" name="price-min" readonly>
                                                <input class="value-max" name="price-max" readonly>
                                            </div>
                                            <div class="element"></div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!--/.col-md-6-->

                                <div class="clearfix"></div>
                                <div class="filter-row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button class="btn btn-default pull-right margin-top-25">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/.row-->
                        </form>
                        <!-- /.main-search -->
                    </div>
                    <!--end Filter-->
                    <header class="clearfix">
                        <h3 class="pull-left">Results</h3>
                        <!-- div class="buttons pull-right">
                            <span>Display:</span>
                            <span class="icon active" id="display-grid"><i class="fa fa-th"></i></span>
                            <span class="icon" id="display-list"><i class="fa fa-th-list"></i></span>
                        </div-->
                    </header>
                    <ul class="results grid">

                    </ul>
                </div>
                <!--results-->
            </div>
            <!--end Items List-->
        </div>
        <!-- end Map Canvas-->
        <!--Featured-->
        <section id="featured" class="block background-color-white">
            <div class="container">
                <header>
                    <h2>Nổi bật - Featured</h2>
                </header>
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="item featured equal-height">
                            <div class="image">
                                <div class="quick-view"><i class="fa fa-eye"></i><span>Quick View</span></div>
                                <a href="">
                                    <div class="icon">
                                        <i class="fa fa-thumbs-up"></i>
                                    </div>
                                    <img src="/assets/img/items/6.jpg" alt="">
                                </a>
                            </div>
                            <div class="wrapper">
                                <a href="real-estate-item-detail.html"><h3>3295 Valley Street</h3></a>
                                <figure>Collingswood</figure>
                                <div class="price">$42.000</div>
                                <div class="info">
                                    <div class="type">
                                        <i><img src="/assets/icons/real-estate/apartment-3.png" alt=""></i>
                                        <span>Apartment</span>
                                    </div>
                                    <div class="rating" data-rating="4"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.item-->
                    </div>
                    <!--/.col-sm-4-->
                    <div class="col-md-3 col-sm-3">
                        <div class="item featured equal-height">
                            <div class="image">
                                <div class="quick-view"><i class="fa fa-eye"></i><span>Quick View</span></div>
                                <a href="real-estate-item-detail.html">
                                    <div class="icon">
                                        <i class="fa fa-thumbs-up"></i>
                                    </div>
                                    <img src="/assets/img/items/12.jpg" alt="">
                                </a>
                            </div>
                            <div class="wrapper">
                                <a href="real-estate-item-detail.html"><h3>534 Roosevelt Street</h3></a>
                                <figure>San Francisco</figure>
                                <div class="price">$16.000</div>
                                <div class="info">
                                    <div class="type">
                                        <i><img src="/assets/icons/real-estate/apartment-3.png" alt=""></i>
                                        <span>Apartment</span>
                                    </div>
                                    <div class="rating" data-rating="4"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.item-->
                    </div>
                    <!--/.col-sm-4-->
                    <div class="col-md-3 col-sm-3">
                        <div class="item featured equal-height">
                            <div class="image">
                                <div class="quick-view"><i class="fa fa-eye"></i><span>Quick View</span></div>
                                <a href="real-estate-item-detail.html">
                                    <img src="/assets/img/items/1.jpg" alt="">
                                </a>
                            </div>
                            <div class="wrapper">
                                <a href="real-estate-item-detail.html"><h3>3019 White Avenue</h3></a>
                                <figure>Corpus Christi</figure>
                                <div class="price">$39.000</div>
                                <div class="info">
                                    <div class="type">
                                        <i><img src="/assets/icons/real-estate/apartment-3.png" alt=""></i>
                                        <span>Apartment</span>
                                    </div>
                                    <div class="rating" data-rating="5"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.item-->
                    </div>
                    <!--/.col-sm-4-->
                    <div class="col-md-3 col-sm-3">
                        <div class="item featured equal-height">
                            <div class="image">
                                <div class="quick-view"><i class="fa fa-eye"></i><span>Quick View</span></div>
                                <a href="real-estate-item-detail.html">
                                    <img src="/assets/img/items/8.jpg" alt="">
                                </a>
                            </div>
                            <div class="wrapper">
                                <a href="real-estate-item-detail.html"><h3>1882 Trainer Avenue</h3></a>
                                <figure>Louisville</figure>
                                <div class="price">$150.000</div>
                                <div class="info">
                                    <div class="type">
                                        <i><img src="/assets/icons/real-estate/apartment-3.png" alt=""></i>
                                        <span>Apartment</span>
                                    </div>
                                    <div class="rating" data-rating="4"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.item-->
                    </div>
                    <!--/.col-sm-4-->
                </div>
            </div>
        </section>
        <!--end Featured-->
    </div>
    <!-- end Page Content-->
</div>
@stop

@push('js-include')
<script type="text/javascript" src="/assets/js/markerclusterer.js"></script>
<script type="text/javascript" src="/assets/js/richmarker-compiled.js"></script>
<script type="text/javascript" src="/assets/js/infobox.js"></script>
<script type="text/javascript" src="/assets/js/icheck.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
@endpush

@push('js-script')
<script>
    var _latitude = {{ $center->latitude }};
    var _longitude = {{ $center->longitude }};
    var jsonPath = "{{ route('client.marker') }}";

    // Load JSON data and create Google Maps

    $.getJSON(jsonPath)
            .done(function(json) {
                createHomepageGoogleMap(_latitude,_longitude,json);
            })
            .fail(function( jqxhr, textStatus, error ) {
                console.log(error);
            })
    ;

    $(".updown").on("click", function() {
        var $button = $(this);
        var oldValue = $button.closest( "div.counter" ).find("input").val();
        if ($button.attr('counter') == "up") {
            var newVal = parseFloat(oldValue) + 1;
            } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.closest( "div.counter" ).find("input").val(newVal);
    });
</script>
@endpush