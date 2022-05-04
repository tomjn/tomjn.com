<?php
/**
 * The template for displaying Taxonomy pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tomjn.com
 */

get_header();
$post_type = get_post_type();
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
		<h1>Talks</h1>
	</header>

	<div class="taxonomy-listing">
		<?php

		/* Start the Loop */
		while ( have_posts() ) {
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'project_listing_item' ); ?>>
				<header>
					<h3>
						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<?php the_title(); ?>
						</a>
					</h3>
				</header>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div>
				<footer class="entry-meta">
					<?php
					foreach ( get_object_taxonomies( $post_type ) as $tax_name ) {
						$term_list = get_the_term_list( get_the_ID(), $tax_name, '', '', '' );
						if ( empty( $term_list ) ) {
							continue;
						}
						$the_tax = get_taxonomy( $tax_name );
						?>
						<span class="<?php echo esc_attr( $tax_name ); ?>-links tax-tag-links">
							<?php echo wp_kses_post( $term_list ); ?>
						</span>
						<?php
					}
					?>
				</footer>
			</article>
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
get_footer();
