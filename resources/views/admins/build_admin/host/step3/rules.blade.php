@extends('admins.build_admin._master')
@section('titleName', 'Your listings')


    @section('content')
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Cài đặt host</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="javascript:;">Home</a><i class="fa fa-circle"></i>
                </li>
                <li class="active">
                    Host
                </li>
            </ul>

            <price link="{{ route('host.active', $data_Room->id) }}"
                back="{{ route('host.addpricing', $data_Room->id) }}"></price>
        </div>

        <template id="price_tp">
            <div class="row">
                <div class="col-md-6">
                 <div class="portlet light form-fit">
                    <div class="portlet-body">
                        <div class="col-md-12">
                            <validator name="validatelocationform">
                                <form method="POST" id="highlight-form">
                                    {{ csrf_field() }}
                                    <div>
                                        <div class="panel-title">
                                            <h3>Start building your description</h3>
                                        </div>
                                        <div class="kind">
                                            @if(isset($amenities) && $amenities->count() > 0)
                                                @foreach($amenities as $a)
                                            <div class="space-5 amenity-item">
                                                <input id="amenities-for-{{ $a->id }}" type="checkbox" 
                                                        class="col-sm-1" value="{{ $a->id }}" 
                                                        name="amenities_id[]" {{ $data_Room != '' && $data_Room->amenities->contains($a->id) ? 'checked=checked' : '' }}>
                                                <div class="pull-left col-sm-11">
                                                    <label for="amenities-for-{{ $a->id }}">
                                                        <span>{{ $a->name }}</span>
                                                    </label>
                                                    <span>&nbsp;</span>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                                @endforeach
                                            @endif
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="location package_desc col-sm-12">
                                            <div class="panel-body">
                                                <label for="rules">Thêm quy tắc cho ngôi nhà của bạn</label>
                                                <select multiple class="input input-block input-jumbo lys-address-form__input"
                                                        id="rules" name="rules[]">
                                                    <option value="0" disabled="true">Du khách nên biết những gì khác?</option>
                                                    @if(isset($house_rules))
                                                        @foreach($house_rules as $v_rules)
                                                            <option value="{{ $v_rules }}" selected="true">{{ $v_rules }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                                <hr>
                                <div>
                                    <a href="@{{ back }}"  class="back-process">
                                        <i class="ti-arrow-left"></i>
                                        <span>Back</span>
                                    </a>
                                    <a href="@{{ link }}" 
                                        class="pull-right btn btn-large btn-progress-next btn-large__next-btn pull-right-md btn-primary"
                                        onclick="event.preventDefault();
                                                document.getElementById('highlight-form').submit();">
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
        </template>
    @stop

    @push('css-include')
        <link href="{{ asset('admins/assets/css/select2.css') }}" rel="stylesheet" />
    @endpush
    @push('css-style')
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
            .package_desc {
                border: 1px solid #c4c4c4;
                -webkit-border-radius: 2px;
                -moz-border-radius: 2px;
                border-radius: 2px;
                background-color: #fff;
            }

            .panel-body {
                border-top: 0;
            }
            p {
                font-size: 18px;
                line-height: 1.4em;
                color: #484848;
            }
        </style>
    @endpush
    
    @push('js-include')
        <script src="{{ asset('admins/assets/js/select2.js') }}"></script>
    @endpush
    
    @push('js-script')
        <script>
            $("#rules").select2({
              tags: true
            });
        </script>
    @endpush