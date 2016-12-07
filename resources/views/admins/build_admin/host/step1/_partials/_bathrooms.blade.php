<template id="bathroom-choose">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light form-fit">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="bedroom">
                                <div class="kind">
                                    <div class="increment-btn no-padding">
                                        <label class="h4 text-gray text-normal">
                                            <span>Có bao nhiêu phòng tắm?</span>
                                        </label>
                                        <div class="clearfix"></div>
                                        <div class="increment-btn btn-group no-border-bottom-radius field">
                                            <div class="text-gray btn increment-jumbo increment-btn__label increment-btn__label--with-increment-btns" tabindex="0" role="textbox">
                                                <div class="increment-btn__border-container-label text-truncated">
                                                    <span class="text-muted"><span>@{{ count_bathroom }} bathroom@{{ (count_bathroom > 1) ? 's' : '' }}</span></span>
                                                    <input type="hidden" value="@{{ count_bathroom }}" name="bathroom_count">
                                                </div>
                                            </div>
                                            <button type="button" @click="updateBathroomDecrement" :disabled="diasableMin" class="btn btn-jumbo increment-btn__decrementer"></button>
                                            <button type="button" @click="updateBathroomIncrement" :disabled="diasableMax" class="btn btn-jumbo increment-btn__incrementer"></button>
                                        </div>
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
        .btn {
            border: 1px solid rgba(0, 0, 0, 0.19);
        }
    </style>
</template>