<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package tomjn.com
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>

	<div class="entry-content">
		<?php
		the_content();
		wp_link_pages( [
			'before' => '<div class="page-links">' . __( 'Pages:', '_s' ),
			'after'  => '</div>',
		] );
		?>
	</div>
</article>
