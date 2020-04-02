<?php
/**
 * The template for displaying search forms in _s
 *
 * @package _s
 * @since _s 1.0
 */

?>
<form
	method="get"
	id="searchform"
	action="<?php echo esc_url( home_url( '/' ) ); ?>"
	role="search"
>
	<label for="s" class="assistive-text"><?php esc_html_e( 'Search', '_s' ); ?></label>
	<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', '_s' ); ?>" value="<?php get_search_query(); ?>" />
	<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', '_s' ); ?>" />
</form>
