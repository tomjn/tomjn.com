<?php
/**
 * Theme template
 *
 * @package tomjn.com
 */

get_header();
?>
<section id="content" class="site-content" role="main">
	<?php
	while ( have_posts() ) {
		the_post();
		get_template_part( 'content', 'page' );
		comments_template( '', true );
	}
	?>
</section>
<?php
get_sidebar();
get_footer();
