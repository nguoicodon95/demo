<?php $filemanager = true; ?>
@extends('admins.build_admin._master')
@section('titleName', 'Files marnager')
@section('content')
    <div class="page-content">
        <div id="elfinder"></div>
    </div>
@stop

@push('css-include')
    <link rel="stylesheet" href="/admins/assets/root/global/plugins/jquery-ui/jquery-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/packages/barryvdh/elfinder/css/elfinder.min.css">
    <link rel="stylesheet" type="text/css" href="/packages/barryvdh/elfinder/css/theme.css">
@endpush


@push('js-include')
    <script src="/packages/barryvdh/elfinder/js/elfinder.min.js"></script>
@endpush

@push('js-script')
    <script type="text/javascript" charset="utf-8">
        var baseUrl = '{{ asset('') }}';
        var selectMethod = '{{ Request::get('method', 'standalone') }}';
        var fileType = '{{ Request::get('type', 'image') }}';
        var funcNum = '{{ Request::get('CKEditorFuncNum') }}';

        function getUrlParam(paramName) {
            var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i');
            var match = window.location.search.match(reParam);

            return (match && match.length > 1) ? match[1] : '';
        }

        $(document).ready(function () {
            $('#elfinder').elfinder({
                // set your elFinder options here
                customData: {
                    _token: '{{ csrf_token() }}'
                },
                url: '{{ $url }}',
                @if(Request::get('type', 'image') != 'file')
                onlyMimes: ["image"],
                @endif
                getFileCallback: function (file) {
                    var URL = file.url.replace(baseUrl, '/');
                    if (selectMethod == "ckeditor") {
                        window.opener.CKEDITOR.tools.callFunction(funcNum, URL);
                        window.close();
                    }
                    if (selectMethod == 'standalone') {
                        $modal = window.parent.document.mediaModal;
                        $target = window.parent.document.currentMediaBox;
                        if (fileType == 'file') {
                            $target.find('a .title').html(URL);
                        }
                        else {
                            $target.find('.img-responsive').attr('src', URL);
                        }

                        $target.find('.input-file').val(URL);
                        $modal.find('iframe').remove();
                        $modal.modal('hide');
                    }
                }
            });
        });
    </script>
@endpush
