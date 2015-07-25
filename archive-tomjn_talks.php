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
	} else if ( is_tag() ) {
		$taxonomy = 'post_tag';
	}
}

$current_term =	$wp_query->queried_object;
$tname = $taxonomy;
$taxobj = get_taxonomy( $taxonomy );
if ( !empty( $taxobj ) ) {
	$tname = $taxobj->labels->name;
}
?>
		<section id="primary" class="site-content">
			<div id="content" role="main">
<?php
if ( have_posts() ) {
	?>
				<header class="page-header">
					<h1>Talks</h1>
				</header>

					<div class="taxonomy-listing grid">
	<?php

	/* Start the Loop */
	while ( have_posts() ) {
		the_post();

		?>
		<a href="<?php echo esc_url( get_permalink() ); ?>" class="project_listing_item grid__item one-whole palm-one-whole lap-one-half desk-one-half">
			<h2><?php the_title(); ?></h2>
			<?php
			$term_list = get_the_term_list( get_the_ID(), 'technology', '', ' ', '' );
			if ( !empty( $term_list ) ) {
				$the_tax = get_taxonomy( 'technology' );
				?>
				<span class="<?php echo esc_attr( $tax_name ); ?>-links tax-tag-links">
					<?php echo wp_kses_post( $term_list ); ?>
				</span><br>
				<?php
			}
			$tech_term_list = get_the_term_list( get_the_ID(), 'tomjn_talk_tag', '', ' ', '' );
			if ( !empty( $tech_term_list ) ) {
				$the_tax = get_taxonomy( 'tomjn_talk_tag' );
				?>
				<span class="<?php echo esc_attr( $tax_name ); ?>-links tax-tag-links">
					<?php echo wp_kses_post( $tech_term_list ); ?>
				</span><br>
				<?php
			}
			the_excerpt();
			?>
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
			</div>
		</section>
<?php
get_sidebar();
get_footer();
