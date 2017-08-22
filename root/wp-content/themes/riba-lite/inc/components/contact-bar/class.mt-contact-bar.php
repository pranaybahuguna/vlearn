<?php
/**
 * Class MTL_Contact_Bar_Output
 *
 * This file does the handling of the contact bar displayed above the header
 *
 * @author		Cristian Raiber
 * @copyright	(c) Copyright by Macho Themes
 * @link		http://www.machothemes.com
 * @package 	Muscle Core Lite (prefix: MTL)
 * @since		Version 1.0.1
 */


if( !function_exists('MTL_CallContactBarClass' ) ) {
    /**
     *
     */
    function MTL_CallContactBarClass()
    {
        // instantiate the class & load everything else
        MTL_Contact_Bar_Output::getInstance();
    }
    add_action( 'wp_loaded', 'MTL_CallContactBarClass' );
}



if( !class_exists( 'MTL_Contact_Bar_Output' ) ) {

    class MTL_Contact_Bar_Output
    {

        /**
         * @var Singleton The reference to *Singleton* instance of this class
         */
        private static $instance;


        protected function __construct()
        {

            // quickly fetch some vars
            $this->facebook_url = get_theme_mod('riba_lite_contact_bar_facebook_url', '#');
            $this->twitter_url = get_theme_mod('riba_lite_contact_bar_twitter_url', '#');
            $this->youtube_url = get_theme_mod('riba_lite_contact_bar_youtube_url', '#');
            $this->pinterest_url = get_theme_mod('riba_lite_contact_bar_pinterest_url', '#');
            $this->linkedin_url = get_theme_mod('riba_lite_contact_bar_linkedin_url', '#');
            $this->email_addr = get_theme_mod('riba_lite_email', 'contact@site.com');
            $this->phone_number = get_theme_mod('riba_lite_phone', '+0 332 548 954');

            // add the action hook to generate the HTML output
            add_action( 'mtl_before_header', array( $this, 'contact_bar_output' ), 1 );
            add_action( 'wp_footer', array( $this, 'search_form_output') );
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

        public function contact_bar_output() {

            // quickly fetch some vars

            echo '<div class="mt-contact-bar container-fluid">';


            echo '<div class="social-bar-details col-sm-7 hidden-xs text-left">';

            if( $this->facebook_url ) {
                echo '<span class="facebook-icon">';
                echo '<i class="fa fa-facebook"></i>';
                    echo '<a href="' . esc_url( $this->facebook_url ).'" rel="nofollow" target="_blank" title="' . esc_html__('Follow on Facebook.', 'riba-lite'). '">' . esc_html__('Facebook', 'riba-lite') . '</a>';
                echo '</span>';
            }
            
            if( $this->twitter_url ) {
                echo '<span class="twitter-icon">';
                echo '<i class="fa fa-twitter"></i>';
                    echo '<a href="' . esc_url( $this->twitter_url ).'" rel="nofollow" target="_blank" title="' . esc_html__('Follow on Twitter', 'riba-lite') . '">' . esc_html__('Twitter', 'riba-lite') .'</a>';
                echo '</span>';
            }

            if( $this->youtube_url ) {
                echo '<span class="youtube-icon">';
                echo '<i class="fa fa-youtube"></i>';
                    echo '<a href="' . esc_url( $this->youtube_url ).'" rel="nofollow" target="_blank" title="' . esc_html__('View on Youtube', 'riba-lite') . '">' . esc_html__('YouTube', 'riba-lite') . '</a>';
                echo '</span>';
            }
            
            if( $this->pinterest_url ) { 
                echo '<span class="pinterest-icon">';
                echo '<i class="fa fa-pinterest"></i>';
                    echo '<a href="' . esc_url( $this->pinterest_url ).'" rel="nofollow" target="_blank" title="' . esc_html__('Follow on Pinterest', 'riba-lite') . '">' . esc_html__('Pinterest', 'riba-lite') . '</a>';
                echo '</span>';
            }
            
            if( $this->linkedin_url ) {
                echo '<span class="linkedin-icon">';
                echo '<i class="fa fa-linkedin"></i>';
                    echo '<a href="' . esc_url( $this->linkedin_url ).'" rel="nofollow" target="_blank" title="' . esc_html__('Follow on LinkedIN', 'riba-lite') . '">' . esc_html__('LinkedIn', 'riba-lite') .'</a>';
                echo '</span>';
            }

            echo '</div><!--/.social-bar-details-->';


            echo '<div class="contact-bar-details col-sm-5 col-xs-12 text-lg-right text-md-right text-sm-right text-xs-center">';

            if( $this->email_addr ) {
                echo '<span class="mail-icon">';
                echo '<i class="fa fa-envelope-o"></i>';
                echo '<a href="mailto:' . esc_html( $this->email_addr ) . '" rel="nofollow">' . esc_html( $this->email_addr ) . '</a>';
                echo '</span>';
            }

            if( $this->phone_number ) {
                echo '<span class="phone-icon">';
                echo '<i class="fa fa-phone"></i>';
                echo '<a href="tel:' . esc_html( $this->phone_number ) . '" rel="nofollow">' . esc_html( $this->phone_number ) . '</a>';
                echo '</span>';
            }

            echo '<span class="search-icon hidden-xs">';
            echo '<a href="#search" rel="nofollow"><i class="fa fa-search"></i>'.esc_html__('Search', 'riba-lite').'</a>';
            echo '</span>';

            echo '</div>';

            echo '</div><!--/.mt-contact-bar-->';

        }

        public function search_form_output() {


            echo '<div id="search">';
            echo '<button type="button" class="close">x</button>';
                echo get_search_form( false );
            echo '</div>';

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

    }
}