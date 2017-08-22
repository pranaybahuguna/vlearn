 (function($) {


  'use strict';

/* ==========================================================================
  Smooth Parallax Effect
  @see https://github.com/tysonmatanich/viewportSize
========================================================================== */

    var lastScrollY = 0,
        ticking = false,
        bgElm = document.getElementsByClassName('parallax-bg-image'),
        i = 0,
        speedDivider = 2;

    // Update scroll value and request tick
    var ParallaxDoScroll = function() {
      lastScrollY = window.pageYOffset;
      ParallaxRequestTick();
    };

      var ParallaxRequestTick = function() {
      if (!ticking) {
        window.requestAnimationFrame(ParallaxUpdatePosition);
        ticking = true;
      }
    };

    var ParallaxUpdatePosition = function() {

      var translateValue = lastScrollY / speedDivider;

      // We don't want parallax to happen if scrollpos is below 0
      if (translateValue < 0)
        translateValue = 0;


      for (i = 0; i < bgElm.length; i++) {
        //bgElm[i].style.backgroundColor = "red";
        ParallaxTranslateY3d(bgElm[i], translateValue)
      }

      // Stop ticking
      ticking = false;

    };

    // Translates an element on the Y axis using translate3d
    // to ensure that the rendering is done by the GPU
    var ParallaxTranslateY3d = function(elm, value) {
      var translate = 'translate3d(0px,' + value + 'px, 0px)';
      elm.style['-webkit-transform'] = translate;
      elm.style['-moz-transform'] = translate;
      elm.style['-ms-transform'] = translate;
      elm.style['-o-transform'] = translate;
      elm.style.transform = translate;
    };


/* ==========================================================================
    ieViewportFix - fixes viewport problem in IE 10 SnapMode and IE Mobile 10
 ========================================================================== */

  function ieViewportFix() {

      var msViewportStyle = document.createElement("style");

      msViewportStyle.appendChild(
        document.createTextNode(
          "@-ms-viewport { width: device-width; }"
        )
      );
      if (navigator.userAgent.match(/IEMobile\/10\.0/)) {

        msViewportStyle.appendChild(
          document.createTextNode(
            "@-ms-viewport { width: auto !important; }"
          )
        );
      }

      document.getElementsByTagName("head")[0].
      appendChild(msViewportStyle);
    }

/* ==========================================================================
  WooCommerce Tabs: Description and Reviews
========================================================================== */
  function woocommerceTabs() {
    var descriptionTab = $( 'li.description_tab' );
    var descriptionTabLink = $( 'li.description_tab a' );
    var reviewsTab = $( 'li.reviews_tab' );
    var reviewsTabLink = $( 'li.reviews_tab a' );
    var panelDescription = $( '.panel#tab-description' );
    var panelReviews = $( '.panel#tab-reviews' );

    $( descriptionTabLink ).click( function() {
      $( this ).parent().addClass( 'active' );
      $( reviewsTab ).removeClass( 'active' );
      $( panelDescription ).show();
      $( panelReviews ).hide();
    });

    $( reviewsTabLink ).click( function() {
      $( this ).parent().addClass( 'active' );
      $( descriptionTab ).removeClass( 'active' );
      $( panelReviews ).show();
      $( panelDescription ).hide();
    });
  }

/* ==========================================================================
  Smooth scrolling
========================================================================== */

  function smoothScrollAnchors() {

        $('a[href*="#"]:not([href="#"])').on('click', function() {


            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }


        });
    }

 /* ==========================================================================
      Mobile Detection
  ========================================================================== */

 function isMobile(){
     return (
         (navigator.userAgent.match(/Android/i)) ||
         (navigator.userAgent.match(/webOS/i)) ||
         (navigator.userAgent.match(/iPhone/i)) ||
         (navigator.userAgent.match(/iPod/i)) ||
         (navigator.userAgent.match(/iPad/i)) ||
         (navigator.userAgent.match(/BlackBerry/))
     );
 }


/* ==========================================================================
      isTouchDevice - return true if it is a touch device
========================================================================== */

  function isTouchDevice() {
    return !!('ontouchstart' in window) || ( !! ('onmsgesturechange' in window) && !! window.navigator.maxTouchPoints);
  }


/* ==========================================================================
        Remove behaviour of anchors linking to #
========================================================================== */

  function removeAnchors(){
    $('a[href="#"]').on('click', function(e){
      e.preventDefault();
    });
  }



/* ==========================================================================
      Back to top function
========================================================================== */
  
  function MTBackToTop() {

    // browser window scroll (in pixels) after which the "back to top" link is shown
    var offset = 300,
      //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
      offset_opacity = 300,
      //duration of the top scrolling animation (in ms)
      scroll_top_duration = 700,
      //grab the "back to top" link
      $back_to_top = $('.mt-top');

    //hide or show the "back to top" link
    $(window).scroll(function(){
      ( $(this).scrollTop() > offset ) ? $back_to_top.addClass('mt-is-visible') : $back_to_top.removeClass('mt-is-visible mt-fade-out');
      if( $(this).scrollTop() > offset_opacity ) {
        $back_to_top.addClass('mt-fade-out');
      }
    });

    //smooth scroll to top
    $back_to_top.on('click', function(event){
      event.preventDefault();
      $('body,html').animate({
        scrollTop: 0 ,
        }, scroll_top_duration
      );
    });
  }


 /* ==========================================================================
  Full Screen Search
  ========================================================================== */

 function fullScreenSearchBox() {

     $('a[href="#search"]').on('click', function(event) {
         event.preventDefault();
         $('#search').addClass('open');
         $('#search > form > input[type="search"]').focus();
     });

     $('#search, #search button.close').on('click keyup', function(event) {
         if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
             $(this).removeClass('open');
         }
     });
 }

 /* ==========================================================================
  Fade Out Text on Scroll
  ========================================================================== */
 function fadeOutTextOnScroll() {

     /** Get the scroll position of the page */
     var scrollPos = $(window).scrollTop();

     /** Scroll and fade out the banner text */
     $('.single .parallax-text-fade').css({
         'top' : -( scrollPos / 3 ) + "px",
         'position'   : 'relative',
         'opacity' : 1 - ( scrollPos / 300 ),
         '-ms-filter' : 'progid:DXImageTransform.Microsoft.Alpha(Opacity=' + 1 - ( scrollPos / 300 ) + ')'
     });

     /** Scroll and lower the opacity of the parallax bg image */
     $('.single .parallax-bg-image').css({
         'opacity' : 1 - ( scrollPos / 750 ),
     });

 }

     /* ==========================================================================
      Enable tooltips
      ========================================================================== */

 function enableTooltips() {
     $('[data-toggle="tooltip"]').tooltip();
 }

    // Responsive Menu
    function responsiveMenu() {
        $( 'button.responsive-button' ).click( function() {
            $( 'nav.responsive-navigation' ).slideToggle( 'slow' );
        });
    }

     /* ==========================================================================
               When document is ready, do
     ========================================================================== */
  jQuery(document).ready(function($) {
    responsiveMenu();
    ieViewportFix();
    smoothScrollAnchors();
    removeAnchors();
    MTBackToTop();
    enableTooltips();
    fullScreenSearchBox();
    woocommerceTabs();


});

     jQuery(window).scroll(function($) {


         if(!isMobile()) {
             ParallaxDoScroll();
             fadeOutTextOnScroll();
         }

     });


 })(window.jQuery);
 // non jQuery functions go below