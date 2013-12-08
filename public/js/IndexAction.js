$(document).ready(function() {
    $('#slider1').codaSlider({
        autoSlide: false,
        autoHeight:false,
        dynamicArrows: false
    });

    datePickerController.addEvent(window, 'load', index.initialiseInputs);
    datePickerController.addEvent(window, 'unload', index.removeInputEvents);

    $('a[rel*=facebox]').facebox({
        loadingImage : 'public/img/loading.gif',
        closeImage : 'public/img/closelabel.png'
    })
});
