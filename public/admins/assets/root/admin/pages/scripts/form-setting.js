var FormSetting = function() {


    return {
        //main function to initiate the module
        init: function() {
            if (!jQuery().bootstrapWizard) {
                return;
            }

            var form = $('#submit_form_setting');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
                    //location
                    description: {
                        required: true
                    },
                    title: {
                        required: true
                    },
                },

                messages: {
                    description: {
                        required: "Mô tả vị trí của bạn"
                    },
                    title: {
                        required: "Tên vị trí của bạn"
                    }
                },

                errorPlacement: function(error, element) { // render error placement for each input type
                    error.insertAfter(element); // for other inputs, just perform default behavior
                },

                invalidHandler: function(event, validator) { //display error alert on form submit   
                    success.hide();
                    error.show();
                    Metronic.scrollTo(error, -200);
                },

                highlight: function(element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function(element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function(label) {
                    if (label.attr("for") == "gender" || label.attr("for") == "payment[]") { // for checkboxes and radio buttons, no need to show OK icon
                        label
                            .closest('.form-group').removeClass('has-error').addClass('has-success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                            .addClass('valid') // mark the current input as valid and display OK icon
                            .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    }
                },

                submitHandler: function(form) {
                    success.show();
                    error.hide();
                    form.submit(function() {
                        repo.remove(form, form.attr('id'));
                    });
                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                }

            });

            var displayConfirm = function() {
                $('#tab4 .form-control-static', form).each(function() {
                    var input = $('[name="' + $(this).attr("data-display") + '"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="' + $(this).attr("data-display") + '"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    } else if ($(this).attr("data-display") == 'payment[]') {
                        var payment = [];
                        $('[name="payment[]"]:checked', form).each(function() {
                            payment.push($(this).attr('data-title'));
                        });
                        $(this).html(payment.join("<br>"));
                    }
                });
            }

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_step_setting')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                // jQuery('li', $('#form_step_setting')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#form_step_setting').find('.button-previous').hide();
                } else {
                    $('#form_step_setting').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#form_step_setting').find('.button-next').hide();
                    $('#form_step_setting').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#form_step_setting').find('.button-next').show();
                    $('#form_step_setting').find('.button-submit').hide();
                }

                Metronic.scrollTo($('.page-title'));
            }
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {});
            // default form wizard
            $('#form_step_setting').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function(tab, navigation, index, clickedIndex) {
                    // return false;
                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }
                    handleTitle(tab, navigation, clickedIndex);
                },
                onNext: function(tab, navigation, index) {
                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }

                    handleTitle(tab, navigation, index);
                },
                onPrevious: function(tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                },
                onTabShow: function(tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_step_setting').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });
            var repo = new FormRepo('restclient');
            // get the last submitted values back
            repo.restore(form, form.attr('id'));
            $('#form_step_setting').find('.button-previous').hide();
            $('#form_step_setting .button-submit').on('click', function() {
                repo.preserve(form, form.attr('id'));
                form.submit();
            }).hide();

            //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
            /*$('#country_list', form).change(function() {
                form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });*/
        }

    };

}();