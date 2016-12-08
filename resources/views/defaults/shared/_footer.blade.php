<footer id="page-footer">
            <div class="inner">
                <div class="footer-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <!--New Items-->
                                <section>
                                    <h2>Các phòng vừa đăng</h2>
                                    @foreach($relatedRoom as $room)
                                    <a href="" class="item-horizontal small">
                                        <h3>{{ $room->title or '' }}</h3>
                                        <figure>
                                            {{ _setName($room->place_room->state, $room->place_room->city, $room->place_room->country) }}
                                        </figure>
                                        <div class="wrapper">
                                            <div class="image">
                                                <img src="{{ !empty($room->photo_room) ? $room->photo_room[0]->name : '' }}" alt="{{ $room->title or '' }}" title="{{ $room->title or '' }}">
                                            </div>
                                            <div class="info">
                                                <div class="type">
                                                    <i class="{{ $room->kind->icon or '' }}"></i>
                                                    <span>{{ $room->kind->name or '' }}</span>
                                                </div>
                                                <div class="type">
                                                    <i class="icon-guest"></i>
                                                    <span>{{ $room->count_guest or 1 }} người</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                    <!--/.item-horizontal small-->
                                </section>
                                <!--end New Items-->
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <!--Recent Reviews-->
                                <section>
                                    <h2>Công ty</h2>
                                    {!! _menuHtml('footer-menu', 'bootstrap') !!}
                                   
                                </section>
                                <!--end Recent Reviews-->
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <section>
                                    <h2>About Us</h2>
                                    <address>
                                        <div>Max Five Lounge</div>
                                        <div>63 Birch Street</div>
                                        <div>Granada Hills, CA 91344</div>
                                        <figure>
                                            <div class="info">
                                                <i class="fa fa-mobile"></i>
                                                <span>818-832-5258</span>
                                            </div>
                                            <div class="info">
                                                <i class="fa fa-phone"></i>
                                                <span>+1 123 456 789</span>
                                            </div>
                                            <div class="info">
                                                <i class="fa fa-globe"></i>
                                                <a href="#">www.maxfivelounge.com</a>
                                            </div>
                                        </figure>
                                    </address>
                                    <div class="social">
                                        <a href="#" class="social-button"><i class="fa fa-twitter"></i></a>
                                        <a href="#" class="social-button"><i class="fa fa-facebook"></i></a>
                                        <a href="#" class="social-button"><i class="fa fa-pinterest"></i></a>
                                    </div>

                                    <a href="contact.html" class="btn framed icon">Contact Us<i class="fa fa-angle-right"></i></a>
                                </section>
                            </div>
                            <!--/.col-md-4-->
                        </div>
                        <!--/.row-->
                    </div>
                    <!--/.container-->
                </div>
                <!--/.footer-top-->
                <div class="footer-bottom">
                    <div class="container">
                        <span class="left">(C) ThemeStarz, All rights reserved</span>
                        <span class="right">
                            <a href="#page-top" class="to-top roll"><i class="fa fa-angle-up"></i></a>
                        </span>
                    </div>
                </div>
                <!--/.footer-bottom-->
            </div>
        </footer>