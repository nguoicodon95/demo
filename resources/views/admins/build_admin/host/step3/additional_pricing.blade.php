@extends('admins.build_admin._master')
@section('titleName', 'Your listings')


    @section('content')
        <div class="page-content">
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Cài đặt host</h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD -->
            <!-- BEGIN PAGE BREADCRUMB -->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="javascript:;">Home</a><i class="fa fa-circle"></i>
                </li>
                <li class="active">
                    Host
                </li>
            </ul>

            <sales link="{{ route('host.rules', $data_Room->id) }}" weekly-discount={{ $weekly_discount != '' ? $weekly_discount : 0 }}
                    monthly-discount={{ $monthly_discount != '' ? $monthly_discount : 0 }}
                    back="{{ route('host.addpricing', $data_Room->id) }}"></sales>
        </div>

        <template id="sales_tp">
            <div class="row">
                <div class="col-md-6">
                <div class="portlet light form-fit">
                        <div class="portlet-body">
                            <div class="col-md-12">
                                <validator name="validatesaleform">
                                    <form action="" method="POST" id="sale-form">
                                        {{ csrf_field() }}
                                        <div class="row" id="address">
                                            <div class="col-md-12">
                                                <h4><span>Giảm giá cho đợt nghỉ dài</span></h4>
                                            </div>
                                            <div class="location col-sm-6">
                                                <label for="weekly-discount" >
                                                    <span>Giảm giá hàng tuần</span>
                                                </label>
                                                <div class="col-md-8 row">
                                                    <input autofocus="true" autocomplete="off" 
                                                        class="input input-block input-jumbo lys-address-form__input"
                                                        id="weekly-discount" name="weekly_discount" type="number" 
                                                        placeholder=""
                                                        v-validate:week="{ max: 100, min: 0 }" 
                                                        :classes="{invalid: 'lys-invalid', valid: ''}"
                                                        v-model="weeklyDiscount">
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="cur text-muted">
                                                        %
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <div class="location col-sm-6">
                                                <label for="monthly-discount" >
                                                    <span>Giảm giá hàng tháng</span>
                                                </label>
                                                <div class="col-md-8 row">
                                                    <input autofocus="true" autocomplete="off" 
                                                        class="input input-block input-jumbo lys-address-form__input"
                                                        id="monthly-discount" name="monthly_discount" type="number" 
                                                        placeholder=""
                                                        v-validate:month="{ max: 100, min: 0 }" 
                                                        :classes="{invalid: 'lys-invalid', valid: ''}"
                                                        v-model="monthlyDiscount">
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="cur text-muted">
                                                        %
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </form>
                                    <hr>
                                    <div>
                                        <a href="@{{ back }}"  class="back-process">
                                            <i class="ti-arrow-left"></i>
                                            <span>Back</span>
                                        </a>
                                        <a v-if="$validatesaleform.valid" href="@{{ link }}"
                                            onclick="event.preventDefault();
                                                    document.getElementById('sale-form').submit();"
                                            class="pull-right btn btn-large btn-progress-next btn-large__next-btn pull-right-md btn-primary" >
                                            <div class="btn-progress-next__text">
                                                <span>Next</span>
                                            </div>
                                        </a>
                                    </div>
                                </validator>
                            </div>
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
                                            <span>Providing the essentials helps guests feel at home in your place</span>
                                        </p>
                                        <p>
                                            <span>Some hosts provide breakfast, or just coffee and tea. None of these things are required, but sometimes they add a nice touch to help guests feel welcome.</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    @stop

    @push('css')
        <style>
            label {
                color: #484848;
            }
            .cur {
                padding: 20px 0;
                margin-top: 3px;
            }
            .text-label {
                padding: 25px 0 0;
            }
        </style>
    @endpush