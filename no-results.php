<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 * @since _s 1.0
 */
?>

<article id="post-0" class="post no-results not-found">
	<header class="entry-header">
		<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', '_s' ); ?></h1>
	</header>

	<div class="entry-content">
		<?php
		if ( is_home() && is_user_logged_in() ) {
			?>
			<p><?php printf( wp_kses_post( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', '_s' ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
			<?php
		} else if ( is_home() ) {
			?>
			<p><?php echo esc_html__( 'There are no posts here yet! Come back later', '_s' ); ?></p>
			<?php
		} elseif ( is_search() ) {
			?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', '_s' ); ?></p>
			<?php
			get_search_form();
		} else {
			?>
			<p><?php echo wp_kses_post( __( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', '_s' ) ); ?></p>
			<?php
			get_search_form();
		}
		?>
	</div>
</article>
