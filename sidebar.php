<?php
/**
 * Theme template
 *
 * @package tomjn.com
 */

?>
<section id="secondary" class="widget-area container" role="complementary">
	<div class="columns">
		<?php
		do_action( 'before_sidebar' );
		if ( ! dynamic_sidebar( 'sidebar-1' ) ) {
			?>

			<aside id="search" class="widget widget_search column">
				<?php get_search_form(); ?>
			</aside>

			<?php
		}
		?>
	</div>
</section>
