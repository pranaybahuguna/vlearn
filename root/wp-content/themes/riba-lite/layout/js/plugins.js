(function($) {


    'use strict';

    /* ==========================================================================
                     When document is ready, do
   ========================================================================== */
    $(document).ready(function() {


        // simplePlaceholder - polyfill for mimicking the HTML5 placeholder attribute using jQuery
        // https://github.com/marcgg/Simple-Placeholder/blob/master/README.md
        if(typeof $.fn.simplePlaceholder !== 'undefined'){

            $('input[placeholder], textarea[placeholder]').simplePlaceholder();

        }

        // Owl Carousel - used to create carousels throughout the site
        // http://owlgraphic.com/owlcarousel/
        if (typeof $.fn.owlCarousel !== 'undefined') {

            $('.owlCarousel').each(function ( index ) {

                var sliderSelector = '#owlCarousel-' + $(this).data('slider-id'); // this is the slider selector
                var sliderItems         = $(this).data('slider-items');
                var sliderSpeed         = $(this).data('slider-speed');
                var sliderAutoPlay      = $(this).data('slider-auto-play');
                var sliderNavigation    = $(this).data('slider-navigation');
                var sliderPagination    = $(this).data('slider-pagination');
                var sliderSingleItem    = $(this).data('slider-single-item');

                //conversion of 1 to true & 0 to false


                // auto play
                if(sliderAutoPlay == 0 || sliderAutoPlay == 'false') {
                    sliderAutoPlay = false;
                } else {
                    sliderAutoPlay = true;
                }

                // pager
                if(sliderPagination == 0 || sliderPagination == 'false') {
                    sliderPagination = false;
                } else {
                    sliderPagination = true;
                }

                // navigation
                if(sliderNavigation == 0 || sliderNavigation == 'false') {
                    sliderNavigation = false;
                } else {
                    sliderNavigation = true;
                }

                // Custom Navigation events outside of the owlCarousel mark-up
                $(".mt-owl-next").on('click', function(){
                    $(sliderSelector).trigger('owl.next');
                })
                $(".mt-owl-prev").on('click', function(){
                    $(sliderSelector).trigger('owl.prev');
                })



                // instantiate the slider with all the options
                $(sliderSelector).owlCarousel({

                    items: sliderItems,
                    slideSpeed: sliderSpeed,
                    navigation : sliderNavigation,
                    autoPlay: sliderAutoPlay,
                    pagination: sliderPagination,
                    navigationText: [ // custom navigation text (instead of bullets). navigationText : false to disable arrows / bullets
                        "<i class='fa fa-angle-left'></i>",
                        "<i class='fa fa-angle-right'></i>"
                    ]
                });

            });

        } // end

        // Headroom - Give your pages some headroom. Hide your header until you need it.
        // http://wicky.nillia.ms/headroom.js/
        if (typeof $.fn.headroom !== 'undefined') {

            $('#masthead').headroom({

                // vertical offset in px before element is first unpinned
                offset: 0,
                // scroll tolerance in px before state changes
                tolerance: 0,
            });
        }

        // LazyLoad - delays loading of images in long paged websites
        // https://github.com/tuupola/jquery_lazyload
        if (typeof $.fn.lazyload !== 'undefined') {


            $('.lazy').show().lazyload({
                effect : "fadeIn",
                skip_invisible : true
            });
        }


    });

})(window.jQuery);

//non jQuery plugins below