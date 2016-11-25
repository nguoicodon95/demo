<!DOCTYPE html>
<html>
	<head>
		<title>Cho thuê nhà nghỉ, ngôi nhà, căn hộ & Phòng cho Thuê - Airbnb</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('dist/css/font-awesome.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('plugin/flatpickr/dist/flatpickr.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
		<!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}"> -->
		<link rel="stylesheet" type="text/css" href="{{ asset('dist/css/style.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('dist/css/animate.css') }}">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		@stack('css')
		<script>
			$(window).load(function() {
			    $('#status').fadeOut();
			    $('#preloader').delay(350).fadeOut('slow');
			    $('body').delay(350).css({'overflow':'visible'});
			})
		</script>
	</head>
	<body>
		<!-- Start Preloader
		==================================== -->

		<div id="preloader">
	        <div id="status">&nbsp;</div>
	    </div>
		 <!-- End Preloader
		==================================== -->


		<!-- Start Header - nav - slideshow
		==================================== -->

		<header id="navigation" class="top-nav">
			<nav class="navigation unset">
				<div class="container-rooms-header">
					<div class="logo pull-left">
						<h1>
							<a href="/" title="Cho thuê nhà nghỉ, ngôi nhà, căn hộ & Phòng cho Thuê - Airbnb">Airbnb</a>
						</h1>
					</div>
					<div class="searchForm pull-left">
						<form action="/" method="get">
							<div class="searchForm-input-wrapper pull-left">
								<div class="searchForm_location">
									<div class="input-location">
										<label class="input-placeholder-group locationInput_label">
											<i class="glyphicon glyphicon-search"></i>
											<span class="input-placeholder-label screen-reader-only">Bạn đến đâu?</span>
											<input class="LocationInput input-large" name="location" type="text" placeholder="Bạn đến đâu?" autocomplete="off" value="">
										</label>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="nav-item pull-right">
						<div class="list-item">
							<div class="item">
								<a href="#">Trợ giúp</a>
								<div class="block-box panel field-guide">
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
								</div>
							</div>
							<div class="item">
								<a href="#" data-toggle="modal" data-target="#loginModal">Đăng nhập</a>
							</div>
							<div class="item">
								<a href="#" data-toggle="modal" data-target="#regisModal">Đăng kí</a>
							</div>
						</div>
					</div>
				</div>
			</nav>
			@yield('slide')
		</header>

		<!-- End Header - nav - slideshow
		==================================== -->

		<div class="clearfix"></div>

		<!-- Start Section - main content
		==================================== -->
		
		@yield('content')

		<!-- End Section - main content
		==================================== -->
		
		<div class="clearfix"></div>
		<footer id="footer">
			<div class="container">
				<div class="main-footer">
					<div class="col-lg-3 col-md-6 col-custom-footer">
						<div class="config-choose">
							<div class="config-content">
								<div class="language">
									<a href=""><span class="vi">Tiếng Việt</span></a>
									<span>|</span>
									<a href=""><span class="en">English</span></a>
								</div>

								<div class="currency">
									<select name="" id="currency-selector">
										<option value="vnd">VNĐ</option>
										<option value="usd">USD</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="footer-title">
							<h2>Công ty</h2>
						</div>
						<div class="footer-element">
							<ul>
								<li><a href="">Về chúng tôi</a></li>
								<li><a href="">Blog</a></li>
								<li><a href="">Trợ giúp</a></li>
								<li><a href="">Chính sách</a></li>
								<li><a href="">Về chúng tôi</a></li>
								<li><a href="">Điều khoản & bảo mật</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="footer-title">
							<h2>Khám phá</h2>
						</div>
						<div class="footer-element">
							<ul>
								<li><a href="">Tin tưởng & an toàn</a></li>
								<li><a href="">Tín dụng du lịch</a></li>
								<li><a href="">Chọn lựa</a></li>
								<li><a href="">Hành động</a></li>
								<li><a href="">Site Map</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="copy">
					<div class="copy-title">
						<h2>Tham gia cùng chúng tôi</h2>
					</div>
					<div class="social-icon">
						<ul>
							<li><a href=""><i class="fa fa-facebook"></i></a></li>
							<li><a href=""><i class="fa fa-google-plus"></i></a></li>
							<li><a href=""><i class="fa fa-twitter"></i></a></li>
							<li><a href=""><i class="fa fa-linkedin"></i></a></li>
							<li><a href=""><i class="fa fa-pinterest"></i></a></li>
							<li><a href=""><i class="fa fa-youtube"></i></a></li>
							<li><a href=""><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
					<div class="copy-right">
						&copy Airbnb, Inc.
					</div>
				</div>
			</div>
		</footer>

		@include('_shares.login_form')
		@include('_shares.reg_form')

		<script src="{{ asset('plugin/flatpickr/dist/flatpickr.js') }}"></script>
		<script src="{{ asset('plugin/javascripts/bootstrap.js') }}"></script>
		<!-- <script src="{{ asset('js/carosel.js') }}"></script> -->
	    

	    <script>
			var calendars = flatpickr(".flatpickr");
	    </script>
	    @stack('js')
	</body>
</html>