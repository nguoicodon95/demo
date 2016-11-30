var UINestable = function() {

    var updateOutput = function(e) {
        console.log(JSON.stringify($('.dd').nestable('serialize')));
        var _getlink = $('#nestable-menu').attr('url-order');
        console.log(_getlink)
    };


    return {
        init: function() {
            $('#nestable-menu').nestable({})
                .on('change', updateOutput);
        }

    };

}();