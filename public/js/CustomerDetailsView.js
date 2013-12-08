this.CustomerDetailsView = function() {
    this.showHide = function(shID) {
        if (document.getElementById(shID)) {
            if (document.getElementById(shID+'-show').style.display != 'none') {
                document.getElementById(shID+'-show').style.display = 'none';
                document.getElementById(shID).style.display = 'block';
            }
            else {
                document.getElementById(shID+'-show').style.display = 'inline';
                document.getElementById(shID).style.display = 'none';
            }
        }
    }

    this.validateForm = function()
    {
        if ($("#chbTermsAndConditions:checked").length == 0) {
            alert ('Please agree to the terms and conditions of this hotel to continue');
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
