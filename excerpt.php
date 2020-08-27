<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h3 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', '_s' ), esc_attr( the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h3>
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
	<?php /*
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<footer class="entry-meta">
		<?php
		$post_type = get_post_type();
		foreach ( get_object_taxonomies( $post_type ) as $tax_name ) {
			$term_list = get_the_term_list( get_the_ID(), $tax_name, '', '', '' );
			if ( empty( $term_list ) ) {
				continue;
			}
			$the_tax = get_taxonomy( $tax_name );
			?>
			<span class="<?php echo esc_attr( $tax_name ); ?>-links tax-tag-links">
				<?php echo wp_kses_post( $term_list ); ?>
			</span>
			<?php
		}
		?>
	</footer> */  ?>
</article>
