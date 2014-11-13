$(document).ready(function () {
    $('menu>a').fadeOut(0);
    
    $('.burger').hover(function () {
        $('menu>a').fadeIn('fast');
    });
    $('menu').mouseleave(function () {
        $('menu>a').fadeOut('fast');
    });
});