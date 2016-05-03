<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! $messages ){
	return;
}

?>

<?php foreach ( $messages as $message ) : ?>
	<div class="woocommerce-notice woocommerce-info"><?php echo wp_kses_post( $message ); ?><a href="#" class="woocommerce-notice__close"><i class="fa fa-times"></i></a></div>
<?php endforeach; ?>
