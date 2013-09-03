<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package _s
 * @since _s 1.0
 */

get_header(); ?>

		<section id="primary" class="site-content">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', '_s' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>
				<?php _s_content_nav( 'nav-above' ); ?>

				<div class="taxonomy-list grid">
					<div class="taxonomy-term-choices grid__item one-quarter palm-one-whole lap-one-third desk-one-quarter">
						<h1 class="page-title">
	<?php
	echo 'Search:';


	?>
					</h1>
	<?php
	get_template_part( 'searchform' );

	echo '<h1>Archives</h1>';
	echo '<ul class="taxonomy-term-choices-list ">';
	wp_get_archives( array( 'type' => 'monthly', 'format' => 'li', 'show_post_count' => 0 ) );
	echo '</ul>';
	?>
					</div>
					<div class="taxonomy-listing grid__item three-quarters palm-one-whole lap-two-thirds desk-three-quarters">
	<?php
	//rewind_posts();

	

	/* Start the Loop */
	while ( have_posts() ) {
		the_post();

		/* Include the Post-Format-specific template for the content.
		 * If you want to overload this in a child theme then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */
		get_template_part( 'content', 'search' );
	}
	_s_content_nav( 'nav-below' );

	?>
					</div>
				</div>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>