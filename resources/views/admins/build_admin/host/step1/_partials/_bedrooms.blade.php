<template id="bedroom-choose">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light form-fit">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="bedroom">
                                <div class="property">
                                    <div class="select__top select-block select-jumbo">
                                        <select id="how-many-bedroom" name="bedroom_count">
                                            <option selected="" value="0" disabled="">Studio</option>
                                            @for( $i = 1; $i <= 8; $i++ )
                                                <option value="{{ $i }}" {{ (($data_Room != '') && $data_Room->bedroom_count == $i ) ? 'selected' : '' }}>
                                                    {{ $i }} bedroom{{ ($i > 1) ? 's' : '' }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="kind">
                                    <div class="increment-btn no-padding">
                                        <label class="h4 text-gray text-normal">
                                            <span>Có bao nhiêu giường?</span>
                                        </label>
                                        <div class="clearfix"></div>
                                        <div class="increment-btn btn-group no-border-bottom-radius">
                                            <div class="text-gray btn increment-jumbo increment-btn__label increment-btn__label--with-increment-btns" tabindex="0" role="textbox">
                                                <div class="increment-btn__border-container-label text-truncated field">
                                                    <span class="text-muted">
                                                        <span>
                                                            @{{ count_bed }} bed@{{ (count_bed > 1) ? 's' : '' }}
                                                        </span>
                                                    </span>
                                                    <input type="hidden" value="@{{ count_bed }}" name="bed_count">
                                                </div>
                                            </div>
                                            <button type="button" @click="updateBedDecrement" :disabled="diasableMin" class="btn btn-jumbo increment-btn__decrementer"></button>
                                            <button type="button" @click="updateBedIncrement" :disabled="diasableMax" class="btn btn-jumbo increment-btn__incrementer"></button>
                                        </div>
                                    </div>
                                    <div class="select select-block select-jumbo field" v-if="oneBed">
                                        <select id="house-type" name="bed_types">
                                            @if($bed_types->count() > 0)
                                                @foreach($bed_types as $bed_type)
                                                    <option value="{{ $bed_type->name }}" {{ (($data_Room != '') && $data_Room->bed_types == $bed_type->name ) ? 'selected' : '' }}>{{ $bed_type->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="property">
                                <label class="h4 text-gray text-normal">
                                    <span>Có bao nhiêu khách có thể ở lại?</span>
                                </label>
                                <div class="increment-btn no-padding">
                                    <div class="increment-btn btn-group no-border-bottom-radius">
                                        <div class="text-gray btn increment-jumbo increment-btn__label increment-btn__label--with-increment-btns" tabindex="0" role="textbox">
                                            <div class="increment-btn__border-container-label text-truncated field">
                                                <span class="text-muted"><span>@{{ count_guest }} guest@{{ (count_guest > 1) ? 's' : '' }}</span></span>
                                                <input type="hidden" value="@{{ count_guest }}" name="guest_count">
                                            </div>
                                        </div>
                                        <button type="button" @click="updateGuestDecrement" :disabled="diasableGuestMin" class="btn btn-jumbo increment-btn__decrementer" disabled="">
                                        </button>
                                        <button type="button" @click="updateGuestIncrement" :disabled="diasableGuestMax" class="btn btn-jumbo increment-btn__incrementer">
                                        </button>
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
                                                    <span>Số lượng và loại giường bạn đã xác định có bao nhiêu khách có thể ở thoải mái.</span>
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
        .btn {
            border: 1px solid rgba(0, 0, 0, 0.19);
        }
    </style>
</template>