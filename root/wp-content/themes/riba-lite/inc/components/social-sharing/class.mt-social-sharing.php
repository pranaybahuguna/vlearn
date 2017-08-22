<?php
/**
 * Class MTL_Social_Sharing_Output
 *
 * This file does the social sharing handling for the Muscle Core Lite Framework
 *
 * @author		Cristian Raiber
 * @copyright	(c) Copyright by Macho Themes
 * @link		http://www.machothemes.com
 * @package 	Muscle Core Lite
 * @since		Version 1.0.0
 */


/**
 *
 * Gets called only if the "display social media options" option is checked
 * in the back-end
 *
 * @since   1.0.0
 *
 */
if(!function_exists('MTL_CallSocialMediaClass')) {
    function MTL_CallSocialMediaClass()
    {

        $display_social_sharing = get_theme_mod('riba_lite_enable_social_sharing_blog_posts', 1);

        if ($display_social_sharing == 1) {
            // instantiate the class & load everything else
            MTL_Social_Sharing_Output::getInstance();
        }
    }
    add_action('wp_loaded', 'MTL_CallSocialMediaClass');
}



if( !class_exists( 'MTL_Social_Sharing_Output' ) ) {

    class MTL_Social_Sharing_Output
    {

        /**
         * @var Singleton The reference to *Singleton* instance of this class
         */
        private static $instance;


        protected function __construct() {

            $sharing_bar_position = get_theme_mod('riba_lite_social_sharing_position', 'after_content');

            if( $sharing_bar_position == 'after_content' ) {
                /**
                 * Display the sharing bar at the end of the content
                 */
                add_action('mtl_single_after_content', array($this, 'output_social_sharing_box'), 1);

            } else if( $sharing_bar_position == 'before_content' ) {
                /**
                 * Display social sharing box before the content (right below the big bg. image)
                 */
                add_action('mtl_single_before_content', array($this, 'output_social_sharing_box'), 1);
            }


        }

        /**
         * Returns the *Singleton* instance of this class.
         *
         * @return Singleton The *Singleton* instance.
         */
        public static function getInstance()
        {
            if (null === static::$instance) {
                static::$instance = new static();
            }

            return static::$instance;
        }

        /**
         * Private clone method to prevent cloning of the instance of the
         * *Singleton* instance.
         *
         * @return void
         */
        private function __clone()
        {
        }

        /**
         * Private unserialize method to prevent unserializing of the *Singleton*
         * instance.
         *
         * @return void
         */
        private function __wakeup()
        {
        }


        /**
         * Set up the array for sharing box social networks.
         *
         * @return array  The social links array containing the social media and links to them.
         */
        public function social_links_array()
        {

            /*
             * Build the array
             */
            $social_links_array = array();

            /*
             * Get stored & Set defaults
             */

            $mtl_tumblr = get_theme_mod( 'riba_lite_tumblr_visibility', 1 );
            $mtl_vk = get_theme_mod( 'riba_lite_vk_visibility', 1 );
            $mtl_mail = get_theme_mod( 'riba_lite_mail_visibility', 1 );


            if ($mtl_tumblr) {
                $social_link = 'http://www.tumblr.com/share/link?url=' . rawurlencode(get_the_permalink()) . '&amp;name=' . rawurlencode(get_the_title()) . '&amp;description=' . rawurlencode(get_the_excerpt());
                $social_links_array['tumblr'] = $social_link;
            }

            if ($mtl_vk) {
                $social_link = sprintf('http://vkontakte.ru/share.php?url=%s&amp;title=%s&amp;description=%s', rawurlencode(get_the_permalink()), rawurlencode(get_the_title()), rawurlencode(get_the_excerpt()));
                $social_links_array['vk'] = $social_link;
            }

            if ($mtl_mail) {
                $social_link = 'mailto:?subject=' . get_the_title() . '&amp;body=' . get_the_permalink();
                $social_links_array['mail'] = $social_link;
            }

            return $social_links_array;
        }


        function output_social_sharing_box()
        {

            echo '<div class="text-center mtl-social-sharing-box-wrapper">';
            echo '<div class="row">';
            echo '<div class="mtl-social-sharing-box">';
            echo '<div class="col-xs-12">';


            // Title goes here
            $sharing_bar_title = get_theme_mod('riba_lite_sharing_bar_text', esc_html__('Share this article : ', 'riba-lite') );

            echo '<div class="col-sm-4 text-left">';
                echo '<h4 class="mtl-social-sharing-box-title">'. $sharing_bar_title . '</h4>';
            echo '</div><!--/.col-sm-4-->';



            /*
			 * Start the HTML output
			 */
            echo '<div class="col-sm-8 text-right social-icon-links">';
            foreach ( $this->social_links_array() as $key => $value) {

                switch ($key) {

                    case 'tumblr':
                        echo '<a target="_blank" rel="nofollow" href="' . $value . '" data-toggle="tooltip" data-placement="top" title="Tumblr"><i class="fa fa-tumblr"></i></a>';
                        break;
                    case 'vk':
                        echo '<a target="_blank" rel="nofollow" href="' . $value . '" data-toggle="tooltip" data-placement="top" title="Vkontakte"><i class="fa fa-vk"></i></a>';
                        break;
                    case 'mail':
                        echo '<a target="_blank" rel="nofollow" href="' . $value . '" data-toggle="tooltip" data-placement="top" title="Mail"><i class="fa fa-envelope"></i></a>';
                        break;
                }

            }
            echo '</div><!--/.col-sm-8-->';
            echo '</div><!--/.col-xs-12-->';
            echo '<div class="clearfix"></div>';
            echo '</div><!--/.mt-social-sharing-box-->';
            echo '</div><!--/.row-->';
            echo '</div><!--/.social-sharing-box-wrapper-->';
        }
    }
}



