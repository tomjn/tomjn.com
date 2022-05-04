<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tomjn.com
 */

if ( ! is_singular() ) {
	get_template_part( 'archive' );
	return;
}

get_header();
?>
<section id="content" class="site-content" role="main">
	<?php
	if ( have_posts() ) {
		_s_content_nav( 'nav-above' );
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', get_post_format() );
		}
		_s_content_nav( 'nav-below' );
	} elseif ( current_user_can( 'edit_posts' ) ) {

		get_template_part( 'no-results', 'index' );

	}
	?>
</section>

<?php
get_sidebar();
get_footer();
