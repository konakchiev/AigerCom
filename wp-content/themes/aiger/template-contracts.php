<?php
/*
Template name: Contracts
 */
get_header();
?>

    <section class="contract--section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1>
                        <?php echo the_field('title');?>
                    </h1>
                    <p><?php echo the_field('description');?></p>
                </div>
                <div class="col-lg-6">
                    <img src="/wp-content/uploads/2023/02/8263-copy-1200x800-1.jpg" alt="">
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
?>