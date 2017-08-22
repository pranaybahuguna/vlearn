<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main text-center" role="main">

        <?php if ( have_posts() ) : ?>

            <?php if ( is_home() && ! is_front_page() ) : ?>
                <header>
                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                </header>
            <?php endif; ?>

            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <?php do_action('mtl_inside_loop_before'); ?>
                <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
                <?php do_action('mtl_inside_loop_after'); ?>


            <?php endwhile; ?>
            <div class="clearfix"></div>


            <?php do_action('mtl_after_content_above_footer'); ?>


        <?php else : ?>

            <?php get_template_part( 'template-parts/content', 'none' ); ?>

        <?php endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>