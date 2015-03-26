
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php _s_posted_on(); ?>
		</div>
	</header>

	<div class="entry-content">
		<?php
		the_content();
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', '_s' ),
			'after' => '</div>'
		) );
		?>
	</div>

	<footer class="entry-meta">
		<?php
		$post_type = get_post_type();
		foreach ( get_object_taxonomies( $post_type ) as $tax_name ) {
			$term_list = get_the_term_list( get_the_ID(), $tax_name, '', ' ', '' );
			if ( !empty( $term_list ) ) {
				$the_tax = get_taxonomy( $tax_name );
				?>
				<span class="<?php echo esc_attr( $tax_name ); ?>-links tax-tag-links">
					<?php echo wp_kses_post( $term_list ); ?>
				</span>
				<?php
			}
		}

		$meta_text = __( 'Bookmark the <a href="%1$s" title="Permalink to %2$s" rel="bookmark">permalink</a>.', '_s' );

		printf(
			'<p>'.$meta_text.'</p>',
			esc_url( get_permalink() ),
			esc_attr( the_title_attribute( 'echo=0' ) )
		);
		?>
	</footer>
</article>
