<?php
$display_ert = get_theme_mod('riba_lite_post_'.esc_attr( get_post_format( $post->ID ) ).'_enable_ert', 1);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-grid post-featured-image col-xs-12'); ?>>
        <div class="link-wrapper">
            <div class="post-cover-wrapper">
                <?php if( has_post_thumbnail() ) {
                    $featured_image =  wp_get_attachment_image_src(get_post_thumbnail_id(), 'riba-lite-2x' );
                    echo '<a href="'.esc_url( get_the_permalink() ).'" class="post-cover post-cover-'.get_the_ID().'"><img class="lazy" data-original="'.esc_url( $featured_image[0] ).'" width="'. esc_attr( $featured_image[1] ).'" height="'. esc_attr( $featured_image[2] ).'"></a>';
                } else if( !has_post_thumbnail() && get_theme_mod('riba_lite_enable_random_blog_images', 'images_enabled') == 'images_enabled') {
                    echo '<div class="entry-featured-image">';
                        echo '<img src="' . esc_url( get_template_directory_uri() . '/layout/images/blog-defaults/random-'.mt_rand(1,7) ).'-1200x900.jpg">';
                    echo '</div><!--/.entry-featured-image-->';
                } ?>
            </div><!-- .post-cover-wrapper -->

            <div class="entry-content">
                <header class="entry-header">
                    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

                    <?php if ( 'post' == get_post_type() ) : ?>
                        <?php do_action('mtl_entry_meta'); ?>
                    <?php endif; ?>
                </header><!-- .entry-header -->
            </div><!-- .entry-content -->
        </div>

    </article><!-- #post-## -->
