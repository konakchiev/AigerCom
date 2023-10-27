<?php
/* 
    Template name: Blog 
*/
get_header();

$post_date = get_the_date( 'l F j, Y' );
?>


    <section class="main-blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    <?php
                    $wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1)); ?>
                    <?php $wpb_query = new WP_QUERY($wpb_all_query); ?>

                    <?php if ( $wpb_all_query->have_posts() ) : ?>
                    <?php
                    while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>

                        <article class="normal-post">
                            <h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
                            <div class="row">
                            <?php if(get_the_post_thumbnail() != "") : ?>
                                <div class="col-lg-4">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                            <?php else : ?>
                            <?php endif; ?>
                            <div class="col-lg-8">
                                <div class="post-content">

                                    <p><?php echo excerpt(40); ?></p>
                                    <span class="datetime"><?php echo $post_date;?></span>
                                    <div class="readmore">
                                        <a class="button_default blog-button" href="<?php the_permalink();?>">Read More</a>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </article>

                        <div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
                        <div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>
                    <?php endwhile; ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    </div>

<?php 

    get_footer();

?>