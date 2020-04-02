<?php
/**
 * The template for displaying Taxonomy pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 * @since _s 1.0
 */

get_header();
$taxonomy = '';
if ( is_tax() ) {
	$taxonomy = get_query_var( 'taxonomy' );
} else {
	if ( is_category() ) {
		$taxonomy = 'category';
	} elseif ( is_tag() ) {
		$taxonomy = 'post_tag';
	}
}

$current_term = get_queried_object();
$tname = $taxonomy;
$taxobj = get_taxonomy( $taxonomy );
if ( ! empty( $taxobj ) ) {
	$tname = $taxobj->labels->name;
}
?>
<section id="content" class="site-content" role="main">
	<?php
	if ( have_posts() ) {
		?>
		<header class="page-header">
			<h1>Projects &amp; Work</h1>
		</header>
		<div class="taxonomy-listing columns">
		<?php

		/* Start the Loop */
		while ( have_posts() ) {
			the_post();
			?>
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="project_listing_item column is-half">
				<div class="columns">
					<div class="column is-one-third">
						<?php the_post_thumbnail( 'project-main' ); ?>
					</div>
					<div class="column is-two-thirds">
						<h3><?php the_title(); ?></h3>
						<?php the_excerpt(); ?>
					</div>
				</div>
			</a>
			<?php
		}
		_s_content_nav( 'nav-below' );

	} else {
		get_template_part( 'no-results', 'archive' );
	}
	?>
		</div>
	</div>
</section>
<?php
get_sidebar();
get_footer();
