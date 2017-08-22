<?php

/**
 * Class that handles the preloader style output
 *
 * @since   1.0.0
 *
 */


// @todo: add more preloader styles

if(!function_exists('MTL_CallPreloaderClass')) {
    /**
     *
     */
    function MTL_CallPreloaderClass()
    {

        // instantiate the class & load everything else
        MTL_Preloader_Output::getInstance();

    }
    add_action('wp_loaded', 'MTL_CallPreloaderClass');
}

if(!class_exists('MTL_Preloader_Output')) {
    /**
     * Class MTL_Preloader_Output
     */
    class MTL_Preloader_Output
    {


        /**
         * @var Singleton The reference to *Singleton* instance of this class
         */
        private static $instance;


        protected function __construct()
        {
            //var setting
            $this->preloader_is_enabled = get_theme_mod('riba_lite_enable_site_preloader', 1);
            $this->preloader_text = get_theme_mod('riba_lite_preloader_text', __('Loading', 'riba-lite'));
            $this->preloader_bg_color = get_theme_mod('riba_lite_preloader_bg_color', '#FFF');
            $this->preloader_progress_color = get_theme_mod('riba_lite_preloader_progress_color', '#000');
            $this->preloader_text_color = get_theme_mod('riba_lite_preloader_text_color', '#000');
            $this->preloader_style = get_theme_mod('riba_lite_preloader_style', 'default');

            // Hooks
            add_action('mtl_site_preloader', array($this, 'preloader_markup_output'), 1);
            add_action('wp_enqueue_scripts', array($this, 'preloader_style_output'), 99);
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
         *  Output preloader HTML mark-up
         */
        function preloader_markup_output()
        {
            global $wp_customize;

            if (!isset($wp_customize) && $this->preloader_is_enabled == 1) { ?>
                <!-- Site Preloader -->
                <div id="page-loader">
                    <div class="page-loader-inner">
                        <div class="loader"><strong><?php echo esc_html($this->preloader_text); ?></strong></div>
                    </div>
                </div>
                <!-- END Site Preloader -->
                <?php

            }
        } // preloader_markup_output

        /**
         * Output preloader CSS
         *
         * Hooked to wp_head
         */
        function preloader_style_output()
        {

            if ($this->preloader_is_enabled == 1) {

                switch( $this->preloader_style ) {
                    case 'default':
                        $this->preloader_style_minimal();
                        break;
                    /*
                    case 'flash':
                        $this->preloader_style_flash();
                        break;
                    */

                }
                # Add custom body class for more CSS weight
                add_filter('body_class', array($this, 'preloader_body_class'));

            }

        } // preloader_style_output


        /**
         * Add custom body class to give some more weight to our styles.
         *
         * @since  1.0.0
         * @access public
         * @param  array $classes
         * @return array
         */
        function preloader_body_class($classes)
        {
            return array_merge($classes, array('mt-preloader'));

        } //preloader_body_class


        function preloader_style_minimal() {

                $css = '.pace .pace-progress {';
                    $css .= 'background: ' . esc_attr( $this->preloader_progress_color ) . ';';
                $css .= '}';

                $css .= '#page-loader {';
                    $css .= 'font-family: \'Montserrat\';';
                    $css .= 'background: '. esc_attr( $this->preloader_bg_color ).';';
                $css .= '}';


                $css .= '#page-loader .loader {';
                    $css .= 'color: '.esc_attr( $this->preloader_text_color ).';';
                $css .= '}';

            if( $css ) {
                wp_enqueue_style('preloader-minimal-style', get_template_directory_uri() . '/inc/components/preloader/assets/css/preloader-minimal-style.css');
                wp_add_inline_style('preloader-minimal-style', $css);
            }
        }
    } // actual class
} // class exists



