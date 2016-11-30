<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Metronic | Admin Dashboard Template</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="/admins/assets/root/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="/admins/assets/root/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="/admins/assets/root/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="/admins/assets/root/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="/admins/assets/root/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="/admins/assets/root/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
<link href="/admins/assets/root/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<link href="/admins/assets/css/main.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE STYLES -->
<!-- INCLUDE CSS -->
@stack('css-include')
<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
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
</script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
<!-- BEGIN HEADER -->
@include('admins.build_admin._shared._header')
<!-- END HEADER -->
<div class="clearfix"></div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	@include('admins.build_admin._shared._sidebar')
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		@yield('content')
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
@include('admins.build_admin._shared._footer')
<!-- END FOOTER -->
@include('admins.build_admin._shared._modal')
<!-- MODAL -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="/admins/assets/root/plugins/respond.min.js"></script>
<script src="/admins/assets/root/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="/admins/assets/root/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/admins/assets/root/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
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
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/admins/assets/root/global/scripts/metronic.js" type="text/javascript"></script>
<script src="/admins/assets/root/scripts/layout.js" type="text/javascript"></script>
<script src="/admins/assets/js/main.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- INCLUDE SCRIPT -->
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
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
});
</script>
<!-- INCLUDE SCRIPT -->
@stack('js-script')
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>