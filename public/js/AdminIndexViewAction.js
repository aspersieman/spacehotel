$(document).ready(function() {
    $('#slider1').codaSlider({
        autoSlide: false,
        dynamicArrows: false
    });

    $('a[rel*=facebox]').facebox({
        loadingImage : '../public/img/loading.gif',
        closeImage : '../public/img/closelabel.png'
    })
});
