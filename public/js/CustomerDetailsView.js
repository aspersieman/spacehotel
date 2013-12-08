this.CustomerDetailsView = function() {
    // Check whether the terms and conditions checkbox is checked
    this.validateForm = function()
    {
        if ($("#chbTermsAndConditions:checked").length == 0) {
            alert ('Please agree to the terms and conditions of this hotel to continue');
            return false;
        } else {
            return true;
        }
    }

    // Refresh the captcha image content
    this.refreshCaptcha = function() {
        var img = document.images['captchaimg'];
        img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
    }
}
