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
$taxonomy = get_query_var( 'taxonomy' );
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
					<h1><?php echo esc_html( $current_term->name ) ?></h1>
				</header>
				<div class="taxonomy-list grid">
					<div class="taxonomy-term-choices grid__item one-quarter palm-one-whole lap-one-third desk-one-quarter">
						<h1 class="page-title"><?php echo esc_html( $tname ); ?></h1>
						<?php
						$terms = get_terms( array( $taxonomy ) );
						if ( !empty( $terms ) ) {
							echo '<ul class="taxonomy-term-choices-list">';
							foreach ( $terms as $term ) {
								$class = '';
								if ( $term->slug == $current_term->slug ) {
									$class = 'active';
								}
							    echo '<li class="'.esc_attr( $class ).'"><a href="'.esc_url( get_term_link( $term->slug, $taxonomy ) ).'">'.esc_html( $term->name ).'</a></li>';
							}
							echo '</ul>';
						}
						?>
					</div>
					<div class="taxonomy-listing grid__item three-quarters palm-one-whole lap-two-thirds desk-three-quarters">
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
				</div>
			</div>
		</section>

<?php
get_sidebar();
get_footer();
