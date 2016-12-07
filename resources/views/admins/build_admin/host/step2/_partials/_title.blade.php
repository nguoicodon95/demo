<template id="titles_tp">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light form-fit">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="bedroom">
                                <div class="kind">
                                    <input autofocus="true"
                                            class="input input-block input-jumbo lys-summary-form__input"
                                            id="title" name="title" autocomplete="off" placeholder="Tên vị trí của bạn"
                                            value="">
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
        .lys-summary-form__input {
            -webkit-border-radius: 3px; */
            -moz-border-radius: 3px;
            border-radius: 3px;
            border: solid 1px #dce0e0;
            padding: 20px;
            resize: none;
            outline: 0 solid transparent;
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