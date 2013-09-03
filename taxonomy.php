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

	<?php
	echo '<h1>'.$current_term->name.'</h1>';
	//$tag_description = tag_description();
	//	if ( ! empty( $tag_description ) )
	//		echo apply_filters( 'tax_archive_meta', '<div class="taxonomy-description">' . $tax_description . '</div>' );
	?>
				</header>
				<div class="taxonomy-list grid">
					<div class="taxonomy-term-choices grid__item one-quarter palm-one-whole lap-one-third desk-one-quarter">
						<h1 class="page-title">
	<?php
	echo $tname;
	?>
					</h1>
	<?php
	$terms = get_terms( array( $taxonomy ) );
	if ( !empty( $terms ) ) {
		echo '<ul class="taxonomy-term-choices-list">';
		foreach ( $terms as $term ) {
			$class = '';
			if ( $term->slug == $current_term->slug ) {
				$class = 'active';
			}
		    echo '<li class="'.$class.'"><a href="'.get_term_link( $term->slug, $taxonomy ).'">'.$term->name.'</a></li>';
		}
		echo '</ul>';
	}
	?>
					</div>
					<div class="taxonomy-listing grid__item three-quarters palm-one-whole lap-two-thirds desk-three-quarters">
	<?php
	//rewind_posts();

//	_s_content_nav( 'nav-above' );

	/* Start the Loop */
	while ( have_posts() ) {
		the_post();

		/* Include the Post-Format-specific template for the content.
		 * If you want to overload this in a child theme then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */
		get_template_part( 'excerpt', get_post_type() );
	}
	_s_content_nav( 'nav-below' );

} else {
	get_template_part( 'no-results', 'archive' );
}
?>
					</div>
				</div>
			</div><!-- #content -->
		</section><!-- #primary .site-content -->

<?php
get_sidebar();
get_footer();