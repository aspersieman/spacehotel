$(document).ready(function() {
    // Set up the main slider with the content
    $('#slider1').codaSlider({
        autoSlide: false,
        dynamicArrows: false
    });

    // Enable the dialogs 
    $('a[rel*=facebox]').facebox({
        loadingImage : '../public/img/loading.gif',
        closeImage : '../public/img/closelabel.png'
    })
});
