<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package themotion
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-sm-4 recently-posted-about' ); ?>>
	<header class="entry-header">

			<?php
			$post = get_post();

			if ( has_post_format( 'video' ) ) {
				themotion_show_video_post_thumbnail( $post, array(
					'class' => 'post-image-container',
					'placeholder' => true,
				) );
			} else { ?>
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'themotion-post-thumbnail' );
					} else {
						$default_image = get_template_directory_uri() . '/images/default-thumbnail.jpg'; ?>
						<img width="790" height="300" src="<?php echo esc_url( $default_image ); ?>" class="attachment-post-thumbnail wp-post-image" alt="">
						<?php
					} ?>
				</a>
				<?php
			} ?>


		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<?php
			the_title( '<span class="home-entry-title">', '</span>' ); ?>
		</a>
	</header><!-- .entry-header -->
</article><!-- #post-## -->
