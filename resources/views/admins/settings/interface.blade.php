@extends('admins.master')

    @section('titleName', 'Danh sách các tiện nghi')

    @section('content')
        <div class="content">
            <div class="container-fluid">
                
                <!-- @include('admins.host._shared.action') -->
                
                <div class="">
                    <div class="fresh-table full-color-orange">
		                <div class="pull-left">
		                	<a href="{{ route('locations.create') }}" class="btn btn-success">
		                		<i class="ti-plus"></i> Thêm
		                	</a>
		                </div>
	                    <table id="fresh-table" class="table">
	                        <thead>
	                            <th>ID</th>
	                        	<th></th>
	                        	<th width="150">Tên</th>
	                        	<th>Mô tả</th>
	                        	<th width="75">Hiển thị</th>
	                        	<th width="75"></th>
	                        </thead>
	                        <tbody>
	                        @foreach( $locations as $k => $a )
	                            <tr>
	                            	<td>{{ $k+1 }}</td>
	                            	<td><img src="{{ asset($a->image) }}" width="150"></td>
	                            	<td>{{ $a->name }}</td>
	                            	<td>{!! ($a->description != '') ? $a->description : '-' !!}</td>
	                            	<td></td>
	                            	<td>
										<a title="Edit" 
											class="table-action edit" 
											href="{{ route('locations.edit', $a->id) }}">
											<i class="fa fa-edit"></i>
										</a>
										<a title="Remove" 
											class="table-action remove" 
											href="{{ route('locations.destroy', $a->id) }}"
											onclick="if(confirm('Bạn đã thật sự muốn xóa mục này!')) {event.preventDefault();
											document.getElementById('delete-form-{{ $a->id }}').submit();}">
											<i class="fa fa-remove"></i>
										</a>
										<form id="delete-form-{{ $a->id }}" action="{{ route('locations.destroy', $a->id) }}" method="POST">
											{{ method_field('DELETE') }}
											{{ csrf_field() }}
										</form>
	                            	</td>
	                            </tr>
	                        @endforeach 
	                        </tbody>
	                    </table>
	                </div>
                </div>
            </div>
        </div>
    @stop

	@push('css')
		<link rel="stylesheet" href="{{ asset('admins/assets/css/jquery.dataTables.css') }}">
		<style>
			.fresh-table {
				overflow: hidden;
			}
			.fixed-table-loading {
				display: none;
			}

			.search input, .columns button {
			    height: 37px;
			    border-radius: 0;
			}

			.normal, .safety, .location, .special, .space_place, .rules {
				padding: 2px 5px;
			    font-size: 13px;
			    border-radius: 2px;
			    color: #FFF;
			}
			.safety {
				background: #e83f0c;
			}
			.normal {
				background: #1c7f16;
			}
			.location {
				background: #377ade;
			}
			.special {
				background: #de373f;
			}
			.space_place {
				background: #37deb0;
			}
			.rules {
			    background: #96005a;
			}
		</style>
	@endpush

    @push('js')
    	<script src="{{ asset('admins/assets/js/jquery.dataTables.js')}}"></script>
		<script type="text/javascript">
	        $(document).ready(function(){
			    $('#fresh-table').DataTable();
			})
	    </script>
    @endpush