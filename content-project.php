<?php
/**
 * @package _s
 * @since _s 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="grid">

		<div class="grid__item  one-whole  lap-two-thirds  desk-two-thirds">
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php
				$links = array();
				$desired_links = array(
					'visit_url' => 'Visit the site',
					'docs_url' => 'View the documentation',
					'download_url' => 'Download',
					'vcs_url' => 'View the code',
					'support_url' => 'Support'
				);
				foreach ( $desired_links as $key => $desc ) {
					$meta = get_post_meta( get_the_ID(), $key, true );
					if ( !empty( $meta ) ) {
						$links[] = array( 'url' => $meta, 'text' => $desc );
					}
				}
				if ( !empty( $links ) ) {
					echo '<ul class="project_links">';
					foreach ( $links as $link ) {
						echo '<li class="project_link">';
						echo '<a href="'.$link['url'].'">'.$link['text'].'</a>';
						echo '</li>';
					}
					echo '</ul>';
				}
				$term_list = get_the_term_list( get_the_ID(), 'technology', '', ' ', '' );
				if ( !empty( $term_list ) ) {
					$the_tax = get_taxonomy( 'technology' );
					?>
					<span class="<?php echo $tax_name; ?>-links tax-tag-links">
						<?php echo $term_list; ?>
					</span><br>
					<?php
				}
				$tech_term_list = get_the_term_list( get_the_ID(), 'tomjn_talk_tag', '', ' ', '' );
				if ( !empty( $tech_term_list ) ) {
					$the_tax = get_taxonomy( 'tomjn_talk_tag' );
					?>
					<span class="<?php echo $tax_name; ?>-links tax-tag-links">
						<?php echo $tech_term_list; ?>
					</span><br>
					<?php
				}
				?>
			</header>
		</div>
		<div class="grid__item  one-whole  lap-one-third  desk-one-third">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'project-main' );
			}
			?>
		</div>
	</div>

	<hr/>

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
				<span class="<?php echo $tax_name; ?>-links tax-tag-links">
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
		edit_post_link( __( 'Edit', '_s' ), '<span class="edit-link">', '</span>' );
		if ( shortcode_exists( 'followbutton' ) ) {
			?>
			<p><?php echo do_shortcode( "[followbutton username='Tarendai' count='true' lang='en' theme='light']" ); ?></p>
			<?php
		}
		?>
	</footer>
</article>
