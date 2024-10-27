/***************************************************
==================== JS INDEX ======================
 * ***************************************************
01. Toggle For Footer
 ****************************************************/

(function ($) {
	('use strict');

	// 01. Toggle For Footer
	function initializeFooterToggle() {
		const windowWidth = $( window ).width();
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
	$( document ).ready(
		function () {
			initializeFooterToggle();
		}
	);
	$( window ).on(
		'resize',
		function () {
			initializeFooterToggle();
		}
	);
})( jQuery );
