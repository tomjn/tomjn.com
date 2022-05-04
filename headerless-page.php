<?php
/**
 * Template Name: Headerless page
 *
 * @package tomjn.com
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
