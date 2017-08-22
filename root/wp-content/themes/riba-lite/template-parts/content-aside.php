<article id="post-<?php the_ID(); ?>" <?php post_class('post-grid post-aside text-center col-xs-12'); ?>>
    <div class="link-wrapper">
        <div class="entry-content">
            <header class="entry-header">
                <a href="<?php echo get_the_permalink(); ?>">
                    <?php echo get_the_content(); ?>
                </a>
                <a class="btn btn-read-more" href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo sprintf('%s %s', __('Read more', 'riba-lite'), '&raquo;'); ?></a>
            </header><!-- .entry-header -->
        </div><!-- .entry-content -->
    </div>

</article><!-- #post-## -->
