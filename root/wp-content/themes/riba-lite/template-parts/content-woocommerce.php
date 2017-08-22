<?php
/**
 *	The template for dispalying the WooCommerce Content.
 *
 *	@package WordPress
 *	@subpackage riba-lite
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content post-content">
		<?php woocommerce_content(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->