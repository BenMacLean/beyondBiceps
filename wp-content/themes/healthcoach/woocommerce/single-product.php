<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );
get_template_part( 'parts/breadcrumbs');

$product_single_sidebar = stm_option( 'single_product_sidebar' );

if( $product_single_sidebar == 'left' ) {
	$before_content = '<div class="row"><div class="col-lg-9 col-md-9 col-lg-push-3 col-md-push-3">';
	$after_content = '</div>';
} else if( $product_single_sidebar == 'right' ) {
	$before_content = '<div class="row"><div class="col-lg-9 col-md-9">';
	$after_content = '</div>';
}

?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

	<?php echo ( ( isset( $before_content ) ) ? $before_content : '' ) ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php echo ( ( isset( $after_content ) ) ? $after_content : '' ) ?>

	<?php
	/**
	 * woocommerce_sidebar hook
	 *
	 * @hooked woocommerce_get_sidebar - 10
	 */
	if( $product_single_sidebar != 'hide' ) {
		do_action( 'woocommerce_sidebar' );
	}
	?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

<?php get_footer( 'shop' ); ?>
