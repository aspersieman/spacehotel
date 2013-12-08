$(document).ready(function() {
    $("input[name='btnReserve']").click(function(e){
        if ($("input[type='checkbox']:checked").length != 1) {
            alert("Please select only one room.");
            return false;
        }
    });
});
