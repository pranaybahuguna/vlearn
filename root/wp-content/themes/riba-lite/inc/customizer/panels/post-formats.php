<?php

// Set Panel ID
$panel_id = 'riba_lite_panel_formats';

// Set prefix
$prefix = 'riba_lite';

/***********************************************/
/************** Post Formats  ***************/
/***********************************************/


    $wp_customize->add_panel( $panel_id,
        array(
            'priority' => 32,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Archive Blog Post Settings', 'riba-lite' ),
            'description' => esc_html__('This section allows you to control various settings specific to each post-format. Making changes in these sections will be reflected on the homepage.', 'riba-lite'),
        )
    );

    /***********************************************/
    /************** Standard Settings  ***************/
    /***********************************************/


    $wp_customize->add_section( $prefix.'_post_standard_format_section' ,
        array(
            'title'       => esc_html__( 'Standard', 'riba-lite' ),
            'description' => esc_html__( 'Post format: Standard (or default) settings', 'riba-lite'),
            'panel' 	  => $panel_id
        )
    );


    /* Enable Author Name  */
    $wp_customize->add_setting( $prefix.'_post_standard_enable_author',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
        $wp_customize,
        $prefix.'_post_standard_enable_author',
            array(
                'type'	=> 'checkbox',
                'label' => esc_html__('Enable Author', 'riba-lite'),
                'description' => esc_html__('Initial status: enabled', 'riba-lite'),
                'section' => $prefix.'_post_standard_format_section',
            )
        )
    );

    /* Enable Posted Ago  */
    $wp_customize->add_setting( $prefix.'_post_standard_enable_posted',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
	    $wp_customize,
	        $prefix.'_post_standard_enable_posted',
	        array(
	            'type'	=> 'checkbox',
	            'label' => esc_html__('Enable Posted ago', 'riba-lite'),
	            'description' => esc_html__('Initial status: enabled', 'riba-lite'),
	            'section' => $prefix.'_post_standard_format_section',
	        )
	    )
    );

    /* Enable Estimated Reading Time  */
    $wp_customize->add_setting( $prefix.'_post_standard_enable_ert',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
	    $wp_customize,
        $prefix.'_post_standard_enable_ert',
	        array(
	            'type'	=> 'checkbox',
	            'label' => esc_html__('Enable Estimated Reading Time', 'riba-lite'),
	            'description' => esc_html__('Initial status: enabled', 'riba-lite'),
	            'section' => $prefix.'_post_standard_format_section',
	        )
	    )
    );

    /***********************************************/
    /************** Image Settings  ***************/
    /***********************************************/


    $wp_customize->add_section( $prefix.'_post_image_format_section' ,
        array(
            'title'       => esc_html__( 'Image', 'riba-lite' ),
            'description' => esc_html__( 'Post format: Image or (featured image) settings here.', 'riba-lite'),
            'panel'       => $panel_id
        )
    );


    /* Enable Author Name  */
    $wp_customize->add_setting( $prefix.'_post_image_enable_author',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
	    $wp_customize,
        $prefix.'_post_image_enable_author',
	        array(
	            'type'  => 'checkbox',
	            'label' => esc_html__('Enable Author', 'riba-lite'),
	            'description' => esc_html__('Initial status: enabled', 'riba-lite'),
	            'section' => $prefix.'_post_image_format_section',
	        )
	    )
    );

    /* Enable Posted Ago  */
    $wp_customize->add_setting( $prefix.'_post_image_enable_posted',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
	    $wp_customize,
        $prefix.'_post_image_enable_posted',
	        array(
	            'type'  => 'checkbox',
	            'label' => esc_html__('Enable Posted ago', 'riba-lite'),
	            'description' => esc_html__('Initial status: enabled', 'riba-lite'),
	            'section' => $prefix.'_post_image_format_section',
	        )
	    )
    );

    /* Enable Estimated Reading Time  */
    $wp_customize->add_setting( $prefix.'_post_image_enable_ert',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
	    $wp_customize,
        $prefix.'_post_image_enable_ert',
	        array(
	            'type'  => 'checkbox',
	            'label' => esc_html__('Enable Estimated Reading Time', 'riba-lite'),
	            'description' => esc_html__('Initial status: enabled', 'riba-lite'),
	            'section' => $prefix.'_post_image_format_section',
	        )
	    )
    );