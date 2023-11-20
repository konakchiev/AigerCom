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

    jQuery('.navi a').click(function(event) {
        var id = jQuery(this).attr("href");
        var offset = 70;
        var target = jQuery(id).offset().top - offset;
        jQuery('html, body').animate({
            scrollTop: target
        }, 500);
        event.preventDefault();
    });

    jQuery('.btn').click(function(event) {
        var id = jQuery(this).attr("href");
        var offset = 70;
        var target = jQuery(id).offset().top - offset;
        jQuery('html, body').animate({
            scrollTop: target
        }, 500);
        event.preventDefault();
    });
});