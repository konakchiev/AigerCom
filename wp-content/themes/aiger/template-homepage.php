<?php
/*
Template name: Homepage
 */
get_header();
?>


<section class="slider">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1>Integral World Wide</h1>
                <p>
                    Integral Worldwide provides a number of niche telecom carrier services focused primarily on emerging markets.
                </p>
                <a href="" class="btn-primary btn">About</a>
            </div>
            <div class="col-lg-6">
                <img src="/wp-content/uploads/2023/03/Inteliguent-Redesign-Page-78-04-3.png.webp" alt="">
            </div>
        </div>
    </div>
</section>


<section class="first--section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Services</h2>
                <p>Affordable communications and related services where Integral can offer <br>and achieve market and competitive differentiation.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card-new">
                    <ion-icon name="git-network-outline"></ion-icon>
                    <h4>Wholesale voice services</h4>
                    <p>Integral is not a typical A-Z carrier.  Instead, we offer a select number of destinations where we can offer our clients cost effective differentiation.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card-new">
                    <ion-icon name="mail-outline"></ion-icon>
                    <h4>SMS</h4>
                    <p>Integral Worldwide offers wholesale SMS routes based on the needs of enterprise traffic.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card-new">
                    <ion-icon name="wifi-outline"></ion-icon>
                    <h4>Digital products transfer</h4>
                    <p>Integral provides a unique solution to enable “unbanked” consumers the ability to purchase digital products.</p>
                </div>
            </div>
            <a href="/our-services" class="btn mt-5 mx-auto btn-primary">Read More</a>
        </div>
    </div>
</section>


<section class="about--section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h2>Who we are?</h2>
                <p>
                    Integral Worldwide provides a number of niche telecom carrier services focused primarily on emerging markets. Our focus is on affordable communications and related services where Integral can offer and achieve market and competitive differentiation.
                </p>
                <a href="/who-we-are" style="width: 180px;" class="btn btn-primary">View more</a>
                <a href="/our-team" style="width: 180px;" class="btn btn-secondary">Our People</a>
            </div>
            <div class="col-lg-4">
                <img src="https://integral.deversity.eu/wp-content/uploads/2023/03/image_team.png" alt="">
            </div>
        </div>
    </div>
</section>

<div class="container-fluid">
    <section class="contact--section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2>
                        Let's help you get started with the best telecom solution for your business.
                    </h2>
                    <img src="https://integral.deversity.eu/wp-content/uploads/2023/03/two_people_win-together_0.png" alt="">
                </div>
                <div class="col-lg-6">
                    <?php echo do_shortcode('[contact-form-7 id="40" title="Contact form 1"]'); ?>
                    <p class="very-small">By submitting this form you agree to our <a href="#">privacy policy</a>.
                        <br>For more information on how your personal data will be processed, please read our privacy statement.
                        We will not share your information with third parties.</p>
                </div>
            </div>
        </div>
    </section>
</div>


<?php
    get_footer();
?>