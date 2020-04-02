<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package _s
 * @since _s 1.0
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
