var FormRepo = function(namespace) {
    this.N = namespace + '.' + window.location.pathname;
};
$.extend(FormRepo.prototype, {
    namespace: function(key) {
        return this.N + '.' + key;
    },
    preserve: function($form, iden) {
        var data = $form.serializeArray();

        localStorage.setItem(this.namespace('form.' + (iden || $form.index())), JSON.stringify(data));
    },
    restore: function($form, iden) {
        var data = localStorage.getItem(this.namespace('form.' + (iden || $form.index())));
        if (null == data || $.isEmptyObject(data)) return; // nothing to do

        $.each(JSON.parse(data), function(i, kv) {
            var $input = $form.find('[name="' + kv.name + '"]');

            if ($input.is(':checkbox') || $input.is(':radio')) {
                $input.filter(function() {
                    if ($(this).val() == kv.value)
                        $(this).parent().addClass('checked')
                    return $(this).val() == kv.value;
                }).first().attr('checked', 'checked');
            } else {
                $input.val(kv.value);
            }
        });
    },
    remove: function($form, iden) {
        localStorage.removeItem(this.namespace('form.' + (iden || $form.index())));
    },
    all: function() {
        var allData = {};
        for (var i = 0, l = localStorage.length; i < l; i++) {
            allData[localStorage.key(i)] = localStorage.getItem(localStorage.key(i));
        }
        return allData;
    }
});