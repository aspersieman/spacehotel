$(document).ready(function() {
    // Activate form validation
    global.genericFormValidation();
    // Validate all appropriate elements
    global.validateAll();

    // Bind a replacement function to the required fields
    global.addConstraints();

    // If the error message is displayed remove it after a while
    $(".err").delay(3200).fadeOut(300);
});
