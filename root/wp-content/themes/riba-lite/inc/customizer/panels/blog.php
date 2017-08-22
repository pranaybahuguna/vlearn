<?php

    // includes
    require get_template_directory() . '/inc/customizer/custom-controls/slider-selector.php';
	require get_template_directory() . '/inc/customizer/custom-controls/pro-controls-selector.php';

    // Set Panel ID
    $panel_id = 'riba_lite_panel_blog';

    // Set prefix
    $prefix = 'riba_lite';

    /***********************************************/
    /************** BLOG OPTIONS  ***************/
    /***********************************************/


    $wp_customize->add_panel( $panel_id,
        array(
            'priority' => 29,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Single Post Options', 'riba-lite' ),
            'description' => esc_html__( 'Control various blog options from here. Most of the options from this panel refer to the blog single page view. If you\'re not familiar with that term, please perform a Google search.', 'riba-lite' ),
        )
    );

    /***********************************************/
    /************** Global Blog Settings  ***************/
    /***********************************************/

    $wp_customize->add_section( $prefix.'_blog_global_section' ,
        array(
            'title'       => esc_html__( 'Global', 'riba-lite' ),
            'description' => esc_html__( 'This section allows you to control how certain elements are displayed on the blog single page.', 'riba-lite' ),
            'panel' 	  => $panel_id
        )
    );

    /* Posted on on single blog posts */
    $wp_customize->add_setting( $prefix.'_enable_post_posted_on_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control(
        $prefix.'_enable_post_posted_on_blog_posts',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Posted on meta on single blog post', 'riba-lite'),
            'description' => esc_html__('This will disable the posted on zone as well as the author name', 'riba-lite'),
            'section' => $prefix.'_blog_global_section',
        )
    );


    /* Estimated reading time single blog posts */
    $wp_customize->add_setting( $prefix.'_enable_post_esrt_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control(
        $prefix.'_enable_post_esrt_blog_posts',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Estimated reading time meta on single blog post', 'riba-lite'),
            'description' => esc_html__('This will disable the estimated reading time zone.', 'riba-lite'),
            'section' => $prefix.'_blog_global_section',
        )
    );

    /* Post Category on single blog posts */

    $wp_customize->add_setting( $prefix.'_enable_post_category_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 0
        )
    );
    $wp_customize->add_control(
        $prefix.'_enable_post_category_blog_posts',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Category meta on single blog post', 'riba-lite'),
            'description' => esc_html__('This will disable the posted in zone.', 'riba-lite'),
            'section' => $prefix.'_blog_global_section',
        )
    );



    /* Post Tags on single blog posts */
    $wp_customize->add_setting( $prefix.'_enable_post_tags_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control(
        $prefix.'_enable_post_tags_blog_posts',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Tags meta on single blog post', 'riba-lite'),
            'description' => esc_html__('This will disable the tagged with zone.', 'riba-lite'),
            'section' => $prefix.'_blog_global_section',
        )
    );

    /* Post Comments on single blog posts */

    $wp_customize->add_setting( $prefix.'_enable_post_comments_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 0
        )
    );

    $wp_customize->add_control(
        $prefix.'_enable_post_comments_blog_posts',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Coments meta on single blog post', 'riba-lite'),
            'description' => esc_html__('This will disable the comments header zone.', 'riba-lite'),
            'section' => $prefix.'_blog_global_section',
        )
    );


    /* Breadcrumbs on single blog posts */
    $wp_customize->add_setting( $prefix.'_enable_post_breadcrumbs',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );

    $wp_customize->add_control(
        $prefix.'_enable_post_breadcrumbs',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Breadcrumbs on single blog posts', 'riba-lite'),
            'description' => esc_html__('This will disable the breadcrumbs', 'riba-lite'),
            'section' => $prefix.'_blog_global_section',
        )
    );



    /* Social Sharing on single blog posts */
    $wp_customize->add_setting( $prefix.'_enable_social_sharing_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
	    $wp_customize,
        $prefix.'_enable_social_sharing_blog_posts',
	        array(
	            'type'	=> 'checkbox',
	            'label' => esc_html__('Social sharing ?', 'riba-lite'),
	            'description' => esc_html__('Displayed right under the post title', 'riba-lite'),
	            'section' => $prefix.'_blog_global_section',
	        )
	    )
    );


    /* Author Info Box on single blog posts */
    $wp_customize->add_setting( $prefix.'_enable_author_box_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control(
        $prefix.'_enable_author_box_blog_posts',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Author info box on single blog post', 'riba-lite'),
            'description' => esc_html__('Displayed right at the end of the post', 'riba-lite'),
            'section' => $prefix.'_blog_global_section',
        )
    );

    /*  related posts carousel */
    $wp_customize->add_setting( $prefix.'_enable_related_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control(
        $prefix.'_enable_related_blog_posts',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Related posts carousel ?', 'riba-lite'),
            'description' => esc_html__('Displayed after the author box', 'riba-lite'),
            'section' => $prefix.'_blog_global_section',
        )
    );

    /***********************************************/
    /************** Breadcrumb Settings  ***************/
    /***********************************************/

    $wp_customize->add_section( $prefix.'_blog_breadcrumb_section' ,
        array(
            'title'       => esc_html__( 'Breadcrumbs', 'riba-lite' ),
            'description' => esc_html__( 'Various breadcrumb related settings, like: breadcrumb prefix, breadcrumb item separator & breadcrumb menu post category visibility setting.', 'riba-lite'),
            'panel' 	  => $panel_id
        )
    );


    /* BreadCrumb Menu:  Prefix */
    $wp_customize->add_setting($prefix.'_blog_breadcrumb_menu_prefix',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );
    $wp_customize->add_control(
        $prefix.'_blog_breadcrumb_menu_prefix',
        array(
            'label' => esc_html__('Text before the breadcrumbs menu', 'riba-lite'),
            'description' => esc_html__('Recommended: You are here','riba-lite'),
            'section' => $prefix.'_blog_breadcrumb_section',
        )
    );

    /* BreadCrumb Menu:  separator */
    $wp_customize->add_setting($prefix.'_blog_breadcrumb_menu_separator',
        array(
            'sanitize_callback' => $prefix.'_sanitize_radio_buttons',
            'default' => 'rarr'
        )
    );
    $wp_customize->add_control(
        $prefix.'_blog_breadcrumb_menu_separator',
        array(
            'type' => 'select',
            'choices' => array(
                'rarr' => esc_html('&rarr;'),
                'middot' => esc_html('&middot;'),
                'diez' => esc_html('&#35;'),
                'ampersand' => esc_html('&#38;'),
            ),
            'label' => esc_html__('Separator to be used between breadcrumb items', 'riba-lite'),
            'description' => esc_html__('HTML accepted here', 'riba-lite'),
            'section' => $prefix.'_blog_breadcrumb_section',
        )
    );

    /* BreadCrumb Menu:  post category */
    $wp_customize->add_setting($prefix.'_blog_breadcrumb_menu_post_category',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
	    $wp_customize,
        $prefix.'_blog_breadcrumb_menu_post_category',
	        array(
	            'type' => 'checkbox',
	            'label' => esc_html__('Show post category ?', 'riba-lite'),
	            'description' => esc_html__('Show the post category in the breadcrumb ?', 'riba-lite'),
	            'section' => $prefix.'_blog_breadcrumb_section',
	        )
	    )
    );


    /***********************************************/
    /************** Social Blog Settings  ***************/
    /***********************************************/


    $wp_customize->add_section( $prefix.'_blog_social_section' ,
        array(
            'title'       => esc_html__( 'Social Sharing', 'riba-lite' ),
            'description' => esc_html__( 'Control visibility of various social sharing networks. The changes made here will reflect on the blog single post view.', 'riba-lite' ),
            'panel' 	  => $panel_id
        )
    );


    /* Sharing Bar Position */
    $wp_customize->add_setting($prefix.'_social_sharing_position',
        array(
            'sanitize_callback' => $prefix.'_sanitize_radio_buttons',
            'default' => 'after_content'
        )
    );
    $wp_customize->add_control(
        $prefix.'_social_sharing_position',
        array(
            'type'	=> 'radio',
            'choices' => array(
                'after_content' => esc_html__('After content', 'riba-lite'),
                'before_content' => esc_html__('Before Content', 'riba-lite'),
            ),
            'label' => esc_html__('Sharing Bar Postion: After / Before Content', 'riba-lite'),
            'description' => esc_html__('Initial position: after content', 'riba-lite'),
            'section' => $prefix.'_blog_social_section',
        )
    );

    /* Sharing Bar "Share this" content */
    $wp_customize->add_setting($prefix.'_sharing_bar_text',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => esc_html__('Share this article :', 'riba-lite'),
        )
    );
    $wp_customize->add_control(
        $prefix.'_sharing_bar_text',
        array(
            'type'	=> 'text',
            'label' => esc_html__('Text to display above icons', 'riba-lite'),
            'description' => esc_html__('This is the text that will be displayed above the icons. Change this to whatever you feel like', 'riba-lite'),
            'section' => $prefix.'_blog_social_section',
        )
    );

    /* Facebook visibility */
    $wp_customize->add_setting($prefix.'_facebook_visibility',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control (
	    $wp_customize,
        $prefix.'_facebook_visibility',
	        array(
	            'type'	=> 'checkbox',
	            'label' => esc_html__('Display share on Facebook ?', 'riba-lite'),
	            'section' => $prefix.'_blog_social_section',
	        )
	    )
    );

    /* Twitter visibility */
    $wp_customize->add_setting($prefix.'_twitter_visibility',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control (
        $wp_customize,
        $prefix.'_twitter_visibility',
            array(
                'type'	=> 'checkbox',
                'label' => esc_html__('Display share on Twitter ?', 'riba-lite'),
                'section' => $prefix.'_blog_social_section',
            )
        )
    );

    /* LinkedIN visibility */
    $wp_customize->add_setting($prefix.'_linkein_visibility',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
	    $wp_customize,
        $prefix.'_linkein_visibility',
	        array(
	            'type'	=> 'checkbox',
	            'label' => esc_html__('Display share on LinkedIN ?', 'riba-lite'),
	            'section' => $prefix.'_blog_social_section',
	        )
	    )
    );

    /* Reddit visibility */
    $wp_customize->add_setting($prefix.'_reddit_visibility',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
	    $wp_customize,
        $prefix.'_reddit_visibility',
	        array(
	            'type'	=> 'checkbox',
	            'label' => esc_html__('Display share on Reddit?', 'riba-lite'),
	            'section' => $prefix.'_blog_social_section',
	        )
	    )
    );

    /* Tumblr visibility */
    $wp_customize->add_setting($prefix.'_tumblr_visibility',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control(
        $prefix.'_tumblr_visibility',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Display share on Tumblr ?', 'riba-lite'),
            'section' => $prefix.'_blog_social_section',
        )
    );

    /* Google+ visibility */
    $wp_customize->add_setting($prefix.'_googlep_visibility',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
	    $wp_customize,
        $prefix.'_googlep_visibility',
	        array(
	            'type'	=> 'checkbox',
	            'label' => esc_html__('Display share on Google+ ?', 'riba-lite'),
	            'section' => $prefix.'_blog_social_section',
	        )
	    )
    );

    /* Pinterest visibility */
    $wp_customize->add_setting($prefix.'_pinterest_visibility',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
	    $wp_customize,
        $prefix.'_pinterest_visibility',
	        array(
	            'type'	=> 'checkbox',
	            'label' => esc_html__('Display share on Pinterest ?', 'riba-lite'),
	            'section' => $prefix.'_blog_social_section',
	        )
	    )
    );

    /* VK visibility */
    $wp_customize->add_setting($prefix.'_vk_visibility',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control(
        $prefix.'_vk_visibility',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Display share on VK ?', 'riba-lite'),
            'section' => $prefix.'_blog_social_section',
        )
    );


    /* Mail visibility */
    $wp_customize->add_setting($prefix.'_mail_visibility',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control(
        $prefix.'_mail_visibility',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Display share on mail ?', 'riba-lite'),
            'section' => $prefix.'_blog_social_section',
        )
    );



    /***********************************************/
    /************** Related Blog Settings  ***************/
    /***********************************************/

    $wp_customize->add_section( $prefix.'_blog_related_section' ,
        array(
            'title'       => esc_html__( 'Related posts', 'riba-lite' ),
            'description' => esc_html__( 'Control various related posts settings from here. For a demo-like experience, we recommend you don\'t change these settings.', 'riba-lite'),
            'panel' 	  => $panel_id
        )
    );


    /*  related posts title */
    $wp_customize->add_setting( $prefix.'_enable_related_title_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 0
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
	    $wp_customize,
        $prefix.'_enable_related_title_blog_posts',
	        array(
	            'type'	=> 'checkbox',
	            'label' => esc_html__('Show posts title in the carousel ?', 'riba-lite'),
	            'section' => $prefix.'_blog_related_section',
	        )
	    )
    );

    /*  related posts date */
    $wp_customize->add_setting( $prefix.'_enable_related_date_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 0
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
	    $wp_customize,
        $prefix.'_enable_related_date_blog_posts',
	        array(
	            'type'	=> 'checkbox',
	            'label' => esc_html__('Show posts date  ?', 'riba-lite'),
	            'section' => $prefix.'_blog_related_section',
	        )
	    )
    );


    /* Auto play carousel */
    $wp_customize->add_setting( $prefix.'_autoplay_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1,
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
	    $wp_customize,
        $prefix.'_autoplay_blog_posts',
	        array(
	            'type'	=> 'checkbox',
	            'label' => esc_html__('Autoplay related carousel ?', 'riba-lite'),
	            'section' => $prefix.'_blog_related_section',
	        )
	    )
    );

    /* Number of related posts to display at once  */
    $wp_customize->add_setting( $prefix.'_howmany_blog_posts',
        array(
            'sanitize_callback' => 'absint',
            'default' => 1
        )
    );
    $wp_customize->add_control( new Riba_lite_Controls_Slider_Control($wp_customize,
        $prefix.'_howmany_blog_posts',
            array(
                'label' => esc_html__('How many blog posts to display in the carousel at once ?', 'riba-lite'),
                'description' => esc_html__('No more than 4 posts at once;', 'riba-lite'),
                'choices' => array(
                    'min' => 1,
                    'max' => 4,
                    'step' => 1,
                ),
                'section' => $prefix.'_blog_related_section',
                'default' => 3
            )
        )
    );

    /* Display pagination ?  */
    $wp_customize->add_setting( $prefix.'_pagination_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new Riba_lite_Disabled_Custom_Control(
	    $wp_customize,
	        $prefix.'_pagination_blog_posts',
	        array(
	            'type'	=> 'checkbox',
	            'label' => esc_html__('Display pagination controls ?', 'riba-lite'),
	            'description' => esc_html__('Will be displayed as navigation bullets', 'riba-lite'),
	            'section' => $prefix.'_blog_related_section',
	        )
	    )
    );