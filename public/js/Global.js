function Global(baseURL) {
    // Form validation collection
    this.validForms = new Array();

    this.getDatetimeSettings = function() {
        var settings = {
            showSecond: global.showSecond,
            dateFormat: global.dateFormat,
            timeFormat: global.timeFormat,
            stepHour: global.hourStep,
            stepMinute: global.minuteStep,
            stepSecond: global.secondStep,
            hourGrid: global.hourGrid,
            minuteGrid: global.minuteGrid,
            secondGrid: global.secondGrid
        };

        return settings;
    }

    this.getDateSettings = function() {
        var settings = {
            dateFormat: global.dateFormat,
        };

        return settings;
    }

    this.displaySuccessMessage = function(message) {
        // Get the super container
        var container = $('.current_message_container');
        // Remove the previous error message
        container.find('.success').remove();
        // Clone the message container
        var messageHolder = $('.success').clone();
        // Replace the MESSAGE variable with the actual message variable
        var messageHolderContent = messageHolder.html().replace("MESSAGE", message);
        // Replace the new content with the container with the new content
        messageHolder.html(messageHolderContent);
        // append the cloned message holder to the container
        container.append(messageHolder);
        // Show the super container, and the cloned message container
        messageHolder.slideDown("slow");
        // Attach a delayed actionlistener to close the message box when the user does nothing
        messageHolder.delay(global.messageTimeout).slideUp("slow", function() {
            messageHolder.remove();
        });
        // Attach an actionlistener to the closing button, which is linked to the parent element
        messageHolder.find('.btn').click(function() {
            var removalEl = $(this).parent().parent();
            removalEl.remove();
        });
        // Make the page jump to the error message
        $(document).scrollTop($(".current_message_container").offset().top);
    }

    this.displayWarningMessage = function(message) {
        // Get the super container
        var container = $('.current_message_container');
        // Remove the previous error message
        container.find('.warning').remove();
        // Clone the message container
        var messageHolder = $('.warning').clone();
        // Replace the MESSAGE variable with the actual message variable
        var messageHolderContent = messageHolder.html().replace("MESSAGE", message);
        // Replace the new content with the container with the new content
        messageHolder.html(messageHolderContent);
        // append the cloned message holder to the container
        container.append(messageHolder);
        // Show the super container, and the cloned message container
        messageHolder.slideDown("slow");
        // Attach a delayed actionlistener to close the message box when the user does nothing
        messageHolder.delay(global.messageTimeout).slideUp("slow", function() {
            messageHolder.remove();
        });
        // Attach an actionlistener to the closing button, which is linked to the parent element
        messageHolder.find('.btn').click(function() {
            var removalEl = $(this).parent().parent();
            removalEl.remove();
        });
        // Make the page jump to the error message
        $(document).scrollTop($(".current_message_container").offset().top);
    }

    this.displayErrorMessage = function(message) {
        // Get the super container
        var container = $('.current_message_container');
        if (container.length > 1) {
            container = $(container[container.length - 1]);
            for (var i = 0; i < (container.length - 2); i ++) {
                $(container[i]).remove();
                $(container[i]).find('.error').remove();
            }
        }
        // Remove the previous error message
        container.find('.error').remove();
        // Clone the message container
        var messageHolder = $('.error').clone();
        if (messageHolder.length > 1) {
            messageHolder = $(messageHolder[messageHolder.length - 1]);
            for (var i = 0; i < (messageHolder.length - 2); i ++) {
                $(messageHolder[i]).remove();
                $(messageHolder[i]).find('.error').remove();
            }
        }
        // Replace the MESSAGE variable with the actual message variable
        var messageHolderContent = messageHolder.html().replace("MESSAGE", message);
        // Replace the new content with the container with the new content
        messageHolder.html(messageHolderContent);
        // append the cloned message holder to the container
        container.append(messageHolder);
        // Show the super container, and the cloned message container
        messageHolder.slideDown("slow");
        // Attach a delayed actionlistener to close the message box when the user does nothing
        messageHolder.delay(global.messageTimeout).slideUp("slow", function() {
            messageHolder.remove();
        });
        // Attach an actionlistener to the closing button, which is linked to the parent element
        messageHolder.find('.btn').click(function() {
            var removalEl = $(this).parent().parent();
            removalEl.remove();
        });
        // Make the page jump to the error message
        $(document).scrollTop($(".current_message_container").offset().top);
    }

    /*
     * Displays a growl message error using the blockUI plugin
     */
    this.growlErrorMessage = function(message) {
        $.jGrowl(message, { header: 'Error' });
    }

    /*
     * Displays a growl message using the blockUI plugin
     */
    this.growlMessage = function(message, headertext) {
        if (!headertext) {
            headertext = "Notice";
        }
        $.jGrowl(message, { header: headertext });
    }

    /*
     * While the page is being processed/loading this method can "block"
     * the user from accessing it by dimming the page, showing a message
     * at the top and displaying a loading icon (wheel of death)
     */
    this.blockPage = function(message) {
        $.blockUI({ message: message, css: { 
            border: 'none', 
            color: '#FFFFFF',
            padding: '15px', 
            baseZ: 2000,
            width:"100%",
            height:"100%",
            top: '0%', 
            left: '0%',
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff'
        } 
        }); 

        $(".blockUI.blockMsg.blockPage").addClass("blockui_big_message");
        $('.blockOverlay').click($.unblockUI);
        $('.blockUI').click($.unblockUI);
        $(".blockUI.blockMsg.blockPage").addClass("field_loading_big");
    }

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

    this.getNumberOfDays = function(year, month) {
        var isLeap = ((year % 4) == 0 && ((year % 100) != 0 || (year % 400) == 0));
        return [31, (isLeap ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
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

    this.addSpacer = function(element, position) {
        var filler = $("<div>");
        filler.addClass("spacer");
        filler.css("clear", "both");
        if (position == "before")
            filler.insertBefore(element);
        if (position == "after")
            filler.insertAfter(element);
    }

    this.addBreak = function(element, position) {
        var br = $("<br />");
        if (position == "before")
            br.insertBefore(element);
        if (position == "after")
            br.insertAfter(element);
    }

    this.addDottedLine = function(element, position) {
        var dottedLineElement = $("<div class='spacer_dotted'></div>");
        if (position == "before")
            dottedLineElement.insertBefore(element);
        if (position == "after")
            dottedLineElement.insertAfter(element);
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

    this.jumpToElement = function() {
        var new_position = $('#add_availability_container').offset();
        window.scrollTo(new_position.left, new_position.top);
    }

    this.showPanelStatusHistory = function (entityName, entityId) {
        var dlgStatusLog = $("<div id='divStatusLog'>").dialog({
            modal: true,
            open: function ()
            {
                $("span.ui-dialog-title").addClass("field_loading");
                $("span.ui-dialog-title").width(100);
                $("span.ui-dialog-title").height(16);
                $(this).load(global.getBaseURL() + "/panel/statuslog/name/" + entityName  + "/id/" + entityId);
            },         
            height: 400,
            width: 600,
            title: global.STATUS_LOG_HEADING
        });
        dlgStatusLog.dialog("open");
    }
    
    this.reloadUrl = function (urlString) {
        if (urlString.indexOf("?") == -1) {
            queryStringStart = urlString.length;
        } else {
            queryStringStart = urlString.indexOf("?");
        }
        urlStringBase = urlString.substring(0, queryStringStart) + '?' + Math.round(Math.random() * 1000);
        return urlStringBase;
    }

    this.formatCurrency = function(symbol, amount) {
       aDigits = parseFloat(amount).toFixed(2).split(".");
       aDigits[0] = aDigits[0].split("").reverse().join("").replace(/(\d{3})(?=\d)/g,"$1,").split("").reverse().join("");
       return symbol + aDigits.join(".");
    }

    this.datePickerAvailableDate = function (date, availableDates) {
        dmy = date.getDate() + "-" + (date.getMonth()+1) + "-" + date.getFullYear();
        if ($.inArray(dmy, availableDates) == 1) {
            return [true, "","Available"];
        } else {
            return [false,"","unAvailable"];
        }
    }

    this.openWindow = function(height, width, url) {
        leftOffset = (screen.width/2) - width/2;
        topOffset = (screen.height/2) - height/2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + width + ',height=' + height + ',resizable,scrollbars=yes');
    }
}
