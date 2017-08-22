<?php


if (function_exists('register_sidebar')) {
    if( !function_exists('riba_lite_register_sidebars') ) {
        function riba_lite_register_sidebars() {

            #
            #    Register sidebars
            #

            register_sidebar(array(
                    'id' => 'footer-sidebar-1',
                    'name' => __('[Footer] Sidebar #1', 'riba-lite'),
                    'description' => __('In the footer, first column', 'riba-lite'),
                    'before_title' => '<h3 class="widget-title"><span>',
                    'after_title' => '</span></h3>',
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' => '</div>')
            );

            register_sidebar(array(
                    'id' => 'footer-sidebar-2',
                    'name' => __('[Footer] Sidebar #2', 'riba-lite'),
                    'description' => __('In the footer, 2nd column', 'riba-lite'),
                    'before_title' => '<h3 class="widget-title"><span>',
                    'after_title' => '</span></h3>',
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' => '</div>')
            );

        } // function riba_lite_register_sidebars end

        add_action('widgets_init', 'riba_lite_register_sidebars');

    } // function exists (riba_lite_register_sidebars) check
} // function exists (register_sidebar) check
