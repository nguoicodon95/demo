@extends('admins.build_admin._master')
@section('titleName', 'Edit category')
@section('content')
<div class="page-content">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<!-- BEGIN PAGE TITLE -->
		<div class="page-title">
			<h1>Categories <small>create new category</small></h1>
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
            Categories
		</li>
	</ul>
	<!-- END PAGE BREADCRUMB -->
	<!-- BEGIN PAGE CONTENT INNER -->
	<div class="row">
        <div class="col-md-12">
            <div class="portlet light form-fit">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-layers font-dark"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Edit category</span>
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
                    <form action="{{ $category->exists ? route('categories.update', $category->id) : route('categories.store') }}" class="form-horizontal form-bordered" method="post">
                        {{ csrf_field() }}
                        {{ method_field($category->exists ? 'PUT' : 'POST') }}

                        <div class="form-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label">
                                        <b>Title</b>
                                        <span class="required">*</span>
                                    </label>
                                    <input  type="text" name="title" class="form-control" value="{{ $category->title or '' }}"
                                        autocomplete="off">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label">
                                        <b>Alias</b>
                                    </label>
                                    <input  type="text" name="slug"
                                        class="form-control"
                                        value="{{ $category->slug or '' }}"
                                        autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label">
                                        <b>Child of</b>
                                    </label>
                                    <select name="parent_id" class="form-control">
                                        <option value="0">Select parent category</option>
                                        {!! $categoriesHtmlSrc !!}
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label">
                                        <b>Sumary</b>
                                    </label>
                                    <textarea name="description" class="form-control">{{ $category->description or '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label">
                                        <b>Content</b>
                                    </label>
                                    <textarea name="content" class="form-control contentMCE">{{ $category->content or '' }}</textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label">
                                        <b>Keywords</b>
                                    </label>
                                    <input  type="text" name="keywords"
                                        class="form-control" id="keyword"
                                        value="{{ $category->keywords or '' }}"
                                        autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label">
                                        <b>Image</b>
                                    </label>
                                    <div class="clearfix"></div>
                                    <div class="select-media-box">
                                        <button type="button" class="btn blue show-add-media-popup">Choose image</button>
                                        <div class="clearfix"></div>
                                        <a title="" class="show-add-media-popup">
                                            <img src="{{ ($category->exists && trim($category->image != '')) ? $category->image : '/admins/assets/img/no-image.png' }}" alt="Thumbnail" class="img-responsive">
                                        </a>
                                        <input type="hidden" name="image" value="{{ $category->image or '' }}" class="input-file">
                                        <a title="" class="remove-image"><span>&nbsp;</span></a>
                                    </div>
                                </div>
                            </div>

                           
                            
                            <div class="form-group last">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-primary"
                                        type="submit">
                                        <i class="fa fa-check"></i> Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>
	<!-- END PAGE CONTENT INNER -->
</div>

@stop

@push('css-include')
<link rel="stylesheet" href="/admins/assets/root/global/plugins/jquery-tags-input/jquery.tagsinput.css">
@endpush

@push('css-style')
<style>
    .form .form-bordered .form-group > div {
         border-color: transparent;
    }

    .form .form-bordered .form-group .control-label {
        padding-top: 0;
    }

    .alert {
        border-radius: 0;
    }

    .delete-confirm {
        margin-left: 10px;
    }
</style>
@endpush

@push('js-include')
<script src="/admins/plugins/tinymce/tinymce.min.js"></script>
<script src="/admins/plugins/tinymce/config.mce.js"></script>
<script src="/admins/assets/root/global/plugins/jquery-tags-input/jquery.tagsinput.min.js"></script>
@endpush

@push('js-script')
<script>
    $('#keyword').tagsInput({
        width: 'auto',
        'onAddTag': function() {},
    });
</script>
@endpush