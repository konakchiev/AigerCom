<?php
?>
<footer>
    <div class="container">
                <img src="http://localhost/AigerCom/wp-content/uploads/2023/11/logo-aiger-big.png" class="logo-footer" alt="">
                <div class="row">
                
                    <div class="col-lg-6">
                        <div class="aiger-contact">
                            <h4>Адрес:</h4>
                            <p>гр. Пловдив
<br>ул. Васил Левски 246</p>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1478.12216064585!2d24.735425648560962!3d42.18784327613468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14acd23e265a7edf%3A0xde5eb9c034a004b3!2sAiger%20Engineering!5e0!3m2!1sen!2sbg!4v1700481778753!5m2!1sen!2sbg" width="600" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <?php
                            dynamic_sidebar('footer');
                        ?>
                    </div>
                    <div class="col-lg-6">
                        <div class="aiger-contact social-fot">
                        <h4>Социални мрежи:</h4>
                        <ul>
                            <li>
                                <a href="#">
                                <ion-icon name="logo-facebook"></ion-icon>
</a>
</li>
<li>
                                <a href="#">
                                <ion-icon name="logo-instagram"></ion-icon>
</a>
</li>
<li>
                                <a href="#">
                                <ion-icon name="logo-linkedin"></ion-icon>
</a>
</li>
<li>
                                <a href="#">
                                <ion-icon name="logo-youtube"></ion-icon>
</li>
</ul>
</div>
                        <?php
                            dynamic_sidebar('footer-second');
                        ?>
                    </div>
                </div>
    </div>
    </footer>

    <div class="bottom-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <p></p>
                </div>
                <div class="col-lg-6">
                    <p>@2023 All rights reserved - Aiger Ltd.
<br>Created and Managed By SocialFreaks Ltd.</p>
                </div>
            </div>
        </div>
</div>

<div class="cookie-bar is-active" data-cookie-bar="">
    <div class="container cookie-bar__container">
        <a class="cookie-bar__logo" href="#"> <img style="width: 40px;" src="" class="cookie-bar__logo-image" alt=""> </a>
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
   jQuery("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
    jQuery(e.target)
    .prev()
    .find("i:last-child")
    .toggleClass("fa-minus fa-plus");
});
</script>
</body>
</html>