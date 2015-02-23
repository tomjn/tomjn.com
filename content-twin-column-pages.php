<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package _s
 * @since _s 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$title = the_title( '','',false);
	if ( !empty( $title ) ) {
		?>
	<header class="entry-header">
		<h1 class="entry-title"><?php echo esc_html( $title ); ?></h1>
	</header>
		<?php
	}
	?>

	<div id="twin-columns" class="grid">
		<?php
		if ( is_active_sidebar( 'Top Sidebar' ) || is_active_template_sidebar('Top Sidebar') ) {
			?>
			<div class="grid__item  one-whole">
				<?php dynamic_sidebar('Top Sidebar'); ?>
			</div>
			<?php
		}
		if (	is_active_sidebar( 'Left Sidebar' ) || is_active_sidebar( 'Right Sidebar' ) ||
			is_active_template_sidebar( 'Left Sidebar' ) || is_active_template_sidebar( 'Right Sidebar' ) ) {
			?>
			<div class="grid__item  one-whole palm-one-whole lap-one-half  desk-one-half">
				<?php dynamic_sidebar('Left Sidebar'); ?>
			</div>
			<div class="grid__item  one-whole palm-one-whole lap-one-half  desk-one-half">
				<?php dynamic_sidebar('Right Sidebar'); ?>
			</div>
			<?php
		}
		?>
	</div>

	<div class="entry-content">
		<?php
		the_content();
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', '_s' ),
			'after' => '</div>'
		) );
		?>
	</div>
</article>
