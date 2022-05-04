<?php
/**
 * The template for displaying Taxonomy pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tomjn.com
 */

get_header();
$taxonomy = get_query_var( 'taxonomy' );
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
		<h1><?php echo esc_html( $current_term->name ) ?></h1>
	</header>
	<div class="taxonomy-list columns">
		<div class="taxonomy-listing column is-three-quarters">
		<?php

		/* Start the Loop */
		while ( have_posts() ) {
			the_post();
			get_template_part( 'excerpt', get_post_type() );
		}
		_s_content_nav( 'nav-below' );

	} else {
		get_template_part( 'no-results', 'archive' );
	}
	?>
		</div>
		<div class="taxonomy-term-choices column">
			<h1 class="page-title"><?php echo esc_html( $tname ); ?></h1>
			<?php
			$terms = get_terms( [ $taxonomy ] );
			if ( ! empty( $terms ) ) {
				echo '<ul class="taxonomy-term-choices-list">';
				foreach ( $terms as $term ) {
					$class = '';
					if ( $term->slug === $current_term->slug ) {
						$class = 'active';
					}
					$term_link = get_term_link( $term->slug, $taxonomy );
					if ( ! is_wp_error( $term_link ) ) {
						echo '<li class="' . esc_attr( $class ) . '"><a href="' . esc_url( $term_link ) . '">' . esc_html( $term->name ) . '</a></li>';
					}
				}
				echo '</ul>';
			}
			?>
		</div>
	</div>
</section>

<?php
get_sidebar();
get_footer();
