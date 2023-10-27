<?php
/*
Template name: FAQ
*/
get_header();
?>

    <section class="people--section text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Our People</h1>
                    <p>
                        Check our dedicated team of professionals with more than 200+ years of combined experience.
                    </p>
                    <a href="/contact" style="width: 180px;" class="btn btn-primary">Contact us</a>
                </div>
            </div>
        </div>
    </section>

    <section class="faq--first">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <img src="/wp-content/uploads/2023/04/20190305_083247-3.webp" alt="">
                        <div class="card-content">
                            <h4>
                                Richard Van Den Bergh
                            </h4>
                            <p>Over 40 years business experience, over 20 years in telecoms and technology and over 20 years as an investor and board member.
                                Hutchison 3G ("3"), EnQii PLC, Palace Ventures, Oracle Tanker Chartering, InterMatrix Group, Battelle, Arthur Anderson </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <img src="/wp-content/uploads/2023/04/M-Boyd-2.webp" alt="">
                        <div class="card-content">
                            <h4>
                                Michael Boyd
                            </h4>
                            <p>Over 40 years business and entrepreneurial experience.
                                Lombard, NTL, Hutchinson 3G ("3"), Octopus Inc.
                                Representing Integral in the U.S.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <img src="/wp-content/uploads/2023/04/HM-Photo.webp" alt="">
                        <div class="card-content">
                            <h4>
                                Haider Mawji
                            </h4>
                            <p>Over 30 years business and entrepreneurial  experience with over 20 years in telecoms .
                                iCard Mobile, iCX, Redstone</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <img src="/wp-content/uploads/2023/04/IMG_20190224_191226.webp" alt="">
                        <div class="card-content">
                            <h4>
                                Christopher Spicer
                            </h4>
                            <p>Over 30 years telecoms experience.
                                Interoute, Vodafone,
                                Cable and Wireless</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <img src="/wp-content/uploads/2023/04/passport-pic-2_edited.webp" alt="">
                        <div class="card-content">
                            <h4>
                                Amrit Chana
                            </h4>
                            <p>Over 20 years  telecoms experience.
                                iCX Europe, Symmetry Networks Ltd.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <img src="/wp-content/uploads/2023/04/Roger-Biddlecom_edited.webp" alt="">
                        <div class="card-content">
                            <h4>
                                Rodger Biddlecombe
                            </h4>
                            <p>Over 30 years experience in accountancy serving multiple successful entrepreneurs</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <img src="/wp-content/uploads/2023/04/joha.webp" alt="">
                        <div class="card-content">
                            <h4>
                                Johanna Sanchez
                            </h4>
                            <p>Over 15 years telecoms experience . Vox Communications, Stonehenge Telecom, Fusion Telecommunications Intl.
                                Representing  Integral in the U.S.</p>
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
                            Let's help you get started with the best telecom solution for your business.
                        </h2>
                        <img src="/wp-content/uploads/2023/03/two_people_win-together_0.png" alt="">
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