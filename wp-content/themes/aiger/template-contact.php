<?php
/*
Template name: Contact
*/
get_header();
?>

<section class="contact--section2">
    <div class="container">
        <h1>Contact us</h1>
        <p>
            Get in touch with us at anytime. We aim to respond in 24 hours to all inquiries.
        </p>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="row">
                        <div class="col-lg-12">
                            <ion-icon name="location-outline"></ion-icon>
                            <span>Location</span>
                            <h6>Integral Worldwide Ltd., Mulberry Grove
                                Wokingham, RG40 9NN England</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="row">
                        <div class="col-lg-12">
                            <ion-icon name="call-outline"></ion-icon>
                            <span>Call us</span>
                            <h6>+44(0)207.122.4127</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="row">

                        <div class="col-lg-12">
                            <ion-icon name="mail-outline"></ion-icon>
                            <span>Email us</span>
                            <h6>info@integralworldwide.com</h6>
                        </div>
                    </div>
                </div>
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
                        Write us
                    </h2>
                    <p>Don't hesitate. Get your team of professionals now.</p>
                    <?php echo do_shortcode('[contact-form-7 id="40" title="Contact form 1"]'); ?>
                </div>
                <div class="col-lg-6">
                    <h2>Let's help you get started with the best telecom solution for your business.</h2>
                    <img style="margin: 130px 0 0 0;" src="https://integral.deversity.eu/wp-content/uploads/2023/03/Illustration_updated_persons_talking_1050x811.png.webp" alt="">
                </div>
            </div>
        </div>
    </section>
</div>


<?php
get_footer();
?>