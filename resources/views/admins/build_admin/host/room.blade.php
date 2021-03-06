@extends('admins.build_admin._master')

@section('titleName', 'Danh sách các phòng đã đăng')

@section('content')
      <div class="page-content">
        <!-- BEGIN PAGE HEAD -->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Room </h1>
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
                Room
            </li>
        </ul>
        
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-layers font-dark"></i>
                            <span class="caption-subject font-red-sunglo bold uppercase">Danh sách các phòng đang hoàn thành</span>
                            <span class="caption-helper"></span>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload" data-original-title="" title=""></a>
                            <a href="javascript:;" class="collapse" data-original-title="" title=""></a>
                        </div>
                        <div class="actions">
                            <a href="{{ route('admin.room.create') }}" class="btn btn-default">
                                <i class="ti-marker-alt"></i> Add new listings
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                         @if($listings->count() > 0)
                            @foreach($listings->where('publish', 0) as $listing)
                            <?php
                                $step_1 = $listing->process->step_one;
                                $step_2 = $listing->process->step_two;
                                $step_3 = $listing->process->step_three;
                            ?>
                            @if( $step_1 != 1 || $step_2 != 1 || $step_3 != 1 )
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="content">
                                        <div class="img-cover col-md-4" align="center">
                                            <a href="{{ route('admin.room.create', $listing->id) }}">
                                                <img  src="{{ !empty($listing->photo_room->first()->name) ? asset($listing->photo_room->first()->name) : 'http://www.residenceilpolaresco.it/wp-content/uploads/2015/06/background.jpg' }}" alt="">
                                            </a>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="header" style="padding: 0;">
                                                <h4 class="title">
                                                    <a href="{{ route('admin.room.create', $listing->id) }}">
                                                        @if($listing->title != '')
                                                            {{ $listing->title }}
                                                        @else
                                                            {{ $listing->kind->name }} in {{ $listing->place_room->city }}
                                                        @endif
                                                    </a>
                                                </h4>
                                                <p class="category">{{ $listing->place_room->city .', '. $listing->place_room->country }}</p>
                                            </div>

                                            <div class="footer">
                                                <div class="stats">
                                                    <i class="ti-timer"></i> Lần cập nhật cuối cùng: {{ $listing->updated_at }}
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="preview">
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-layers font-dark"></i>
                            <span class="caption-subject font-green-sharp bold uppercase">Danh sách các phòng đang hiển thị</span>
                            <span class="caption-helper"></span>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload" data-original-title="" title=""></a>
                            <a href="javascript:;" class="collapse" data-original-title="" title=""></a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="init_table">
                            <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th></th>
                                    <th>
                                        Tên phòng
                                    </th>
                                    <th>
                                        Địa chỉ
                                    </th>
                                    <th>
                                        Hiển thị
                                    </th>
                                    <th>
                                        Là nổi bật
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($listings->count() > 0)
                                @foreach($listings as $k => $listing)
                                    <?php
                                        $step_1 = $listing->process->step_one;
                                        $step_2 = $listing->process->step_two;
                                        $step_3 = $listing->process->step_three;
                                    ?>
                                    @if( $step_1 == 1 && $step_2 == 1 && $step_3 == 1 )
                                    <tr>
                                        <td>{{ $k+1 }}</td>
                                        <td>
                                            <div class="thumb">
                                                <img src="{{ !empty($listing->photo_room->first()->name) ? asset($listing->photo_room->first()->name) : '' }}" alt="">
                                            </div>
                                        </td>
                                        <td>{{ $listing->title }}</td>
                                        </td>
                                        <td>{{ $listing->place_room->city .', '. $listing->place_room->country }}</td>
                                        <td>
                                            <form action="{{ route('host.active', $listing->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}
                                                <select name="active" class={{ $listing->publish == 1 ? "pb" : "unpb" }}>
                                                    <option value="1" {{ $listing->publish == 1 ? 'selected' : '' }}>Hiển thị</option>
                                                    <option value="0" {{ $listing->publish == 0 ? 'selected' : '' }}>Không hiển thị</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('host.status', $listing->id) }}" class="status-update" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}
                                                @if($listing->status == 1)
                                                    <input type="hidden" value=0 name="status">
                                                    <button class="btn-hidden">
                                                        <img src="/admins/assets/img/check-mark.png" alt="Là nổi bật" width=50>
                                                    </button>
                                                @else
                                                    <input type="hidden" value=1 name="status">
                                                    <button class="btn-hidden">
                                                        <span>-</span>
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.room.create', $listing->id) }}" class="btn btn-circle btn-sm btn-default edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <form style="display: -webkit-inline-box;" action="{{ route('admin.room.delete', $listing->id) }}" id="delete_form" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button onclick="return confirm('Bạn muốn xóa listing này?')" class="btn btn-circle btn-sm btn-default delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>

@stop

@push('css-style')
    <style>
        .thumb {
            width: 100px;
            max-height: 100px;
            overflow: hidden;
            margin: 0 auto;
        }
        .thumb img {
            max-width: 100%;
            max-height: 100%;
        }
        .pb, .unpb {
            padding: 3px 5px;
            font-size: 12px;
            border-radius: 3px;
            color: #fff;
        }
        .pb {
            border-color: #9cdb34;
            background: rgb(111, 190, 0);
        }
        .unpb {
            background-color: #d9534f;
            border-color: #d43f3a;
        }
        .btn-hidden {
            background: transparent;
            border: 0;
        }
        .edit {
            color: blue;
        }
        .delete {
            color: red;
        }
    </style>
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
    
    $('select[name=active]').change(function () {
        var form = $(this).parent();
        var url = form.attr('action');
        $.ajax({
            method: 'post',
            url: url,
            data: form.serializeArray(),
            success: function () {
                location.reload();
            }
        })
    })

    $('.status-update').submit(function(e) {
        e.preventDefault();
        var frmData = $(this).serializeArray();
        var url = $(this).attr('action');
        $.ajax({
            method: 'post',
            url: url,
            data: frmData,
            success: function () {
                location.reload();
            }
        }) 
    })
});

</script>
@endpush