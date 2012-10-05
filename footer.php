<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package _s
 * @since _s 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-container">
			<div class="site-info">
				<?php do_action( '_s_credits' ); ?>
				<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'tomjn' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'tomjn' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( __( 'Theme: %1$s by %2$s.', 'tomjn' ), 'tomjn', '<a href="http://tomjn.com/" rel="designer">Tom J Nowell</a>' ); ?>
			</div><!-- .site-info -->
		</div>
	</footer><!-- .site-footer .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>