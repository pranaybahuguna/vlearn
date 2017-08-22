<?php

    // Set Panel ID
    $panel_id = 'riba_lite_panel_advanced';

    // Set prefix
    $prefix = 'riba_lite';

    /***********************************************/
    /************** Settings  ***************/
    /***********************************************/


    $wp_customize->add_panel( $panel_id,
        array(
            'priority' => 35,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Advanced Options', 'riba-lite' )
        )
    );

    /* Advanced */
    $wp_customize->add_section( $prefix.'_advanced_section' ,
        array(
            'title'       => esc_html__( 'Settings', 'riba-lite' ),
            'panel' 	  => $panel_id
        )
    );


    /* Enable Site Preloader*/
    $wp_customize->add_setting( $prefix.'_enable_site_preloader',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
        $wp_customize,
        $prefix.'_enable_site_preloader',
            array(
                'type'	=> 'checkbox',
                'label' => esc_html__('Enable site preloader', 'riba-lite'),
                'description' => esc_html__('Initial status: enabled', 'riba-lite'),
                'section' => $prefix.'_advanced_section',
            )
        )
    );

    /* Enable SmothScroll */
    $wp_customize->add_setting( $prefix.'_enable_site_smoothscroll',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
	    $wp_customize,
        $prefix.'_enable_site_smoothscroll',
	        array(
	            'type'	=> 'checkbox',
	            'label' => esc_html__('Enable smoothscroll', 'riba-lite'),
	            'description' => esc_html__('Initial status: enabled', 'riba-lite'),
	            'section' => $prefix.'_advanced_section',
	        )
	    )
    );


    /* Enable Image LazyLoad Behavior */
    $wp_customize->add_setting( $prefix.'_enable_site_lazyload',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );

    $wp_customize->add_control(
        $prefix.'_enable_site_lazyload',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Enable Lazy Load behavior for images ?', 'riba-lite'),
            'description' => esc_html__('Initial status: enabled. If you don\'t like the fact that images are being loaded as you scroll them into view, uncheck this.', 'riba-lite'),
            'section' => $prefix.'_advanced_section',
        )
    );


    /* Enable Blog Random Images Placeholders */
    $wp_customize->add_setting( $prefix.'_enable_random_blog_images',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );

    $wp_customize->add_control(
        $prefix.'_enable_random_blog_images',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Enable Random Blog Post Images ', 'riba-lite'),
            'description' => esc_html__('Initial status: enabled. If you\'ve forgotten to set a featured image, these will be used as placeholders to make the site look nicer.', 'riba-lite'),
            'section' => $prefix.'_advanced_section',
        )
    );