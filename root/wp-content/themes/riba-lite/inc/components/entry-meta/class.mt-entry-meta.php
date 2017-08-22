<?php


/**
 *
 *
 * @since   1.0.0
 *
 */
if(!function_exists('MTL_CallEntryMetaClass')) {
    /**
     *
     */
    function MTL_CallEntryMetaClass()
    {

        // instantiate the class & load everything else
        MTL_Entry_Meta_Output::getInstance();

    }
    add_action('wp_loaded', 'MTL_CallEntryMetaClass');
}



if( !class_exists( 'MTL_Entry_Meta_Output' ) ) {

    class MTL_Entry_Meta_Output
    {

        /**
         * @var Singleton The reference to *Singleton* instance of this class
         */
        private static $instance;


        protected function __construct()
        {

            add_action('mtl_entry_meta', array($this, 'entry_meta_output'), 1);
	        add_action('mtl_single_after_content', array($this, 'entry_footer_output'), 2);
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

        public function entry_meta_output() {

            // quickly fetch some vars
            $display_post_posted_on_meta = get_theme_mod('riba_lite_enable_post_posted_on_blog_posts', 1);
            $display_post_esrt_meta = get_theme_mod('riba_lite_enable_post_esrt_blog_posts', 1);

            echo '<div class="entry-meta parallax-text-fade">';

            if( $display_post_posted_on_meta == 1 ) {
               echo $this->posted_on_output();
            }

            if( $display_post_esrt_meta == 1 ) {
               echo $this->reading_time_output();
            }

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



        /**
         * Function to estimate the reading time of a post, based on the average reading speed of 200 words / minute
         */
        function reading_time_output() {

            $post = get_post();

            $words = str_word_count(strip_tags($post->post_content));
            $minutes = floor($words / 200);


            if ( $minutes >= 1 ) {
                $estimated_time = $minutes . __(' min. read', 'riba-lite');
            } else {
                $estimated_time = sprintf('%s', __('1 min. read', 'riba-lite') );
            }

            echo '<span class="riba-lite-estimated-reading-time">'. $estimated_time . '</span>';
        }

        /**
         * Prints HTML with meta information for the current post-date/time and author.
         */
        function posted_on_output()
        {
            global $post;


            if( get_post_format() !== false ) {
                $display_author = get_theme_mod('riba_lite_post_'.esc_attr( get_post_format( $post->ID ) ).'_enable_author', 1);
                $display_date = get_theme_mod('riba_lite_post_'.esc_attr( get_post_format( $post-> ID ) ).'_enable_posted', 1);
            } else {
                $display_author = get_theme_mod('riba_lite_post_standard_enable_author', 1);
                $display_date = get_theme_mod('riba_lite_post_standard_enable_posted', 1);
            }


            $posted_on = sprintf(
                esc_html_x( '%s ago', '%s = human-readable time difference', 'riba-lite' ),
                human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) )
            );


            $byline = sprintf(
                esc_html_x('%s', 'post author', 'riba-lite'),
                '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta('ID') ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
            );



            if( $display_author == 1 ) {
                echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
            }


            if( $display_date == 1 ) {
                echo '<span class="posted-on">' . $posted_on . '</span>';
            }
        }

	    /**
	     * Prints HTML with meta information for the categories, tags and comments.
	     */
	    public function entry_footer_output() {
            echo '<div class="mt-entry-footer">';
            echo '<footer>';

            $display_category_post_meta = get_theme_mod( 'riba_lite_enable_post_category_blog_posts', 1 );
            $display_tags_post_meta     = get_theme_mod( 'riba_lite_enable_post_tags_blog_posts', 1 );
            $display_number_comments    = get_theme_mod( 'riba_lite_enable_post_comments_blog_posts', 1 );


            # Hide category and tag text for pages.
            if ( 'post' == get_post_type() ) {

	            echo '<div class="row">';

	            echo '<div class="col-sm-6">';
                # check if category post meta is enabled
                if ( $display_category_post_meta == 1 ) {

                    // translators: used between list items, there is a space after the comma
                    $categories_list = get_the_category_list( esc_html__( ', ', 'riba-lite' ) );

                    if ( $categories_list && riba_lite_categorized_blog() ) {
                        printf( '<span class="cat-links"><i class="fa fa-tags"></i>' . esc_html__( 'Posted in: %1$s', 'riba-lite' ) . '</span>', $categories_list ); // WPCS: XSS OK.
                    }
                }
	            echo '</div><!--/.col-sm-6-->';
            } # end if

            # check if comment meta is enabled
            if ( $display_number_comments == 1 ) {
	            echo '<div class="col-sm-6 text-right">';

                if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
                    echo '<span class="comments-link"><i class="fa fa-comment"></i>';
                    comments_popup_link( esc_html__( 'Leave a comment', 'riba-lite' ), esc_html__( '1 Comment', 'riba-lite' ), esc_html__( '% Comments', 'riba-lite' ) );
                    echo '</span>';
                }

	            echo '</div><!--/.col-sm-6-->';
	            echo '</div><!--/.row-->';
            } # end if


            # Hide category and tag text for pages.
            if ( 'post' == get_post_type() ) {

	            echo '<div class="row">';

                # check if tags post meta is enabled
                if ( $display_tags_post_meta == 1 ) {

	                echo '<div class="col-xs-12">';

                    /* translators: used between list items, there is a space after the comma */
                    $tags_list = get_the_tag_list( '', esc_html__( ' ', 'riba-lite' ) );
                    if ( $tags_list ) {
                        echo '<span class="tags-links">' . $tags_list . '</span>'; // WPCS: XSS OK.
                    }
                }

	            echo '</div><!--/.col-xs-12-->';
	            echo '</row><!--/.row-->';
            }

		    echo '</footer>';
		    echo '</div><!--/.entry-footer-->';

	    }
    }
}