<form role="search s" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<input id="search-input" type="search" class="search-field"
		placeholder="<?php echo esc_attr_x( 'Skriv ett sökord', 'boo_energy' ) ?>"
		value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Sök', 'submit button' ) ?>" />
</form>