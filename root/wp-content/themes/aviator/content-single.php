<?php
/**
 * @package aviator
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php aviator_posted_on(); ?>
		</div><!-- .entry-meta -->

		<div class="enter-header-decoration">
			<div class="decoration-mark"></div>
		</div>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'aviator' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php aviator_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
