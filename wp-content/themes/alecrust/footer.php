<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Alec_Rust
 * @since Alec Rust 1.0
 */
?>
	</div><!-- #main .wrapper -->

	<footer id="colophon" role="contentinfo">

		<div class="site-info">
			<?php do_action( 'alecrust_credits' ); ?>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'alecrust' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'alecrust' ); ?>"><?php printf( __( 'Proudly powered by %s', 'alecrust' ), 'WordPress' ); ?></a>
		</div>

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
