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
</body>
</html>