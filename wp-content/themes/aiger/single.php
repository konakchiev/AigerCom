<?php 
    // Calling Header
    get_header(); 
?>

<section class="post-contents">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <?php the_post_thumbnail( 'full' );  ?>

                <?php the_content(); ?>

            <?php endwhile; ?>
            <?php endif; ?>
            </div>
                <?php include('blog-sidebar.php'); ?>
        </div>
    </div>
</section>

<?php 
    //Calling Footer
    get_footer();
?>