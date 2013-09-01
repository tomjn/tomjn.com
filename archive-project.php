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

	<?php
	echo '<h1>Projects &amp; Work</h1>';
	?>
				</header>

					<div class="taxonomy-listing grid">
	<?php
	//rewind_posts();

	//	_s_content_nav( 'nav-above' );

	/* Start the Loop */
	while ( have_posts() ) {
		the_post();

		?>
		<a href="<?php echo get_permalink(); ?>" class="grid__item one-whole lap-one-half desk-one-half">
			<div class="grid">
				<div class="grid__item one-third ">
					<?php the_post_thumbnail( 'medium' ); ?>
				</div>
				<div class="grid__item two-thirds">
					<h2><?php the_title(); ?></h2>
					<p><?php the_excerpt(); ?></p>
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
			</div><!-- #content -->
		</section><!-- #primary .site-content -->

<?php
get_sidebar();
get_footer();