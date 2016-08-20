<?php
/**
 * @package Themefreesia
 * @subpackage Freesia Empire
 * @since Freesia Empire 1.0
 */
?>
<?php
/************************* FREESIAEMPIRE FOOTER DETAILS **************************************/
function freesiaempire_site_footer() {
if ( is_active_sidebar( 'freesiaempire_footer_options' ) ) :
		dynamic_sidebar( 'freesiaempire_footer_options' );
	else:
		echo '<div class="copyright">' .'&copy; ' . date('Y') .' '; ?>
		<a title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" target="_blank" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo get_bloginfo( 'name', 'display' ); ?></a> | 
						<?php _e('Designed by:','freesia-empire'); ?> <a title="<?php echo esc_attr__( 'Themefreesia', 'freesia-empire' ); ?>" target="_blank" href="<?php echo esc_url( 'http://themefreesia.com' ); ?>"><?php _e('Theme Freesia','freesia-empire');?></a> | 
						<?php _e('Powered by:','freesia-empire'); ?> <a title="<?php echo esc_attr__( 'WordPress', 'freesia-empire' );?>" target="_blank" href="<?php echo esc_url( 'http://wordpress.org' );?>"><?php _e('WordPress','freesia-empire'); ?></a>
					</div>
	<?php endif;
}
add_action( 'freesiaempire_sitegenerator_footer', 'freesiaempire_site_footer');
?>