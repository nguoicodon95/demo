@extends('admins.master')

    @section('titleName', 'Danh sách các tiện nghi')

    @section('content')
        <div class="content">
            <div class="container-fluid">
                
                <!-- @include('admins.host._shared.action') -->
                
                <div class="">
                    <div class="fresh-table full-color-orange">
		                <div class="pull-left">
		                	<a href="{{ route('amenities.create') }}" class="btn btn-success">
		                		<i class="ti-plus"></i> Thêm
		                	</a>
		                </div>
	                    <table id="fresh-table" class="table">
	                        <thead>
	                            <th>ID</th>
	                        	<th>Tên</th>
	                        	<th>Mô tả</th>
	                        	<th>Icon</th>
	                        	<th style="width: 150px;">Loại tiện nghi</th>
	                        	<th style="width: 104px;">Hành động</th>
	                        </thead>
	                        <tbody>
	                        @foreach( $amenities as $k => $a )
	                            <tr>
	                            	<td>{{ $k+1 }}</td>
	                            	<td>{{ $a->name }}</td>
	                            	<td>{!! ($a->description != '') ? $a->description : '-' !!}</td>
	                            	<td><span class="icon {{ $a->icon }}"></span></td>
	                            	<td>
										@if($a->types == 'safety')
											<span class="safety">An toàn</span>
										@elseif($a->types == 'normal')
											<span class="normal">Thông thường</span>
										@elseif($a->types == 'location')
											<span class="location">Vị trí</span>
										@elseif($a->types == 'special')
											<span class="special">Nổi bật</span>
										@elseif($a->types == 'space_place')
											<span class="space_place">Không gian</span>
										@elseif($a->types == 'rules')
											<span class="rules">Quy tắc</span>
										@endif
	                            	</td>
	                            	<td>
										<a title="Edit" 
											class="table-action edit" 
											href="{{ route('amenities.edit', $a->id) }}">
											<i class="fa fa-edit"></i>
										</a>
										<a title="Remove" 
											class="table-action remove" 
											href="{{ route('amenities.destroy', $a->id) }}"
											onclick="if(confirm('Bạn đã thật sự muốn xóa mục này!')) {event.preventDefault();
											document.getElementById('delete-form-{{ $a->id }}').submit();}">
											<i class="fa fa-remove"></i>
										</a>
										<form id="delete-form-{{ $a->id }}" action="{{ route('amenities.destroy', $a->id) }}" method="POST">
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