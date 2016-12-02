@extends('admins.master')

    <?php $step_two = true; ?>
    @section('titleName')
        Your listings
    @stop

    @section('content')
        <div class="content">
            <div class="container-fluid">
                @include('admins.host._shared.action')
                <photos image-src="" post_link="{{ route('host.post.photos', $room_ID) }}"
                        back="{{ route('host.title', $data_Room->id) }}" room-id="{{ $room_ID }}"></photos>
            </div>
        </div>
        
        <template id="photos_tp">
            <form action="{{ route('host.post.photos', $room_ID) }}" id="photos-form" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class=" col-md-12" v-if="error!=''">
                        <div class="alert alert-danger">
                            @{{ error }}
                        </div>
                    </div>
                    
                    <div class="col-md-4 image-box" v-for="item in list">
                        <div class="image">
                            <img v-bind:src="item.name" alt="">
                        </div>
                        <div class="caption">
                            <input type="text" @blur="updateCaption(item.id)" id="caption-@{{item.id}}" name="caption" v-bind:value="item.caption" placeholder="Thêm lời chú thích">
                        </div>
                        <div class="remove-item">
                            <a @click="deletePhoto(item.id)" href="#">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="Image-input">
                            <div class="Image-input__input-wrapper">
                                <i class="fa fa-cloud-upload"></i>
                                Upload photo
                                <input @change="previewThumbnail" id="image" class="Image-input__input" accept="image/jpg, image/jpeg, image/png, image/gif" name="image" type="file">
                            </div>
                        </div>
                    </div>
                </div>
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
                            document.getElementById('photos-form').submit();">
                    <div class="btn-progress-next__text">
                        <span>Hoàn thành</span>
                    </div>
                </a>
            </div>

        </template>
    @stop

    @push('js')
        <script>
            $(document).ready(function() {
                var text_max = 50;
                $('.lys-input__remaining-char-count').html(text_max);

                $('#title').keyup(function() {
                    var text_length = $('#title').val().length;
                    var text_remaining = text_max - text_length;

                    $('.lys-input__remaining-char-count').html(text_remaining);
                });

            });

        </script>
    @endpush