<?php

require_once dirname( __FILE__ ) . '/tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'stm_require_plugins' );

function stm_require_plugins() {
	$plugins_path = get_template_directory() . '/inc/tgm/plugins';
	$plugins = array(
		array(
			'name'               => 'STM Post Type',
			'slug'               => 'stm-post-type',
			'source'             => $plugins_path . '/stm-post-type.zip',
			'version'            => '2.3',
			'required'           => true,
		),
		array(
			'name'               => 'WPBakery Visual Composer',
			'slug'               => 'js_composer',
			'source'             => $plugins_path . '/js_composer.zip',
			'version'            => '4.11.2',
			'required'           => true,
			'external_url'       => 'http://vc.wpbakery.com'
		),
		array(
			'name'               => 'Revolution Slider',
			'slug'               => 'revslider',
			'source'             => $plugins_path . '/revslider.zip',
			'version'            => '5.2.4.1',
			'required'           => true,
			'external_url'       => 'http://revolution.themepunch.com/'
		),
		array(
			'name'               => 'Breadcrumb NavXT',
			'slug'               => 'breadcrumb-navxt',
			'required'           => true,
			'external_url'       => 'http://mtekk.us/code/breadcrumb-navxt/'
		),
		array(
			'name'         => 'Contact Form 7',
			'slug'         => 'contact-form-7',
			'required'     => false,
			'external_url' => 'http://contactform7.com/'
		),
		array(
			'name'         => 'Instagram Feed',
			'slug'         => 'instagram-feed',
			'required'     => false,
			'external_url' => 'http://smashballoon.com/instagram-feed/'
		),
		array(
			'name'         => 'MailChimp for WordPress',
			'slug'         => 'mailchimp-for-wp',
			'required'     => false,
			'external_url' => 'https://mc4wp.com/'
		),
		array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => false
		)
	);

	tgmpa( $plugins, array( 'is_automatic' => true ) );

}