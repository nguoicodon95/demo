<template id="photos_tp">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light form-fit">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="photos">
                                <div class="kind">
                                    @if($data_Room != '' && !empty($data_Room->photo_room))
                                    @foreach($data_Room->photo_room as $photo)
                                    <div class="select-media-box">
                                        <a title="" class="show-add-media-popup">
                                            <img src="{{ $photo->name }}" alt="Thumbnail" class="img-responsive">
                                        </a>
                                        <input type="hidden" name="photo[]" value="{{ $photo->name }}" class="input-file">
                                        <a title="" class="remove-image" id-pt="{{ $photo->id }}"><span>&nbsp;</span></a>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="select-media-box">
                                        <a title="" class="show-add-media-popup">
                                            <img src="/admins/assets/img/no-image.png" alt="Thumbnail" class="img-responsive">
                                        </a>
                                        <input type="hidden" name="photo[]" value="" class="input-file">
                                        <a title="" class="remove-image"><span>&nbsp;</span></a>
                                    </div>
                                    <div class="select-media-box">
                                        <a title="" class="show-add-media-popup">
                                            <img src="/admins/assets/img/no-image.png" alt="Thumbnail" class="img-responsive">
                                        </a>
                                        <input type="hidden" name="photo[]" value="" class="input-file">
                                        <a title="" class="remove-image"><span>&nbsp;</span></a>
                                    </div>
                                    <div class="select-media-box">
                                        <a title="" class="show-add-media-popup">
                                            <img src="/admins/assets/img/no-image.png" alt="Thumbnail" class="img-responsive">
                                        </a>
                                        <input type="hidden" name="photo[]" value="" class="input-file">
                                        <a title="" class="remove-image"><span>&nbsp;</span></a>
                                    </div>
                                    @endif
                                    <div style="display: flex" class="addbxphoto" @click="addbxthumb">
                                        <a href="#">Thêm ảnh</a>
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
        .select-media-box {
            margin: 0 24px;
        }
        .select-media-box, .select-media-box img  {
            width: 270px;
            height: 200px;

        }
        .addbxphoto {
            margin: 24px;
            width: 273px;
        }
        .addbxphoto a {
            padding: 24px;
            border: 1px solid #e5e5e5;
        }
    </style>
</template>