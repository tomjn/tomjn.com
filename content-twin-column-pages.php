<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package _s
 * @since _s 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>

	<div id="twin-columns" class="grid">
		<?php
		if ( is_active_sidebar( 'Top Sidebar' ) ) {
			?>
			<div class="grid__item  one-whole">
				<?php dynamic_sidebar('Top Sidebar'); ?>
			</div>
			<?php
		}
		?>
		<div class="grid__item  one-whole palm-one-whole lap-one-half  desk-one-half">
			<?php dynamic_sidebar('Left Sidebar'); ?>
		</div>
		<div class="grid__item  one-whole palm-one-whole lap-one-half  desk-one-half">
			<?php dynamic_sidebar('Right Sidebar'); ?>
		</div>
	</div>

	<div class="entry-content">
		<?php
		the_content();
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', '_s' ),
			'after' => '</div>'
		) );
		edit_post_link( __( 'Edit', '_s' ), '<span class="edit-link">', '</span>' );
		?>
	</div>
</article>
