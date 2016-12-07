<template id="amenities-choose">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light form-fit">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="amenities">
                                <div class="kind">
                                    <div class="increment-btn no-padding">
                                        <label class="h4 text-gray text-normal">
                                            <span>Những tiện nào bạn cung cấp?</span>
                                        </label>
                                        @if($amenities_normal->count() > 0)
                                            @foreach($amenities_normal as $am)
                                                <div class="space-5 amenity-item field">
                                                    <input id="amenities-for-{{ $am->id }}" type="checkbox" 
                                                            class="col-sm-1" value="{{ $am->id }}" 
                                                            name="amenities_id[]"
                                                            {{ $data_Room != '' && $data_Room->amenities->contains($am->id) ? 'checked=checked' : '' }}>
                                                    <div class="pull-right col-sm-11">
                                                        <label for="amenities-for-{{ $am->id }}">
                                                            <span class="text-muted">{{ $am->name }}</span>
                                                        </label>
                                                        <span>&nbsp;</span>
                                                        @if(!is_null($am->description))
                                                            <div class="text-muted">{{ $am->description }}</div>
                                                        @endif
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="kind">
                                    <div class="increment-btn no-padding field">
                                        <label class="h4 text-gray text-normal">
                                            <span>Tiện nghi an toàn</span>
                                        </label>
                                        @if($amenities_safety->count() > 0)
                                            @foreach($amenities_safety as $am)
                                                <div class="space-5 amenity-item">
                                                    <input id="amenities-for-{{ $am->id }}" type="checkbox" 
                                                            class="col-sm-1" value="{{ $am->id }}" 
                                                            name="amenities_id[]"
                                                            {{ $data_Room != '' && $data_Room->amenities->contains($am->id) ? 'checked=checked' : '' }}>
                                                    <div class="pull-right col-sm-11">
                                                        <label for="amenities-for-{{ $am->id }}">
                                                            <span class="text-muted">{{ $am->name }}</span>
                                                        </label>
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
                                                    <span>Cung cấp các yếu tố cần thiết giúp khách cảm thấy như ở nhà tại chỗ của bạn.</span>
                                                </p>
                                                <p>
                                                    <span>Một số máy chủ cung cấp bữa sáng, hoặc chỉ là cà phê và trà. Không ai trong số những điều này là cần thiết, nhưng đôi khi họ thêm một liên lạc tốt đẹp để giúp khách cảm thấy được chào đón.</span>
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

    