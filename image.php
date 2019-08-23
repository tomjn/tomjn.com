<?php
/**
 * The template for displaying image attachments.
 *
 * @package _s
 * @since _s 1.0
 */

get_header();
?>
		<div id="primary" class="site-content image-attachment">
			<div id="content" role="main">

			<?php
			while ( have_posts() ) {
				the_post();
				global $post;
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>

						<div class="entry-meta">
							<?php
								$metadata = wp_get_attachment_metadata();
								printf( wp_kses_post( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s" pubdate>%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a>', '_s' ) ),
									esc_attr( get_the_date( 'c' ) ),
									esc_html( get_the_date() ),
									esc_url( wp_get_attachment_url() ),
									absint( $metadata['width'] ),
									absint( $metadata['height'] ),
									esc_url( get_permalink( $post->post_parent ) ),
									esc_html( get_the_title( $post->post_parent ) )
								);
							?>
						</div>

						<nav id="image-navigation">
							<span class="previous-image"><?php previous_image_link( 'none', __( '&larr; Previous', '_s' ) ); ?></span>
							<span class="next-image"><?php next_image_link( 'none', __( 'Next &rarr;', '_s' ) ); ?></span>
						</nav>
					</header>

					<div class="entry-content">
						<div class="entry-attachment">
							<div class="attachment">
								<?php
									/**
									 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
									 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
									 */
									$children = get_posts( array(
										'post_parent' => $post->post_parent,
										'post_status' => 'inherit',
										'post_type' => 'attachment',
										'post_mime_type' => 'image',
										'order' => 'ASC',
										'orderby' => 'menu_order ID',
										'posts_per_page' => 150,
										'suppress_filters' => false,
									) );
									$attachments = array_values( $children );
									$k = 0;
									foreach ( $attachments as $k => $attachment ) {
										if ( $attachment->ID === $post->ID )
											break;
									}
									$k++;
									// If there is more than 1 attachment in a gallery
									if ( count( $attachments ) > 1 ) {
										if ( isset( $attachments[ $k ] ) )
											// get the URL of the next image attachment
											$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
										else
											// or get the URL of the first image attachment
											$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
									} else {
										// or, if there's only 1 image, get the URL of the image
										$next_attachment_url = wp_get_attachment_url();
									}
								?>

								<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
									$attachment_size = apply_filters( '_s_attachment_size', array( 1200, 1200 ) ); // Filterable image size.
									echo wp_get_attachment_image( $post->ID, $attachment_size );
								?></a>
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
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
							'after' => '</div>'
						) );
						?>

					</div>
				</article>

				<?php
				comments_template();
			}
			?>
			</div>
		</div>

<?php
get_footer();
