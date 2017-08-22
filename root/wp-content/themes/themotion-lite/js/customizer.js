/* global theMotion_header_social_icons_width */
/* global theMotion_menu_toggle_height */
/* global requestpost */

/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	'use strict';
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).html( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).html( to );
		} );
	} );


	// Logo
	wp.customize( 'custom_logo', function( value ) {
  		value.bind( function( to ) {
			if( to !== '' ) {
				$( '.custom-logo-link' ).removeClass( 'themotion-only-customizer' );
				$( '.header-logo-wrap' ).addClass( 'themotion-only-customizer' );
			}
			else {
				$( '.custom-logo-link' ).addClass( 'themotion-only-customizer' );
				$( '.header-logo-wrap' ).removeClass( 'themotion-only-customizer' );
			}
  		} );
	} );


	wp.customize( 'themotion_footer_copyright', function( value ) {
		value.bind( function( to ) {
			if( to !== '' ){
				$('.site-info').removeClass('themotion-only-customizer');
			} else {
				$('.site-info').addClass('themotion-only-customizer');
			}
			$('.site-info').html(to);
		} );
	} );

	// Search icon.
	wp.customize( 'themotion_show_search', function( value ) {
		value.bind( function( to ) {
			if ( to !== true ) {
				$( '.header-search' ).parent().removeClass('themotion-only-customizer');
				theMotion_header_social_icons_width();
				theMotion_menu_toggle_height();
			} else {
				$( '.header-search' ).parent().addClass('themotion-only-customizer');
				theMotion_header_social_icons_width();
				theMotion_menu_toggle_height();
			}
		} );
	} );


	// Social repeater
	wp.customize( 'themotion_social_icons', function( value ) {
		value.bind( function( to ) {
			var obj = JSON.parse( to );
			var result ='';
			var result2;
			var lastIcon = $( '.social-media-icons li:last-child' );

			obj.forEach(function(item) {
				result+=  '<li><a href="' + item.link + '" class="social-icon"></a></li>';
			});

			result2 = result;
			if ( ! lastIcon.hasClass('themotion-only-customizer') ){
				result+= '<li><button type="button" class="search-opt search-toggle"></button><div class="header-search"></div></li>';
			} else {
				result+= '<li class="themotion-only-customizer"><button type="button" class="search-opt search-toggle"></button><div class="header-search"></div></li>';
			}
			$( '.social-media-icons' ).html( result );
			$( '.contact-block-left .social-media-icons' ).html( result2 );
			theMotion_header_social_icons_width();
			theMotion_menu_toggle_height();
		} );
	} );

	//Homepage A show banner
	wp.customize( 'themotion_home_a_show_banner', function( value ) {
		value.bind( function( to ) {

			if ( to !== true ) {
				$( '.home-ribbon' ).removeClass('themotion-only-customizer');
			} else {
				$( '.home-ribbon' ).addClass('themotion-only-customizer');
			}
		} );
	} );

	// Homepage A banner text
	wp.customize( 'themotion_home_a_banner_text', function( value ) {
		value.bind( function( to ) {
			if(to !== ''){
				var show = wp.customize._value.themotion_home_a_show_banner();
				if(show !== true) {
					$('.home-ribbon').removeClass('themotion-only-customizer');
					$('.home-ribbon-text h2').removeClass('themotion-only-customizer');
				}
			} else {
				$( '.home-ribbon-text h2' ).addClass('themotion-only-customizer');
				var banner_text = wp.customize._value.themotion_home_a_banner_button_text();
				if( banner_text === '' ){
					$( '.home-ribbon' ).addClass('themotion-only-customizer');
				}
			}
			$( '.home-ribbon-text h2' ).html(to);
		} );
	} );

	// Homepage A banner button text
	wp.customize( 'themotion_home_a_banner_button_text', function( value ) {
		value.bind( function( to ) {
			if(to !== ''){
				var show = wp.customize._value.themotion_home_a_show_banner();
				if(show !== true){
					$( '.home-ribbon' ).removeClass('themotion-only-customizer');
					$( '.home-ribbon-btn a' ).removeClass('themotion-only-customizer');
				}
			} else {
				$( '.home-ribbon-btn a' ).addClass('themotion-only-customizer');
				var button_text = wp.customize._value.themotion_home_a_banner_text();
				if( button_text === '' ){
					$( '.home-ribbon' ).addClass('themotion-only-customizer');
				}
			}
			$( '.home-ribbon-btn a' ).html(to);
		} );
	} );

	// Homepage A call to action link
	wp.customize('themotion_home_a_banner_button_link', function(value) {
        value.bind(function( to ) {
        	if(to.charAt(0) === '#'){
        		$( '.home-ribbon-btn .themotion-scroll-to-section' ).attr('data-anchor',to);
        		$( '.home-ribbon-btn .themotion-scroll-to-section' ).removeAttr('href');
        	} else {
				$( '.home-ribbon-btn .themotion-scroll-to-section' ).attr( 'href', to );
        		$( '.home-ribbon-btn .themotion-scroll-to-section' ).removeAttr('data-anchor');
        	}
		} );
    } );

	wp.customize( 'themotion_home_a_bottom_posts_title', function( value ){
		value.bind( function( to ) {
			if( to !== '' ){
				$('.homepage-one .recently-posted-title').removeClass('themotion-only-customizer');
			} else {
				$('.homepage-one .recently-posted-title').addClass('themotion-only-customizer');
			}
			$('.homepage-one .recently-posted-title').html(to);
		} );
	} );


	wp.customize( 'themotion_home_a_post_category', function( value ){
		value.bind( function( to ){

			var params = {
				url: requestpost.ajaxurl,
				type: 'post',
				beforeSend: function() {
					$('.homepage-one .recently-posted-wrap').html( '<div id="loader">'+ requestpost.placeholder +'</div>' );
				},
				success: function( result ) {
					$('#loader').replaceWith( result );
				}
			};

			if( typeof wp.customize._value.themotion_home_a_post_nb() !== 'undefined' ) {
				params.data = {
					page: 'homea_bottom',
					action: 'request_post',
					category: to,
					postnb: wp.customize._value.themotion_home_a_post_nb()
				};
			} else {
				params.data = {
					page: 'homea_bottom',
					action: 'request_post',
					category: to
				};
			}

			$.ajax(params);

		} );
	} );


    wp.customize( 'themotion_home_a_post_nb', function( value ){
        value.bind( function( to ){
			var params = {
				url: requestpost.ajaxurl,
				type: 'post',
				beforeSend: function() {
					$('.homepage-one .recently-posted-wrap').html( '<div id="loader">'+ requestpost.placeholder +'</div>' );
				},
				success: function( result ) {
					$('#loader').replaceWith( result );
				}
			};

        	if( typeof wp.customize._value.themotion_home_a_post_category() !== 'undefined' ) {
				params.data = {
					page: 'homea_post_nb',
					action: 'request_post',
					category: wp.customize._value.themotion_home_a_post_category(),
					postnb: to
				};
			} else {
				params.data = {
					page: 'homea_post_nb',
					action: 'request_post',
					postnb: to
				};
			}
			
			$.ajax(params);
        } );
    } );




    wp.customize('header_image', function(value) {
    	value.bind(function( to ) {
			if( to !== '' && to !== 'remove-header' ){
				$('.home-top-area').removeClass('themotion-only-customizer');
				$('.home-three-videos').removeClass('themotion-only-customizer');
				$('.home-ribbon-intro').css('margin-top','150px');
			} else {
				var header_text = wp.customize._value.themotion_home_b_header_text();
				var button_text = wp.customize._value.themotion_home_b_button_text();
				if(button_text === '' && header_text === ''){
					$('.home-top-area').addClass('themotion-only-customizer');
					$('.home-three-videos').addClass('themotion-only-customizer');
					$('.home-ribbon-intro').css('margin-top','0');
				}
			}
			$('.home-top-area').css('background-image','url('+ to +')');
		} );
    } );

    wp.customize('themotion_home_b_header_text', function(value) {
    	value.bind(function( to ) {
			if( to !== '' ){
				$('.home-top-area').removeClass('themotion-only-customizer');
				$('.home-three-videos').removeClass('themotion-only-customizer');
				$('.home-ribbon-intro').css('margin-top','150px');
			} else {
				var header_image = wp.customize._value.header_image();
				var button_text = wp.customize._value.themotion_home_b_button_text();
				if(button_text === '' && (header_image === '' || header_image === 'remove-header')){
					$('.home-top-area').addClass('themotion-only-customizer');
					$('.home-three-videos').addClass('themotion-only-customizer');
					$('.home-ribbon-intro').css('margin-top','0');
				}
			}
    		$('.home-top-area-inner h1').html(to);
    	} );
    } );

    wp.customize('themotion_home_b_button_text', function(value) {
		value.bind(function( to ) {
			if( to !== '' ){
				$('.home-top-area').removeClass('themotion-only-customizer');
				$('.home-three-videos').removeClass('themotion-only-customizer');
				$('.home-ribbon-intro').css('margin-top','150px');
				if( ! $('.home-top-area-inner a').hasClass('btn') ){
					$('.home-top-area-inner a').addClass('btn');
				}
			} else {
				var header_image = wp.customize._value.header_image();
				var header_text = wp.customize._value.themotion_home_b_header_text();
				if((header_image === '' || header_image === 'remove-header') && header_text === ''){
					$('.home-top-area').addClass('themotion-only-customizer');
					$('.home-three-videos').addClass('themotion-only-customizer');
					$('.home-ribbon-intro').css('margin-top','0');
				}
				$('.home-top-area-inner a').removeClass('btn');
			}
			$('.home-top-area-inner a').html(to);
		} );
	} );

	wp.customize('themotion_home_b_button_link', function(value) {
		value.bind(function( to ) {
			if(to.charAt(0) === '#'){
        		$( '.home-top-area-inner .themotion-scroll-to-section' ).attr('data-anchor',to);
        		$( '.home-top-area-inner .themotion-scroll-to-section' ).attr('href','#');
        	} else {
				$( '.home-top-area-inner .themotion-scroll-to-section' ).attr( 'href', to );
        		$( '.home-top-area-inner .themotion-scroll-to-section' ).removeAttr('data-anchor');
        	}
        } );
	} );

	wp.customize( 'themotion_show_videos', function( value ) {
		value.bind( function( to ) {
			if ( '1' !== to ) {
				$( '.home-three-videos' ).removeClass('themotion-only-customizer');
			} else {
				$( '.home-three-videos' ).addClass('themotion-only-customizer');
			}
		} );
	} );

	wp.customize( 'themotion_video_category', function( value ){
		value.bind( function( to ){

			$.ajax( {
				url: requestpost.ajaxurl,
				type: 'post',
				data: {
					page: 'homeb',
					action: 'request_post',
					category: to,
					is_hidden: wp.customize._value.themotion_show_videos()
				},
				beforeSend: function() {
					$('.home-three-videos .container').html( '<div id="loader">'+ requestpost.placeholder +'</div>' );
				},
				success: function( result ) {
					$('.home-three-videos').replaceWith( result );
				}
			} );
		} );
	} );


	wp.customize( 'themotion_home1_video_category', function( value ){
		value.bind( function( to ){

			$.ajax( {
				url: requestpost.ajaxurl,
				type: 'post',
				data: {
					page: 'homea',
					action: 'request_post',
					category: to
				},
				beforeSend: function() {
					$('.featured-video-wrap').html( '<div id="loader">'+ requestpost.placeholder +'</div>' );
				},
				success: function( result ) {
					$('.featured-video-wrap').replaceWith( result );
				}
			} );
		} );
	} );



	wp.customize( 'themotion_call_to_action_title', function( value ){
		value.bind( function( to ){
			if( to !== '' ) {
				$('.home-ribbon-intro-inner h2').removeClass('themotion-only-customizer');
			} else {
				$('.home-ribbon-intro-inner h2').addClass('themotion-only-customizer');

			}
			$('.home-ribbon-intro-inner h2').html(to);
		} );
	} );

	wp.customize( 'themotion_call_to_action_text', function( value ){
		value.bind( function( to ){
			if( to !== '' ) {
				$('.home-ribbon-intro-inner .home-ribbon-intro-container').removeClass('themotion-only-customizer');
			} else {
				$('.home-ribbon-intro-inner .home-ribbon-intro-container').addClass('themotion-only-customizer');
			}
			$('.home-ribbon-intro-inner .home-ribbon-intro-container p').html(to);
		} );
	} );





	wp.customize( 'themotion_call_to_action_button_text', function( value ){
		value.bind( function( to ){
			if( to !== '' && wp.customize._value.themotion_call_to_action_button_link() !== '' ) {
				$('.home-ribbon-intro-btn').removeClass('themotion-only-customizer');
				$('.home-ribbon-intro-btn a').html(to);
			} else {
				$('.home-ribbon-intro-btn').addClass('themotion-only-customizer');
			}
		} );
	} );




	wp.customize( 'themotion_call_to_action_button_link', function( value ){
		value.bind( function( to ){
			if( to !== '' && wp.customize._value.themotion_call_to_action_button_text() !== '' ) {
				$('.home-ribbon-intro-btn').removeClass('themotion-only-customizer');
				if(to.charAt(0) === '#'){
	        		$( '.home-ribbon-intro-btn .themotion-scroll-to-section' ).attr('data-anchor',to);
	        		$( '.home-ribbon-intro-btn .themotion-scroll-to-section' ).removeAttr('href');
	        	} else {
					$( '.home-ribbon-intro-btn .themotion-scroll-to-section' ).attr( 'href', to );
	        		$( '.home-ribbon-intro-btn .themotion-scroll-to-section' ).removeAttr('data-anchor');
	        	}
			} else {
				$('.home-ribbon-intro-btn').addClass('themotion-only-customizer');
			}


		} );
	} );

	wp.customize( 'themotion_bottom_posts_title', function( value ){
		value.bind( function( to ) {
			if( to !== '' ){
				$('.homepage-two .recently-posted-title').removeClass('themotion-only-customizer');
			} else {
				$('.homepage-two .recently-posted-title').addClass('themotion-only-customizer');
			}
			$('.homepage-two .recently-posted-title').html(to);
		} );
	} );

	wp.customize( 'themotion_bottom_posts_category', function( value ){
		value.bind( function( to ){

			var params = {
				url: requestpost.ajaxurl,
				type: 'post',
				beforeSend: function() {
					$('.posts-on-b').html( '<div id="loader"><div class="container">'+ requestpost.placeholder +'</div></div>' );
				},
				success: function( result ) {
					$('.posts-on-b #loader').replaceWith( result );
				}
			};

			if( typeof wp.customize._value.themotion_home_b_post_nb() !== 'undefined' ) {
				params.data = {
					page: 'homeb_bottom',
					action: 'request_post',
					category: to,
					postnb: wp.customize._value.themotion_home_b_post_nb()
				};
			} else {
				params.data = {
					page: 'homeb_bottom',
					action: 'request_post',
					category: to
				};
			}

			$.ajax(params);
		} );
	} );

	wp.customize( 'themotion_home_b_post_nb', function( value ){
		value.bind( function( to ){
			var params = {
				url: requestpost.ajaxurl,
				type: 'post',
				beforeSend: function() {
					$('.posts-on-b').html( '<div id="loader"><div class="container">'+ requestpost.placeholder +'</div></div>' );
				},
				success: function( result ) {
					$('.posts-on-b #loader').replaceWith( result );
				}
			};

			if( typeof wp.customize._value.themotion_bottom_posts_category() !== 'undefined' ) {
				params.data = {
					page: 'homeb_post_nb',
					action: 'request_post',
					category: wp.customize._value.themotion_bottom_posts_category(),
					postnb: to
				};
			} else {
				params.data = {
					page: 'homeb_post_nb',
					action: 'request_post',
					postnb: to
				};
			}

			$.ajax(params);
		} );
	} );






	/* == About page == */
	wp.customize('themotion_about_header_image', function(value) {
		value.bind(function( to ) {
			if(to !== ''){
				$('.about-top-area').removeClass('themotion-only-customizer');
			} else {
				var header_text = wp.customize._value.themotion_about_header_text();
				var button_text = wp.customize._value.themotion_about_button_text();
				if(header_text === '' && button_text === ''){
					$('.about-top-area').addClass('themotion-only-customizer');
				}
			}
			$('.about-top-area').css('background-image','url('+ to +')');
		} );
	} );

	wp.customize('themotion_about_header_text', function(value) {
		value.bind(function( to ) {
			if(to !== ''){
				$('.about-top-area').removeClass('themotion-only-customizer');
			} else {
				var header_image = wp.customize._value.themotion_about_header_image();
				var button_text = wp.customize._value.themotion_about_button_text();
				if(header_image === '' && button_text === ''){
					$('.about-top-area').addClass('themotion-only-customizer');
				}
			}
			$('.about-top-area-inner h1').html(to);
		} );
	} );

	wp.customize('themotion_about_button_text', function(value) {
		value.bind(function( to ) {
			if( to !== '' ){
				$('.about-top-area').removeClass('themotion-only-customizer');
				if( ! $('.about-top-area-inner a').hasClass('btn') ){
					$('.about-top-area-inner a').addClass('btn');
				}
			} else {
				$('.about-top-area-inner a').removeClass('btn');
				var header_image = wp.customize._value.themotion_about_header_image();
				var header_text = wp.customize._value.themotion_about_header_text();
				if(header_image === '' && header_text === ''){
					$('.about-top-area').addClass('themotion-only-customizer');
				}
			}
			$('.about-top-area-inner a').html(to);
		} );
	} );

	wp.customize('themotion_about_button_link', function(value) {
		value.bind(function( to ) {
			if(to.charAt(0) === '#'){
				$( '.about-top-area-inner .themotion-scroll-to-section' ).attr('data-anchor',to);
				$( '.about-top-area-inner .themotion-scroll-to-section' ).attr('href','#');
			} else {
				$( '.about-top-area-inner .themotion-scroll-to-section' ).attr( 'href', to );
				$( '.about-top-area-inner .themotion-scroll-to-section' ).removeAttr('data-anchor');
			}
		} );
	} );

	wp.customize('themotion_about_b1_title', function(value) {
		value.bind(function( to ) {
			if(to!==''){
				$('.info-block').removeClass('themotion-only-customizer');
				$('.block-left .info-block-title').removeClass('themotion-only-customizer');
			} else {
				$('.block-left .info-block-title').addClass('themotion-only-customizer');
				var b1_text = wp.customize._value.themotion_about_b1_text();
				var b2_title = wp.customize._value.themotion_about_b2_title();
				var b2_text = wp.customize._value.themotion_about_b2_text();
				if( b1_text === '' && b2_title === '' && b2_text === '' ){
					$('.info-block').addClass('themotion-only-customizer');
				}
			}
			$('.block-left .info-block-title').html(to);
		} );
	} );

	wp.customize('themotion_about_b1_text', function(value) {
		value.bind(function( to ) {
			if(to!==''){
				$('.info-block').removeClass('themotion-only-customizer');
				$('.block-left .info-block-content').removeClass('themotion-only-customizer');
			} else {
				$('.block-left .info-block-content').addClass('themotion-only-customizer');
				var b1_title = wp.customize._value.themotion_about_b1_title();
				var b2_title = wp.customize._value.themotion_about_b2_title();
				var b2_text = wp.customize._value.themotion_about_b2_text();
				if( b1_title === '' && b2_title === '' && b2_text === '' ){
					$('.info-block').addClass('themotion-only-customizer');
				}
			}
			$('.block-left .info-block-content p').html(to);
		} );
	} );

	wp.customize('themotion_about_b2_title', function(value) {
		value.bind(function( to ) {
			if(to!==''){
				$('.info-block').removeClass('themotion-only-customizer');
				$('.block-right .info-block-title').removeClass('themotion-only-customizer');
			} else {
				$('.block-right .info-block-title').addClass('themotion-only-customizer');
				var b1_title = wp.customize._value.themotion_about_b1_title();
				var b1_text = wp.customize._value.themotion_about_b1_text();
				var b2_text = wp.customize._value.themotion_about_b2_text();
				if( b1_title === '' && b1_text === '' && b2_text === '' ){
					$('.info-block').addClass('themotion-only-customizer');
				}
			}
			$('.block-right .info-block-title').html(to);
		} );
	} );

	wp.customize('themotion_about_b2_text', function(value) {
		value.bind(function( to ) {
			if(to!==''){
				$('.info-block').removeClass('themotion-only-customizer');
				$('.block-right .info-block-content').removeClass('themotion-only-customizer');
			} else {
				$('.block-right .info-block-content').addClass('themotion-only-customizer');
				var b1_title = wp.customize._value.themotion_about_b1_title();
				var b1_text = wp.customize._value.themotion_about_b1_text();
				var b2_title = wp.customize._value.themotion_about_b2_title();
				if( b1_title === '' && b1_text === '' && b2_title === '' ){
					$('.info-block').addClass('themotion-only-customizer');
				}
			}
			$('.block-right .info-block-content p').html(to);
		} );
	} );

	/*About page STATS*/

	wp.customize('themotion_show_stats', function(value) {
		value.bind(function( to ) {
			if ( to !== true ) {
				$( '.stats' ).removeClass('themotion-only-customizer');
			} else {
				$( '.stats' ).addClass('themotion-only-customizer');
			}
		} );
	} );

	wp.customize('themotion_about_stats_one_number', function(value) {
		value.bind(function( to ) {
			if( to !== '' ){
				var show = wp.customize._value.themotion_show_stats();
				if(show !== true){
					$('.stat-1').removeClass('themotion-only-customizer');
					$('.stats').removeClass('themotion-only-customizer');
				}
			} else {
				if(wp.customize._value.themotion_about_stats_one_text() === ''){
					$('.stat-1').addClass('themotion-only-customizer');
				}
			}
			$('.stat-1 .stat-number').html(to);
		} );
	} );

	wp.customize('themotion_about_stats_one_text', function(value) {
		value.bind(function( to ) {
			if(to !== ''){
				var show = wp.customize._value.themotion_show_stats();
				if(show !== true){
					$('.stat-1').removeClass('themotion-only-customizer');
					$('.stats').removeClass('themotion-only-customizer');
				}
			} else {
				if(wp.customize._value.themotion_about_stats_one_number() === ''){
					$('.stat-1').addClass('themotion-only-customizer');
				}
			}
			$('.stat-1 .stat-text').html(to);
		} );
	} );

	wp.customize('themotion_about_stats_two_number', function(value) {
		value.bind(function( to ) {
			if(to !== ''){
				var show = wp.customize._value.themotion_show_stats();
				if(show !== true) {
					$('.stat-2').removeClass('themotion-only-customizer');
					$('.stats').removeClass('themotion-only-customizer');
				}
			} else {
				if(wp.customize._value.themotion_about_stats_two_text() === ''){
					$('.stat-2').addClass('themotion-only-customizer');
				}
			}
			$('.stat-2 .stat-number').html(to);
		} );
	} );

	wp.customize('themotion_about_stats_two_text', function(value) {
		value.bind(function( to ) {
			if( to !== '' ){
				var show = wp.customize._value.themotion_show_stats();
				if(show !== true) {
					$('.stat-2').removeClass('themotion-only-customizer');
					$('.stats').removeClass('themotion-only-customizer');
				}
			} else {
				if(wp.customize._value.themotion_about_stats_two_number() === ''){
					$('.stat-2').addClass('themotion-only-customizer');
				}
			}
			$('.stat-2 .stat-text').html(to);
		} );
	} );

	wp.customize('themotion_about_stats_three_number', function(value) {
		value.bind(function( to ) {
			if(to !== ''){
				var show = wp.customize._value.themotion_show_stats();
				if(show !== true) {
					$('.stat-3').removeClass('themotion-only-customizer');
					$('.stats').removeClass('themotion-only-customizer');
				}
			} else {
				if(wp.customize._value.themotion_about_stats_three_text() === ''){
					$('.stat-3').addClass('themotion-only-customizer');
				}
			}
			$('.stat-3 .stat-number').html(to);
		} );
	} );

	wp.customize('themotion_about_stats_three_text', function(value) {
		value.bind(function( to ) {
			if(to !== ''){
				var show = wp.customize._value.themotion_show_stats();
				if(show !== true) {
					$('.stat-3').removeClass('themotion-only-customizer');
					$('.stats').removeClass('themotion-only-customizer');
				}
			} else {
				if(wp.customize._value.themotion_about_stats_three_number() === ''){
					$('.stat-3').addClass('themotion-only-customizer');
				}
			}
			$('.stat-3 .stat-text').html(to);
		} );
	} );

	wp.customize('themotion_about_stats_four_number', function(value) {
		value.bind(function( to ) {
			if(to !== ''){
				var show = wp.customize._value.themotion_show_stats();
				if(show !== true) {
					$('.stat-4').removeClass('themotion-only-customizer');
					$('.stats').removeClass('themotion-only-customizer');
				}
			} else {
				if(wp.customize._value.themotion_about_stats_four_text() === ''){
					$('.stat-4').addClass('themotion-only-customizer');
				}
			}
			$('.stat-4 .stat-number').html(to);
		} );
	} );

	wp.customize('themotion_about_stats_four_text', function(value) {
		value.bind(function( to ) {
			if(to !== ''){
				var show = wp.customize._value.themotion_show_stats();
				if(show !== true) {
					$('.stat-4').removeClass('themotion-only-customizer');
					$('.stats').removeClass('themotion-only-customizer');
				}
			} else {
				if(wp.customize._value.themotion_about_stats_four_number() === ''){
					$('.stat-4').addClass('themotion-only-customizer');
				}
			}
			$('.stat-4 .stat-text').html(to);
		} );
	} );

	/*About page TESTIMONY*/

	wp.customize('themotion_show_testimony', function(value) {
		value.bind(function( to ) {
			if ( to !== true ) {
				$( '.testimonial-area' ).removeClass('themotion-only-customizer');
			} else {
				$( '.testimonial-area' ).addClass('themotion-only-customizer');
			}
		} );
	} );


	wp.customize('themotion_testimony_avatar', function(value) {
		value.bind(function( to ) {
			if(to !== '') {
				var show = wp.customize._value.themotion_show_testimony();
				if (show !== true) {
					$('.testimonial-area').removeClass('themotion-only-customizer');
					$('.testimonial-avatar').removeClass('themotion-only-customizer');
				}
			} else {
				var text = wp.customize._value.themotion_testimony_text();
				var subtext = wp.customize._value.themotion_testimony_subtext();
				if( text === '' && subtext === ''){
					$('.testimonial-area').addClass('themotion-only-customizer');
				}
				$('.testimonial-avatar').addClass('themotion-only-customizer');
			}
			$('.testimonial-avatar').attr('style','background:url('+to+'); background-position:center; background-size:cover;');
		} );
	} );

	wp.customize('themotion_testimony_text', function(value) {
		value.bind(function( to ) {
			if(to !== ''){
				var show = wp.customize._value.themotion_show_testimony();
				if (show !== true) {
					$('.testimonial-area').removeClass('themotion-only-customizer');
					$('.testimonial-content').removeClass('themotion-only-customizer');
				}
			} else {
				var subtext = wp.customize._value.themotion_testimony_subtext();
				var avatar = wp.customize._value.themotion_testimony_avatar();
				if( subtext === '' && avatar === ''){
					$('.testimonial-area').addClass('themotion-only-customizer');
				}
				$('.testimonial-content').addClass('themotion-only-customizer');
			}
			$('.testimonial-content').html(to);
		} );
	} );

	wp.customize('themotion_testimony_subtext', function(value) {
		value.bind(function( to ) {
			if(to !== ''){
				var show = wp.customize._value.themotion_show_testimony();
				if (show !== true) {
					$('.testimonial-area').removeClass('themotion-only-customizer');
					$('.testimonial-author').removeClass('themotion-only-customizer');
				}
			} else {
				var text = wp.customize._value.themotion_testimony_text();
				var avatar = wp.customize._value.themotion_testimony_avatar();
				if( text === '' && avatar === ''){
					$('.testimonial-area').addClass('themotion-only-customizer');
				}
				$('.testimonial-author').addClass('themotion-only-customizer');
			}
			$('.testimonial-author').html(to);
		} );
	} );



	wp.customize( 'themotion_show_latest', function( value ) {
		value.bind( function( to ) {
			if ( to !== true ) {
				$( '.themotion-about-latest-posts' ).removeClass('themotion-only-customizer');
			} else {
				$( '.themotion-about-latest-posts' ).addClass('themotion-only-customizer');
			}
		} );
	} );

	wp.customize( 'themotion_latest_posts_title', function( value ) {
		value.bind( function( to ) {
			$('.recently-posts-about-page .recently-posted-title').html(to);
		} );
	} );

	wp.customize( 'themotion_latest_posts_category', function( value ){
		value.bind( function( to ){
			$.ajax( {
				url: requestpost.ajaxurl,
				type: 'post',
				data: {
					page: 'about',
					action: 'request_post',
					category: to,
					is_hidden: wp.customize._value.themotion_show_latest()
				},
				beforeSend: function() {
					$('.about-us-page .recently-posted-wrap').html( '<div id="loader">'+ requestpost.placeholder +'</div>' );
				},
				success: function( result ) {
					$('.about-us-page .recently-posted-wrap #loader').replaceWith( result );
				}
			} );
		} );
	} );


	/* == Contact page == */
	wp.customize('themotion_contact_header_image', function(value) {
		value.bind(function( to ) {
			if(to !== ''){
				$('.about-top-area').removeClass('themotion-only-customizer');
			} else {
				var header_text = wp.customize._value.themotion_contact_header_text();
				var button_text = wp.customize._value.themotion_contact_button_text();
				if(button_text === '' && header_text === ''){
					$('.about-top-area').addClass('themotion-only-customizer');
				}
			}
			$('.contact-section.about-top-area').css('background-image','url('+ to +')');
		} );
	} );

	wp.customize('themotion_contact_header_text', function(value) {
		value.bind(function( to ) {
			if(to !== ''){
				$('.about-top-area').removeClass('themotion-only-customizer');
			} else {
				var header_image = wp.customize._value.themotion_contact_header_image();
				var button_text = wp.customize._value.themotion_contact_button_text();
				if(button_text === '' && header_image === ''){
					$('.about-top-area').addClass('themotion-only-customizer');
				}
			}
			$('.contact-section .about-top-area-inner h1').html(to);
		} );
	} );

	wp.customize('themotion_contact_button_text', function(value) {
		value.bind(function( to ) {
			if( to !== '' ){
				$('.about-top-area').removeClass('themotion-only-customizer');
				if( ! $('.contact-section .about-top-area-inner a').hasClass('btn') ){
					$('.contact-section .about-top-area-inner a').addClass('btn');
				}
			} else {
				var header_image = wp.customize._value.themotion_contact_header_image();
				var header_text = wp.customize._value.themotion_contact_header_text();
				if(header_text === '' && header_image === ''){
					$('.about-top-area').addClass('themotion-only-customizer');
				}
				$('.contact-section .about-top-area-inner a').removeClass('btn');
			}
			$('.contact-section .about-top-area-inner a').html(to);
		} );
	} );

	wp.customize('themotion_contact_button_link', function(value) {
		value.bind(function( to ) {
			if(to.charAt(0) === '#'){
				$( '.contact-section .about-top-area-inner .themotion-scroll-to-section' ).attr('data-anchor',to);
				$( '.contact-section .about-top-area-inner .themotion-scroll-to-section' ).attr('href','#');
			} else {
				$( '.contact-section .about-top-area-inner .themotion-scroll-to-section' ).attr( 'href', to );
				$( '.contact-section .about-top-area-inner .themotion-scroll-to-section' ).removeAttr('data-anchor');
			}
		} );
	} );

	wp.customize('themotion_contact_cl_title', function(value) {
		value.bind(function( to ) {
			if(to !== ''){
				$('.contact-block-left .contact-block-title').removeClass('themotion-only-customizer');
				$('.contact-block-left').removeClass('themotion-only-customizer');
				$( '.contact-block-right' ).removeClass('col-md-12');
				$( '.contact-block-right' ).addClass('col-md-6');
			} else {
				$('.contact-block-left .contact-block-title').addClass('themotion-only-customizer');
				var themotion_contact_cl_text = wp.customize._value.themotion_contact_cl_text();
				var themotion_contact_hide_socials = wp.customize._value.themotion_contact_hide_socials();
				if(themotion_contact_cl_text === '' && themotion_contact_hide_socials === true){
					$( '.contact-block-right' ).removeClass('col-md-6');
					$( '.contact-block-right' ).addClass('col-md-12');
				}
			}
			$('.contact-block-left .contact-block-title').html(to);
		} );
	} );

	wp.customize('themotion_contact_cl_text', function(value) {
		value.bind(function( to ) {
			if(to !== ''){
				$('.contact-block-left .contact-block-content p').removeClass('themotion-only-customizer');
				$('.contact-block-left').removeClass('themotion-only-customizer');
				$( '.contact-block-right' ).removeClass('col-md-12');
				$( '.contact-block-right' ).addClass('col-md-6');
			} else {
				$('.contact-block-left .contact-block-content p').addClass('themotion-only-customizer');
				var themotion_contact_cl_title = wp.customize._value.themotion_contact_cl_title();
				var themotion_contact_hide_socials = wp.customize._value.themotion_contact_hide_socials();
				if(themotion_contact_cl_title === '' && themotion_contact_hide_socials === true){
					$( '.contact-block-right' ).removeClass('col-md-6');
					$( '.contact-block-right' ).addClass('col-md-12');
				}
			}
			$('.contact-block-left .contact-block-content p').html(to);
		} );
	} );


	wp.customize('themotion_contact_hide_socials', function(value) {
		value.bind(function( to ) {
			var contact_block_right = $( '.contact-block-right' );
			if ( to !== true ) {
				$( '.contact-block-left .social-media-icons' ).removeClass('themotion-only-customizer');
				$('.contact-block-left').removeClass('themotion-only-customizer');
				contact_block_right.removeClass('col-md-12');
				contact_block_right.addClass('col-md-6');

				var themotion_social_icons = wp.customize._value.themotion_social_icons();
				var obj = JSON.parse( themotion_social_icons );
				var result ='';
				obj.forEach(function(item) {
					result+=  '<li><a href="' + item.link + '" class="social-icon"></a></li>';
				});
				$( '.social-media-icons' ).html(result);
			} else {
				$( '.contact-block-left .social-media-icons' ).addClass('themotion-only-customizer');
				var themotion_contact_cl_title = wp.customize._value.themotion_contact_cl_title();
				var themotion_contact_cl_text = wp.customize._value.themotion_contact_cl_text();
				if(themotion_contact_cl_title === '' && themotion_contact_cl_text === ''){
					contact_block_right.removeClass('col-md-6');
					contact_block_right.addClass('col-md-12');
				}
			}
		} );
	} );

	wp.customize('themotion_contact_cr_title', function(value) {
		value.bind(function( to ) {
			var contact_block_left = $('.contact-block-left');
			if(to !== ''){
				$('.contact-block-right .contact-block-title').removeClass('themotion-only-customizer');
				$('.contact-block-right').removeClass('themotion-only-customizer');
				contact_block_left.addClass('col-md-6');
				contact_block_left.removeClass('col-md-12');
			} else {
				$('.contact-block-right .contact-block-title').addClass('themotion-only-customizer');

				var themotion_contact_cr_b1_title = wp.customize._value.themotion_contact_cr_b1_title();
				var themotion_contact_cr_b1_text = wp.customize._value.themotion_contact_cr_b1_text();
				var themotion_contact_cr_b1_email = wp.customize._value.themotion_contact_cr_b1_email();
				var themotion_contact_cr_b1_phone = wp.customize._value.themotion_contact_cr_b1_phone();
				var themotion_contact_cr_b2_title = wp.customize._value.themotion_contact_cr_b2_title();
				var themotion_contact_cr_b2_text = wp.customize._value.themotion_contact_cr_b2_text();
				var themotion_contact_cr_b2_email = wp.customize._value.themotion_contact_cr_b2_email();
				var themotion_contact_cr_b2_phone = wp.customize._value.themotion_contact_cr_b2_phone();
				if( themotion_contact_cr_b1_title === '' && themotion_contact_cr_b1_text === '' && themotion_contact_cr_b1_email === '' && themotion_contact_cr_b1_phone === '' && themotion_contact_cr_b2_title === '' && themotion_contact_cr_b2_text === '' && themotion_contact_cr_b2_email === '' && themotion_contact_cr_b2_phone === '' ){
					contact_block_left.removeClass('col-md-6');
					contact_block_left.addClass('col-md-12');
				}
			}
			$('.contact-block-right .contact-block-title').html(to);
		} );
	} );

	wp.customize('themotion_contact_cr_b1_title', function(value) {
		value.bind(function( to ) {
			var contact_block_left = $('.contact-block-left');
			if(to !== ''){
				$('.contact-block-right .themotion-block-left .contact-second-title').removeClass('themotion-only-customizer');
				$('.contact-block-right').removeClass('themotion-only-customizer');
				contact_block_left.addClass('col-md-6');
				contact_block_left.removeClass('col-md-12');
			} else {
				$('.contact-block-right .themotion-block-left .contact-second-title').addClass('themotion-only-customizer');

				var themotion_contact_cr_title = wp.customize._value.themotion_contact_cr_title();
				var themotion_contact_cr_b1_text = wp.customize._value.themotion_contact_cr_b1_text();
				var themotion_contact_cr_b1_email = wp.customize._value.themotion_contact_cr_b1_email();
				var themotion_contact_cr_b1_phone = wp.customize._value.themotion_contact_cr_b1_phone();
				var themotion_contact_cr_b2_title = wp.customize._value.themotion_contact_cr_b2_title();
				var themotion_contact_cr_b2_text = wp.customize._value.themotion_contact_cr_b2_text();
				var themotion_contact_cr_b2_email = wp.customize._value.themotion_contact_cr_b2_email();
				var themotion_contact_cr_b2_phone = wp.customize._value.themotion_contact_cr_b2_phone();
				if( themotion_contact_cr_title === '' && themotion_contact_cr_b1_text === '' && themotion_contact_cr_b1_email === '' && themotion_contact_cr_b1_phone === '' && themotion_contact_cr_b2_title === '' && themotion_contact_cr_b2_text === '' && themotion_contact_cr_b2_email === '' && themotion_contact_cr_b2_phone === '' ){
					contact_block_left.removeClass('col-md-6');
					contact_block_left.addClass('col-md-12');
				}
			}
			$('.contact-block-right .themotion-block-left .contact-second-title').html(to);
		} );
	} );

	wp.customize('themotion_contact_cr_b1_text', function(value) {
		value.bind(function( to ) {
			var contact_block_left = $('.contact-block-left');
			if(to !== ''){
				$('.themotion-block-left .themotion_contact_left').removeClass('themotion-only-customizer');
				$('.contact-block-right').removeClass('themotion-only-customizer');
				contact_block_left.addClass('col-md-6');
				contact_block_left.removeClass('col-md-12');
			} else {
				$('.themotion-block-left .themotion_contact_left').addClass('themotion-only-customizer');

				var themotion_contact_cr_b1_title = wp.customize._value.themotion_contact_cr_b1_title();
				var themotion_contact_cr_title = wp.customize._value.themotion_contact_cr_title();
				var themotion_contact_cr_b1_email = wp.customize._value.themotion_contact_cr_b1_email();
				var themotion_contact_cr_b1_phone = wp.customize._value.themotion_contact_cr_b1_phone();
				var themotion_contact_cr_b2_title = wp.customize._value.themotion_contact_cr_b2_title();
				var themotion_contact_cr_b2_text = wp.customize._value.themotion_contact_cr_b2_text();
				var themotion_contact_cr_b2_email = wp.customize._value.themotion_contact_cr_b2_email();
				var themotion_contact_cr_b2_phone = wp.customize._value.themotion_contact_cr_b2_phone();
				if( themotion_contact_cr_b1_title === '' && themotion_contact_cr_title === '' && themotion_contact_cr_b1_email === '' && themotion_contact_cr_b1_phone === '' && themotion_contact_cr_b2_title === '' && themotion_contact_cr_b2_text === '' && themotion_contact_cr_b2_email === '' && themotion_contact_cr_b2_phone === '' ){
					contact_block_left.removeClass('col-md-6');
					contact_block_left.addClass('col-md-12');
				}
			}
			$('.themotion-block-left .themotion_contact_left').html(to);
		} );
	} );

	wp.customize('themotion_contact_cr_b1_email', function(value) {
		value.bind(function( to ) {
			var contact_block_left = $('.contact-block-left');
			if(to !== ''){
				$('.contact-left-email').removeClass('themotion-only-customizer');
				$('.contact-block-right').removeClass('themotion-only-customizer');
				contact_block_left.addClass('col-md-6');
				contact_block_left.removeClass('col-md-12');
			} else{
				$('.contact-left-email').addClass('themotion-only-customizer');

				var themotion_contact_cr_b1_title = wp.customize._value.themotion_contact_cr_b1_title();
				var themotion_contact_cr_b1_text = wp.customize._value.themotion_contact_cr_b1_text();
				var themotion_contact_cr_title = wp.customize._value.themotion_contact_cr_title();
				var themotion_contact_cr_b1_phone = wp.customize._value.themotion_contact_cr_b1_phone();
				var themotion_contact_cr_b2_title = wp.customize._value.themotion_contact_cr_b2_title();
				var themotion_contact_cr_b2_text = wp.customize._value.themotion_contact_cr_b2_text();
				var themotion_contact_cr_b2_email = wp.customize._value.themotion_contact_cr_b2_email();
				var themotion_contact_cr_b2_phone = wp.customize._value.themotion_contact_cr_b2_phone();
				if( themotion_contact_cr_b1_title === '' && themotion_contact_cr_b1_text === '' && themotion_contact_cr_title === '' && themotion_contact_cr_b1_phone === '' && themotion_contact_cr_b2_title === '' && themotion_contact_cr_b2_text === '' && themotion_contact_cr_b2_email === '' && themotion_contact_cr_b2_phone === '' ){
					contact_block_left.removeClass('col-md-6');
					contact_block_left.addClass('col-md-12');
				}
			}
			$('.contact-left-email a').html(to);
			var mail_string = 'mailto:'+to;
			$('.contact-left-email a').attr('href',mail_string);
		} );
	} );

	wp.customize('themotion_contact_cr_b1_phone', function(value) {
		value.bind(function( to ) {
			var contact_block_left = $('.contact-block-left');
			if(to !== ''){
				$('.contact-left-phone').removeClass('themotion-only-customizer');
				$('.contact-block-right').removeClass('themotion-only-customizer');
				contact_block_left.addClass('col-md-6');
				contact_block_left.removeClass('col-md-12');
			} else{
				$('.contact-left-phone').addClass('themotion-only-customizer');
				var themotion_contact_cr_b1_title = wp.customize._value.themotion_contact_cr_b1_title();
				var themotion_contact_cr_b1_text = wp.customize._value.themotion_contact_cr_b1_text();
				var themotion_contact_cr_b1_email = wp.customize._value.themotion_contact_cr_b1_email();
				var themotion_contact_cr_title = wp.customize._value.themotion_contact_cr_title();
				var themotion_contact_cr_b2_title = wp.customize._value.themotion_contact_cr_b2_title();
				var themotion_contact_cr_b2_text = wp.customize._value.themotion_contact_cr_b2_text();
				var themotion_contact_cr_b2_email = wp.customize._value.themotion_contact_cr_b2_email();
				var themotion_contact_cr_b2_phone = wp.customize._value.themotion_contact_cr_b2_phone();
				if( themotion_contact_cr_b1_title === '' && themotion_contact_cr_b1_text === '' && themotion_contact_cr_b1_email === '' && themotion_contact_cr_title === '' && themotion_contact_cr_b2_title === '' && themotion_contact_cr_b2_text === '' && themotion_contact_cr_b2_email === '' && themotion_contact_cr_b2_phone === '' ){
					contact_block_left.removeClass('col-md-6');
					contact_block_left.addClass('col-md-12');
				}
			}
			$('.contact-left-phone a').html(to);
			var tel_string = 'tel:'+to;
			$('.contact-left-phone a').attr('href', tel_string);
		} );
	} );

	wp.customize('themotion_contact_cr_b2_title', function(value) {
		var contact_block_left = $('.contact-block-left');
		value.bind(function( to ) {
			if(to !== ''){
				$('.contact-block-content-second .contact-second-title').removeClass('themotion-only-customizer');
				$('.contact-block-right').removeClass('themotion-only-customizer');
				contact_block_left.addClass('col-md-6');
				contact_block_left.removeClass('col-md-12');
			} else {
				$('.contact-block-content-second .contact-second-title').addClass('themotion-only-customizer');
				var themotion_contact_cr_b1_title = wp.customize._value.themotion_contact_cr_b1_title();
				var themotion_contact_cr_b1_text = wp.customize._value.themotion_contact_cr_b1_text();
				var themotion_contact_cr_b1_email = wp.customize._value.themotion_contact_cr_b1_email();
				var themotion_contact_cr_b1_phone = wp.customize._value.themotion_contact_cr_b1_phone();
				var themotion_contact_cr_title = wp.customize._value.themotion_contact_cr_title();
				var themotion_contact_cr_b2_text = wp.customize._value.themotion_contact_cr_b2_text();
				var themotion_contact_cr_b2_email = wp.customize._value.themotion_contact_cr_b2_email();
				var themotion_contact_cr_b2_phone = wp.customize._value.themotion_contact_cr_b2_phone();
				if( themotion_contact_cr_b1_title === '' && themotion_contact_cr_b1_text === '' && themotion_contact_cr_b1_email === '' && themotion_contact_cr_b1_phone === '' && themotion_contact_cr_title === '' && themotion_contact_cr_b2_text === '' && themotion_contact_cr_b2_email === '' && themotion_contact_cr_b2_phone === '' ){
					contact_block_left.removeClass('col-md-6');
					contact_block_left.addClass('col-md-12');
				}
			}
			$('.contact-block-content-second .contact-second-title').html(to);
		} );
	} );

	wp.customize('themotion_contact_cr_b2_text', function(value) {
		var contact_block_left = $('.contact-block-left');
		value.bind(function( to ) {
			if(to !== ''){
				$('.contact-block-content-second .themotion_contact_right').removeClass('themotion-only-customizer');
				$('.contact-block-right').removeClass('themotion-only-customizer');
				contact_block_left.addClass('col-md-6');
				contact_block_left.removeClass('col-md-12');
			} else {
				$('.contact-block-content-second .themotion_contact_right').addClass('themotion-only-customizer');
				var themotion_contact_cr_b1_title = wp.customize._value.themotion_contact_cr_b1_title();
				var themotion_contact_cr_b1_text = wp.customize._value.themotion_contact_cr_b1_text();
				var themotion_contact_cr_b1_email = wp.customize._value.themotion_contact_cr_b1_email();
				var themotion_contact_cr_b1_phone = wp.customize._value.themotion_contact_cr_b1_phone();
				var themotion_contact_cr_b2_title = wp.customize._value.themotion_contact_cr_b2_title();
				var themotion_contact_cr_title = wp.customize._value.themotion_contact_cr_title();
				var themotion_contact_cr_b2_email = wp.customize._value.themotion_contact_cr_b2_email();
				var themotion_contact_cr_b2_phone = wp.customize._value.themotion_contact_cr_b2_phone();
				if( themotion_contact_cr_b1_title === '' && themotion_contact_cr_b1_text === '' && themotion_contact_cr_b1_email === '' && themotion_contact_cr_b1_phone === '' && themotion_contact_cr_b2_title === '' && themotion_contact_cr_title === '' && themotion_contact_cr_b2_email === '' && themotion_contact_cr_b2_phone === '' ){
					contact_block_left.removeClass('col-md-6');
					contact_block_left.addClass('col-md-12');
				}
			}
			$('.contact-block-content-second .themotion_contact_right').html(to);
		} );
	} );

	wp.customize('themotion_contact_cr_b2_email', function(value) {
		var contact_block_left = $('.contact-block-left');
		value.bind(function( to ) {
			if(to !== ''){
				$('.contact-right-email').removeClass('themotion-only-customizer');
				$('.contact-block-right').removeClass('themotion-only-customizer');
				contact_block_left.addClass('col-md-6');
				contact_block_left.removeClass('col-md-12');
			} else{
				$('.contact-right-email').addClass('themotion-only-customizer');
				var themotion_contact_cr_b1_title = wp.customize._value.themotion_contact_cr_b1_title();
				var themotion_contact_cr_b1_text = wp.customize._value.themotion_contact_cr_b1_text();
				var themotion_contact_cr_b1_email = wp.customize._value.themotion_contact_cr_b1_email();
				var themotion_contact_cr_b1_phone = wp.customize._value.themotion_contact_cr_b1_phone();
				var themotion_contact_cr_b2_title = wp.customize._value.themotion_contact_cr_b2_title();
				var themotion_contact_cr_b2_text = wp.customize._value.themotion_contact_cr_b2_text();
				var themotion_contact_cr_title = wp.customize._value.themotion_contact_cr_title();
				var themotion_contact_cr_b2_phone = wp.customize._value.themotion_contact_cr_b2_phone();
				if( themotion_contact_cr_b1_title === '' && themotion_contact_cr_b1_text === '' && themotion_contact_cr_b1_email === '' && themotion_contact_cr_b1_phone === '' && themotion_contact_cr_b2_title === '' && themotion_contact_cr_b2_text === '' && themotion_contact_cr_title === '' && themotion_contact_cr_b2_phone === '' ){
					contact_block_left.removeClass('col-md-6');
					contact_block_left.addClass('col-md-12');
				}
			}
			$('.contact-right-email a').html(to);
			var mail_string = 'mailto:'+to;
			$('.contact-right-email a').attr('href', mail_string);
		} );
	} );

	wp.customize('themotion_contact_cr_b2_phone', function(value) {
		var contact_block_left = $('.contact-block-left');
		value.bind(function( to ) {
			if(to !== ''){
				$('.contact-right-phone').removeClass('themotion-only-customizer');
				$('.contact-block-right').removeClass('themotion-only-customizer');
				contact_block_left.addClass('col-md-6');
				contact_block_left.removeClass('col-md-12');
			} else{
				$('.contact-right-phone').addClass('themotion-only-customizer');
				var themotion_contact_cr_b1_title = wp.customize._value.themotion_contact_cr_b1_title();
				var themotion_contact_cr_b1_text = wp.customize._value.themotion_contact_cr_b1_text();
				var themotion_contact_cr_b1_email = wp.customize._value.themotion_contact_cr_b1_email();
				var themotion_contact_cr_b1_phone = wp.customize._value.themotion_contact_cr_b1_phone();
				var themotion_contact_cr_b2_title = wp.customize._value.themotion_contact_cr_b2_title();
				var themotion_contact_cr_b2_text = wp.customize._value.themotion_contact_cr_b2_text();
				var themotion_contact_cr_b2_email = wp.customize._value.themotion_contact_cr_b2_email();
				var themotion_contact_cr_title = wp.customize._value.themotion_contact_cr_title();
				if( themotion_contact_cr_b1_title === '' && themotion_contact_cr_b1_text === '' && themotion_contact_cr_b1_email === '' && themotion_contact_cr_b1_phone === '' && themotion_contact_cr_b2_title === '' && themotion_contact_cr_b2_text === '' && themotion_contact_cr_b2_email === '' && themotion_contact_cr_title === '' ){
					contact_block_left.removeClass('col-md-6');
					contact_block_left.addClass('col-md-12');
				}
			}
			$('.contact-right-phone a').html(to);
			var tel_string = 'tel:'+to;
			$('.contact-right-phone a').attr('href', tel_string);
		} );
	} );

	wp.customize('themotion_featured_video_header', function(value) {
		value.bind(function( to ) {
			var themotion_featured_video = wp.customize._value.themotion_featured_video_link();
			if(to !== ''){
				$('.themotion-featured-video').removeClass('themotion-only-customizer');
				$('.themotion-featured-video .widget-title').removeClass('themotion-only-customizer');
				$('.themotion-footer-right-side').addClass('col-lg-8').removeClass('col-lg-12');
			} else{
				if(themotion_featured_video === ''){
					$('.themotion-featured-video').addClass('themotion-only-customizer');
					$('.themotion-footer-right-side').addClass('col-lg-12').removeClass('col-lg-8');
				}
				$('.themotion-featured-video .widget-title').addClass('themotion-only-customizer');
			}
			$('.themotion-featured-video .widget-title').html(to);
		} );
	} );

	wp.customize('themotion_featured_video_link', function(value) {
		value.bind(function( to ) {
			var themotion_featured_video_header = wp.customize._value.themotion_featured_video_header();
			if (to !== '') {
				$('.themotion-featured-video').removeClass('themotion-only-customizer');
				$('.themotion-video').removeClass('themotion-only-customizer');
				$('.themotion-footer-right-side').addClass('col-lg-8');
				$('.themotion-footer-right-side').removeClass('col-lg-12');
				if (to.indexOf('iframe') >= 0) {
					$('.themotion-video').html(to);
				} else {
					var match = themotionGetVimeoIDbyUrl(to);
					var string;
					if (match) {
						string = '<iframe src="https://player.vimeo.com/video/' + match + '" width="420" height="240" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
						$('.themotion-video').html(string);
					} else {
						var videoid = to.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
						if (videoid !== null) {
							string = '<iframe width="420" height="240" src="https://www.youtube.com/embed/' + videoid + '" frameborder="0" allowfullscreen></iframe>';
							$('.themotion-video').html(string);
						}
					}
				}
			} else {
				if(themotion_featured_video_header === ''){
					$('.themotion-footer-right-side').addClass('col-lg-12').removeClass('col-lg-8');
					$('.themotion-featured-video').addClass('themotion-only-customizer');
				}
				$('.themotion-video').addClass('themotion-only-customizer');
			}
		} );
	} );

	wp.customize('themotion_footer_contact',function(value){
		value.bind(function(to){
			var themotion_quick_contact_header = wp.customize._value.themotion_quick_contact_header();
			var footer = JSON.parse(to);
			if( footer !== '' ) {
				$('.menu-social-footer').removeClass('themotion-only-customizer');
				$('.themotion-footer-sidebar').addClass('col-lg-6');
				$('.themotion-footer-sidebar').removeClass('col-lg-12');
				$('.themotion-footer-first-row').removeClass('themotion-only-customizer');

				var links = '';
				var i;
				for(i = 0; i < footer.length; i++){
					var text = footer[i].text;
					var link = footer[i].link;
					if(text !== '' && link !== ''){
						var arraytoadd = '<li class="themotion-footer-link"><a href="'+link+'">'+text+'</a><li>';
						links+=arraytoadd;
					}
				}
				$('.menu-social-footer').html(links);
			} else {
				if(themotion_quick_contact_header === ''){
					$('.themotion-footer-sidebar').removeClass('col-lg-6');
					$('.themotion-footer-sidebar').addClass('col-lg-12');
				}
				$('.menu-social-footer').addClass('themotion-only-customizer');
			}
		});
	});

	wp.customize('themotion_quick_contact_header', function(value) {
		value.bind(function( to ) {
			var themotion_footer_contact = wp.customize._value.themotion_footer_contact();
			if(to !== ''){
				$('.themotion-footer-contact .widget-title').removeClass('themotion-only-customizer');
				$('.themotion-footer-first-row').removeClass('themotion-only-customizer');
				$('.themotion-footer-sidebar').addClass('col-lg-6');
				$('.themotion-footer-sidebar').removeClass('col-lg-12');
			} else{
				if(themotion_footer_contact === ''){
					$('.themotion-footer-first-row').addClass('themotion-only-customizer');
					$('.themotion-footer-sidebar').removeClass('col-lg-6');
					$('.themotion-footer-sidebar').addClass('col-lg-12');
				}
				$('.themotion-footer-contact .widget-title').addClass('themotion-only-customizer');
			}
			$('.themotion-footer-contact .widget-title').html(to);
		} );
	} );


	wp.customize('themotion_footer_call_to_action_title', function(value) {
		value.bind(function( to ) {
			var themotion_footer_call_to_action_text = wp.customize._value.themotion_footer_call_to_action_text();
			var themotion_footer_call_to_action_button_text = wp.customize._value.themotion_footer_call_to_action_button_text();
			if(to !== ''){
				$('.themotion-footer-second-row').removeClass('themotion-only-customizer');
				$('.themotion-footer-second-row .widget-title').removeClass('themotion-only-customizer');
			} else{
				if(themotion_footer_call_to_action_text === '' && themotion_footer_call_to_action_button_text === ''){
					$('.themotion-footer-second-row').addClass('themotion-only-customizer');
				}
				$('.themotion-footer-second-row .widget-title').addClass('themotion-only-customizer');
			}
			$('.themotion-footer-second-row .widget-title').html(to);
		} );
	} );

	wp.customize('themotion_footer_call_to_action_text', function(value) {
		value.bind(function( to ) {
			var themotion_footer_call_to_action_title = wp.customize._value.themotion_footer_call_to_action_title();
			var themotion_footer_call_to_action_button_text = wp.customize._value.themotion_footer_call_to_action_button_text();
			if(to !== ''){
				$('.themotion-footer-second-row p').removeClass('themotion-only-customizer');
				$('.themotion-footer-second-row').removeClass('themotion-only-customizer');
			} else{
				if(themotion_footer_call_to_action_title === '' && themotion_footer_call_to_action_button_text === ''){
					$('.themotion-footer-second-row').addClass('themotion-only-customizer');
				}
				$('.themotion-footer-second-row p').addClass('themotion-only-customizer');
			}
			$('.themotion-footer-second-row p').html(to);
		} );
	} );

	wp.customize('themotion_footer_call_to_action_button_text', function(value) {
		value.bind(function( to ) {
			var themotion_footer_call_to_action_title = wp.customize._value.themotion_footer_call_to_action_title();
			var themotion_footer_call_to_action_text = wp.customize._value.themotion_footer_call_to_action_text();
			if(to !== ''){
				$('.themotion-footer-second-row a').removeClass('themotion-only-customizer');
				$('.themotion-footer-second-row').removeClass('themotion-only-customizer');
			} else{
				if(themotion_footer_call_to_action_title === '' && themotion_footer_call_to_action_text === ''){
					$('.themotion-footer-second-row').addClass('themotion-only-customizer');
				}
				$('.themotion-footer-second-row a').addClass('themotion-only-customizer');
			}
			$('.themotion-footer-second-row a').html(to);
		} );
	} );

	wp.customize('themotion_footer_call_to_action_button_link', function(value) {
		value.bind(function( to ) {
			if(to !== ''){
				$('.themotion-footer-second-row a').removeClass('themotion-only-customizer');
			} else{
				$('.themotion-footer-second-row a').addClass('themotion-only-customizer');
			}
			$('.themotion-footer-second-row a').attr('href',to);
		} );
	} );

} )( jQuery );

function themotionGetVimeoIDbyUrl(url) {
	'use strict';
	var id = false;
	jQuery.ajax({
		url: 'https://vimeo.com/api/oembed.json?url='+url,
		type: 'GET',
		async: false,
		success: function(response) {
			if(response.video_id) {
				id = response.video_id;
			}
		}
	});
	return id;
}
