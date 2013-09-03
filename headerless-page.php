<?php
/**
 * Template Name: Headerless page
 *
 * @package _s
 * @since _s 1.0
 */


get_header( 'empty' );
?>

<div id="primary" class="site-content">
	<div id="content" role="main">
<?php
while ( have_posts() ) {
	the_post();
	get_template_part( 'content', 'page' );
}
 // end of the loop.
?>

	</div><!-- #content -->
</div><!-- #primary .site-content -->

<?php
get_sidebar();
get_footer();