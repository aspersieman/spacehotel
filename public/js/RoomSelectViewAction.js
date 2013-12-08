$(document).ready(function() {
    $("a[rel*=facebox]").facebox({
        loadingImage : "public/img/loading.gif",
        closeImage : "public/img/closelabel.png"
    })

    $("input[name='btnReserve']").click(function(e){
        if ($("input[type='checkbox']:checked").length != 1) {
            alert("Please select only one room.");
            return false;
        }
    });
});
