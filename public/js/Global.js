function Global(baseURL) {
    // Form validation collection
    this.validForms = new Array();

    /**
     * Validates a given element based on its value, and given regex it needs
     * to comply with. The appropriate classes will be coupled with the element.
     * 
     * @param object elem
     * @param string value
     * @param pattern regex
     * 
     * @return boolean
     */
    this.validateRegex = function(elem, value, regex) {
        var re = new RegExp(regex);

        if (value === null) {
            $(elem).removeClass('validate_ok');
            $(elem).addClass('validate_error');

            return false;
        }


        if (value.match(re)) {
            $(elem).removeClass('validate_error');
            $(elem).addClass('validate_ok');

            return true;
        } else {
            $(elem).removeClass('validate_ok');
            $(elem).addClass('validate_error');

            return false;
        }
    }

    /**
     * Generic form validation. Loops through all forms and checks if any of the
     * elements within the form contain the 'validate_error' class. If they do, 
     * an error message will be displayed, and the form submit will be canceled.
     * If no 'validate_error' class has been detected, the form can be submitted.
     * 
     * @return boolean
     */
    this.genericFormValidation = function() {
        var formArray = $("form");

        $.each(formArray, function(formKey, formValue) {
            var submit = $(formValue).find("#SUBMIT");
            if (submit.val() != undefined) {
                $(submit).click(function() {
                    var elements = $(formValue).find(".validate_error");
                    if (elements.length > 0) {
                        alert("Validation failure:\nPlease enter all required fields marked with a yellow exclamation mark");
                        return false;
                    }
                });
            }
        });
    }

    this.addConstraintStringCapitalize = function(element) {
        $(element).bind("keyup blur focus", function() {
            return $(this).val($(this).val().replace(/\w\S*/g, function(txt) {
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            }));
        });
    }

    this.addConstraintStringInitialize = function(element) {
        $(element).bind("blur", function() {
            return $(this).val($(this).val().replace(/\w\S*/g, function(txt) {
                return txt.charAt(0).toUpperCase();
            }));
        });
    }

    this.addConstraintInteger = function(element) {
        $(element).keydown(function(event) {
            // Allow: backspace, delete, tab, escape, and enter
            if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
                // Allow: Ctrl+A
                (event.keyCode == 65 && event.ctrlKey === true) ||
                // Allow: Ctrl+V
                (event.keyCode == 86 && event.ctrlKey === true) ||
                // Allow: home, end, left, right
                (event.keyCode >= 35 && event.keyCode <= 39)) {
                    return;
                }
            else {
                // Ensure that it is a number and stop the keypress
                if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                    event.preventDefault();
                }
            }
        });
    }

    this.addConstraintIntegerOrComma = function(element) {
        $(element).keydown(function(event) {
            // Allow: backspace, delete, tab, escape, and enter
            if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
                // Allow: comma
                event.keyCode == 188 ||
                // Allow: Ctrl+A
                (event.keyCode == 65 && event.ctrlKey === true) ||
                // Allow: Ctrl+V
                (event.keyCode == 86 && event.ctrlKey === true) ||
                // Allow: home, end, left, right
                (event.keyCode >= 35 && event.keyCode <= 39)) {
                    return;
                }
            else {
                // Ensure that it is a number and stop the keypress
                if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                    event.preventDefault();
                }
            }
        });
    }

    this.addConstraintFloat = function(element) {
        $(element).keydown(function(event) {
            // Allow: backspace, delete, tab, escape, and enter
            if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || event.keyCode == 188 || event.keyCode == 190 ||
                // Allow: Ctrl+A
                (event.keyCode == 65 && event.ctrlKey === true) ||
                // Allow: Ctrl+V
                (event.keyCode == 86 && event.ctrlKey === true) ||
                // Allow: home, end, left, right
                (event.keyCode >= 35 && event.keyCode <= 39)) {
                    if (event.keyCode == 188 || event.keyCode == 190) {
                        var resultSearch = $(this).val().indexOf(".");
                        if (resultSearch == '-1' && $(this).val() != "") {
                            if (event.keyCode == 188) {
                                $(this).val($(this).val() + ".");
                                return false;
                            } else {
                                return;
                            }
                        } else {
                            return false;
                        }
                    }
                }
            else {
                // Ensure that it is a number and stop the keypress
                if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                    event.preventDefault();
                }
            }
        });
    }

    this.addValidationString = function(element) {
        $(element).bind("keyup blur focus", function() {
            var currentElement = $(this);
            global.validateRegex(currentElement, currentElement.val(), /(^\s*\S.*$)/);
        });
        $(element).trigger("keyup");
    }

    this.addValidationStringOptional = function(element) {
        $(element).bind("keyup blur focus", function() {
            var currentElement = $(this);
            global.validateRegex(currentElement, currentElement.val(), /(^\s*\S.*$)?/);
        });
        $(element).trigger("keyup");
    }

    this.addValidationInteger = function(element) {
        $(element).bind("keyup blur focus", function() {
            var currentElement = $(this);
            global.validateRegex(currentElement, currentElement.val(), /\d+/);
        });
        $(element).trigger("keyup");
    }

    this.addValidationIntegerOptional = function(element) {
        $(element).bind("keyup blur focus", function() {
            var currentElement = $(this);
            global.validateRegex(currentElement, currentElement.val(), /\d*/);
        });
        $(element).trigger("keyup");
    }

    this.addValidationIntegerOrCommaOptional = function(element) {
        $(element).bind("keyup blur focus", function() {
            var currentElement = $(this);
            global.validateRegex(currentElement, currentElement.val(), /^([0-9]+,?)+$/);
        });
        $(element).trigger("keyup");
    }

    this.addValidationFloat = function(element) {
        $(element).bind("keyup blur focus", function() {
            var currentElement = $(this);
            global.validateRegex(currentElement, currentElement.val(), /(^-?([1-9][0-9]*|0)(\.[0-9]*)?$)/);
        });
        $(element).trigger("keyup");
    }

    this.addValidationFloatOptional = function(element) {
        $(element).bind("keyup blur focus", function() {
            var currentElement = $(this);
            global.validateRegex(currentElement, currentElement.val(), /(^([1-9][0-9]*|0)(\.[0-9]*)?$)?/);
        });
        $(element).trigger("keyup");
    }

    this.addValidationDateOptional = function(element) {
        $(element).bind("keyup blur focus change", function() {
            var currentElement = $(this);
            global.validateRegex(currentElement, currentElement.val(), /^((\d{2})\/(\d{2})\/(\d{4}))?$/);
        });
        $(element).trigger("keyup");
    }

    this.addValidationDateRequired = function(element) {
        $(element).bind("keyup blur focus change", function() {
            var currentElement = $(this);
            global.validateRegex(currentElement, currentElement.val(), /^((\d{2})\/(\d{2})\/(\d{4}))+$/);
        });
        $(element).trigger("keyup");
    }

    this.addValidationDateTimeOptional = function(element) {
        $(element).bind("keyup blur focus", function() {
            var currentElement = $(this);
            global.validateRegex(currentElement, currentElement.val(), /^((\d{2})-(\d{2})-(\d{4}) (\d{2}):(\d{2}):(\d{2}))?$/);
        });
        $(element).trigger("keyup");
    }

    this.addValidationTimeShortOptional = function(element) {
        $(element).bind("keyup blur focus", function() {
            var currentElement = $(this);
            global.validateRegex(currentElement, currentElement.val(), /^((\d{2}):(\d{2}))?$/);
        });
        $(element).trigger("keyup");
    }

    this.addValidationTimeShortRequired = function(element) {
        $(element).bind("keyup blur focus", function() {
            var currentElement = $(this);
            global.validateRegex(currentElement, currentElement.val(), /^(\d{2}):(\d{2})?$/);
        });
        $(element).trigger("keyup");
    }


    this.addValidationDateTimeRequired = function(element) {
        $(element).bind("keyup blur focus", function() {
            var currentElement = $(this);
            global.validateRegex(currentElement, currentElement.val(), /^((\d{2})-(\d{2})-(\d{4}) (\d{2}):(\d{2}):(\d{2}))+$/);
        });
        $(element).trigger("keyup");
    }

    this.addValidationEmailOptional = function(element) {
        $(element).bind("keyup blur focus", function() {
            var currentElement = $(this);
            global.validateRegex(currentElement, currentElement.val(), /^([a-zA-Z0-9,!#\$%&'\*\+/=\?\^_`\{\|}~-]+(\.[a-zA-Z0-9,!#\$%&'\*\+/=\?\^_`\{\|}~-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.([a-zA-Z]{2,}))?$/);
            });
        $(element).trigger("keyup");
    }

    this.addValidationEmailRequired = function(element) {
        $(element).bind("keyup blur focus", function() {
            var currentElement = $(this);
            global.validateRegex(currentElement, currentElement.val(), /^[a-zA-Z0-9,!#\$%&'\*\+/=\?\^_`\{\|}~-]+(\.[a-zA-Z0-9,!#\$%&'\*\+/=\?\^_`\{\|}~-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.([a-zA-Z]{2,})$/);
            });
        $(element).trigger("keyup");
    }

    this.addValidationTelephoneNumberOptional = function(element) {
        $(element).bind("keyup blur focus", function() {
            var currentElement = $(this);
            global.validateRegex(currentElement, currentElement.val(), /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}?/);
        });
        $(element).trigger("keyup");
    }

    this.addValidationTelephoneNumberRequired = function(element) {
        $(element).bind("keyup blur focus", function() {
            var currentElement = $(this);
            global.validateRegex(currentElement, currentElement.val(), /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/);
            });
        $(element).trigger("keyup");
    }

    this.addValidationSelectRequired = function(element) {
        $(element).bind("keyup blur focus change", function() {
            if ($(this).hasClass("chosen_select")) {
                // Validate select dropdowns that are chosen jquery select elements
                var currentElement = $("#" + $(this).attr("id") + "_chzn.chzn-container-single .chzn-single div");
                // Find the chzn element div for this select element
                var currentElement = $("#" + $(this).parent().find("div[id$=_chzn]").attr("id") + ".chzn-container-single .chzn-single div");
                var currentElementValue = $(this).chosen().val();
            } else {
                var currentElement = $(this);
                var currentElementValue = currentElement.val();
            }
            global.validateRegex(currentElement, currentElementValue, /(^\s*\S.*$)/);
        });
        $(element).trigger("keyup");
    }

    this.addValidationSelectOptional = function(element) {
        $(element).bind("keyup blur focus change", function() {
            if ($(this).hasClass("chosen_select")) {
                // Validate select dropdowns that are chosen jquery select elements
                var currentElement = $("#" + $(this).attr("id") + "_chzn.chzn-container-single .chzn-single div");
                // Find the chzn element div for this select element
                var currentElement = $("#" + $(this).parent().find("div[id$=_chzn]").attr("id") + ".chzn-container-single .chzn-single div");
                var currentElementValue = $(this).chosen().val();
            } else {
                var currentElement = $(this);
                var currentElementValue = currentElement.val();
            }
            global.validateRegex(currentElement, currentElementValue, /(^\s*\S.*$)?/);
        });
        $(element).trigger("keyup");
    }

    /* 
     * Call all the validation methods
     */
    this.validateAll = function () {
        // Validate integer fields
        this.addValidationFloatOptional('.validate_float_optional');
        this.addValidationFloat('.validate_float');

        // Validate integer fields
        this.addValidationIntegerOptional('.validate_integer_optional');
        this.addValidationInteger('.validate_integer');
        
        // Validate integer or comma fields
        this.addValidationIntegerOrCommaOptional('.validate_integer_or_comma_optional');

        // Validate text fields
        this.addValidationStringOptional('.validate_string_optional');
        this.addValidationString('.validate_string');

        // Validate date fields
        this.addValidationDateOptional('.validate_date_optional');
        this.addValidationDateRequired('.validate_date_required');

        // Validate email fields
        this.addValidationEmailOptional(".validate_email_optional");
        this.addValidationEmailRequired(".validate_email_required");

        // Validate date/time fields
        this.addValidationDateTimeOptional('.validate_datetime_optional');
        this.addValidationDateTimeRequired('.validate_datetime_required');

        // Validate time fields
        this.addValidationTimeShortOptional('.validate_time_optional');
        this.addValidationTimeShortRequired('.validate_time_required');

        // Validate select dropdown lists
        this.addValidationSelectRequired('.validate_select_required');
        this.addValidationSelectOptional('.validate_select_optional');

        // Validate telephone numbers
        this.addValidationTelephoneNumberRequired('.validate_telephone_required');
        this.addValidationTelephoneNumberOptional('.validate_telephone_optional');
    }

    /* 
     * Add all the constraints to all controls
     */
    this.addConstraints = function () {
        global.addConstraintStringInitialize('.constraint_initialize');
        global.addConstraintStringCapitalize('.constraint_capitalize');

        // Bind key hooking code to avoid the alphabet in integer fields
        global.addConstraintInteger('.constraint_integer');

        // Bind key hooking code to avoid the alphabet in integer fields 
        // but also allow commas (for CSV lists)
        global.addConstraintIntegerOrComma('.constraint_integer_or_comma');

        // Bind key hooking code to avoid the alphabet in float fields
        global.addConstraintFloat('.constraint_float');
    }
}
