<article id="post-<?php the_ID(); ?>" <?php post_class('post-grid ' . get_post_type() ); ?>>

    <div class="link-wrapper">
        <div class="post-cover-wrapper">

            <?php do_action('mtl_breadcrumbs'); ?>

            <?php if( has_post_thumbnail() ) {
                $featured_image =  wp_get_attachment_image_src(get_post_thumbnail_id(), 'riba-lite-2x' );

                echo '<a class="post-cover post-cover-'.get_the_ID().'">';
                echo '<div class="parallax-bg-image" style="background-image: url('.esc_url( $featured_image[0] ).');"></div>';
                echo '</a>';
            }  ?>
        </div><!-- .post-cover-wrapper -->

        <div class="entry-content">
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title parallax-text-fade">', '</h1>' ); ?>
                <?php if ( 'post' == get_post_type() ) {
                    do_action('mtl_entry_meta');
                } ?>
            </header><!-- .entry-header -->
        </div>
    </div><!-- .entry-content -->

    <div class="container">
        <div class="row">
            <?php do_action('mtl_single_before_content'); ?>
            <div class="post-content">
                <?php the_content(); ?>
            </div>
            <div class="clearfix"></div>
            <?php do_action('mtl_single_after_content'); ?>
        </div>
    </div>

</article><!-- #post-## -->