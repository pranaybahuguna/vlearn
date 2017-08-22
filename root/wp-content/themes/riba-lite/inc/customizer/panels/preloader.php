<?php

	// requires
	require get_template_directory() . '/inc/customizer/custom-controls/pro-controls-selector.php';

    // Set Panel ID
    $panel_id = 'riba_lite_panel_preloader';

    // Set prefix
    $prefix = 'riba_lite';

// @todo: add preloader text font-family control

    /***********************************************/
    /************** GENERAL OPTIONS  ***************/
    /***********************************************/


    $wp_customize->add_panel( $panel_id,
        array(
            'priority' => 28,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Preloader Options', 'riba-lite' ),
            'description' => esc_html__('This panel allows you to control the way the site pre-loader looks', 'riba-lite'),
        )
    );

    /* Layout */
    $wp_customize->add_section( $prefix.'_preloader_general_section' ,
        array(
            'title'       => esc_html__( 'General', 'riba-lite' ),
            'description' => esc_html__( 'Change pre-loader text color, background-color as well as the text message that\'s being displayed.', 'riba-lite'),
            'panel' 	  => $panel_id
        )
    );


    /* Preloader Text */
    $wp_customize->add_setting($prefix.'_preloader_text',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => esc_html__('Loading', 'riba-lite'),
        )
    );

    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
        $wp_customize,
        $prefix.'_preloader_text',
	        array(
	            'type'          => 'text',
	            'label' 		=> esc_html__('Preloader text', 'riba-lite'),
	            'description'   => esc_html__('Current text: Loading', 'riba-lite'),
	            'section' 		=> $prefix.'_preloader_general_section',
	        )
	    )
    );



    /* Preloader Progress Color */
    $wp_customize->add_setting($prefix.'_preloader_progress_color',
        array(
            'sanitize_callback' => 'sanitize_hex_color',
            'default' => '#000',
        )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            $prefix.'_preloader_progress_color',
            array(
                'label' 		=> esc_html__('Preloader Loading Color', 'riba-lite'),
                'description'   => esc_html__('Current value: #000 (black)', 'riba-lite'),
                'section' 		=> $prefix.'_preloader_general_section',
            )
        )
    );

    /* Preloader BG Color */
    $wp_customize->add_setting($prefix.'_preloader_bg_color',
        array(
            'sanitize_callback' => 'sanitize_hex_color',
            'default' => '#FFF'
        )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
    $prefix.'_preloader_bg_color',
            array(

                'label' 		=> esc_html__('Preloader background color', 'riba-lite'),
                'description'   => esc_html__('Current color: #FFF (white) ', 'riba-lite'),
                'section' 		=> $prefix.'_preloader_general_section',
            )
        )
    );

    /* Preloader Text Color */
    $wp_customize->add_setting($prefix.'_preloader_text_color',
        array(
            'sanitize_callback' => 'sanitize_hex_color',
            'default' => '#000'
        )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        $prefix.'_preloader_text_color',
            array(
                'label' 		=> esc_html__('Preloader text color', 'riba-lite'),
                'description'   => esc_html__('Current color: #000 (black) ', 'riba-lite'),
                'section' 		=> $prefix.'_preloader_general_section',
            )
        )
    );


/***********************************************/
/************** Preloader Styles  ***************/
/***********************************************/


    /* Styles  */
    $wp_customize->add_section( $prefix.'_preloader_styles_section' ,
        array(
            'title'       => esc_html__( 'Styles', 'riba-lite' ),
            'description' => esc_html__( 'This section allows you to pick your preloader style. More styles are available in the PRO version', 'riba-lite'),
            'panel' 	  => $panel_id
        )
    );

    /* Preloader Text */
    $wp_customize->add_setting($prefix.'_preloader_style',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => esc_html__('Loading', 'riba-lite'),
        )
    );

    $wp_customize->add_control(
        $prefix.'_preloader_style',

        array(
            'type' => 'select',
            'choices' => array(
              'default' => esc_html__('Default', 'riba-lite'),
            ),
            'label' 		=> esc_html__('Preloader style', 'riba-lite'),
            'description'   => esc_html__('Current style: Default', 'riba-lite'),
            'section' 		=> $prefix.'_preloader_styles_section',
        )
    );

