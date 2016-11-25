@extends('defaults.homepage._master')

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
                        <form class="main-search" role="form" method="post" action="?">
                            <header class="clearfix">
                                <h3 class="pull-left">Search</h3>
                                <a href="#advanced-search" class="show-more pull-right" data-toggle="collapse" aria-expanded="false" aria-controls="advanced-search">Advanced Search</a>
                            </header>
                            <div class="advanced-search collapse" id="advanced-search">
                                <h4>Features</h4>
                                <ul class="list-unstyled checkboxes">
                                    <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="1">Free Parking</label></div></li>
                                    <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="2">Cards Accepted</label></div></li>
                                    <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="3">Wi-Fi</label></div></li>
                                    <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="4">Air Condition</label></div></li>
                                    <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="5">Reservations</label></div></li>
                                    <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="6">Team-buildings</label></div></li>
                                    <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="7">Places to seat</label></div></li>
                                    <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="8">Winery</label></div></li>
                                    <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="9">Draft Beer</label></div></li>
                                    <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="10">LCD</label></div></li>
                                    <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="11">Saloon</label></div></li>
                                    <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="12">Free Access</label></div></li>
                                    <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="13">Terrace</label></div></li>
                                    <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="14">Minigolf</label></div></li>
                                    <li><div class="checkbox"><label><input type="checkbox" name="features[]" value="15">Night Bar</label></div></li>
                                </ul>
                            </div>
                            <div class="row">
                                <!-- <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <div class="input-group location">
                                            <input type="text" class="form-control" id="location" placeholder="Enter Location">
                                            <span class="input-group-addon"><i class="fa fa-map-marker geolocation" data-toggle="tooltip" data-placement="bottom" title="Find my position"></i></span>
                                        </div>
                                    </div>
                                    /.form-group
                                </div> -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Property Type</label>
                                        <select name="type" multiple title="All" data-live-search="true" id="type">
                                            <option value="1">Stores</option>
                                            <option value="2" class="sub-category">Apparel</option>
                                            <option value="3" class="sub-category">Computers</option>
                                            <option value="4" class="sub-category">Nature</option>
                                            <option value="5">Tourism</option>
                                            <option value="6">Restaurant & Bars</option>
                                            <option value="7" class="sub-category">Bars</option>
                                            <option value="8" class="sub-category">Vegetarian</option>
                                            <option value="9" class="sub-category">Steak & Grill</option>
                                            <option value="10">Sports</option>
                                            <option value="11" class="sub-category">Cycling</option>
                                            <option value="12" class="sub-category">Water Sports</option>
                                            <option value="13" class="sub-category">Winter Sports</option>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!--/.col-md-6-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bedrooms">Bedrooms</label>
                                        <div class="input-group counter">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="fa fa-minus"></i></button>
                                        </span>
                                            <input type="text" class="form-control" id="bedrooms" name="bedrooms" placeholder="Any">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
                                        </span>
                                        </div><!-- /input-group -->
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!--/.col-md-3-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bathrooms">Bathrooms</label>
                                        <div class="input-group counter">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="fa fa-minus"></i></button>
                                        </span>
                                            <input type="text" class="form-control" id="bathrooms" name="bathrooms" placeholder="Any">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
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
                                            <div class="col-middle-alt col-sm-4">
                                                <label class="checkbox facet-checkbox checkbox-rooms-type">
                                                    <div class="checkbox_label">
                                                        <span>Nhà nguyên căn</span>
                                                    </div>
                                                    <div class="checkbox_input">
                                                        <input type="checkbox" name="room-type" value="Entire home">
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-middle-alt col-sm-4">
                                                <label class="checkbox facet-checkbox checkbox-rooms-type">
                                                    <div class="checkbox_label">
                                                        <span>Phòng riêng</span>
                                                    </div>
                                                    <div class="checkbox_input">
                                                        <input type="checkbox" name="room-type" value="Entire home">
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-middle-alt col-sm-4">
                                                <label class="checkbox facet-checkbox checkbox-rooms-type">
                                                    <div class="checkbox_label">
                                                        <span>Phòng chung</span>
                                                    </div>
                                                    <div class="checkbox_input">
                                                        <input type="checkbox" name="room-type" value="Entire home">
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/.col-md-3-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <div class="ui-slider" id="price-slider" data-value-min="100" data-value-max="40000" data-value-type="price" data-currency="$" data-currency-placement="before">
                                            <div class="values clearfix">
                                                <input class="value-min" name="value-min[]" readonly>
                                                <input class="value-max" name="value-max[]" readonly>
                                            </div>
                                            <div class="element"></div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!--/.col-md-6-->
                            </div>
                            <!--/.row-->
                        </form>
                        <!-- /.main-search -->
                    </div>
                    <!--end Filter-->
                    <header class="clearfix">
                        <h3 class="pull-left">Results</h3>
                        <div class="buttons pull-right">
                            <span>Display:</span>
                            <span class="icon active" id="display-grid"><i class="fa fa-th"></i></span>
                            <span class="icon" id="display-list"><i class="fa fa-th-list"></i></span>
                        </div>
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
</script>
@endpush
