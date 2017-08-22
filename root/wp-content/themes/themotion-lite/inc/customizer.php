<?php
/**
 * Themotion Theme Customizer.
 *
 * @package themotion
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function themotion_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->remove_control( 'header_textcolor' );
	$wp_customize->remove_control( 'background_color' );

	require_once get_template_directory() . '/inc/customizer-repeater/class/class-themotion-general-repeater.php';
	require_once get_template_directory() . '/inc/customizer-category-selector/class-themotion-category-selector.php';

	$wp_customize->get_control( 'display_header_text' )->priority = 2;
	$wp_customize->get_control( 'blogname' )->priority = 3;
	$wp_customize->get_control( 'blogdescription' )->priority = 4;
	$wp_customize->get_control( 'custom_logo' )->priority = 5;

	/* Control for social icons */
	$wp_customize->add_section( 'themotion_social_media', array(
		'title'	=> esc_html__( 'Social Media Icons', 'themotion-lite' ),
		'priority'	=> 40,
	) );
	$wp_customize->add_setting( 'themotion_social_icons', array(
		'default'	=> json_encode( array(
			array(
				'link' => 'facebook.com',
			),
			array(
				'link' => 'twitter.com',
			),
		) ),
		'transport'	=> 'postMessage',
		'sanitize_callback'	=> 'themotion_sanitize_repeater',
	) );
	$wp_customize->add_control( new Themotion_General_Repeater( $wp_customize, 'themotion_social_icons', array(
		'label'	=> esc_html__( 'Add new social icon','themotion-lite' ),
		'section'	=> 'themotion_social_media',
		'priority'	=> 1,
		'themotion_link_control' => true,
	) ) );

	/* Control for hiding social icons on contact page */

	$wp_customize->add_setting( 'themotion_contact_hide_socials', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'themotion_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'themotion_contact_hide_socials', array(
		'type' => 'checkbox',
		'label' => esc_html__( 'Hide social icons?','themotion-lite' ),
		'description' => esc_html__( 'If you check this box, the social icons will disappear from Contact page.','themotion-lite' ),
		'section' => 'themotion_contact_cl_settings',
		'priority' => 1,
	) );

	/* === Homepage A settings === */
	$wp_customize->add_section( 'themotion_home_a', array(
		 'title'	=> esc_html__( 'Home Page Option A', 'themotion-lite' ),
		 'priority'	=> 50,
	) );

	$wp_customize->add_setting( 'themotion_home1_video_category', array(
		'default'			=> 'all',
		'transport'			=> 'postMessage',
		'sanitize_callback'	=> 'themotion_sanitize_category_dropdown',
	) );

	$wp_customize->add_control( new Themotion_Category_Selector( $wp_customize, 'themotion_home1_video_category', array(
		'label'		=> esc_html__( 'Top Section Post Category', 'themotion-lite' ),
		'section'	=> 'themotion_home_a',
		'priority'	=> 1,
	) ) );

	$wp_customize->add_setting( 'themotion_home_a_bottom_posts_title', array(
		'default' => esc_html__( 'Recently Posted','themotion-lite' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'themotion_home_a_bottom_posts_title', array(
		'label'		=> esc_html__( 'Bottom posts title', 'themotion-lite' ),
		'section'	=> 'themotion_home_a',
		'priority'	=> 6,
	));

	$wp_customize->add_setting( 'themotion_home_a_post_category', array(
		'default'			=> 'all',
		'transport'			=> 'postMessage',
		'sanitize_callback'	=> 'themotion_sanitize_category_dropdown',
	) );

	$wp_customize->add_control( new Themotion_Category_Selector( $wp_customize, 'themotion_home_a_post_category', array(
		'label'		=> esc_html__( 'Bottom posts category', 'themotion-lite' ),
		'section'	=> 'themotion_home_a',
		'priority'	=> 7,
	) ) );

	$wp_customize->add_setting( 'themotion_home_a_post_nb', array(
		'default'			=> 6,
		'transport'			=> 'postMessage',
		'sanitize_callback'	=> 'absint',
	) );

	$wp_customize->add_control( 'themotion_home_a_post_nb', array(
		'type'              => 'number',
		'label'		=> esc_html__( 'Number of posts', 'themotion-lite' ),
		'section'	=> 'themotion_home_a',
		'priority'	=> 8,
	));

	/* === Contact page === */
	$wp_customize->add_panel( 'themotion_contact', array(
		'priority' => 65,
		'capability' => 'edit_theme_options',
		'title' => esc_html__( 'Contact page', 'themotion-lite' ),
	) );

	$wp_customize->add_section( 'themotion_contact_header_settings', array(
		'title'	=> esc_html__( 'Header Settings', 'themotion-lite' ),
		'priority'	=> 1,
		'panel'	=> 'themotion_contact',
	) );

	/* Header Image	*/
	$wp_customize->add_setting( 'themotion_contact_header_image', array(
		'default' => esc_url( get_template_directory_uri() . '/images/contact.jpg' ),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themotion_contact_header_image', array(
		'label'    => esc_html__( 'Header Image', 'themotion-lite' ),
		'section'  => 'themotion_contact_header_settings',
		'priority'    => 1,
	)));

	/* Control for header text */
	$wp_customize->add_setting( 'themotion_contact_header_text', array(
		'default' => esc_html__( 'FEEL FREE TO CONTACT US WITH ANY QUESTIONS OR COMMENTS','themotion-lite' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'themotion_contact_header_text', array(
		'label'		=> esc_html__( 'Header text', 'themotion-lite' ),
		'section'	=> 'themotion_contact_header_settings',
		'priority'	=> 2,
	));

	/* Control for button text*/
	$wp_customize->add_setting( 'themotion_contact_button_text', array(
		'default' => esc_html__( 'Send us an email','themotion-lite' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'themotion_contact_button_text', array(
		'label'		=> esc_html__( 'Button text', 'themotion-lite' ),
		'section'	=> 'themotion_contact_header_settings',
		'priority'	=> 3,
	));

	/*  Latest posts */
	$wp_customize->add_section( 'themotion_latest_posts', array(
		'title'	=> esc_html__( 'Latest posts', 'themotion-lite' ),
		'priority'	=> 5,
		'panel'	=> 'themotion_about',
	) );

	$wp_customize->add_setting( 'themotion_show_latest', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'themotion_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'themotion_show_latest', array(
		'type' => 'checkbox',
		'label' => esc_html__( 'Hide latest posts?','themotion-lite' ),
		'description' => esc_html__( 'If you check this box, latest posts will disappear from About page.','themotion-lite' ),
		'section' => 'themotion_latest_posts',
		'priority' => 1,
	) );

	$wp_customize->add_setting( 'themotion_latest_posts_title', array(
		'default' => esc_html__( 'Recently Posted','themotion-lite' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'themotion_latest_posts_title', array(
		'label'		=> esc_html__( 'Title', 'themotion-lite' ),
		'section'	=> 'themotion_latest_posts',
		'priority'	=> 2,
	));

	$wp_customize->add_setting( 'themotion_latest_posts_category', array(
		'default'			=> 'all',
		'transport'			=> 'postMessage',
		'sanitize_callback'	=> 'themotion_sanitize_category_dropdown',
	) );

	$wp_customize->add_control( new Themotion_Category_Selector( $wp_customize, 'themotion_latest_posts_category', array(
		'label'		=> esc_html__( 'Category', 'themotion-lite' ),
		'section'	=> 'themotion_latest_posts',
		'priority'	=> 3,
	) ) );

	/* Control for button link*/
	$wp_customize->add_setting( 'themotion_contact_button_link', array(
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'themotion_contact_button_link', array(
		'label'		=> esc_html__( 'Button URL', 'themotion-lite' ),
		'section'	=> 'themotion_contact_header_settings',
		'priority'	=> 4,
	));

	$wp_customize->add_section( 'themotion_contact_cl_settings', array(
		'title'	=> esc_html__( 'Content Left Settings', 'themotion-lite' ),
		'priority'	=> 2,
		'panel'	=> 'themotion_contact',
	) );

	$wp_customize->add_setting( 'themotion_contact_cl_title', array(
		'default' => esc_html__( 'WHY THE MOTION','themotion-lite' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'themotion_contact_cl_title', array(
		'label'		=> esc_html__( 'Block Title', 'themotion-lite' ),
		'section'	=> 'themotion_contact_cl_settings',
		'priority'	=> 2,
	));

	$wp_customize->add_setting( 'themotion_contact_cl_text', array(
		'default'   => esc_html__( 'Using best practices and a keen eye, we curated this video feed for the business beginner and experienced alike. We are a resource for creatives wanting to push their business forward.','themotion-lite' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'themotion_contact_cl_text', array(
		'label'		=> esc_html__( 'Text', 'themotion-lite' ),
		'type'      => 'textarea',
		'section'	=> 'themotion_contact_cl_settings',
		'priority'	=> 3,
	));

	$wp_customize->add_section( 'themotion_contact_cr_settings', array(
		'title'	=> esc_html__( 'Content Right Settings', 'themotion-lite' ),
		'priority'	=> 3,
		'panel'	=> 'themotion_contact',
	) );

	$wp_customize->add_setting( 'themotion_contact_cr_title', array(
		'default' => esc_html__( 'Get in touch','themotion-lite' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'themotion_contact_cr_title', array(
		'label'		=> esc_html__( 'Block Title', 'themotion-lite' ),
		'section'	=> 'themotion_contact_cr_settings',
		'priority'	=> 1,
	));

	$wp_customize->add_setting( 'themotion_contact_cr_b1_title', array(
		'default' => esc_html__( 'The.Motion Headquarters','themotion-lite' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'themotion_contact_cr_b1_title', array(
		'label'		=> esc_html__( 'Left side title', 'themotion-lite' ),
		'section'	=> 'themotion_contact_cr_settings',
		'priority'	=> 2,
	));

	$wp_customize->add_setting( 'themotion_contact_cr_b1_text', array(
		'default'   => esc_html__( '329 South Street Court - Albany, NY 83741','themotion-lite' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'themotion_contact_cr_b1_text', array(
		'label'		=> esc_html__( 'Left side text', 'themotion-lite' ),
		'type'      => 'textarea',
		'section'	=> 'themotion_contact_cr_settings',
		'priority'	=> 3,
	));

	$wp_customize->add_setting( 'themotion_contact_cr_b1_email', array(
		'default' => esc_html__( 'start@example.com','themotion-lite' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'themotion_contact_cr_b1_email', array(
		'label'		=> esc_html__( 'Left side email', 'themotion-lite' ),
		'section'	=> 'themotion_contact_cr_settings',
		'priority'	=> 3,
	));

	$wp_customize->add_setting( 'themotion_contact_cr_b1_phone', array(
		'default' => esc_html__( '(432) 203-3321','themotion-lite' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'themotion_contact_cr_b1_phone', array(
		'label'		=> esc_html__( 'Left side phone', 'themotion-lite' ),
		'section'	=> 'themotion_contact_cr_settings',
		'priority'	=> 4,
	));

	$wp_customize->add_setting( 'themotion_contact_cr_b2_title', array(
		'default' => esc_html__( 'THE.MOTION VIDEO RECORDING','themotion-lite' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'themotion_contact_cr_b2_title', array(
		'label'		=> esc_html__( 'Right side title', 'themotion-lite' ),
		'section'	=> 'themotion_contact_cr_settings',
		'priority'	=> 5,
	));

	$wp_customize->add_setting( 'themotion_contact_cr_b2_text', array(
		'default'   => esc_html__( '153 East Fifth Avenue - New York, NY 83741','themotion-lite' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'themotion_contact_cr_b2_text', array(
		'label'		=> esc_html__( 'Right side text', 'themotion-lite' ),
		'type'      => 'textarea',
		'section'	=> 'themotion_contact_cr_settings',
		'priority'	=> 6,
	));

	$wp_customize->add_setting( 'themotion_contact_cr_b2_email', array(
		'default' => esc_html__( 'recording@example.com','themotion-lite' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'themotion_contact_cr_b2_email', array(
		'label'		=> esc_html__( 'Right side email', 'themotion-lite' ),
		'section'	=> 'themotion_contact_cr_settings',
		'priority'	=> 7,
	));

	$wp_customize->add_setting( 'themotion_contact_cr_b2_phone', array(
		'default' => esc_html__( '(324) 923-8321','themotion-lite' ),
		'sanitize_callback' => 'themotion_sanitize_text',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'themotion_contact_cr_b2_phone', array(
		'label'		=> esc_html__( 'Right side phone', 'themotion-lite' ),
		'section'	=> 'themotion_contact_cr_settings',
		'priority'	=> 8,
	));

	$wp_customize->add_control( 'themotion_contact_cr_b2_phone', array(
		'label'		=> esc_html__( 'Right side phone', 'themotion-lite' ),
		'section'	=> 'themotion_contact_cr_settings',
		'priority'	=> 8,
	));

	/* === Featured image on single post === */
	$wp_customize->add_setting( 'themotion_single_post_featured_image', array(
		'default' => 0,
		'sanitize_callback' => 'themotion_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'themotion_single_post_featured_image', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Display featured images on single posts', 'themotion-lite' ),
		'section'  => 'title_tagline',
		'priority' => 70,
	) );

	$wp_customize->get_control( 'header_image' )->section = 'themotion_header_settings';
	$wp_customize->get_control( 'header_image' )->priority = 5;
	$wp_customize->get_setting( 'header_image' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_image_data' )->transport = 'postMessage';

}
add_action( 'customize_register', 'themotion_customize_register' );

/**
 * Checkbox Sanitization
 */
function themotion_sanitize_checkbox( $input ) {
	return ( isset( $input ) && true == $input ? true : false );
}

/**
 * Number Sanitization
 */
function themotion_sanitize_number( $input ) {
	return ( ! empty( $input ) ? (int) $input : '');
}

/**
 * Repeater Sanitization
 */
function themotion_sanitize_repeater( $input ) {
	if ( ! empty( $input ) ) {
		$input_decoded = json_decode( $input, true );
		if ( ! empty( $input_decoded ) ) {
			foreach ( $input_decoded as $iconk => $iconv ) {
				foreach ( $iconv as $key => $value ) {
					if ( 'link' == $key ) {
						$input_decoded [ $iconk ][ $key ] = esc_url( $value );
					}
				}
			}
			$result = json_encode( $input_decoded );
			return $result;
		}
	}
	return $input;
}

/**
 * Category Dropdown Sanitization
 */
function themotion_sanitize_category_dropdown( $input ) {
	$cat = get_category_by_slug( $input );
	if ( empty( $cat ) ) {
		return 'all';
	}
	return $input;
}

if ( ! function_exists( 'themotion_sanitize_text' ) ) {
	/**
	 * Text Sanitization
	 */
	function themotion_sanitize_text( $input ) {
		return wp_kses_post( force_balance_tags( $input ) );
	}
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function themotion_customize_preview_js() {
	wp_enqueue_script( 'themotion_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '1.1.0', true );
	wp_localize_script( 'themotion_customizer', 'requestpost', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'placeholder' => esc_html__( 'Loading New Posts...','themotion-lite' ),
	));
}
add_action( 'customize_preview_init', 'themotion_customize_preview_js' );
