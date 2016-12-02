@extends('admins.build_admin._master')

@section('titleName', 'Danh sách các loại tài sản')

@section('content') 
	<div class="page-content">
		<!-- BEGIN PAGE HEAD -->
		<div class="page-head">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Properties management</h1>
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
				Tài sản
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
							<a href="{{ route('properties.create') }}" class="btn btn-default btn-sm">
								<i class="fa fa-globe"></i>
								create new properties
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
							<th width="200">
								Name
							</th>
							<th width="350">
								Description
							</th>
							<th>
								Action
							</th>
						</tr>
						</thead>
						<tbody>
						@foreach( $properties as $k => $p )
	                            <tr>
	                            	<td>{{ $k+1 }}</td>
	                            	<td>{{ $p->name }}</td>
	                            	<td>{!! ($p->description != '') ? $p->description : '-' !!}</td>
									<td>
										<a href="{{ route('properties.edit', $p->id) }}" class="btn btn-sm btn-primary edit">
											<i class="fa fa-pencil"></i> Edit
										</a>
										<form style="display: -webkit-inline-box;" action="{{ route('properties.destroy', $p->id) }}" id="delete_form" method="POST">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<button onclick="return confirm('Bạn muốn xóa địa điểm này?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
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

@push('css-stype')
@endpush


@push('css-include')
	<link rel="stylesheet" type="text/css" href="/admins/assets/root/global/plugins/select2/select2.css"/>
	<link rel="stylesheet" type="text/css" href="/admins/assets/root/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
	<link rel="stylesheet" type="text/css" href="/admins/assets/root/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
	<link rel="stylesheet" type="text/css" href="/admins/assets/root/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
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
		});
	</script>
@endpush