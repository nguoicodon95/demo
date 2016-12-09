<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8"/>
	<title>@yield('titleName')</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<meta name="csrf-token" content="{{ csrf_token() }}"/>

	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('admins/assets/css/style.css')}}" rel="stylesheet" />
	<link href="/admins/assets/root/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="/admins/assets/root/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
	<link href="/admins/assets/root/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="/admins/assets/root/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<link href="/admins/assets/root/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

	<link href="/admins/assets/root/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
	<link href="/admins/assets/root/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>

	<link href="/admins/assets/css/main.css" rel="stylesheet" type="text/css"/>

	@stack('css-include')

	<link href="/admins/assets/root/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
	<link href="/admins/assets/root/global/css/plugins.css" rel="stylesheet" type="text/css"/>
	<link href="/admins/assets/root/css/layout.css" rel="stylesheet" type="text/css"/>
	<link href="/admins/assets/root/css/themes/light.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="/admins/assets/root/css/custom.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->
	<link rel="shortcut icon" href="favicon.ico"/>
	<!-- CSS STYLE SCRIPT -->
	@stack('css-style')
	<script type="text/javascript">
		var fileManagerUrl = '{{ route('file.viewFile') }}';
		var base_url = '{{ url('/') }}';
		window.Laravel = <?= json_encode(['csrfToken' => csrf_token(),]); ?>
	</script>
	<style>
		span.logo-default {
			line-height: 70px;
			font-size: 1.7em;
			text-transform: uppercase;
		}
	</style>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
	@if(!isset($filemanager))
		@include('admins.build_admin._shared._header')

		<div class="clearfix"></div>

		<div class="page-container">
			@include('admins.build_admin._shared._sidebar')
			<div class="page-content-wrapper">
				@yield('content')
			</div>
		</div>

		@include('admins.build_admin._shared._footer')

		@include('admins.build_admin._shared._modal')
	@else
		@yield('content')
	@endif
	<!--[if lt IE 9]>
	<script src="/admins/assets/root/plugins/respond.min.js"></script>
	<script src="/admins/assets/root/plugins/excanvas.min.js"></script> 
	<![endif]-->
	<script src="/admins/assets/root/global/plugins/jquery.min.js" type="text/javascript"></script>
	<script src="/admins/assets/root/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>

	<script src="/admins/assets/root/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
	<script src="/admins/assets/root/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="/admins/assets/root/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
	<script src="/admins/assets/root/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="/admins/assets/root/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="/admins/assets/root/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
	<script src="/admins/assets/root/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
	<script src="/admins/assets/root/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
	<script src="/admins/assets/root/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
	<script src="/admins/assets/root/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>

	<script src="/admins/assets/root/global/scripts/metronic.js" type="text/javascript"></script>
	<script src="/admins/assets/root/scripts/layout.js" type="text/javascript"></script>
	<script src="/admins/assets/js/main.js" type="text/javascript"></script>

	<script src="{{ asset('js/app.js') }}"></script>

	@stack('js-include')

	<script>
		$.ajaxSetup({
		beforeSend: function() {
			Metronic.blockUI({
					animate: true,
					overlayColor: 'none'
				});
		},
		complete: function() {
			Metronic.unblockUI()
		}
		});
		(function($) {    
		Metronic.init(); // init metronic core componets
		Layout.init(); // init layout
		})(jQuery);
	</script>
	@stack('js-script')
</body>
<!-- END BODY -->
</html>