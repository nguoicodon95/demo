@extends('admins.build_admin._master')
@section('titleName', 'List Menu')
@section('content')
<div class="page-content">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<!-- BEGIN PAGE TITLE -->
		<div class="page-title">
			<h1>Menu management</h1>
		</div>
		<!-- END PAGE TITLE -->
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE BREADCRUMB -->
	<ul class="page-breadcrumb breadcrumb">
		<li>
			<a href="javascript:;">Home</a><i class="fa fa-circle"></i>
		</li>
		<li class="active">
			Menu
		</li>
	</ul>
	<!-- END PAGE BREADCRUMB -->
	<!-- BEGIN PAGE CONTENT INNER -->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PORTLET-->
			<div class="portlet box blue-hoki">
				<div class="portlet-title">
					<div class="caption">
						<a href="{{ route('menus.create') }}" class="btn btn-default btn-sm">
							<i class="fa fa-globe"></i>
							create new menu
						</a>
					</div>
					<div class="tools">
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover" id="init_table">
					<thead>
					<tr>
						<th>
							ID
						</th>
						<th>
							Name
						</th>
						<th>
							Alias
						</th>
						<th>
							Count item
						</th>
						<th>
							Action
						</th>
					</tr>
					</thead>
					<tbody>
					@foreach($menus as $menu)
					<tr>
						<td>
							{{ $menu->id }}
						</td>
						<td>
							{{ $menu->name }}
						</td>
						<td>
							{{ $menu->slug }}
						</td>
						<td>
							{{ $menu->items->count() }}
						</td>
						<td>
							<a href="{{ route('menus.builder', $menu->id) }}" class="btn btn-sm btn-primary edit">
								<i class="fa fa-pencil"></i> Edit
							</a>
							<div class="btn btn-sm btn-danger delete" data-id="{{ $menu->id }}">
								<i class="fa fa-trash"></i> Delete
							</div>
						</td>
					</tr>
					@endforeach
					</tbody>
					</table>
				</div>
			</div>
			<!-- END PORTLET-->
		</div>
	</div>
	<!-- END PAGE CONTENT INNER -->
</div>
<!-- DELETE MODAL -->
<div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">
					<i class="voyager-trash"></i> Hãy cân nhắc trước khi xóa menu!
				</h4>
			</div>
			<div class="modal-footer">
				<form action="{{ route('menus.delete') }}" id="delete_form" method="POST">
					{{ csrf_field() }}
                    {{ method_field('DELETE') }}
					<input type="submit" class="btn btn-danger pull-right delete-confirm" value="Đồng ý xóa">
				</form>
				<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Hủy</button>
			</div>
		</div>
	</div>
</div>
@stop

@push('css-include')
<link rel="stylesheet" type="text/css" href="/admins/assets/root/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="/admins/assets/root/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="/admins/assets/root/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
<link rel="stylesheet" type="text/css" href="/admins/assets/root/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
@endpush

@push('css-style')
<style>
.delete-confirm {
	margin-left: 10px;
}
</style>
@endpush

@push('js-include')
<script type="text/javascript" src="/admins/assets/root/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="/admins/assets/root/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/admins/assets/root/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="/admins/assets/root/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="/admins/assets/root/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="/admins/assets/root/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script src="/admins/assets/root/admin/pages/scripts/table-advanced.js"></script>
@endpush

@push('js-script')
<script>
jQuery(document).ready(function() {    
  	TableAdvanced.init();

	$('td').on('click', '.delete', function (e) {
		id = $(e.target).data('id');

		$('#delete_form')[0].action += '/' + id;

		$('#delete_modal').modal('show');
	});
});

</script>
@endpush