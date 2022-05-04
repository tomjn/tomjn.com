<?php
/**
 * Theme template
 *
 * @package tomjn.com
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', '_s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
		<?php
		if ( 'post' === get_post_type() ) {
			?>
			<div class="entry-meta">
				<?php _s_posted_on(); ?>
			</div>
			<?php
		}
		?>
	</header>

<?php
// Only display Excerpts for Search and archives.
if ( is_search() || is_archive() ) {
	?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<?php
} else {
	?>
	<div class="entry-content">
		<?php
		the_content(
			wp_kses_post(
				__( 'Continue reading <span class="meta-nav">&rarr;</span>', '_s' )
			)
		);
		wp_link_pages( [
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
			'after'  => '</div>',
		] );
		?>
	</div>
	<?php
}
?>
	<footer class="entry-meta">
<?php
$post_type = get_post_type();
foreach ( get_object_taxonomies( $post_type ) as $tax_name ) {
	$term_list = get_the_term_list( get_the_ID(), $tax_name, '', ' ', '' );
	if ( ! empty( $term_list ) ) {
		$the_tax = get_taxonomy( $tax_name );
		?>
		<span class="<?php echo esc_attr( $tax_name ); ?>-links">
			<?php
			printf(
				wp_kses_post( __( '%1$s: %2$s<br>', '_s' ) ),
				esc_html( $the_tax->labels->name ),
				wp_kses_post( $term_list )
			);
			?>
		</span>
		<?php
	}
}

if ( ! post_password_required() && ( comments_open() || have_comments() ) ) {
	?>
	<span class="comments-link">
		<?php
		comments_popup_link(
			esc_html__( 'Leave a comment', '_s' ),
			esc_html__( '1 Comment', '_s' ),
			esc_html__( '% Comments', '_s' )
		);
		?>
		</span>
	<?php
}
?>
	</footer>
</article>
