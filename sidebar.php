<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package _s
 * @since _s 1.0
 */
?>
<div id="secondary" class="widget-area container" role="complementary">
	<div class="grid">
		<?php
		do_action( 'before_sidebar' );
		if ( ! dynamic_sidebar( 'sidebar-1' ) ) {
			?>

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>

			<aside id="archives" class="widget">
				<h1 class="widget-title"><?php _e( 'Archives', '_s' ); ?></h1>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<h1 class="widget-title"><?php _e( 'Meta', '_s' ); ?></h1>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

			<?php
		}
		?>
	</div>
</div>
