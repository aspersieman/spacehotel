$(document).ready(function() {
    // Check if at least one room check box is checked
    $("input[name='btnReserve']").click(function(e){
        if ($("input[type='checkbox']:checked").length != 1) {
            alert("Please select only one room.");
            return false;
        }
    });
});
