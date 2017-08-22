<?php

    // Include Custom Controls
    require get_template_directory() . '/inc/customizer/custom-controls/radio-img-selector.php';
    require get_template_directory() . '/inc/customizer/custom-controls/pro-controls-selector.php';

    // Set Panel ID
    $panel_id = 'riba_lite_panel_general';

    // Set prefix
    $prefix = 'riba_lite';

    // Change panel for Site Title & Tagline Section
    $site_title        = $wp_customize->get_section( 'title_tagline' );
    $site_title->panel = $panel_id;

    // Remove sections from customizer front-view
    $wp_customize->remove_section('colors');

    // Change panel for Background Image
    $site_title        = $wp_customize->get_section( 'background_image' );
    $site_title->panel = $panel_id;

    // Change panel for Static Front Page
    $site_title        = $wp_customize->get_section( 'static_front_page' );
    $site_title->panel = $panel_id;


    // Change priority for Site Title
    $site_title           = $wp_customize->get_control( 'blogname' );
    $site_title->priority = 15;

    // Change priority for Site Tagline
    $site_title           = $wp_customize->get_control( 'blogdescription' );
    $site_title->priority = 17;


    /***********************************************/
    /************** GENERAL OPTIONS  ***************/
    /***********************************************/


    $wp_customize->add_panel( $panel_id,
        array(
            'priority' => 29,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'General Options', 'riba-lite' ),
            'description' => esc_html__('You can change the site layout in this area as well as your contact details (the ones displayed in the header & footer) ', 'riba-lite'),
        )
    );

    /***********************************************/
    /************** General Site Settings  ***************/
    /***********************************************/

    /* Layout */
    $wp_customize->add_section( $prefix.'_layout_section' ,
        array(
            'title'       => esc_html__( 'Site Layout', 'riba-lite' ),
            'description' => esc_html__( 'Depending on the quality of your pictures / videos, you can switch the site layout. We do recommend the boxed one so you can also set a nice looking background image.', 'riba-lite' ),
            'priority'    => 1,
            'panel' 	  => $panel_id
        )
    );

    /* Site Layout */
    $wp_customize->add_setting($prefix.'_site_layout',
        array(
            'sanitize_callback' => $prefix.'_sanitize_radio_buttons',
            'default' => 'boxed'
        )
    );

    $wp_customize->add_control( new Riba_lite_Layout_Picker_Custom_Control( $wp_customize,
        $prefix.'_site_layout',
            array(
                'type'          => 'radio-image',
                'label' 		=> esc_html__('Select Site Layout', 'riba-lite'),
                'description'   => esc_html__('Fixed / Fluid layout', 'riba-lite'),
                'section' 		=> $prefix.'_layout_section',
                'priority' 		=> 2,
                'choices'     => array(
                    'boxed' => get_template_directory_uri() . '/inc/customizer/assets/images/boxed.png',
                    'full' => get_template_directory_uri() . '/inc/customizer/assets/images/fullwidth.png',
                ),
            )
        )
    );



    /* Logo */
    $wp_customize->add_section( $prefix.'_general_section' ,
        array(
            'title'       => esc_html__( 'Logo', 'riba-lite' ),
            'priority'    => 2,
            'panel' 	  => $panel_id
        )
    );


    /* Company text logo */
    $wp_customize->add_setting($prefix.'_text_logo',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => esc_html__('Riba', 'riba-lite'),
        )
    );

    $wp_customize->add_control(
        $prefix.'_text_logo',
        array(
            'label' 		=> esc_html__('Enter company name', 'riba-lite'),
            'description'   => esc_html__('This field is best used when you don\'t have a professional image logo', 'riba-lite'),
            'section' 		=> $prefix.'_general_section',
            'priority' 		=> 2
        )
    );

    /* Company image logo */
    $wp_customize->add_setting($prefix.'_img_logo',
        array(
            'sanitize_callback' => $prefix.'_sanitize_file_url',
            'default' => __('Your site IMAGE logo HERE', 'riba-lite'),
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
            $wp_customize,
            $prefix.'_img_logo',
            array(
	            'type'          => 'text',
                'label'         => esc_html__('Image Site Logo', 'riba-lite'),
                'section'       => $prefix.'_general_section',
                'priority'      => 2
            )
        )
    );


    /***********************************************/
    /************** Contact Details  ***************/
    /***********************************************/

    $wp_customize->add_section( $prefix.'_general_contact_section' ,
        array(
            'title'       => esc_html__( 'Contact Details', 'riba-lite' ),
            'description' => esc_html__( 'These are the contact details displayed in the header & footer of the website.', 'riba-lite' ),
            'priority'    => 3,
            'panel' => $panel_id
        )
    );

	/* Facebook URL */
	$wp_customize->add_setting( $prefix.'_contact_bar_facebook_url',
		array(
			'sanitize_callback' => 'esc_url',
			'default' => esc_url('https://www.facebook.com/machothemes/')
		)
	);

	$wp_customize->add_control( $prefix.'_contact_bar_facebook_url',
		array(
			'label'   => esc_html__( 'Facebook URL', 'riba-lite' ),
			'description' => esc_html__('Will be displayed in the contact bar ( Header )', 'riba-lite'),
			'section' => $prefix.'_general_contact_section',
			'settings'   => $prefix.'_contact_bar_facebook_url',
			'priority' => 10
		)
	);

	/* Twitter URL */
	$wp_customize->add_setting( $prefix.'_contact_bar_twitter_url',
		array(
			'sanitize_callback' => 'esc_url',
			'default' => esc_html('#')
		)
	);

	$wp_customize->add_control( $prefix.'_contact_bar_twitter_url',
		array(
			'label'   => esc_html__( 'Twitter URL', 'riba-lite' ),
			'description' => esc_html__('Will be displayed in the contact bar ( Header )', 'riba-lite'),
			'section' => $prefix.'_general_contact_section',
			'settings'   => $prefix.'_contact_bar_twitter_url',
			'priority' => 10
		)
	);

	/* YouTube URL */
	$wp_customize->add_setting( $prefix.'_contact_bar_youtube_url',
		array(
			'sanitize_callback' => 'esc_url',
			'default' => esc_html('#')
		)
	);

	$wp_customize->add_control( $prefix.'_contact_bar_youtube_url',
		array(
			'label'   => esc_html__( 'YouTube URL', 'riba-lite' ),
			'description' => esc_html__('Will be displayed in the contact bar ( Header )', 'riba-lite'),
			'section' => $prefix.'_general_contact_section',
			'settings'   => $prefix.'_contact_bar_youtube_url',
			'priority' => 10
		)
	);

	/* Pinterest URL */
	$wp_customize->add_setting( $prefix.'_contact_bar_pinterest_url',
		array(
			'sanitize_callback' => 'esc_url',
			'default' => esc_html('#')
		)
	);

	$wp_customize->add_control( $prefix.'_contact_bar_pinterest_url',
		array(
			'label'   => esc_html__( 'Pinterest URL', 'riba-lite' ),
			'description' => esc_html__('Will be displayed in the contact bar ( Header )', 'riba-lite'),
			'section' => $prefix.'_general_contact_section',
			'settings'   => $prefix.'_contact_bar_pinterest_url',
			'priority' => 10
		)
	);

	/* LinkedIN URL */
	$wp_customize->add_setting( $prefix.'_contact_bar_linkedin_url',
		array(
			'sanitize_callback' => 'esc_url',
			'default' => esc_html('#')
		)
	);

	$wp_customize->add_control( $prefix.'_contact_bar_linkedin_url',
		array(
			'label'   => esc_html__( 'LinkedIN URL', 'riba-lite' ),
			'description' => esc_html__('Will be displayed in the contact bar ( Header )', 'riba-lite'),
			'section' => $prefix.'_general_contact_section',
			'settings'   => $prefix.'_contact_bar_linkedin_url',
			'priority' => 10
		)
	);


	/* email */
    $wp_customize->add_setting( $prefix.'_email',
        array(
            'sanitize_callback' => 'sanitize_email',
            'default' => 'contact@site.com'
        )
    );

    $wp_customize->add_control( $prefix.'_email',
        array(
            'label'   => esc_html__( 'Email addr.', 'riba-lite' ),
            'description' => esc_html__('Will be displayed in the header & footer', 'riba-lite'),
            'section' => $prefix.'_general_contact_section',
            'settings'   => $prefix.'_email',
            'priority' => 10
        )
    );


    /* phone number */
    $wp_customize->add_setting( $prefix.'_phone',
        array(
            'sanitize_callback' => $prefix.'_sanitize_number',
            'default' => '0 332 548 954'
        )
    );

    $wp_customize->add_control( $prefix.'_phone',
        array(
            'label'   => esc_html__( 'Phone number', 'riba-lite' ),
            'description' => esc_html__('Will be displayed in the header & footer', 'riba-lite'),
            'section' => $prefix.'_general_contact_section',
            'settings'   => $prefix.'_phone',
            'priority' => 12
        )
    );

    /***********************************************/
    /************** Footer Details  ***************/
    /***********************************************/
    $wp_customize->add_section( $prefix.'_general_footer_section' ,
        array(
            'title'       => esc_html__( 'Footer Details', 'riba-lite' ),
            'description' => esc_html__( 'Change the footer copyright message from here. Note: no HTML allowed.', 'riba-lite'),
            'priority'    => 4,
            'panel' => $panel_id
        )
    );

    /* Footer Copyright */
    $wp_customize->add_setting( $prefix.'_footer_copyright',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => sprintf('&copy; %s', esc_html__('Macho Themes 2016. All Rights Reserved', 'riba-lite') )
        )
    );

    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
	    $wp_customize,
	    $prefix.'_footer_copyright',
	        array(
	            'type'  => 'textarea',
	            'label'   => esc_html__( 'Footer Copyright.', 'riba-lite' ),
	            'description' => esc_html__('Will be displayed in the footer', 'riba-lite'),
	            'section' => $prefix.'_general_footer_section',
	            'settings'   => $prefix.'_footer_copyright',
	            'priority' => 11
	        )
	    )
    );

