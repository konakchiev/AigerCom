jQuery(document).ready(function($) {

    jQuery(window).scroll(function() {
        if (jQuery(document).scrollTop() > 200) { // Checks if user reacher the scroll destination of 100 pixels
            jQuery('header').addClass('sticky-top');
            jQuery('header').addClass('sticky-header');
            jQuery('body').css('padding-top', '-97px');
        } else if (jQuery(document).scrollTop() < 150) {
            jQuery('header').removeClass('sticky-top');
            jQuery('header').removeClass('sticky-header');
            jQuery('body').css('padding-top', '0');
        }
    });
});