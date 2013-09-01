<?php
/**
 * @package _s
 * @since _s 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="grid">

		<div class="grid__item  one-whole  lap-one-half  desk-one-half">
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php the_excerpt(); ?>
			</header>
		</div>
		<div class="grid__item  one-whole  lap-one-half  desk-one-half">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'large' );
			}
			?>
		</div>
	</div>

	<div class="entry-content">
		<?php
		the_content();
		wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', '_s' ), 'after' => '</div>' ) );
		?>
	</div><!-- .entry-content -->


	<footer class="entry-meta">
		<?php

		$post_type = get_post_type();
		foreach ( get_object_taxonomies( $post_type ) as $tax_name ) {
		    $term_list = get_the_term_list( get_the_ID(), $tax_name, '', ' ', '' );
			if ( !empty( $term_list ) ) {
				$the_tax = get_taxonomy( $tax_name );
				?>
				<span class="<?php echo $tax_name; ?>-links">
					<?php printf( __( '%1$s: %2$s', '_s' ), $the_tax->labels->name, $term_list ); ?>
				</span><br>
				<?php
			}
		}

		$meta_text = __( 'Bookmark the <a href="%1$s" title="Permalink to %2$s" rel="bookmark">permalink</a>.', '_s' );

		printf(
			$meta_text,
			get_permalink(),
			the_title_attribute( 'echo=0' )
		);
		?>

		<?php edit_post_link( __( 'Edit', '_s' ), '<span class="edit-link">', '</span>' );
		if ( shortcode_exists( 'followbutton' ) ) {
			?>
		<p><?php echo do_shortcode("[followbutton username='Tarendai' count='true' lang='en' theme='light']"); ?></p>
			<?php
		}
		?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->