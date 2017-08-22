<article id="post-<?php the_ID(); ?>" <?php post_class('post-grid post-quote text-center col-xs-12'); ?>>
    <div class="link-wrapper">
        <div class="entry-content">
            <header class="entry-header">
                <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
                <?php the_content(); ?>
                <?php if ( 'post' == get_post_type() ) : ?>
                <div class="entry-meta">
                    <?php do_action('mtl_entry_meta'); ?>
                    </div>
                <?php endif; ?>
            </header><!-- .entry-header -->
        </div><!-- .entry-content -->
    </div>

</article><!-- #post-## -->
