@extends('admins.build_admin._master')

@section('content')
<div class="page-content">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<!-- BEGIN PAGE TITLE -->
		<div class="page-title">
			<h1>Menu <small>create new menu</small></h1>
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
            Menu
		</li>
	</ul>
	<!-- END PAGE BREADCRUMB -->
	<!-- BEGIN PAGE CONTENT INNER -->
	<div class="row">
        <div class="col-md-4">
            <div class="portlet light form-fit" data-type="custom-link">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-layers font-dark"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Custom link</span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="reload" data-original-title="" title=""></a>
                        <a href="javascript:;" class="collapse" data-original-title="" title=""></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('menus.add_item') }}" method="post" class="form-horizontal form-bordered">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label">
                                        <b>Title</b>
                                    </label>
                                    <input required type="text" name="title"
                                        class="form-control"
                                        value=""
                                        autocomplete="off">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label">
                                        <b>Url</b>
                                    </label>
                                    <input type="text" class="form-control" placeholder="" value="" name="url"
                                        autocomplete="off">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label">
                                        <b>Css class</b>
                                    </label>
                                    <input type="text" class="form-control" placeholder="" value="" name="css_class"
                                        autocomplete="off">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label"><b>Icon font class</b></label>
                                    <input type="text" class="form-control" placeholder="" value="" name="icon_font"
                                        autocomplete="off">
                                </div>
                            </div>
                            @if(isset($menu))
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                            @endif 
                            <div class="form-group last">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-primary add-item"
                                            type="submit">
                                        <i class="fa fa-plus"></i> Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="portlet light form-fit" data-type="custom-link">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-layers font-dark"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Edit menu</span>
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
                    <form action="{{ $menu->exists ? route('menus.update', $menu->id) : route('menus.store') }}" class="form-horizontal form-bordered" method="post">
                        {{ csrf_field() }}
                        {{ method_field($menu->exists ? 'PUT' : 'POST') }}

                        <div class="form-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label">
                                        <b>Title</b>
                                        <span class="required">*</span>
                                    </label>
                                    <input  type="text" name="name" class="form-control" value="{{ $menu->name or '' }}"
                                        autocomplete="off">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label">
                                        <b>Alias</b>
                                        <span class="required">*</span>
                                    </label>
                                    <input  type="text" name="slug"
                                        class="form-control"
                                        value="{{ $menu->slug or '' }}"
                                        autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label">
                                        <b>Status</b>
                                        <span class="required">*</span>
                                    </label>
                                    <select name="status" class="form-control">
                                        <option value="activated" {{ isset($menu) && $menu->status == 'activated' ? 'selected' : '' }}>Activated</option>
                                        <option value="disabled" {{ isset($menu) && $menu->status == 'disabled' ? 'selected' : '' }}>Disabled</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label">
                                        <b>Menu structure</b>
                                    </label>
                                    <div class="dd" id="nestable-menu" url-order="{{ route('menus.order_item') }}">
                                    @if(isset($menu))
                                        {!! \App\Models\Menu::display($menu->slug, 'admin') !!}
                                    @endif
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

<div class="modal modal-info fade" tabindex="-1" id="edit_modal" role="dialog">
    <div class="modal-dialog">
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
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Delete Modal -->
<div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
    <div class="modal-dialog">
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
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop

@push('css-include')
<link href="/admins/assets/root/global/css/nestable.css" rel="stylesheet" type="text/css">
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

    .dd .item_actions {
        z-index: 9;
        position: relative;
        top: 10px;
        right: 10px;
    }

    .dd .item_actions .edit {
        margin-right: 5px;
        cursor: pointer;
    }

    .dd-item:hover {
        cursor: -webkit-grab;
    }

    .dd-item:active, .dd-item:focus {
        cursor: -webkit-grabbing;
    }

    .delete-confirm {
        margin-left: 10px;
    }
    .small, small {
        font-weight: normal;
    }
</style>
@endpush

@push('js-include')
<script src="/admins/assets/root/global/plugins/jquery-nestable/jquery.nestable.js" type="text/javascript"></script>
@endpush

@push('js-script')
<script>
    $('#nestable-menu').nestable({}).on('change', function (e) {
        $.post('{{ route('menus.order_item') }}', {
            order: JSON.stringify($('.dd').nestable('serialize')),
            _token: '{{ csrf_token() }}'
        }, function (data) {
        });
    });

    $('.item_actions').on('click', '.edit', function (e) {
        id = $(e.target).data('id');
        $('#edit_title').val($(e.target).data('title'));
        $('#edit_url').val($(e.target).data('url'));
        $('#edit_icon_class').val($(e.target).data('icon_class'));
        $('#edit_css_class').val($(e.target).data('css_class'));
        $('#edit_id').val(id);

        if ($(e.target).data('target') == '_self') {
            $("#edit_target").val('_self').change();
        } else if ($(e.target).data('target') == '_blank') {
            $("#edit_target option[value='_self']").removeAttr('selected');
            $("#edit_target option[value='_blank']").attr('selected', 'selected');
            $("#edit_target").val('_blank');
        }
        $('#edit_modal').modal('show');
    });

    $('.item_actions').on('click', '.delete', function (e) {
        id = $(e.target).data('id');
        $('#delete_form')[0].action += '/' + id;
        $('#delete_modal').modal('show');
    });
</script>
<script>
</script>
@endpush