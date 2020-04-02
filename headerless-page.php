<?php
/**
 * Template Name: Headerless page
 *
 * @package _s
 * @since _s 1.0
 */

get_header( 'empty' );
?>
<section id="content" class="site-content" role="main">
	<?php
	while ( have_posts() ) {
		the_post();
		get_template_part( 'content', 'page' );
	}
	?>
</section>
<?php
get_sidebar();
get_footer();
