    <!-- Navigation-->
    <header class="header">
        <div class="wrapper">
            <nav class="navigation unset">
                <div class="container-rooms-header">
                    <div class="logo pull-left">
                        <h1>
                            <a href="/" title="{{ $siteSettings['title'] }}">
                                <img src="{{ $siteSettings['logo'] }}" alt="logo">
                            </a>
                        </h1>
                    </div>
                    @if(isset($show_form) && $show_form == true)
                    <div class="searchForm pull-left">
                        <form action="" method="post" id="_frm_findSearchLocation">
                            {!! csrf_field() !!}
                            <div class="searchForm-input-wrapper pull-left">
                                <div class="searchForm_location">
                                    <div class="input-location">
                                        <label class="input-placeholder-group locationInput_label">
                                            <i class="glyphicon glyphicon-search"></i>
                                            <span class="input-placeholder-label screen-reader-only">Bạn đến đâu?</span>
                                            <!--input class="LocationInput input-large" name="location" id="location" type="text" placeholder="Bạn đến đâu?" autocomplete="off" value="{{ $location_request or null }}"-->
                                            <input autofocus autocomplete="off" 
                                                class="LocationInput input-large"
                                                id="location" name="location" type="text" 
                                                placeholder="Bạn đến đâu?" 
                                                value="{{ $location_request or null }}">
                                            <input type="hidden" id="latitude" name="latitude">
                                            <input type="hidden" id="longitude" name="longitude">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif
                    <div class="nav-item pull-right">
                        <div class="list-item">
                            <div class="item">
                                <a href="#">Trợ giúp</a>
                                <!--div class="block-box panel field-guide">
                                    <div class="search-container">
                                        <div class="search-input-inner">
                                            <div class="icon-middle-col">
                                                <i class="glyphicon glyphicon-search"></i>
                                            </div>
                                            <input type="text" class="search-input" name="query" autocomplete="off" placeholder="Chúng tôi có thể giúp được gì cho bạn?" maxlength="1024">
                                        </div>
                                        <div class="search-results-container">
                                            <div class="search-results">
                                                <div class="list-articles">
                                                    <div class="search-panel-header">Bài viết đề nghị</div>
                                                    <a href="" class="link-panel">
                                                        <div class="hover-item">
                                                            <span class="icon-middle-col">
                                                                <i class="glyphicon glyphicon-list-alt"></i>
                                                            </span>
                                                            <span>Hướng dẫn Bắt đầu</span>
                                                        </div>
                                                    </a>
                                                    <a href="" class="link-panel">
                                                        <div class="hover-item">
                                                            <span class="icon-middle-col">
                                                                <i class="glyphicon glyphicon-list-alt"></i>
                                                            </span>
                                                            <span>Tôi có thể thay đổi đặt phòng như một máy chủ?</span>
                                                        </div>
                                                    </a>
                                                    <a href="" class="link-panel">
                                                        <div class="hover-item">
                                                            <span class="icon-middle-col">
                                                                <i class="glyphicon glyphicon-list-alt"></i>
                                                            </span>
                                                            <span>Làm thế nào xác định giá đặt phòng của mình?</span>
                                                        </div>
                                                    </a>
                                                    <a href="" class="link-panel">
                                                        <div class="hover-item">
                                                            <span class="icon-middle-col">
                                                                <i class="glyphicon glyphicon-list-alt"></i>
                                                            </span>
                                                            <span>Làm thế nào để thanh toán?</span>
                                                        </div>
                                                    </a>
                                                    <a href="" class="link-panel">
                                                        <div class="hover-item">
                                                            <span class="icon-middle-col">
                                                                <i class="glyphicon glyphicon-list-alt"></i>
                                                            </span>
                                                            <span>Kích hoạt ID là gì?</span>
                                                        </div>
                                                    </a>
                                                    <a href="" class="link-panel">
                                                        <div class="hover-item">
                                                            <span class="icon-middle-col">
                                                                <i class="glyphicon glyphicon-list-alt"></i>
                                                            </span>
                                                            <span>Các chính sách hủy Airbnb là gì?</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="overlay-bottom"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="help-link-bottom">
                                        <a href="">
                                            <span>Trung tâm trợ giúp</span>
                                        </a>
                                    </div>
                                </div-->
                            </div>
                            <!--div class="item">
                                <a href="#" data-toggle="modal" data-target="#loginModal">Đăng nhập</a>
                            </div>
                            <div class="item">
                                <a href="#" data-toggle="modal" data-target="#regisModal">Đăng kí</a>
                            </div-->
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- end Navigation-->