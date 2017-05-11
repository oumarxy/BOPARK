/*!
 * remark (http://getbootstrapadmin.com/remark)
 * Copyright 2016 amazingsurge
 * Licensed under the Themeforest Standard Licenses
 */
(function(document, window, $) {
    'use strict';

    var Site = window.Site;

    $(document).ready(function($) {
        Site.run();
    });


    (function() {
        var defaults = $.components.getDefaults("wizard");
        var options = $.extend(true, {}, defaults, {
            onInit: function() {
                $('#exampleFormContainer').formValidation({
                    framework: 'bootstrap',
                    fields: {
                        username: {
                            validators: {
                                notEmpty: {
                                    message: 'The username is required'
                                }
                            }
                        },
                        password: {
                            validators: {
                                notEmpty: {
                                    message: 'The password is required'
                                }
                            }
                        },
                        number: {
                            validators: {
                                notEmpty: {
                                    message: 'The credit card number is not valid'
                                }
                            }
                        },
                        cvv: {
                            validators: {
                                notEmpty: {
                                    message: 'The CVV number is required'
                                }
                            }
                        }
                    }
                });
            },
            validator: function() {
                var fv = $('#exampleFormContainer').data('formValidation');

                var $this = $(this);

                // Validate the container
                fv.validateContainer($this);

                var isValidStep = fv.isValidContainer($this);
                if (isValidStep === false || isValidStep === null) {
                    return false;
                }

                return true;
            },
            onFinish: function() {
                // $('#exampleFormContainer').submit();
            },
            buttonsAppendTo: '.panel-body'
        });

        $("#exampleWizardFormContainer").wizard(options);
    })();



})(document, window, jQuery);
