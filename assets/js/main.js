/***************************************************
==================== JS INDEX ======================
 * ***************************************************
01. Toggle For Footer
02. Section Slider
 ****************************************************/

(function ($) {
	('use strict');

	let arrowLeftSVG      = ` < span class = "boo-slider-arrow-left" > < svg width = "22" height = "19" viewBox = "0 0 22 19" fill = "none" xmlns = "http://www.w3.org/2000/svg" > < path d = "M9.12 18.296a.426.426 0 0 0 0-.6L1.445 10.02a1 1 0 0 1-.215-.32h20.345a.425.425 0 1 0 0-.85H1.225c.05-.115.12-.225.215-.32L9.115.856a.426.426 0 0 0 0-.6.426.426 0 0 0-.6 0L.84 7.93a1.91 1.91 0 0 0 0 2.7l7.675 7.675a.426.426 0 0 0 .6 0" fill = "#E2DAD6" / > < / svg > < / span > `;
	let arrowRightSVG     = ` < span class = "boo-slider-arrow-right" > < svg width = "22" height = "19" viewBox = "0 0 22 19" fill = "none" xmlns = "http://www.w3.org/2000/svg" > < path d = "M12.88.626a.426.426 0 0 0 0 .6L20.555 8.9c.095.095.165.205.215.32H.425a.425.425 0 1 0 0 .85h20.35a1 1 0 0 1-.215.32l-7.675 7.675a.426.426 0 0 0 0 .6.426.426 0 0 0 .6 0l7.675-7.675a1.91 1.91 0 0 0 0-2.7L13.485.616a.426.426 0 0 0-.6 0" fill = "#E2DAD6" / > < / svg > < / span > `;
	let sliderInitialized = false;
	let windowWidth       = window.innerWidth;

	// 01. Toggle For Footer
	function initializeFooterToggle() {
		$( '.boo-footer-widget-title' ).off( 'click' );

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
					prevArrow: arrowLeftSVG,
					nextArrow: arrowRightSVG,
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
})( jQuery );
