<?php
/*
Template name: About
*/
get_header();

?>



    <section style="background: url(https://integral.deversity.eu/wp-content/uploads/2023/03/about-scaled.jpg);" class="about--section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img src="/wp-content/uploads/2023/02/SmallLogo-1-1.png" alt="">
                    <h2>We are Integral</h2>
                    <p>
                        Integral Worldwide provides a number of niche telecom carrier services focused primarily on emerging markets.
                    </p>
                    <a href="/contact" class="btn btn-primary">Talk to Expert <ion-icon name="arrow-forward-outline"></ion-icon></a>
                </div>
                <div class="col-lg-6">
                    <img class="team-integral" src="https://integral.deversity.eu/wp-content/uploads/2023/03/integralteam.png" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="about--first">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>About us</h1>
                    <p>Integral Worldwide provides a number of niche telecom carrier services focused primarily on emerging markets. Our focus is on affordable communications and related services where Integral can offer and achieve market and competitive differentiation.</p>
                    <p>Our business was established in 2014 with the goal of investing in those areas of business where we saw considerable opportunity to improve the existing market. In late 2018, Integral Worldwide took over the wholesale voice operations from existing market leaders to become a fully functioning carrier and we have now launched our own wholesale SMS services.</p>
                    <p>Our focus is on a continuous drive for quality and competitive prices combined with the building of long-term relationships with our partners based on respect and responsiveness to their needs.</p>
                    <p>Our operations are automated with the latest advances in technology whenever practicable to provide accuracy and efficiency 24/7, whilst allowing us to build and scale quickly and safely.Our technology is backed by a team located around the globe   with over a hundred combined years of telecom industry experience.  Each member has years of experience in leading international telecoms combined with a dedication to customer satisfaction and personalised service.</p>
                    <p>Our partners include industry leaders such as Digitalk, iBasis Tata, Message Bird, Nexmo, Pareteum, and other first rate companies worldwide.</p>
                    <a href="/our-services" style="width: 180px;" class="btn btn-secondary">Services <ion-icon name="arrow-forward-outline"></ion-icon></a>
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