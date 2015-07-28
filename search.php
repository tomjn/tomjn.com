<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package _s
 * @since _s 1.0
 */

get_header();
?>

		<section id="primary" class="site-content">
			<div id="content" role="main">

			<?php
			if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php printf( __( 'Search Results for: %s', '_s' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?>
					</h1> 
				</header>
				<?php
				_s_content_nav( 'nav-above' );
				?>

				<div class="taxonomy-list grid">
					<div class="taxonomy-listing grid__item three-quarters palm-one-whole lap-two-thirds desk-three-quarters">
					<?php


					while ( have_posts() ) {
						the_post();
						get_template_part( 'content', 'search' );
					}
					_s_content_nav( 'nav-below' );

					?>
					</div>
					<div class="taxonomy-term-choices grid__item one-quarter palm-one-whole lap-one-third desk-one-quarter">
						<h1 class="page-title">Search:</h1>
					<?php
					get_template_part( 'searchform' );

					echo '<h1>Archives</h1>';
					echo '<ul class="taxonomy-term-choices-list ">';
					wp_get_archives( array( 'type' => 'monthly', 'format' => 'li', 'show_post_count' => 0 ) );
					echo '</ul>';
					?>
					</div>
					
				</div>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

			</div>
		</section>

<?php
get_sidebar();
get_footer();
