<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package themotion
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post' ); ?>>

	<?php
	$post = get_post();
	if ( ! is_single() ) {
		if ( has_post_format( 'video' ) ) {
			themotion_show_video_post_thumbnail( $post, array(
				'class' => 'themotion-blog-video-thumbnail',
			) );
		} else { ?>
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-thumbnail" rel="bookmark">
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'post-thumbnail' );
				} ?>
			</a>
			<?php
		}
	} ?>

	<header class="entry-header">
		<?php
			the_title( '<h2 class="entry-title entry-title-blog"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php

			$pos = strpos( $post->post_content, '<!--more-->' );
		if ( $pos <= 0 ) {
			the_excerpt();
		} else {
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Read more %s <span class="meta-nav">&rarr;</span>', 'themotion-lite' ), array(
					'span' => array(
					'class' => array(),
					),
				) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		}

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'themotion-lite' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
