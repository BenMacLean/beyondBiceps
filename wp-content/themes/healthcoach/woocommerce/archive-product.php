<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();
get_template_part( 'parts/page', 'title' );

$shop_sidebar = stm_option( 'shop_sidebar' );

if( $shop_sidebar == 'left' ) {
	$before_content = '<div class="row"><div class="col-lg-9 col-md-9 col-lg-push-3 col-md-push-3">';
	$after_content = '</div>';
} else if( $shop_sidebar == 'right' ) {
	$before_content = '<div class="row"><div class="col-lg-9 col-md-9">';
	$after_content = '</div>';
}

?>
	<?php
		if( stm_option('subscribe_form_enable') && function_exists( 'mc4wp_show_form' ) ) {
			get_template_part( 'parts/subscribe', 'bar' );
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
		<?php if( $shop_products_title = stm_option('shop_products_title') ) : ?>
			<h3 class="page-title"><?php echo esc_html( $shop_products_title ); ?></h3>
		<?php endif; ?>

		<?php do_action( 'woocommerce_archive_description' ); ?>
		<?php echo ( ( isset( $before_content ) ) ? $before_content : '' ); ?>
		<?php if ( have_posts() ) : ?>
			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

		<?php echo ( ( isset( $after_content ) ) ? $after_content : '' ) ?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		if( $shop_sidebar != 'hide' ) {
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

<?php get_footer(); ?>
