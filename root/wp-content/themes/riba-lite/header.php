<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
    	<meta charset="<?php bloginfo( 'charset' ); ?>">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="profile" href="http://gmpg.org/xfn/11">
    	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    	<?php wp_head(); ?>
    </head>
    <?php $riba_lite_logo_text = get_theme_mod('riba_lite_text_logo', __('Riba', 'riba-lite') ); ?>
    <body <?php body_class(); ?>>
        <div id="page" class="hfeed site">
            <?php do_action('mtl_site_preloader'); ?>
            <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'riba-lite' ); ?></a>
            <?php do_action('mtl_before_header'); ?>
            <div id="header-container" class="container-fluid">
                <header id="masthead" class="site-header" role="banner">
                    <div class="site-branding col-lg-4 col-md-4 col-sm-4 col-xs-12 text-lg-left text-md-left text-sm-left text-xs-center">
                        <?php echo '<a class="rl-text-logo" href="'. esc_url( home_url( '/' ) ) .'" rel="home" >'. esc_attr( $riba_lite_logo_text ) .'</a>'; ?>
                    </div><!--/.site-branding.col-lg-4.col-md-4.col-sm-4.col-xs-12.text-lg-left.text-md-left.text-sm-left.text-xs-center-->
                    <nav id="site-navigation" class="main-navigation col-lg-8 col-md-8 col-sm-8 xs" role="navigation">
                        <?php wp_nav_menu( array(
                            'theme_location'    => 'primary',
                            'menu_id'           => 'primary-menu',
                            'container_id'      => 'rl-main-menu',
                            'container_class'   => 'hidden-xs',
                            'walker'            => new MTL_Extended_Menu_Walker(),
                            'fallback_cb'       =>  'MTL_Extended_Menu_Walker::fallback',
                        ) ); ?>
                    </nav><!--/#site-navigation.main-navigation.col-lg-8.col-md-8.col-sm-8.xs-->
                </header><!-- #masthead -->
            </div><!--/#header-container.container-fluid-->
            <div class="clearfix"></div>
            <button class="responsive-button"><i class="fa fa-bars" aria-hidden="true"></i></button>
            <nav class="responsive-navigation">
                <?php wp_nav_menu( array(
                    'theme_location'    => 'primary',
                    'menu_id'           => '',
                    'container_id'      => '',
                    'container_class'   => '',
                    'walker'            => new MTL_Extended_Menu_Walker(),
                    'fallback_cb'       =>  'MTL_Extended_Menu_Walker::fallback',
                ) ); ?>
            </nav><!--/.responsive-navigation-->
            <div id="content" class="site-content container-fluid">