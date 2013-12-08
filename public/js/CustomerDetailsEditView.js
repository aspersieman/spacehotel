this.CustomerDetailsEditView = function() {
    this.validateForm = function() {
        if ($("#chbTermsAndConditions:checked").length == 0) {
            alert ('Please agree to the terms and conditions of this site to continue');
            return false;
        } else {
            return true;
        }
    }

    this.refreshCaptcha = function() {
        var img = document.images['captchaimg'];
        img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
    }
}
