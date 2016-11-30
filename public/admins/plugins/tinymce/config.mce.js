function setImageValue(url) {
    $('.mce-btn.mce-open').parent().find('.mce-textbox').val(url);
}

$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    tinymce.init({
        menubar: false,
        selector: 'textarea.contentMCE',
        height: 350,
        plugins: 'link, image, code, youtube, giphy',
        extended_valid_elements: 'input[onclick|value|style|type]',
        toolbar: 'styleselect bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image youtube giphy | code',
        convert_urls: false,
        image_caption: true,
        image_title: true,
        file_browser_callback: elFinderBrowser
    });

});

function elFinderBrowser(field_name, url, type, win) {
    tinymce.activeEditor.windowManager.open({
        file: '/admin/elfinder/tinymce4', // use an absolute path!
        title: 'elFinder 2.0',
        width: 900,
        height: 450,
        resizable: 'yes'
    }, {
        setUrl: function(url) {
            win.document.getElementById(field_name).value = url;
        }
    });
    return false;
}