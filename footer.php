<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TanX_V1
 */

?>
		</div>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="uk-container uk-container-center">
			<div class="site-info uk-text-center uk-text-contrast">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'tanx_v1' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'tanx_v1' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'tanx_v1' ), 'tanx_v1', '<a href="http://underscores.me/" rel="designer">TanX</a>' ); ?>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
