<?php
/**
 * @package _s
 * @since _s 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', '_s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php _s_posted_on(); ?>
		</div>
		<?php endif; ?>
	</header>

<?php
if ( is_search() || is_archive() ) {
	// Only display Excerpts for Search and archives
	?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<?php
} else {
		?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', '_s' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', '_s' ), 'after' => '</div>' ) ); ?>
	</div>
	<?php
}
?>
	<footer class="entry-meta">
<?php
$post_type = get_post_type();
foreach ( get_object_taxonomies( $post_type ) as $tax_name ) {
	$term_list = get_the_term_list( get_the_ID(), $tax_name, '', ' ', '' );
	if ( !empty( $term_list ) ) {
		$the_tax = get_taxonomy( $tax_name );
		?>
		<span class="<?php echo $tax_name; ?>-links">
			<?php printf( __( '%1$s: %2$s<br>', '_s' ), $the_tax->labels->name, $term_list ); ?>
		</span>
		<?php
	}
}

		if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
			?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', '_s' ), __( '1 Comment', '_s' ), __( '% Comments', '_s' ) ); ?></span>
			<?php
		}
		edit_post_link( __( 'Edit', '_s' ), ' <span class="edit-link">', '</span>' );
		?>
	</footer><!-- #entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
