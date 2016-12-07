<template id="spaces-choose">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light form-fit">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="amenities">
                                <div class="kind">
                                    <div class="increment-btn no-padding field">
                                        <label class="h4 text-gray text-normal">
                                            <span>Không gian khách có thể sử dụng</span>
                                        </label>
                                        @if($spaces->count() >0)
                                            @foreach($spaces as $s)
                                                <div class="space-5 amenity-item">
                                                    <input id="{{ str_slug($s->name) }}" 
                                                        type="checkbox" class="col-sm-1" 
                                                        value="{{ $s->id }}" name="spaces_id[]"
                                                        {{ $data_Room != '' && $data_Room->spaces->contains($s->id) ? 'checked=checked' : '' }}>
                                                    <div class="pull-right col-sm-11">
                                                        <label for="{{ str_slug($s->name) }}">
                                                            <span>{{ $s->name }}</span>
                                                        </label>
                                                        <span>&nbsp;</span>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="help-panel-container">
                                <div class="hide-sm help-panel panel">
                                    <div class="panel-body">
                                        <div class="help-panel__bulb-img space-2"></div>
                                        <div class="help-panel__text">
                                            <div>
                                                <p>
                                                    <span>Không gian nên có trên tài sản. Không bao gồm giặt tự hoặc những nơi gần đó mà không phải là một phần tài sản của bạn. Nếu đó là OK với hàng xóm của bạn, bạn có thể bao gồm một hồ bơi, bồn tắm nước nóng, hoặc không gian chia sẻ khác.</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .amenities .kind .space-5 {
            margin-bottom: 10px;
        }
    </style>
</template>

    