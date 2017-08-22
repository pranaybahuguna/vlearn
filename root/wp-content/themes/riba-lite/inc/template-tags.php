<?php

if ( ! function_exists( 'riba_lite_content_nav' ) ) {
    /**
     * Display navigation to next/previous pages when applicable
     */
    function riba_lite_content_nav($nav_id)
    {
        global $wp_query, $post;

        // Don't print empty markup on single pages if there's nowhere to navigate.
        if (is_single()) {
            $previous = (is_attachment()) ? get_post($post->post_parent) : get_adjacent_post(false, '', true);
            $next = get_adjacent_post(false, '', false);

            if (!$next && !$previous)
                return;
        }

        // Don't print empty markup in archives if there's only one page.
        if ($wp_query->max_num_pages < 2 && (is_home() || is_archive() || is_search()))
            return;

        $nav_class = (is_single()) ? 'post-navigation' : 'paging-navigation';
        ?>
        <nav role="navigation" id="<?php echo esc_attr($nav_id); ?>" class="<?php echo $nav_class; ?>">
            <h1 class="screen-reader-text"><?php _e('Post navigation', 'riba-lite'); ?></h1>

            <?php if (is_single()) : // navigation links for single posts ?>

                <?php previous_post_link('<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x('&larr;', 'Previous post link', 'riba-lite') . '</span>'); ?>
                <?php next_post_link('<div class="nav-next">%link</div>', '<span class="meta-nav">' . _x('&rarr;', 'Next post link', 'riba-lite') . '</span>'); ?>

            <?php elseif ($wp_query->max_num_pages > 1 && (is_home() || is_archive() || is_search())) : // navigation links for home, archive, and search pages ?>

                <?php if (get_next_posts_link()) : ?>
                    <div
                        class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', 'riba-lite')); ?></div>
                <?php endif; ?>

                <?php if (get_previous_posts_link()) : ?>
                    <div
                        class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>', 'riba-lite')); ?></div>
                <?php endif; ?>

            <?php endif; ?>
            <div class="clearfix"></div>
        </nav><!-- #<?php echo esc_html($nav_id); ?> -->
        <?php
    }
}


/**
 * Riba Lite only works in WordPress 4.1 or later.
 */


if ( ! function_exists( 'the_archive_title' ) && version_compare( $GLOBALS['wp_version'], '4.3', '<' ) ) {
    /**
     * Shim for `the_archive_title()`.
     *
     * Display the archive title based on the queried object.
     *
     * @todo Remove this function when WordPress 4.3 is released.
     *
     * @param string $before Optional. Content to prepend to the title. Default empty.
     * @param string $after Optional. Content to append to the title. Default empty.
     */
    function the_archive_title($before = '', $after = '')
    {
        if (is_category()) {
            $title = sprintf(esc_html__('Category: %s', 'riba-lite'), single_cat_title('', false));
        } elseif (is_tag()) {
            $title = sprintf(esc_html__('Tag: %s', 'riba-lite'), single_tag_title('', false));
        } elseif (is_author()) {
            $title = sprintf(esc_html__('Author: %s', 'riba-lite'), '<span class="vcard">' . get_the_author() . '</span>');
        } elseif (is_year()) {
            $title = sprintf(esc_html__('Year: %s', 'riba-lite'), get_the_date(esc_html_x('Y', 'yearly archives date format', 'riba-lite')));
        } elseif (is_month()) {
            $title = sprintf(esc_html__('Month: %s', 'riba-lite'), get_the_date(esc_html_x('F Y', 'monthly archives date format', 'riba-lite')));
        } elseif (is_day()) {
            $title = sprintf(esc_html__('Day: %s', 'riba-lite'), get_the_date(esc_html_x('F j, Y', 'daily archives date format', 'riba-lite')));
        } elseif (is_tax('post_format')) {
            if (is_tax('post_format', 'post-format-aside')) {
                $title = esc_html_x('Asides', 'post format archive title', 'riba-lite');
            } elseif (is_tax('post_format', 'post-format-gallery')) {
                $title = esc_html_x('Galleries', 'post format archive title', 'riba-lite');
            } elseif (is_tax('post_format', 'post-format-image')) {
                $title = esc_html_x('Images', 'post format archive title', 'riba-lite');
            } elseif (is_tax('post_format', 'post-format-video')) {
                $title = esc_html_x('Videos', 'post format archive title', 'riba-lite');
            } elseif (is_tax('post_format', 'post-format-quote')) {
                $title = esc_html_x('Quotes', 'post format archive title', 'riba-lite');
            } elseif (is_tax('post_format', 'post-format-link')) {
                $title = esc_html_x('Links', 'post format archive title', 'riba-lite');
            } elseif (is_tax('post_format', 'post-format-status')) {
                $title = esc_html_x('Statuses', 'post format archive title', 'riba-lite');
            } elseif (is_tax('post_format', 'post-format-audio')) {
                $title = esc_html_x('Audio', 'post format archive title', 'riba-lite');
            } elseif (is_tax('post_format', 'post-format-chat')) {
                $title = esc_html_x('Chats', 'post format archive title', 'riba-lite');
            }
        } elseif (is_post_type_archive()) {
            $title = sprintf(esc_html__('Archives: %s', 'riba-lite'), post_type_archive_title('', false));
        } elseif (is_tax()) {
            $tax = get_taxonomy(get_queried_object()->taxonomy);
            /* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
            $title = sprintf(esc_html__('%1$s: %2$s', 'riba-lite'), $tax->labels->singular_name, single_term_title('', false));
        } else {
            $title = esc_html__('Archives', 'riba-lite');
        }

        /**
         * Filter the archive title.
         *
         * @param string $title Archive title to be displayed.
         */
        $title = apply_filters('get_the_archive_title', $title);

        if (!empty($title)) {
            echo $before . $title . $after;  // WPCS: XSS OK.
        }
    }
}

if ( ! function_exists( 'the_archive_description' ) ) {
    /**
     * Shim for `the_archive_description()`.
     *
     * Display category, tag, or term description.
     *
     * @todo Remove this function when WordPress 4.3 is released.
     *
     * @param string $before Optional. Content to prepend to the description. Default empty.
     * @param string $after Optional. Content to append to the description. Default empty.
     */
    function the_archive_description($before = '', $after = '')
    {
        $description = apply_filters('get_the_archive_description', term_description());

        if (!empty($description)) {
            /**
             * Filter the archive description.
             *
             * @see term_description()
             *
             * @param string $description Archive description to be displayed.
             */
            echo $before . $description . $after;  // WPCS: XSS OK.
        }
    }
}

if( !function_exists( 'riba_lite_categorized_blog' ) ) {
    /**
     * Returns true if a blog has more than 1 category.
     *
     * @return bool
     */
    function riba_lite_categorized_blog()
    {

        if (false === ($all_the_cool_cats = get_transient('riba_lite_categories'))) {

            // Create an array of all the categories that are attached to posts.
            $all_the_cool_cats = get_categories(array(
                'fields' => 'ids',
                'hide_empty' => 1,

                // We only need to know if there is more than one category.
                'number' => 2,
            ));

            // Count the number of categories that are attached to the posts.
            $all_the_cool_cats = count($all_the_cool_cats);

            set_transient('riba_lite_categories', $all_the_cool_cats);
        }

        if ($all_the_cool_cats > 1) {
            // This blog has more than 1 category so riba_lite_categorized_blog should return true.
            return true;
        } else {
            // This blog has only 1 category so riba_lite_categorized_blog should return false.
            return false;
        }
    }
}

if( !function_exists( 'riba_lite_category_transient_flusher' ) ) {
    /**
     * Flush out the transients used in riba_lite_categorized_blog.
     */
    function riba_lite_category_transient_flusher()
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        // Like, beat it. Dig?
        delete_transient('riba_lite_categories');
    }

    add_action('edit_category', 'riba_lite_category_transient_flusher');
    add_action('save_post', 'riba_lite_category_transient_flusher');
}