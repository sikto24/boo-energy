/***************************************************
==================== JS INDEX ======================
 * ***************************************************
01. Toggle For Footer
02. Section Slider
 ****************************************************/

(function ($) {
	('use strict');

	let sliderInitialized = false;

	// Function to get the current window width
	function getWindowWidth() {
		return $( window ).width();
	}

	// 01. Toggle For Footer
	function initializeFooterToggle() {
		$( '.boo-footer-widget-title' ).off( 'click' );
		const windowWidth = getWindowWidth();
		if (windowWidth < 767) {
			const titles         = $( '.boo-footer-widget-title' );
			const menuContainers = $( '.footer-top-area-widget' );

			if (titles.length && menuContainers.length) {
				titles.each(
					function (index) {
						$( this ).on(
							'click',
							function () {
								menuContainers.eq( index ).toggleClass( 'menu-toggle-active' );
							}
						);
					}
				);
			}
		} else {
			$( '.footer-top-area-widget' ).removeClass( 'menu-toggle-active' );
		}
	}
	// 02. Section Slider
	function booSliderSection() {
		const windowWidth = getWindowWidth();
		if (windowWidth < 1200 && ! sliderInitialized) {
			$( '.boo-slider-section' ).slick(
				{
					slidesToShow: 3,
					slidesToScroll: 1,
					autoplay: false,
					autoplaySpeed: 2000,
					dots: true,
					arrows: true,
					infinite: false,
					lazyLoad: 'ondemand',
					responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 2.1
						}
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 1.3
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1.1
						}
					}
					]
				}
			);
			sliderInitialized = true;
		} else if (windowWidth >= 1200 && sliderInitialized) {
			$( '.boo-slider-section' ).slick( 'unslick' );
			sliderInitialized = false;
		}
	}

	$( document ).ready(
		function () {
			initializeFooterToggle();
			booSliderSection();
		}
	);
	$( window ).on(
		'resize',
		function () {
			initializeFooterToggle();
			booSliderSection();
		}
	);
})( jQuery );
