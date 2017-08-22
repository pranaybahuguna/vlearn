<?php
/**
 * Template Name: Home Page Option A
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package themotion
 */

get_header(); ?>

	</div><!-- .container -->


	<section id="featured-videos" class="home-section featured-videos">
		<div class="container">

			<?php
			$themotion_home1_video_category = get_theme_mod( 'themotion_home1_video_category', 'all' );
			if ( empty( $themotion_home1_video_category ) || $themotion_home1_video_category == 'all' ) {
				$themotion_home1_video_category = '';
			}
			$args = array(
				'category_name'  => $themotion_home1_video_category,
				'post_type'      => 'post',
				'posts_per_page' => '-1',
			);

			$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) { ?>
				<div class="featured-video-wrap">

					<!-- Slider -->

					<div class="themotion-playlist" id="slider">
						<!-- Top part of the slider -->
						<div class="themotion-current-item" id="carousel-bounding-box">
							<div class="carousel slide" id="myCarousel">
								<!-- Carousel items -->
								<div class="carousel-inner">
									<?php
									$active_was_set = 'false';

									while ( $the_query->have_posts() ) {
										$the_query->the_post();
										$id = get_the_ID(); ?>
										<div class="item slide-number-<?php echo esc_attr( $id ); ?> <?php if ( $active_was_set == 'false' ) {
											echo 'active';
											$active_was_set = 'true';
} ?>">
											<?php
											if ( has_post_format( 'video' ) ) {
												$post    = get_post();
												$content = apply_filters( 'the_content', $post->post_content );
												$embeds  = get_media_embedded_in_content( $content );
												if ( ! empty( $embeds ) ) {
													echo $embeds[0];
												} else {
													if ( has_post_thumbnail() ) {
														the_post_thumbnail( 'themotion-thumbnail-blog' );
													}
												}
											} else {
												if ( has_post_thumbnail() ) {
													the_post_thumbnail( 'themotion-thumbnail-blog' );
												}
											} ?>
										</div>
										<?php
									}

									wp_reset_postdata(); ?>
								</div><!-- Carousel nav -->
							</div>
						</div>

						<div class="themotion-playlist-tracks" id="slider-thumbs">
							<!-- Bottom switcher of slider -->
							<?php
							$first = 'true';
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								$id             = get_the_ID();
								$attached_video = get_attached_media( 'video', $id );

								if ( ! empty( $attached_video ) ) {
									foreach ( $attached_video as $video ) {
										$video_id     = $video->ID;
										$video_meta   = wp_get_attachment_metadata( $video_id );
										$video_length = $video_meta['length_formatted'];
										break;
									}
								} ?>

								<div class="themotion-playlist-item <?php if ( $first == 'true' ) {
									echo 'themotion-playlist-playing';
									$first = 'false';
} ?>" id="carousel-selector-<?php echo esc_attr( $id ); ?>" data-id="<?php echo esc_attr( $id ); ?>">
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'themotion-playlist-thumbnail' );
									} else {
										$video_thumbnail_url = themotion_get_thumbnail_url( $id );
										if ( $video_thumbnail_url === false ) {
											$video_thumbnail_url = get_template_directory_uri() . '/images/small-empty-image.png';
										} ?>
										<img src="<?php echo esc_url( $video_thumbnail_url ); ?>" alt="<?php esc_html_e( 'Placeholder image', 'themotion-lite' ); ?>">
										<?php
									} ?>
									<div class="themotion-playlist-caption">
										<span class="themotion-playlist-item-title"><?php the_title(); ?></span>
										<?php
										if ( ! empty( $video_length ) ) { ?>
											<span class="themotion-video-time"><?php echo esc_html( $video_length ); ?></span>
											<?php
											$video_length = '';
										} ?>
									</div>
								</div>
								<?php
							}// End while().
	?>
						</div>
					</div>
				</div>
				<?php
				wp_reset_postdata();
			}// End if().
	?>

		</div>
	</section>

<?php

get_template_part( 'template-parts/ribbon', 'content' );

?>

	<div class="container">

	<div class="content-wrap">

		<div id="primary" class="content-area homepage-one">
			<main id="main" class="site-main">
				<?php
				$themotion_home_a_bottom_posts_title = get_theme_mod( 'themotion_home_a_bottom_posts_title', esc_html__( 'Recently Posted', 'themotion-lite' ) );
				if ( ! empty( $themotion_home_a_bottom_posts_title ) ) { ?>
					<h3 class="recently-posted-title"><?php if ( ! empty( $themotion_home_a_bottom_posts_title ) ) {
							echo wp_kses_post( $themotion_home_a_bottom_posts_title );
} ?></h3>
					<?php
				} else {
					if ( is_customize_preview() ) { ?>
						<h3 class="recently-posted-title themotion-only-customizer"></h3>
						<?php
					}
				}
				?>

				<div class="recently-posted-wrap">
					<?php
					$themotion_home_a_post_nb       = get_theme_mod( 'themotion_home_a_post_nb', 6 );
					$themotion_home_a_post_category = get_theme_mod( 'themotion_home_a_post_category' );
					$args                           = array(
						'post_type'           => 'post',
						'post_status'         => 'publish',
						'posts_per_page'      => ( ! empty( $themotion_home_a_post_nb ) ? (int) $themotion_home_a_post_nb : '6' ),
						'ignore_sticky_posts' => 1,
					);
					if ( ! empty( $themotion_home_a_post_category ) && $themotion_home_a_post_category != 'all' ) {
						$args['category_name'] = $themotion_home_a_post_category;
					}

					$the_query = new WP_Query( $args );

					if ( $the_query->have_posts() ) : ?>

						<?php
						/* Start the Loop */
						while ( $the_query->have_posts() ) : $the_query->the_post();

							/*
							* Include the Post-Format-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Format name) and that will be used instead.
							*/
							get_template_part( 'template-parts/content', 'home-one' );

						endwhile;

						the_posts_navigation( array(
								'prev_text' => sprintf( '&#8592; %s', __( 'Older Posts', 'themotion-lite' ) ),
								'next_text' => sprintf( '%s &#8594;', __( 'Newer Posts', 'themotion-lite' ) ),
							)
						);

						/* Restore original Post Data */
						wp_reset_postdata();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>

				</div>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php
		get_sidebar();
		?>
		<?php edit_post_link( __( 'Edit', 'themotion-lite' ), '<span class="edit-link">', '</span>' ); ?>

	</div><!-- .content-wrap -->

<?php
get_footer();
