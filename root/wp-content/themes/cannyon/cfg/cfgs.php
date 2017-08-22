<?php

$facebook_title         = 'Hello my friends. A few minutes ago I found Cannyon freemium and easy to customize WordPress theme. I love it! I suggest you to try it! #Cannyon';
$facebook_url           = 'http://bit.ly/1FpeFwB';

$gplus                  = 'http://bit.ly/1gFYiju';
$twitter                = 'Hello my friends. A few minutes ago I found #Cannyon freemium and easy to customize WordPress theme. I love it! http://bit.ly/1L0xmsT';

$pinterest_description  = 'Hello my friends. A few minutes ago I found Cannyon freemium and easy to customize WordPress theme. I love it! I suggest you to try it! #Cannyon';
$pinterest_url          = 'http://bit.ly/1j2AOXu';
$media                  = get_template_directory_uri() . '/screenshot.png';

$mailto_subject          = str_replace( '&amp;', '%26', rawurlencode( 'I suggest you to try Cannyon' ) );
$mailto_body             = str_replace( '&amp;', '%26', rawurlencode( 'Hello my friends. A few minutes ago I found Cannyon freemium and easy to customize WordPress theme. I love it! I suggest you to try it!' . "\n\n" . 'http://bit.ly/1KucFA2' ) );


$cfgs = array(

    /* AUTHOR */
    'author'        => array(
        'name'              => 'myThem.es',
        'description'       => __( 'myThem.es Marketplace provides WordPress themes with the best quality and the smallest prices.' , 'cannyon' ),
        'url'               => 'http://mythem.es/'
    ),

    /* THEMES */
    'theme'         => array(
        'type'              => 'free',
        'description'       => __( 'Cannyon - free Responsive and Multipupose WordPress Themes.' , 'cannyon' ),
        'premium'           => 'http://mythem.es/item/cannyon-premium-multipurpose-wordpress-theme/'
    ),

    /* LINKS */
    'links'         => array(
        'referrals'         => 'http://mythem.es/referrals/',
        'affiliates'        => 'http://mythem.es/affiliates/',
        'plugins'           => 'javascript:void(null);',
        'items'             => 'http://mythem.es/our-items/'
    ),

    'faqs'          => array(
        array(
            'title'     => __( 'Welcome Message !' , 'cannyon' ),
            'content'   =>

                '<p>' . __( 'Thank you for choosing myThem.es and use one of our WordPress Themes your choice is greatly appreciated!' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'If you have any questions - just ask!' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'Please help us increase the theme quality by reporting bugs.' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'And also please help us increase the theme rank!' , 'cannyon' ) . '</p>' .

                '<p><a href="http://bit.ly/1Opraev" target="_blank">https://wordpress.org/themes/cannyon/</a></p>' .

                '<br/>' .

                '<div class="mythemes-social">' .

                '<a href="https://www.facebook.com/sharer/sharer.php?display=popup&amp;u=' . urlencode( esc_url( $facebook_url ) ) . '&amp;t=' . urlencode( esc_attr( $facebook_title ) ) . '" class="btn facebook" data-social-network-link="" rel="nofollow" target="_blank" onclick="javascript:window.open( this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600\');return false;"><i class="mythemes-icon-facebook"></i></a>' .
                '<a href="https://plus.google.com/share?url=' . urlencode( esc_url( $gplus ) ) . '" class="btn gplus" data-social-network-link="" rel="nofollow" target="_blank" onclick="javascript:window.open( this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=350,width=480\');return false;"><i class="mythemes-icon-gplus"></i></a>' .
                '<a href="https://twitter.com/intent/tweet?text=' . urlencode( esc_attr( $twitter ) ) . '" class="btn twitter" data-social-network-link="" rel="nofollow" target="_blank" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600\');return false;"><i class="mythemes-icon-twitter"></i></a>' .
                '<a href="http://pinterest.com/pin/create/button?description=' . urlencode( esc_attr( $pinterest_description ) ) . '&amp;media=' . urlencode( esc_url( $media ) ) . '&amp;url=' . urlencode( esc_url( $pinterest_url ) ) . '" class="btn pinterest" data-social-network-link="" rel="nofollow" target="_blank" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600\');return false;"><i class="mythemes-icon-pinterest"></i></a>' .
                '<a href="mailto:?Subject=' . esc_attr( $mailto_subject ) . '&amp;Body=' . esc_attr( $mailto_body ) . '" class="btn mail" data-social-network-link="" rel="nofollow" target="_blank" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600\');return false;"><i class="mythemes-icon-mail"></i></a>' .

                '<div class="clear clearfix"></div>' .

                '</div>'
        ),
        array(
            'title'     => __( 'Default content from Sidebars: Front Page, Footer, Blog, Single.' , 'cannyon' ),
            'content'   =>

                '<p><big><strong>' . __( 'GENERAL ABOUT DEFAULT CONTENT' , 'cannyon' ) . '</strong></big></p>' .

                '<p>' . __( 'The default content is available only in sidebars !' , 'cannyon' ) . '</p>' .
                '<p>' . __( 'The default content is hardcoded in theme files. But you can:' , 'cannyon' ) . '</p>' .
                '<p>' . __( '1. Disable all default content and fill with your content.', 'cannyon' ) . '</p>' .
                '<p>' . __( '2. Replace one or more sections with your content.', 'cannyon' ) . '</p>' .

                '<div id="mythemes-header-alert" class="mythemes-flat-alert success"><p>' .
                __( 'You can disable all default content if you go to <strong>Admin Dashboard &rsaquo; Appearance &rsaquo; Customize &rsaquo; Additional</strong> and uncheck "Display default content" option.' , 'cannyon' ) .
                '</p></div>' .

                '<p>' . __(  'To replace Header - Front Page default content ( with 3 sidebars )' , 'cannyon' ) . '</p>' .
                '<p>' . __( 'go to: <strong>Admin Dashboard &rsaquo; Appearance &rsaquo; Widgets</strong>' , 'cannyon' ) . '</p>' .
                '<p>' . __( 'here you have multiple sidebars as well as the ones below:' , 'cannyon' ) . '</p>' .

                '<p>' . __( '...' , 'cannyon' ) . '</p>' .
                '<p>' . __( 'Header - First Front Page Sidebar' , 'cannyon' ) . '</p>' .
                '<p>' . __( 'Header - Second Front Page Sidebar' , 'cannyon' ) . '</p>' .
                '<p>' . __( 'Header - Third Front Page Sidebar' , 'cannyon' ) . '</p>' .
                '<p>' . __( '...' , 'cannyon' ) . '</p>' .

                '<p>' . __( '<strong>IMPORTANT</strong>: if the option "Display default content" is enabled and the Header Sidebars is empty then the default content ( hardcoded ) in this sidebar will be displayed.' , 'cannyon' ) . '</p>' .
                '<p>' . __( 'You just need to put a text widget into a header sidebar and fill the Text widget with you Title and with your Content.' , 'cannyon' ) . '</p>' .
                '<p>' . __( '<strong>IMPORTANT</strong>: The widgets are placed on the left and the sidebars are placed on the right ( <strong>Appearance &rsaquo; Widgets</strong> ).' , 'cannyon' ) . '</p>' .


                '<br/><hr><br/><br/>'.


                '<p><big><strong>' . __( 'FRONT PAGE' , 'cannyon' ) . '</strong></big></p>' .

                '<p>' . __( 'On the home page, there are 3 components below the HEADER image:' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p>' . __( '1. MANY COMPONENTS' , 'cannyon' ) . '</p>' .
                '<p>' . __( '2. BLOCK MODEL' , 'cannyon' ) . '</p>' .
                '<p>' . __( '3. RESPONSIVE LAYOUT' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p>' . __( 'Here we have three sidebars with default content. These are "Header Front Page Sidebars". If you go to Admin Dashboard &rsaquo; Appearance &rsaquo; Widgets you can see:' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p>' . __( '1. Header - First Front Page sidebar' , 'cannyon' ) . '</p>' .
                '<p>' . __( '2. Header - Second Front Page sidebar' , 'cannyon' ) . '</p>' .
                '<p>' . __( '3. Header - Third Front Page sidebar' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p>' . __( 'You can replace the default content with your custom content. Just put a "Text" widget into each "Header Front Page Sidebar" and fill it with your content.' , 'cannyon' ) . '</p>' .

                '<br/><hr><br/><br/>'.

                '<p><big><strong>' . __( 'FOOTER' , 'cannyon' ) . '</strong></big></p>' .

                '<p>' . __( 'In the footer before the copyright section there are 4 components:' , 'cannyon' ) . '</p>' .

                '<br/>'.

                '<p>' . __( '1. Cannyon' , 'cannyon' ) . '</p>' .
                '<p>' . __( '2. ADDRESS' , 'cannyon' ) . '</p>' .
                '<p>' . __( '3. CONTACT' , 'cannyon' ) . '</p>' .
                '<p>' . __( '4. WORKING HOURS' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p>' . __( 'Here we have four sidebars with default content. These are "Footer Sidebars". You can see sidebars in Admin Dashboard &rsaquo; Appearance &rsaquo; Widgets:' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p>' . __( '1. Footer - First Sidebar ( uses the sample Text widget )' , 'cannyon' ) . '</p>' .
                '<p>' . __( '2. Footer - Second Sidebar ( uses the sample Text widget )' , 'cannyon' ) . '</p>' .
                '<p>' . __( '3. Footer - Third Sidebar ( uses the sample Text widget )' , 'cannyon' ) . '</p>' .
                '<p>' . __( '4. Footer - Fourth Sidebar ( uses the sample Text widget )' , 'cannyon' ) . '</p>' .

                '<br/><hr><br/><br/>'.

                '<p><big><strong>' . __( 'BLOG ( MAIN SIDEBAR )' , 'cannyon' ) . '</strong></big></p>' .

                '<p>' . __( 'The content from next widgets: "Search", "Tags Cloud" and "Categories" is used by default.' , 'cannyon' ) . '</p>' .

                '<br/><hr><br/><br/>'.

                '<p><big><strong>' . __( 'SINGLE POST ( SINGLE SIDEBAR )' , 'cannyon' ) . '</strong></big></p>' .

                '<p>' . __( 'The content from next widgets: "Post Meta [myThem.es]", "Post Categories [myThem.es]" and "Post Tags [myThem.es]" is used by default.' , 'cannyon' ) . '</p>' .

                '<br/><hr><br/><br/>'.

                '<p><big><strong>' . __( 'REPLACE CONTENT VS DISABLE DEFAULT CONTENT' , 'cannyon' ) . '</strong></big></p>' .

                '<p>' . __( 'If you disable the default content it will disable all default content from your web site ( sidebars with default content listed below ):' , 'cannyon' ) . '</p>' .

                '<br/>'.

                '<p>' . __( '- Front Page Heade Sidebars' , 'cannyon' ) . '</p>' .
                '<p>' . __( '- Footer Sidebars' , 'cannyon' ) . '</p>' .
                '<p>' . __( '- Main Blog Sidebar' , 'cannyon' ) . '</p>' .
                '<p>' . __( '- Single Sidebar' , 'cannyon' ) . '</p>' .
                '<p>' . __( '- ...' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<p>' . __( 'Also you can replace the default content with your content. This will allow you to make one or more changes. You will not need to replace all default content.' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'To replace the default content you need to add a widget with your content in the sidebar with default content ( listed above). The default content will automatically change with your content (only for this sidebar).' , 'cannyon' ) . '</p>'

        ),
        array(
            'title'     => __( 'Custom CSS and Customizations' , 'cannyon' ),
            'content'   =>

                '<p>' . __( 'This theme comes with special option. This option allow add custom css to customize your web site to your needs.' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'To use it go to Admin Dashboard' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'Appearance &rsaquo; Customize &rsaquo; Additional Css.' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'You can use it for multiple cases, just need to add you css in this field.' , 'cannyon' ) . '</p>'
        ),
        array(
            'title'     => __( 'Customize the Theme' , 'cannyon' ),
            'content'   =>

                '<p>' . __( 'This theme comes with a set of options what allow you to customize content, header, layouts, social items and other.' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'You can see theme options if you go to Admin Dashboard' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'Appearance &rsaquo; Customize' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'Here you can see:' , 'cannyon' ) . '</p>' .

                '<br/>' .

                '<ol>' .
                '<li>' . __( 'Site Identity' , 'cannyon' ) . '</li>' .
                '<li>' . __( 'Colors' , 'cannyon' ) . '</li>' .
                '<li>' . __( 'Background Image' , 'cannyon' ) . '</li>' .
                '<li>' . __( 'Header Image' , 'cannyon' ) . '</li>' .
                '<li>' . __( 'Header Elements' , 'cannyon' ) . '</li>' .
                '<li>' . __( 'Breadcrumbs' , 'cannyon' ) . '</li>' .
                '<li>' . __( 'Additional' , 'cannyon' ) . '</li>' .
                '<li>' . __( 'Layout' , 'cannyon' ) . '</li>' .
                '<li>' . __( 'Social' , 'cannyon' ) . '</li>' .
                '<li>' . __( 'Others' , 'cannyon' ) . '</li>' .
                '<li>' . __( 'Menus' , 'cannyon' ) . '</li>' .
                '<li>' . __( 'Widgets' , 'cannyon' ) . '</li>' .
                '<li>' . __( 'Static Front Page' , 'cannyon' ) . '</li>' .
                '</ol>' .

                '<br/>' .

                '<p>' . __( 'All you have to do is change them and view live changes.' , 'cannyon' ) . '</p>' .

                '<p>' . __( 'Try and you will discover how easy it is to customize.' , 'cannyon' ) . '</p>'
        )

    ),
    'diff'          => array(
        array(
            __( 'Support' , 'cannyon' ),
            __( 'Basic', 'cannyon' ),
            __( 'Priority', 'cannyon' )
        ),
        array(
            __( 'Customizations' , 'cannyon' ),
            __( 'Selective ( at our choice )', 'cannyon' ),
            __( 'Basic &amp; Selective ( at our choice )', 'cannyon' )
        ),
        array(
            __( 'Premium Support' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Documentation' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Responsive layout' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Full support for multilanguages' , 'cannyon' ),
            0,
            1,
        ),
        array(
            __( 'NEW! Support for Custom Fonts ( with plugin Easy Google Fonts )' , 'cannyon' ),
            0,
            1,
        ),
        array(
            __( 'Custom Favicon' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Custom Logo' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Custom Colors' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Scrollable header Menu' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Menu Custom Colors (full)', 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Quick Contact Info ( email, phone )' , 'cannyon' ),
            0,
            1,
        ),
        array(
            __( 'Custom Header ( colors, elements )', 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Custom breadcrumbs settings' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Front Page Header Sidebars ( 3 )' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Shortcodes' , 'cannyon' ),
            '0',
            '26'
        ),
        array(
            __( 'Shortcodes Manager' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'NEW! List [Shortcode]' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'NEW! Timeline [Shortcode]' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'NEW! Post Grid [Shortcode]' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'NEW! Post List [Shortcode]' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Classic Blog View' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Classic Blog View Styles' , 'cannyon' ),
            '1',
            '4'
        ),
        array(
            __( 'Grid Blog View' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Grid Blog View Styles' , 'cannyon' ),
            '0',
            '4'
        ),
        array(
            __( 'Infinit Scroll (autoload posts on page scroll)' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Custom page Template "Blog" with settings' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'WP Classic comments' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Facebook comments' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Disqus comments' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'General header settings' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Single post header settings ( each post )' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Single page header settings ( each page )' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Single portfolio Header settings ( each portfolio )' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Related Posts ( by Tags or Categories )' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Front Page layout' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'General layout settings' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Posts layout settings' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Single post layout settings ( each post )' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Page layout settings' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Single page layout settings ( each page )' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Sidebar builder ( build unlimited number of sidebars )' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Social settings' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Footer Sidebars' , 'cannyon' ),
            '4',
            '4'
        ),
        array(
            __( 'Footer background image' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Footer background color' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Footer link and text colors' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Footer copyright settings' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Footer credit link settings' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Footer Custom Menu' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Custom CSS' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Additional JavaScript settings' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Exclude pages / posts / features / testimonials from the search results' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Exclude pages / posts / features / testimonials from the RSS Feed' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'External URL for each post / page' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Video thumbnail extractor - YouTube &amp; Vimeo for each post' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Post slideshow instead of thumbnail' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( '2 Addvertising section ( before and after content ) for each post' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Custom post Testimonials' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Custom post Features' , 'cannyon' ),
            0,
            1
        ),
        array(
            __( 'Additional Widgets' , 'cannyon' ),
            4,
            9
        ),
        array(
            __( 'Gallery special Effects' , 'cannyon' ),
            '1',
            '5'
        ),
        array(
            __( 'jetpack widgets [styled]' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'jetpack related posts [styled]' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'jetpack post numbers of views' , 'cannyon' ),
            1,
            1
        ),
        array(
            __( 'Contact Form 7 [styled]' , 'cannyon' ),
            1,
            1
        )
    )
);

mythemes_cfg::set( $cfgs );
?>
