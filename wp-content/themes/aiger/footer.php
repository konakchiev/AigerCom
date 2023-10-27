<?php
?>
<footer>
    <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <?php
                            dynamic_sidebar('footer');
                        ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <?php
                        dynamic_sidebar('footer-second');
                        ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <?php
                        dynamic_sidebar('footer-third');
                        ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <?php
                        dynamic_sidebar('footer-fourth');
                        ?>
                    </div>
                </div>
    </div>
    </footer>
<div class="bottom-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <p>Copyright &copy; 2023 Integral World Wide | All Rights Reserved</p>
            </div>
            <div class="col-lg-6">
                <a href="#">
                    <img class="developedby" src="https://integral.deversity.eu/wp-content/uploads/2023/03/developedby-white.png">
                </a>
            </div>
        </div>
    </div>
</div>

<div class="cookie-bar is-active" data-cookie-bar="">
    <div class="container cookie-bar__container">
        <a class="cookie-bar__logo" href="#"> <img style="width: 40px;" src="https://chris.siberiareal.com/wp-content/uploads/2023/02/Flag_of_the_United_Kingdom_1-2.svg_.webp" class="cookie-bar__logo-image" alt=""> </a>
        <div class="cookie-bar__wrap">
            <div class="cookie-bar__content">
                <p>We use cookies to provide necessary website functionality, improve your experience and analyze our traffic. Please check our <a href="/gdpr.php">Privacy Policy</a>.</p>
            </div>
            <div class="cookie-bar__actions"> <button type="button" class="cookie-bar__button" style="color: #000;" data-close-action=""> OK </button></div>
        </div>
    </div>
</div>
<?php
wp_footer();
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script>
    jQuery(".cookie-bar__button").on("click", function() {
        jQuery.cookie('HideCookieMessage', 'true', { expires: 120, path: '/'});
        jQuery('.cookie-bar').hide();
    });
    (function (jQuery) {
        if (jQuery.cookie('HideCookieMessage')) { jQuery('.cookie-bar').hide(); } else {
            jQuery('.cookie-bar').show(); }
    })(jQuery);
</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script type='text/javascript' src='//cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js'></script>
<script>
    jQuery('.marquee').marquee({
        duration: 15000
    });
</script>
<script type="text/javascript">
    (function($) {        /*        *  new_map        *        *  This function will render a Google Map onto the selected jQuery element        *        *  @type    function        *  @date    8/11/2013        *  @since    4.3.0        *        *  @param    $el (jQuery element)        *  @return    n/a        */        function new_map( $el ) {            // var            var $markers = $el.find('.marker');            // vars            var args = {                zoom        : 16,                center        : new google.maps.LatLng(0, 0),                mapTypeId    : google.maps.MapTypeId.ROADMAP            };            // create map            var map = new google.maps.Map( $el[0], args);            // add a markers reference            map.markers = [];            // add markers            $markers.each(function(){                add_marker( $(this), map );            });            // center map            center_map( map );            // return            return map;        }        /*        *  add_marker        *        *  This function will add a marker to the selected Google Map        *        *  @type    function        *  @date    8/11/2013        *  @since    4.3.0        *        *  @param    $marker (jQuery element)        *  @param    map (Google Map object)        *  @return    n/a        */        function add_marker( $marker, map ) {            // var            var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );            var image = "";            // create marker            var marker = new google.maps.Marker({                position    : latlng,                map            : map,                icon        : image            });            var contentString = "<p></p>";            var infowindow = new google.maps.InfoWindow({                content: contentString,                pixelOffset: new google.maps.Size(0,-80)            });            // add to array            map.markers.push( marker );            infowindow.open(map,marker);            // if marker contains HTML, add it to an infoWindow        }        /*        *  center_map        *        *  This function will center the map, showing all markers attached to this map        *        *  @type    function        *  @date    8/11/2013        *  @since    4.3.0        *        *  @param    map (Google Map object)        *  @return    n/a        */        function center_map( map ) {            // vars            var bounds = new google.maps.LatLngBounds();            // loop through all markers and create bounds            $.each( map.markers, function( i, marker ){                var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );                bounds.extend( latlng );            });            // only 1 marker?            if( map.markers.length == 1 )            {                // set center of map                map.setCenter( bounds.getCenter() );                map.setZoom( 14 );            }            else            {                // fit to bounds                map.fitBounds( bounds );            }        }        /*        *  document ready        *        *  This function will render each map when the document is ready (page has loaded)        *        *  @type    function        *  @date    8/11/2013        *  @since    5.0.0        *        *  @param    n/a        *  @return    n/a        */// global var        var map = null;        $(document).ready(function(){            $('.acf-map').each(function(){                // create map                map = new_map( $(this) );            });        });    })(jQuery);</script></body></html>