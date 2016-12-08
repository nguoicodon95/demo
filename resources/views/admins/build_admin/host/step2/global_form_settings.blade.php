@extends('admins.build_admin._master')

@section('content')
<div class="page-content">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<!-- BEGIN PAGE TITLE -->
		<div class="page-title">
			<h1>Register Host <small>Begin step settings</small></h1>
		</div>
		<!-- END PAGE TITLE -->
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE BREADCRUMB -->
	<ul class="page-breadcrumb breadcrumb">
		<li>
			<a href="javascript:;">Trang chủ</a><i class="fa fa-circle"></i>
		</li>
		<li class="active">
            Host settings
		</li>
	</ul>
	<!-- END PAGE BREADCRUMB -->
	<!-- BEGIN PAGE CONTENT INNER -->
	<div class="row">
        <div class="col-md-12">
            <div class="portlet light form-fit" id="form_step_setting">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-layers font-dark"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">
                            <span class="step-title">Step 1 of 3 </span>
                        </span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="reload" data-original-title="" title=""></a>
                        <a href="javascript:;" class="collapse" data-original-title="" title=""></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- error -->
                    @if($errors->all())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <!-- BEGIN FORM-->
                    <!-- BEGIN FORM-->
                    <div class="col-md-12">
                        <form action="{{ route('host.upsetting', $data_Room->id) }}" class="form-horizontal" id="submit_form_setting" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-wizard">
                                <div class="form-body">
                                    <ul class="nav nav-pills nav-justified steps">
                                        <li>
                                            <a href="#tab1" data-toggle="tab" class="step">
                                            <span class="number">
                                            1 </span>
                                            <span class="desc">
                                            <i class="fa fa-check"></i> Mô tả </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab2" data-toggle="tab" class="step">
                                            <span class="number">
                                            2 </span>
                                            <span class="desc">
                                            <i class="fa fa-check"></i> Tên </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab3" data-toggle="tab" class="step active">
                                            <span class="number">
                                            3 </span>
                                            <span class="desc">
                                            <i class="fa fa-check"></i> Hình ảnh </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div id="bar" class="progress progress-striped" role="progressbar">
                                        <div class="progress-bar progress-bar-success">
                                        </div>
                                    </div>
                                    <div class="tab-content">
                                        <div class="alert alert-danger display-none">
                                            <button class="close" data-dismiss="alert"></button>
                                            <span>Bạn có một số lỗi hình thức. Vui lòng kiểm tra dưới đây</span>
                                        </div>
                                        <div class="alert alert-success display-none">
                                            <button class="close" data-dismiss="alert"></button>
                                            <span>Hình thức xác nhận của bạn thành công!</span>
                                        </div>
                                        <div class="tab-pane active" id="tab1">
                                            <description></description>
                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            <titles></titles>
                                        </div>
                                        <div class="tab-pane" id="tab3">
                                            <photos></photos>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <a href="javascript:;" class="btn default button-previous">
                                            <i class="m-icon-swapleft"></i> Back </a>
                                            <a href="javascript:;" class="btn blue button-next">
                                            Continue <i class="m-icon-swapright m-icon-white"></i>
                                            </a>
                                            <a href="javascript:;" class="btn green button-submit">
                                            Submit <i class="m-icon-swapright m-icon-white"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
	<!-- END PAGE CONTENT INNER -->
</div>
@include('admins.build_admin.host.step2._partials._description')
@include('admins.build_admin.host.step2._partials._title')
@include('admins.build_admin.host.step2._partials._photo')
@stop

@push('css-include')
<link href="{{ asset('admins/assets/css/select2.css') }}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="/admins/assets/root/global/plugins/select2/select2.css"/>
@endpush

@push('css-style')
<style>
    .alert {
        border-radius: 0;
    }
    /* CUSTOM CSS FORM WIRZAD */
    .progress {
        height: 5px;
    }
    .form-wizard .progress {
         margin-bottom: 20px; 
    }
    .nav-justified>li {
        width: auto;
    }
    .form-wizard .steps > li > a.step {
        background: transparent;
    }
    .form-wizard .steps > li {
        display:inline-block;
        padding: 0;
        background:#CCC;
        color:#FFF;
        cursor:pointer;
        position:relative;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        overflow:hidden;
    }
    .form-wizard .steps > li.active {
        background:#1fb5ad;
    }
    .form-wizard .steps > li.active a.step .desc {
        color: #fff;
        margin-left: 25px;
    }
    .form-wizard .steps > li > a.step  > span.number {
        position:absolute;
        left:0;
        top:0;
        bottom:0;
        background:#AAA;
        -webkit-border-radius: 0 !important; 
        -moz-border-radius: 0 !important;
        border-radius: 0 !important;
        color: #333;
        height: 43px;
        width: 25px;
        padding: 11px 5px 13px 5px;
    }
    .form-wizard .steps > li > a > span.number:after{
        content: '';
        display: block;
        width: 10px;
        position: absolute;
        right: -10px;
        height: 100%;
        top: 0;
        background: url('data:image/svg+xml; charset=utf-8,<svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 20" preserveAspectRatio="none"><path d="m0,0 l10,10 l-10,10 l-0,-20z" stroke-width="1.5" fill="#AAA"/></svg>') 0 0 no-repeat;
    }
    .form-wizard .steps > li.active > a > span.number:after{
        content: '';
        display: block;
        width: 10px;
        position: absolute;
        right: -10px;
        height: 100%;
        top: 0;
        background: url('data:image/svg+xml; charset=utf-8,<svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 20" preserveAspectRatio="none"><path d="m0,0 l10,10 l-10,10 l-0,-20z" stroke-width="1.5" fill="#18908a"/></svg>') 0 0 no-repeat;
    }
    .form-wizard .steps > li.active > a.step .number {
        background-color: #18908a;
    }
    .form-wizard .steps > li > a.step .desc {
        color: #333;
        margin-left: 25px;
    }
    .package_desc {
        border: 1px solid #c4c4c4;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        background-color: #fff;
    }

    .panel-body {
        border-top: 0;
    }
    p {
        font-size: 18px;
        line-height: 1.4em;
        color: #484848;
    }
</style>
@endpush

@push('js-include')
<script src="/admins/assets/root/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script src="/admins/assets/root/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script src="/admins/assets/root/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="/admins/assets/root/admin/pages/scripts/form-setting.js"></script>
<script src="/admins/assets/js/jquery.session.js"></script>
<script src="/admins/assets/js/jquery.formStorage.js"></script>
        <script src="{{ asset('admins/assets/js/select2.js') }}"></script>
@endpush

@push('js-script')
<script>
    FormSetting.init();
    $("#place-close, #place-highlights").select2({
        tags: true
    });
</script>
 <script>
    var textarea = document.querySelector('textarea');
    $(document).ready(function() {
        autosize();
        countChar();
        $('#description').keyup(countChar);
        $("textarea").keydown(autosize);
    });
    
    function autosize() {
        textarea.style.cssText = 'height:auto;';
        textarea.style.cssText = 'height:' + textarea.scrollHeight + 'px';
    }
    
    function countChar() {
        var text_max = 500;
        $('.lys-input__remaining-char-count').html(text_max);
        var text_length = $('#description').val().length;
        var text_remaining = text_max - text_length;
        $('.lys-input__remaining-char-count').html(text_remaining);
    }
   /* $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.remove-image').click(function (e) {
        e.preventDefault();
        var id = $(this).attr('id-pt');
        $.ajax({
            method: 'DELETE',
            url: "/admin/become-a-host/photo/"+id,
            success: function () {
                return true
            }
        })
    })*/
</script>
@endpush