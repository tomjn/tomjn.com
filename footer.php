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
	</div>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-container">
			<div class="site-info">
				<?php do_action( '_s_credits' ); ?>
			</div>
		</div>
	</footer>
</div>

<?php
wp_footer();
?>

</body>
</html>