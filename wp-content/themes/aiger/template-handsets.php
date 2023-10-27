<?php
/*
Template name: Handsets
*/
get_header();
?>

    <section class="about--section text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img src="/wp-content/uploads/2023/02/SmallLogo-1-1.png" alt="">
                    <h2><?php echo the_field('slider_title');?>
                    </h2>
                    <p>
                        <?php echo the_field('slider_description');?>
                    </p>
                </div>
            </div>
        </div>
    </section>


    <section class="handset--section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?php echo the_field('main_title');?></h2>
                    <p>
                        <?php echo the_field('main_description_1');?>
                    </p>
                    <p><?php echo the_field('main_description_2');?></p>

                    <div class="row">

                        <?php if( have_rows('tabs') ): ?>
                                <?php while( have_rows('tabs') ): the_row();
                                    ?>
                                <div class="col-lg-4">
                                    <div class="card-item">
                                        <img src="<?php echo the_sub_field('phone_image'); ?>" alt="">
                                        <div class="inner-content">
                                            <h4><?php echo the_sub_field('title'); ?></h4>
                                            <p><?php echo the_sub_field('description'); ?></p>
                                            <a href="<?php echo the_sub_field('button_link'); ?>" class="button-56"><?php echo the_sub_field('button_text'); ?></a>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
?>