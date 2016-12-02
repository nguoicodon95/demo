@extends('admins.build_admin._master')

@section('content')
<div class="page-content">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<!-- BEGIN PAGE TITLE -->
		<div class="page-title">
			<h1>Pages management</h1>
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
			Page
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
						<a href="{{ route('pages.create') }}" class="btn btn-default btn-sm">
							<i class="fa fa-globe"></i>
							create new page
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
							Template
						</th>
						<th>
							Status
						</th>
						<th>
							Action
						</th>
					</tr>
					</thead>
					<tbody>
					@foreach($pages as $page)
					<tr>
						<td>
							{{ $page->id }}
						</td>
						<td>
							{{ $page->title }}
						</td>
						<td>
							{{ $page->slug }}
						</td>
						</td>
						<td>
							{{ $page->template }}
						</td>
						<td>
							{{ $page->status }}
						</td>
						<td>
							<a href="{{ route('pages.edit', $page->id) }}" class="btn btn-sm btn-primary edit">
								<i class="fa fa-pencil"></i> Edit
							</a>
							<form style="display: -webkit-inline-box;" action="{{ route('pages.destroy', $page->id) }}" id="delete_form" method="POST">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<button onclick="return confirm('Bạn muốn xóa page này?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
							</form>
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