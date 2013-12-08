$(document).ready(function() {
    $('a[rel*=facebox]').facebox({
        loadingImage : "../public/img/loading.gif",
        closeImage : "../public/img/closelabel.png"
    })

    $("#SUBMIT").click(function(e) {
        return customerdetailsview.validateForm();
    });

    $("#lnkRefreshCaptcha").click(function(e){
        customerdetailsview.refreshCaptcha();
    });
    
});
