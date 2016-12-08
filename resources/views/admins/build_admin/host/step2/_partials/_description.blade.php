<template id="description_tp">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light form-fit">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="bedroom">
                                <div class="kind">
                                    <textarea autofocus="true"
                                            class="input input-block input-jumbo lys-summary-form__texterea"
                                            id="description" name="description">{{ ($data_Room != '') ? $data_Room->description : '' }}</textarea>
                                    <strong>
                                        <span class="lys-input__remaining-char-count text-muted text-small">500</span>
                                    </strong>
                                </div>
                            </div>
                            <div class="kind">
                                <div class="increment-btn no-padding field">
                                    <label class="h4 text-gray text-normal mar-top-25 mar-bot-25">
                                        <span>Vị trí thích hợp cho</span>
                                    </label>
                                    @if(isset($amenities_spaces) && $amenities_spaces->count() > 0)
                                        @foreach($amenities_spaces as $am_space)
                                            <div class="space-5 amenity-item">
                                                <input id="amenities-for-{{ $am_space->id }}" type="checkbox" 
                                                    class="" value="{{ $am_space->id }}" 
                                                    name="amenities_id[]"
                                                    {{ $data_Room != '' && $data_Room->amenities->contains($am_space->id) ? 'checked=checked' : '' }}>
                                                <div class="pull-right col-sm-11">
                                                    <label for="amenities-for-{{ $am_space->id }}">
                                                        <span class="text-muted">{{ $am_space->name }}</span>
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
                        <div class="col-md-5">
                            <div class="help-panel-container">
                                <div class="hide-sm help-panel panel">
                                    <div class="panel-body">
                                        <div class="help-panel__bulb-img space-2"></div>
                                        <div class="help-panel__text">
                                            <div>
                                                <p>
                                                    <span>Đếm chỉ các phòng tắm khách có thể sử dụng.</span>
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

    <!-- Customs style form  -->
    <style>
         .lys-summary-form__texterea {
            -webkit-border-radius: 3px; */
            -moz-border-radius: 3px;
            border-radius: 3px;
            border: solid 1px #dce0e0;
            padding: 20px;
            resize: none;
            outline: 0 solid transparent;
            min-height: 115px;
            overflow: hidden;
            font-size: 18px;
            height: auto;
        }

        .lys-input__remaining-char-count {
            position: absolute;
            top: 8px;
            right: 23px;
            line-height: 1;
            font-size: 12px;
        }
    </style>
</template>