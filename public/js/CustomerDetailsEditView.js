this.CustomerDetailsEditView = function() {
    // Check whether the terms and conditions checkbox was checked
    this.validateForm = function() {
        if ($("#chbTermsAndConditions:checked").length == 0) {
            alert ('Please agree to the terms and conditions of this site to continue');
            return false;
        } else {
            return true;
        }
    }

    // Refresh the captcha image 
    this.refreshCaptcha = function() {
        var img = document.images['captchaimg'];
        img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
    }
}
