<?php

/**
 * Riba Lite back compat functionality
 *
 * Prevents Riba Lite from running on WordPress versions prior to 4.1,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.1.
 *
 * Riba Lite 1.16
 */

if( !function_exists( 'riba_lite_lite_switch_theme' ) ) {
    /**
     * Prevent switching to Riba Lite on old versions of WordPress.
     *
     * Switches to the default theme.
     *
     * Riba Lite 1.16
     */
    function riba_lite_lite_switch_theme()
    {
        switch_theme(WP_DEFAULT_THEME, WP_DEFAULT_THEME);
        unset($_GET['activated']);
        add_action('admin_notices', 'riba_lite_lite_upgrade_notice');
    }

    add_action('after_switch_theme', 'riba_lite_lite_switch_theme');
}

if(!function_exists('riba_lite_lite_upgrade_notice')) {
    /**
     * Add message for unsuccessful theme switch.
     *
     * Prints an update nag after an unsuccessful attempt to switch to
     * Riba Lite on WordPress versions prior to 4.1.
     *
     * Riba Lite 1.16
     */
    function riba_lite_lite_upgrade_notice()
    {
        $message = sprintf(__('Riba Lite requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'riba-lite'), $GLOBALS['wp_version']);
        printf('<div class="error"><p>%s</p></div>', $message);
    }
}

if(!function_exists('riba_lite_lite_customize')) {
    /**
     * Prevent the Customizer from being loaded on WordPress versions prior to 4.1.
     *
     * Riba Lite 1.16
     */
    function riba_lite_lite_customize()
    {
        wp_die(sprintf(__('Riba Lite requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'riba-lite'), $GLOBALS['wp_version']), '', array(
            'back_link' => true,
        ));
    }

    add_action('load-customize.php', 'riba_lite_lite_customize');
}

if(!function_exists('riba_lite_lite_preview')) {
    /**
     * Prevent the Theme Preview from being loaded on WordPress versions prior to 4.1.
     *
     * Riba Lite 1.16
     */
    function riba_lite_lite_preview()
    {
        if (isset($_GET['preview'])) {
            wp_die(sprintf(__('Riba Lite requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'riba-lite'), $GLOBALS['wp_version']));
        }
    }

    add_action('template_redirect', 'riba_lite_lite_preview');
}