<?php
/**
 * @package _s
 * @since _s 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php
		$links = [];
		$desired_links = [
			'visit_url'    => 'Visit the site',
			'docs_url'     => 'View the documentation',
			'download_url' => 'Download',
			'vcs_url'      => 'View the code',
			'support_url'  => 'Support',
		];
		foreach ( $desired_links as $key => $desc ) {
			$meta = get_post_meta( get_the_ID(), $key, true );
			if ( ! empty( $meta ) ) {
				$links[] = [
					'url'  => $meta,
					'text' => $desc,
				];
			}
		}
		if ( ! empty( $links ) ) {
			echo '<ul class="project_links">';
			foreach ( $links as $link ) {
				?>
				<li class="project_link">
					<a href="<?php echo esc_url( $link['url'] ); ?>">
						<?php echo wp_kses_post( $link['text'] ); ?>
					</a>
				</li>
				<?php
			}
			echo '</ul>';
		}
		$term_list = get_the_term_list( get_the_ID(), 'technology', '', ' ', '' );
		if ( ! empty( $term_list ) ) {
			$the_tax = get_taxonomy( 'technology' );
			?>
			<span class="<?php echo esc_attr( $the_tax->name ); ?>-links tax-tag-links">
				<?php echo wp_kses_post( $term_list ); ?>
			</span><br>
			<?php
		}
		$tech_term_list = get_the_term_list( get_the_ID(), 'tomjn_talk_tag', '', ' ', '' );
		if ( ! empty( $tech_term_list ) ) {
			$the_tax = get_taxonomy( 'tomjn_talk_tag' );
			?>
			<span class="<?php echo esc_attr( $the_tax->name ); ?>-links tax-tag-links">
				<?php echo wp_kses_post( $tech_term_list ); ?>
			</span><br/>
			<?php
		}
		?>
	</header>

	<hr/>

	<div class="entry-content">
		<?php
		the_content();
		wp_link_pages( [
			'before' => '<div class="page-links">' . __( 'Pages:', '_s' ),
			'after'  => '</div>',
		] );
		?>
	</div>

	<footer class="entry-meta">
		<?php
		$post_type = get_post_type();
		foreach ( get_object_taxonomies( $post_type ) as $tax_name ) {
		    $term_list = get_the_term_list( get_the_ID(), $tax_name, '', ' ', '' );
			if ( empty( $term_list ) ) {
				continue;
			}
			$the_tax = get_taxonomy( $tax_name );
			?>
			<span class="<?php echo esc_attr( $tax_name ); ?>-links tax-tag-links">
				<?php
				printf(
					wp_kses_post( __( '%1$s: %2$s', '_s' ) ),
					esc_html( $the_tax->labels->name ),
					wp_kses_post( $term_list )
				);
				?>
			</span>
			<br/>
			<?php
		}
		?>
	</footer>
</article>
