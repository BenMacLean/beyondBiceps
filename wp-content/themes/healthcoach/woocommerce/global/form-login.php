<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form method="post" class="login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>

	<?php do_action( 'woocommerce_login_form_start' ); ?>
	<div class="form-desc">
		<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>
	</div>
	<div class="row form-fields-inline">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<p class="form-row">
				<input type="text" class="input-text" name="username" id="username" placeholder="<?php _e( 'Username or email', 'woocommerce' ); ?> *" />
			</p>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<p class="form-row">
				<input class="input-text" type="password" name="password" id="password" placeholder="<?php _e( 'Password', 'woocommerce' ); ?> *" />
			</p>
		</div>
	</div>

	<?php do_action( 'woocommerce_login_form' ); ?>

	<div class="clearfix">
		<?php wp_nonce_field( 'woocommerce-login' ); ?>
		<input type="submit" class="btn btn_view_default btn_type_outline" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />
		<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
		<label for="rememberme" class="inline">
			<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'woocommerce' ); ?>
		</label>
		<span class="lost_password"><a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Forgot password?', 'woocommerce' ); ?></a></span>
	</div>

	<div class="clear"></div>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>
