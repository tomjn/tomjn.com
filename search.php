<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package tomjn.com
 */

get_header();
?>

<section id="content" class="site-content" role="main">
	<?php
	if ( have_posts() ) {
		?>

		<header class="page-header">
			<h1 class="page-title">
				<?php
				printf(
					esc_html__( 'Search Results for: %s', '_s' ),
					'<span>' . esc_html( get_search_query() ) . '</span>'
				);
				?>
			</h1>
		</header>
		<?php
		_s_content_nav( 'nav-above' );
		?>

		<div class="taxonomy-list columns">
			<div class="taxonomy-listing column is-three-quarters">
			<?php

			while ( have_posts() ) {
				the_post();
				get_template_part( 'excerpt', get_post_type() );
			}
			_s_content_nav( 'nav-below' );

			?>
			</div>
			<div class="taxonomy-term-choices column">
				<h1 class="page-title">Search:</h1>
			<?php
			get_template_part( 'searchform' );

			echo '<h1>Archives</h1>';
			echo '<ul class="taxonomy-term-choices-list ">';
			wp_get_archives( [
				'type'            => 'monthly',
				'format'          => 'html',
				'show_post_count' => 0,
			] );
			echo '</ul>';
			?>
			</div>
		</div>

		<?php
	} else {
		get_template_part( 'no-results', 'search' );
	}
	?>
</section>

<?php
get_sidebar();
get_footer();
