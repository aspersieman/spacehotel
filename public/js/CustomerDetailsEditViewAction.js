$(document).ready(function() {
    $('a[rel*=facebox]').facebox({
        loadingImage : '../public/img/loading.gif',
        closeImage : '../public/img/closelabel.png'
    })

    $("#SUBMIT").click(function(e) {
        return customerdetailseditview.validateForm();
    });

    $("#lnkRefreshCaptcha").click(function(e){
        customerdetailseditview.refreshCaptcha();
    });
});
