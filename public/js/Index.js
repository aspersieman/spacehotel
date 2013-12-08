this.Index = function() {
    this.initAttempts = 0;

    this.makeTwoChars = function(inp) {
        return String(inp).length < 2 ? "0" + inp : inp;
    }

    this.initialiseInputs = function() {
        // Clear any old values from the inputs (that might be cached by the browser after a page reload)
        document.getElementById("sd").value = "";
        document.getElementById("ed").value = "";

        // Add the onchange event handler to the start date input
        datePickerController.addEvent(document.getElementById("sd"), "change", this.setReservationDates);
    }

    this.setReservationDates = function(e) {
        // Internet Explorer will not have created the datePickers yet so we poll the datePickerController Object using a setTimeout
        // until they become available (a maximum of ten times in case something has gone horribly wrong)
        try {
            var sd = datePickerController.getDatePicker("sd");
            var ed = datePickerController.getDatePicker("ed");
        } catch (err) {
            if(this.initAttempts++ < 10) setTimeout("setReservationDates()", 50);
            return;
        }

        // Check the value of the input is a date of the correct format
        var dt = datePickerController.dateFormat(this.value, sd.format.charAt(0) == "m");

        // If the input's value cannot be parsed as a valid date then return
        if(dt == 0) return;

        // At this stage we have a valid YYYYMMDD date

        // Grab the value set within the endDate input and parse it using the dateFormat method
        // N.B: The second parameter to the dateFormat function, if TRUE, tells the function to favour the m-d-y date format
        var edv = datePickerController.dateFormat(document.getElementById("ed").value, ed.format.charAt(0) == "m");

        // Set the low range of the second datePicker to be the date parsed from the first
        ed.setRangeLow( dt );

        // If theres a value already present within the end date input and it's smaller than the start date
        // then clear the end date value
        if(edv < dt) {
            document.getElementById("ed").value = "";
        }
    }

    this.removeInputEvents = function() {
        // Remove the onchange event handler set within the function initialiseInputs
        datePickerController.removeEvent(document.getElementById("sd"), "change", this.setReservationDates);
    }

    this.validateForm = function () {
        var x=document.forms["index"]["start"].value;
        if (x==null || x=="")
        {
            alert("you must enter your check in Date(click the calendar icon)");
            return false;
        }
        var y=document.forms["index"]["end"].value;
        if (y==null || y=="")
        {
            alert("you must enter your check out Date(click the calendar icon)");
            return false;
        }
    }
}
