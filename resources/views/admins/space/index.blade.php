@extends('admins.master')

    @section('titleName', 'Danh sách các tiện nghi không gian')

    @section('content')
        <div class="content">
            <div class="container-fluid">
                
                <!-- @include('admins.host._shared.action') -->
                
                <div class="">
                    <div class="fresh-table full-color-orange">
		                <div class="pull-left">
		                	<a href="{{ route('spaces.create') }}" class="btn btn-success">
		                		<i class="ti-plus"></i> Thêm
		                	</a>
		                </div>
	                    <table id="fresh-table" class="table">
	                        <thead>
	                            <th data-field="id">ID</th>
	                        	<th data-field="name" data-sortable="true">Tên</th>
	                        	<th data-field="salary" data-sortable="true">Label</th>
	                        	<th data-field="country" data-sortable="true">Mô tả</th>
	                        	<th data-field="city">Icon</th>
	                        	<th data-field="actions">Hành động</th>
	                        </thead>
	                        <tbody>
	                        @foreach( $spaces as $k => $s )
	                            <tr>
	                            	<td>{{ $k+1 }}</td>
	                            	<td>{{ $s->name }}</td>
	                            	<td>{{ $s->label }}</td>
	                            	<td>{!! ($s->description != '') ? $s->description : '-' !!}</td>
	                            	<td><span class="icon {{ $s->icon }}"></span></td>
	                            	<td>
										<a title="Edit" 
											class="table-action edit" 
											href="{{ route('spaces.edit', $s->id) }}">
											<i class="fa fa-edit"></i>
										</a>
										<a title="Remove" 
											class="table-action remove" 
											href="{{ route('spaces.destroy', $s->id) }}"
											onclick="if(confirm('Bạn đã thật sự muốn xóa mục này!')) {event.preventDefault();
											document.getElementById('delete-form-{{ $s->id }}').submit();}">
											<i class="fa fa-remove"></i>
										</a>
										<form id="delete-form-{{ $s->id }}" action="{{ route('spaces.destroy', $s->id) }}" method="POST">
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
		</style>
	@endpush

    @push('js')
    	<script src="{{ asset('admins/assets/js/bootstrap-table.js') }}"></script>
		<script type="text/javascript">
	        var $table = $('#fresh-table'),
	            $slertBtn = $('#alertBtn'),
	            full_screen = false;
	            
	        $().ready(function(){
	            $table.bootstrapTable({
	                showRefresh: false,
	                search: true,
	                showToggle: false,
	                showColumns: false,
	                pagination: true,
	                striped: true,
	                pageSize: 8,
	                pageList: [8,10,25,50,100],
	                
	                formatShowingRows: function(pageFrom, pageTo, totalRows){
	                    //do nothing here, we don't want to show the text "showing x of y from..." 
	                },
	                formatRecordsPerPage: function(pageNumber){
	                    return pageNumber + " rows visible";
	                },
	                icons: {
	                    refresh: 'fa fa-refresh',
	                    toggle: 'fa fa-th-list',
	                    columns: 'fa fa-columns',
	                    detailOpen: 'fa fa-plus-circle',
	                    detailClose: 'fa fa-minus-circle'
	                }
	            });
	            
	                        
	            
	            $(window).resize(function () {
	                $table.bootstrapTable('resetView');
	            });
	            
	        });
	            
	    </script>
    @endpush