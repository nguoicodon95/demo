@extends('admins.master')
    <?php  $step_one = true; ?>

    @section('titleName')
        Your listings
    @stop

    @section('content')
        <div class="content">
            <div class="container-fluid">
                @include('admins.host._shared.action')
                <?php
                    if ($data_Room != '' && (isset($data_Room)) && (!empty($data_Room)) ) {
                        $count_bed = $data_Room->count_bed;
                    } elseif ( ($storage_bedroom != null) && (isset($storage_bedroom['count_bed'])) && (isset($storage_bedroom['count_bed'])) ) {
                        $count_bed = $storage_bedroom['count_bed'];
                    } else {
                        $count_bed = 1;
                    }

                    if ($data_Room != '' && (isset($data_Room)) && (!empty($data_Room)) ) {
                        $count_guest = $data_Room->count_guest;
                    } elseif ( ($storage_bedroom != null) && (isset($storage_bedroom['count_guest'])) && (isset($storage_bedroom['count_guest'])) ) {
                        $count_guest = $storage_bedroom['count_guest'];
                    } else {
                        $count_guest = 1;
                    }
                ?>
                <bedrooms link="{{ route('host.bathrooms', $data_Room != '' ? $data_Room->id : '') }}"
                            back="{{ route('host.kindroom', $data_Room != '' ? $data_Room->id : '') }}"
                            count_bed= {{$count_bed}} count_guest= {{$count_guest}}></bedrooms>
            </div>
        </div>

        <template id="bedroom-choose">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ ($data_Room != '') ? route('host.edit.bedrooms', $data_Room->id) : route('host.post.bedrooms') }}" method="POST" id="bedroom-form">
                        {{ csrf_field() }}
                        {{ method_field(($data_Room != '') ? 'PUT' : 'POST') }}
                        <input type="hidden" name="_link" value="@{{ link }}">
                        <div class="bedroom">
                            <div class="panel-title">
                                <h3>How many guests can your place accommodate?</h3>
                            </div>
                            <div class="property">
                                <div class="select__top select-block select-jumbo">
                                    <select id="how-many-bedroom" name="bedroom_count">
                                        <option selected="" value="0" disabled="">Studio</option>
                                        @for( $i = 1; $i <= 8; $i++ )
                                            <option value="{{ $i }}" {{ 
                                                                        ($data_Room != '') && (isset($data_Room)) && (!empty($data_Room)) && ($data_Room->bedroom_count == $i) ? 'selected=selected' :
                                                                        ($storage_bedroom != null) && (isset($storage_bedroom['bedroom_count'])) && ($storage_bedroom['bedroom_count'] == $i) ? 'selected=selected' : null 
                                                                    }}>{{ $i }} bedroom{{ ($i > 1) ? 's' : '' }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="kind">
                                <div class="increment-btn no-padding">
                                    <label class="h4 text-gray text-normal">
                                        <span>How many beds can guests use?</span>
                                    </label>
                                    <div class="increment-btn btn-group no-border-bottom-radius">
                                        <div class="text-gray btn increment-jumbo increment-btn__label increment-btn__label--with-increment-btns" tabindex="0" role="textbox">
                                            <div class="increment-btn__border-container-label text-truncated">
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
                                <div class="select select-block select-jumbo" v-if="oneBed">
                                    <select id="house-type" name="bed_types">
                                        @if($bed_types->count() > 0)
                                            @foreach($bed_types as $bed_type)
                                                <option value="{{ $bed_type->name }}" {{ ($storage_bedroom != null) && (isset($storage_bedroom['bed_types'])) && ($storage_bedroom['bed_types'] == $bed_type->name) ? 'selected=selected' : null }}>{{ $bed_type->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="property">
                            <label class="h4 text-gray text-normal">
                                <span>How many guests can stay?</span>
                            </label>
                            <div class="increment-btn no-padding">
                                <div class="increment-btn btn-group no-border-bottom-radius">
                                    <div class="text-gray btn increment-jumbo increment-btn__label increment-btn__label--with-increment-btns" tabindex="0" role="textbox">
                                        <div class="increment-btn__border-container-label text-truncated">
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
                    </form>
                    <hr>
                    <div>
                        <a href="@{{ back }}" class="back-process">
                            <i class="ti-arrow-left"></i>
                            <span>Back</span>
                        </a>
                        <a href="@{{ link }}" 
                            class="pull-right btn btn-large btn-progress-next btn-large__next-btn pull-right-md btn-primary"
                            onclick="event.preventDefault();
                                        document.getElementById('bedroom-form').submit();">
                            <div class="btn-progress-next__text">
                                <span>Next</span>
                            </div>
                        </a>
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
                                            <span>Guests will rent the entire place. Includes in-law units.The number and type of beds you have determines how many guests can stay comfortably.</span>
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