@extends('admins.build_admin._master')
@section('titleName', 'Setting generate')
@section('content')
<div class="page-content">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<!-- BEGIN PAGE TITLE -->
		<div class="page-title">
			<h1>Setting <small>generate</small></h1>
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
            setting
		</li>
	</ul>
	<!-- END PAGE BREADCRUMB -->
	<!-- BEGIN PAGE CONTENT INNER -->
	<div class="row">
        <div class="col-md-12">
            <div class="portlet light form-fit">
                <form action="{{ route('web.settings') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="panel">
                        @foreach($settings as $setting)
                            <div class="panel-heading">
                                <label class="pull-left">
                                    {{ $setting->display_name }}
                                </label>
                                <div class="panel-actions pull-right">
                                    <a href="{{ route('web.settings.move_up', $setting->id) }}">
                                        <i class="icon-arrow-up voyager-sort-asc"></i>
                                    </a>
                                    <a href="{{ route('web.settings.move_down', $setting->id) }}">
                                        <i class="icon-arrow-down voyager-sort-desc"></i>
                                    </a>
                                    <i class="icon-trash"
                                        data-id="{{ $setting->id }}"
                                        data-display-key="{{ $setting->key }}"
                                        data-display-name="{{ $setting->display_name }}"></i>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                @if ($setting->type == "text")
                                    <input type="text" class="form-control" name="{{ $setting->key }}" value="{{ $setting->value }}">
                                @elseif($setting->type == "text_area")
                                    <textarea class="form-control" name="{{ $setting->key }}">
                                        @if(isset($setting->value)){{ $setting->value }}@endif
                                    </textarea>
                                @elseif($setting->type == "rich_text_box")
                                    <textarea class="form-control richTextBox" name="{{ $setting->key }}">
                                        @if(isset($setting->value)){{ $setting->value }}@endif
                                    </textarea>
                                @elseif($setting->type == "image" || $setting->type == "file")
                                    @if($setting->type == "file" && isset( $setting->value ))
                                        <div class="fileType">{{ $setting->value }}</div>
                                    @endif
                                     <div class="form-group">
                                        <div class="select-media-box">
                                            <button type="button" class="btn blue show-add-media-popup">Choose image</button>
                                            <div class="clearfix"></div>
                                            <a title="" class="show-add-media-popup">
                                                <img src="{{ (trim($setting->value != '')) ? $setting->value : '/admins/assets/img/no-image.png' }}" alt="Thumbnail" class="img-responsive">
                                            </a>
                                            <input type="hidden" name="{{ $setting->key }}" value="{{ $setting->value or '' }}" class="input-file">
                                            <a title="" class="remove-image"><span>&nbsp;</span></a>
                                        </div>
                                    </div>
                                @elseif($setting->type == "select_dropdown")
                                    <?php $options = json_decode($setting->details); ?>
                                    <?php $selected_value = (isset($setting->value) && !empty($setting->value)) ? $setting->value : NULL; ?>
                                    <select class="form-control" name="{{ $setting->key }}">
                                        <?php $default = (isset($options->default)) ? $options->default : NULL; ?>
                                        @if(isset($options->options))
                                            @foreach($options->options as $index => $option)
                                                <option value="{{ $index }}" @if($default == $index && $selected_value === NULL){{ 'selected="selected"' }}@endif @if($selected_value == $index){{ 'selected="selected"' }}@endif>{{ $option }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                @elseif($setting->type == "radio_btn")
                                    <?php $options = json_decode($setting->details); ?>
                                    <?php $selected_value = (isset($setting->value) && !empty($setting->value)) ? $setting->value : NULL; ?>
                                    <?php $default = (isset($options->default)) ? $options->default : NULL; ?>
                                    <ul class="radio">
                                        @if(isset($options->options))
                                            @foreach($options->options as $index => $option)
                                                <li>
                                                    <input type="radio" id="option-{{ $index }}" name="{{ $setting->key }}"
                                                            value="{{ $index }}" @if($default == $index && $selected_value === NULL){{ 'checked' }}@endif @if($selected_value == $index){{ 'checked' }}@endif>
                                                    <label for="option-{{ $index }}">{{ $option }}</label>
                                                    <div class="check"></div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                @elseif($setting->type == "checkbox")
                                    <?php $options = json_decode($setting->details); ?>
                                    <?php $checked = (isset($setting->value) && $setting->value == 1) ? true : false; ?>
                                    @if (isset($options->on) && isset($options->off))
                                        <input type="checkbox" name="{{ $setting->key }}" class="toggleswitch" @if($checked) checked @endif data-on="{{ $options->on }}" data-off="{{ $options->off }}">
                                    @else
                                        <input type="checkbox" name="{{ $setting->key }}" @if($checked) checked @endif class="toggleswitch">
                                    @endif
                                @endif

                            </div>
                            @if(!$loop->last)
                                <hr>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right">Save Settings</button>
                    </div>
                    <div class="clearfix"></div>
                </form>

                <div style="clear:both"></div>

                <div class="panel" style="margin-top:10px;">
                    <div class="panel-heading new-setting">
                        <hr>
                        <label>
                            <i class="icon-plus"></i> New Setting
                        </label>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('web.settings.create') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="col-md-4">
                                <label for="display_name">Name</label>
                                <input type="text" class="form-control" name="display_name">
                            </div>
                            <div class="col-md-4">
                                <label for="key">Key</label>
                                <input type="text" class="form-control" name="key">
                            </div>
                            <div class="col-md-4">
                                <label>Type</label>
                                <select name="type" class="form-control">
                                    <option value="text">Text Box</option>
                                    <option value="text_area">Text Area</option>
                                    <option value="rich_text_box">Rich Textbox</option>
                                    <option value="checkbox">Check Box</option>
                                    <option value="radio_btn">Radio Button</option>
                                    <option value="select_dropdown">Select Dropdown</option>
                                    <option value="file">File</option>
                                    <option value="image">Image</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <a id="toggle_options"><i class="voyager-double-down"></i> OPTIONS</a>
                                <div class="new-settings-options">
                                    <label for="options">Options
                                        <small>(optional, only applies to certain types like dropdown box or radio button)
                                        </small>
                                    </label>
                                    <textarea name="details" id="options_textarea" class="form-control"></textarea>
                                    <div id="valid_options" class="alert-success alert" style="display:none">Valid Json</div>
                                    <div id="invalid_options" class="alert-danger alert" style="display:none">Invalid Json</div>
                                </div>
                            </div>
                            
                            <div style="clear:both"></div>
                            <button type="submit" class="btn btn-primary pull-right new-setting-btn">
                                <i class="voyager-plus"></i> Add New Setting
                            </button>
                            <div style="clear:both"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- END PAGE CONTENT INNER -->
</div>

<div class="modal modal-info fade" tabindex="-1" id="edit_modal" role="dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="voyager-edit"></i> Cập nhật phần tử menu</h4>
        </div>
        <form action="{{ route('menus.update_menu_item') }}" id="edit_form" method="POST">
            <div class="modal-body">
                <label for="name">Title</label>
                <input type="text" class="form-control" id="edit_title" name="title" placeholder="Title"><br>
                <label for="url">URL</label>
                <input type="text" class="form-control" id="edit_url" name="url" placeholder="URL"><br>
                <label for="icon_class">Font Icon</label>
                <input type="text" class="form-control" id="edit_icon_class" name="icon_font"
                        placeholder="Icon Class (optional)"><br>
                <label for="icon_class">Css class</label>
                <input type="text" class="form-control" id="edit_css_class" name="css_class"
                        placeholder="Css Class"><br>
                <label for="target">Target</label>
                <select id="edit_target" class="form-control" name="target">
                    <option value="_self" selected="selected">Same Tab/Window</option>
                    <option value="_blank">New Tab/Window</option>
                </select>
                <input type="hidden" name="id" id="edit_id" value="">
            </div>

            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="modal-footer">
                <input type="submit" class="btn btn-success pull-right delete-confirm" value="Update">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal -->

<!-- Delete Modal -->
<div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="voyager-trash"></i>Bạn đồng ý xóa item này?</h4>
        </div>
        <div class="modal-footer">
            <form action="{{ route('menus.delete_menu_item') }}" id="delete_form"
                    method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type="submit" class="btn btn-danger pull-right delete-confirm"
                        value="Đồng ý xóa item này">
            </form>
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Hủy</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal -->
@stop

@push('css-include')

@endpush

@push('css-style')
<style>
    .panel-actions .icon-trash {
        cursor: pointer;
    }

    .panel-actions .icon-trash:hover {
        color: #e94542;
    }

    .panel hr {
        margin-bottom: 10px;
    }

    .panel {
        padding-bottom: 15px;
    }

    .sort-icons {
        font-size: 21px;
        color: #ccc;
        position: relative;
        cursor: pointer;
    }

    .sort-icons:hover {
        color: #37474F;
    }

    .icon-arrow-up, .icon-arrow-down {
        margin-right: 10px;
    }

    .icon-arrow-down {
        top: 10px;
    }

    .page-title {
        margin-bottom: 0;
    }

    .new-setting {
        text-align: center;
        width: 100%;
        margin-top: 20px;
    }

    .new-setting .panel-title {
        margin: 0 auto;
        display: inline-block;
        color: #999fac;
        font-weight: lighter;
        font-size: 13px;
        background: #fff;
        width: auto;
        height: auto;
        position: relative;
        padding-right: 15px;
    }

    #toggle_options {
        clear: both;
        float: right;
        font-size: 12px;
        position: relative;
        margin-top: 15px;
        margin-right: 5px;
        margin-bottom: 10px;
        cursor: pointer;
        z-index: 9;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    textarea {
        min-height: 120px;
    }
    select.form-control {
        display: block;
    }
</style>
@endpush

@push('js-include')
<script src="/admins/assets/js/jsonarea.min.js"></script>
@endpush

@push('js-script')
<script>
    // do the deal
    var myJSONArea = JSONArea(document.getElementById('options_textarea'), {
        sourceObjects: [] // optional array of objects for JSONArea to inherit from
    });

    valid_json = false;

    // then here's how you use JSONArea's update event
    myJSONArea.getElement().addEventListener('update', function (e) {
        if (e.target.value != "") {
            valid_json = e.detail.isJSON;
        }
    });

    myJSONArea.getElement().addEventListener('focusout', function (e) {
        if (valid_json) {
            $('#valid_options').show();
            $('#invalid_options').hide();
            var ugly = e.target.value;
            var obj = JSON.parse(ugly);
            var pretty = JSON.stringify(obj, undefined, 4);
            document.getElementById('options_textarea').value = pretty;
        } else {
            $('#valid_options').hide();
            $('#invalid_options').show();
        }
    });
</script>
<script>
    $('document').ready(function () {
        $('#toggle_options').click(function () {
            $('.new-settings-options').toggle();
            if ($('#toggle_options .voyager-double-down').length) {
                $('#toggle_options .voyager-double-down').removeClass('voyager-double-down').addClass('voyager-double-up');
            } else {
                $('#toggle_options .voyager-double-up').removeClass('voyager-double-up').addClass('voyager-double-down');
            }
        });
    });
</script>
<script>
    $('document').ready(function () {
        $('.icon-trash').click(function () {
            var action = '{{ route('web.settings') }}/' + $(this).data('id'),
                display = $(this).data('display-name') + '/' + $(this).data('display-key');

            $('#delete_setting_title').text(display);
            $('#delete_form')[0].action = action;
            $('#delete_modal').modal('show');
        });

    });
</script>
@endpush