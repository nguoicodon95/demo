@extends('admins.master')

    @section('titleName')
        Your listings
    @stop

    @section('content')
        <div class="content">
            <div class="container-fluid">
                
                @include('admins.host._shared.action')
                <h3>Đang hoàn thành</h3>
                <div class="row">
                    @if($listings->count() > 0)
                        @foreach($listings as $listing)
                        <div class="col-md-12">
                            <div class="card">
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
                                            <div style="float: left; margin-right: 15px">
                                                @if($listing->status == 1)
                                                <i class="fa fa-circle text-info"></i> 
                                                @else
                                                <i class="fa fa-circle text-danger"></i>
                                                @endif
                                                <!-- <i class="fa fa-circle text-warning"></i>  -->
                                                <select name="" class="form-control" style="height: 36px; margin: 0">
                                                    <option value="1" {{ $listing->status == 1 ? 'selected' : '' }}>Listed</option>
                                                    <option value="0" {{ $listing->status == 0 ? 'selected' : '' }}>Unlisted</option>
                                                </select>
                                            </div>
                                            <div>
                                                <a href="" class="btn btn-default">Preview</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @stop