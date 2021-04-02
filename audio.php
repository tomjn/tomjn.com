<?php
/**
 * The template for displaying image attachments.
 *
 * @package _s
 * @since _s 1.0
 */

get_header();
?>
<section id="content" class="site-content" role="main">
	<?php
	while ( have_posts() ) {
		the_post();
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>

				<div class="entry-meta">
					<?php
						$metadata = wp_get_attachment_metadata();
						printf( wp_kses_post( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s" pubdate>%2$s</time></span>, <a href="%3$s" title="Direct link">direct link</a>, posted in <a href="%4$s" title="Return to %5$s">%5$s</a>', '_s' ) ),
							esc_attr( get_the_date( 'c' ) ),
							esc_html( get_the_date() ),
							esc_url( wp_get_attachment_url() ),
							esc_url( get_permalink( wp_get_post_parent_id( 0 ) ) ),
							esc_html( get_the_title( wp_get_post_parent_id( 0 ) ) )
						);
					?>
				</div>

			</header>

			<div class="entry-content">
				<div class="entry-attachment">
					<div class="attachment">
						<audio controls>
							<source src="<?php echo esc_url( wp_get_attachment_url() ); ?>" type="<?php echo esc_attr( get_post_mime_type() ); ?>">
							Your browser does not support the audio tag.
						</audio>
					</div>
					<?php
					if ( ! empty( $post->post_excerpt ) ) {
						?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div>
						<?php
					}
					?>
				</div>
				<?php
				the_content();
				wp_link_pages( [
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
					'after'  => '</div>',
				] );
				?>
			</div>
		</article>

		<?php
		comments_template();
	}
	?>
</section>
<?php
get_footer();
