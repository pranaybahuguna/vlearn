<?php


/**
 * Class MTL_Related_Posts_Output
 *
 * This file does the social sharing handling for the Muscle Core Lite Framework
 *
 * @author		Cristian Raiber
 * @copyright	(c) Copyright by Macho Themes
 * @link		http://www.machothemes.com
 * @package 	Muscle Core Lite
 * @since		Version 1.0.0
 */

// @todo: make the order of the boxed changeable

if( !function_exists( 'MTL_CallAuthorBoxClass' ) ) {
    /**
     *
     * Gets called only if the "display social media options" option is checked
     * in the back-end
     *
     * @since   1.0.0
     *
     */
    function MTL_CallAuthorBoxClass()
    {
        $display_author_box = get_theme_mod('riba_lite_enable_author_box_blog_posts', 1);

        if ( $display_author_box == 1 ) {
            // instantiate the class & load everything else
            MTL_Author_Box_Output::getInstance();
        }
    }
    add_action('wp_loaded', 'MTL_CallAuthorBoxClass');
}

if( !class_exists( 'MTL_Author_Box_Output' ) ) {

    /**
     * Class MTL_Author_Box_Output
     */
    class MTL_Author_Box_Output {

        /**
         * @var Singleton The reference to *Singleton* instance of this class
         */
        private static $instance;

        /**
         *
         */
        protected function __construct() {
            add_action( 'mtl_single_after_content', array( $this, 'output_author_box' ), 4);
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
         * Simple function that renders the Author Box Mark-up HTML code
         *
         * @return string
         */
        function output_author_box() {

            echo '<div class="container">';
            echo '<div class="mt-author-area row">';
            echo '<div class="col-lg-1 col-md-1 hidden-sm hidden-xs">';
            echo'<a class="mt-author-link" href="'.esc_url( get_author_posts_url( get_the_author_meta() ) ).'" rel="author">';
            echo get_avatar( get_the_author_meta( 'user_email' ), 110 );
            echo '</a>';
            echo '</div>';

            echo '<div class="col-lg-11 col-md-11 col-xs-12">';
            echo '<h4>';
            echo  '<a class="mt-author-link" href="'.esc_url( get_author_posts_url( get_the_author_meta() ) ).'" rel="author">'.esc_html( get_the_author() ).'</a>';
            echo '</h4>';
            echo '<div class="mt-author-info">';
            echo '<p>' . esc_html( get_the_author_meta( 'description' ) ) . '</p>';
            echo '</div>';
            echo '</div><!--/.col-lg-9-->';
            echo '</div> <!--/.rl-author-area-->';
            echo '</div> <!--/.container-->';

        }
    }
}