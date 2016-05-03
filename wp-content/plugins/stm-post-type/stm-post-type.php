<?php
/*
Plugin Name: STM Post Type
Plugin URI: http://stylemixthemes.com/
Description: STM Post Type
Author: Stylemix Themes
Author URI: http://stylemixthemes.com/
Text Domain: stm_post_type
Version: 2.3
*/

define( 'STM_POST_TYPE', 'stm_post_type' );

$plugin_path = dirname(__FILE__);

require_once $plugin_path . '/post_type.class.php';

if(!is_textdomain_loaded('stm_post_type'))
{
	load_plugin_textdomain('stm_post_type', false, 'stm-post-type/languages');
}

$options = get_option('stm_post_types_options');

$defaultPostTypesOptions = array(
	'testimonial' => array(
		'title' => __( 'Testimonial', STM_POST_TYPE ),
		'plural_title' => __( 'Testimonial', STM_POST_TYPE ),
		'rewrite' => 'testimonial'
	),
	'item' => array(
		'title' => __( 'Qualification', STM_POST_TYPE ),
		'plural_title' => __( 'Qualification', STM_POST_TYPE ),
		'rewrite' => 'item'
	),
	'service' => array(
		'title' => __( 'Service', STM_POST_TYPE ),
		'plural_title' => __( 'Service', STM_POST_TYPE ),
		'rewrite' => 'service'
	),
	'event' => array(
		'title' => __( 'Event', STM_POST_TYPE ),
		'plural_title' => __( 'Event', STM_POST_TYPE ),
		'rewrite' => 'event'
	),
);

$stm_post_types_options = wp_parse_args( $options, $defaultPostTypesOptions );

// Testimonial
STM_PostType::registerPostType(
	'testimonial',
	$stm_post_types_options['testimonial']['title'],
	array(
		'pluralTitle' => $stm_post_types_options['testimonial']['plural_title'],
		'menu_icon'   => 'dashicons-editor-quote',
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'rewrite' => array( 'slug' => $stm_post_types_options['testimonial']['rewrite'] ),
	)
);
STM_PostType::addTaxonomy( 'testimonial_categories', __( 'Categories', STM_POST_TYPE ), 'testimonial' );

// Qualification
STM_PostType::registerPostType(
	'item',
	$stm_post_types_options['item']['title'],
	array(
		'pluralTitle' => $stm_post_types_options['item']['plural_title'],
		'menu_icon'   => 'dashicons-awards',
		'supports' => array( 'title', 'thumbnail' ),
		'rewrite' => array( 'slug' => $stm_post_types_options['item']['rewrite'] )
	)
);
STM_PostType::addTaxonomy( 'item_categories', __( 'Categories', STM_POST_TYPE ), 'item' );

// Service
STM_PostType::registerPostType(
	'service',
	$stm_post_types_options['service']['title'],
	array(
		'pluralTitle' => $stm_post_types_options['service']['plural_title'],
		'menu_icon'   => 'dashicons-hammer',
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'rewrite' => array( 'slug' => $stm_post_types_options['service']['rewrite'] ),
		'show_in_nav_menus' => true
	)
);
STM_PostType::addTaxonomy( 'service_categories', __( 'Categories', STM_POST_TYPE ), 'service' );

// Event
STM_PostType::registerPostType(
	'event',
	$stm_post_types_options['event']['title'],
	array(
		'pluralTitle' => $stm_post_types_options['event']['plural_title'],
		'menu_icon'   => 'dashicons-groups',
		'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt' ),
		'taxonomies' => array( 'post_tag' ),
		'rewrite' => array( 'slug' => $stm_post_types_options['event']['rewrite'] )
	)
);
STM_PostType::addTaxonomy( 'event_categories', __( 'Categories', STM_POST_TYPE ), 'event' );

// Sidebar
STM_PostType::registerPostType(
	'sidebar',
	__( 'Sidebar', STM_POST_TYPE ),
	array(
		'menu_icon'   => 'dashicons-welcome-widgets-menus',
		'supports' => array( 'title', 'editor' ),
		'rewrite' => array( 'slug' => 'sidebar' )
	)
);

include( get_template_directory() . '/inc/icons/hc-icons.php' );
$hc_icons_array = $stm_icons;

include( get_template_directory() . '/inc/icons/linearicons.php' );
$linear_icons_array = $stm_icons;

$hc_icons = array();

foreach ( $hc_icons_array as $hc_icon ) {
	foreach($hc_icon as $hc_icon_key => $hc_icon_val ) {
		$hc_icons['healthcoach'][] =  $hc_icon_key;
	}
}

foreach ( $linear_icons_array as $linear_icon ) {
	foreach($linear_icon as $linear_icon_key => $linear_icon_val ) {
		$hc_icons['linearicons'][] =  $linear_icon_key;
	}
}

STM_PostType::addMetaBox( 'post_option', __( 'Post options', STM_POST_TYPE ), array( 'post' ), '', '', '', array(
	'fields' => array(
		'embed_code' => array(
			'label'   => __( 'Embed', STM_POST_TYPE ),
			'type'    => 'textarea',
		),
	)
) );

STM_PostType::addMetaBox( 'testimonial_details', __( 'Testimonial Details', STM_POST_TYPE ), array( 'testimonial' ), '', '', '', array(
	'fields' => array(
		'testimonial_author' => array(
			'label'   => __( 'Author', STM_POST_TYPE ),
			'type'    => 'text',
		),
		'testimonial_short_desc' => array(
			'label'   => __( 'Description', STM_POST_TYPE ),
			'type'    => 'textarea',
		),
		'testimonial_photo_before' => array(
			'label'   => __( 'Before', STM_POST_TYPE ),
			'type'    => 'image',
		),
		'testimonial_photo_after' => array(
			'label'   => __( 'After', STM_POST_TYPE ),
			'type'    => 'image',
		),
	)
) );

STM_PostType::addMetaBox( 'service_details', __( 'Service Options', STM_POST_TYPE ), array( 'service' ), '', '', '', array(
 'fields' => array(
  'service_font_icon' => array(
   'label'   => __( 'Icon', STM_POST_TYPE ),
   'type'    => 'icon_picker',
   'options' => $hc_icons
  ),
 )
) );

STM_PostType::addMetaBox( 'page_settings', __( 'Page Settings', STM_POST_TYPE ), array( 'page', 'service', 'event' ), '', '', '', array(
	'fields' => array(
		'header_section' => array(
			'label'   => __( 'Header', STM_POST_TYPE ),
			'type'    => 'separator'
		),
		'header_style' => array(
			'label'   => __( 'Type', STM_POST_TYPE ),
			'type'    => 'select',
			'options' => array(
				'default'     => __( 'Default', STM_POST_TYPE ),
				'transparent' => __( 'Transparent', STM_POST_TYPE ),
			)
		),
		'header_position' => array(
			'label'   => __( 'Position', STM_POST_TYPE ),
			'type'    => 'select',
			'options' => array(
				'static' => __( 'Static', STM_POST_TYPE ),
				'sticky' => __( 'Sticky', STM_POST_TYPE ),
			)
		),
		'breadcrumbs_section' => array(
			'label'   => __( 'Breadcrumbs', STM_POST_TYPE ),
			'type'    => 'separator'
		),
		'breadcrumbs_disable' => array(
			'label'   => __( 'Disable', STM_POST_TYPE ),
			'type'    => 'checkbox'
		),
		'breadcrumbs_margin_bot' => array(
			'label'   => __( 'Spacing', STM_POST_TYPE ),
			'type'    => 'text',
		),
		'breadcrumbs_position' => array(
			'label'   => __( 'Position', STM_POST_TYPE ),
			'type'    => 'select',
			'options' => array(
				'top'    => __( 'Top', STM_POST_TYPE ),
				'bottom' => __( 'Bottom', STM_POST_TYPE ),
			)
		),
		'hero_section' => array(
			'label'   => __( 'Page Title', STM_POST_TYPE ),
			'type'    => 'separator'
		),
		'stm_page_title_enable' => array(
			'label'   => __( 'Enable', STM_POST_TYPE ),
			'type'    => 'checkbox',
		),
		'hero_padd_top' => array(
			'label'   => __( 'Padding Top', STM_POST_TYPE ),
			'type'    => 'text',
			'description' => __( 'Example: 20px', STM_POST_TYPE )
		),
		'hero_padd_bot' => array(
			'label'   => __( 'Padding Bottom', STM_POST_TYPE ),
			'type'    => 'text',
			'description' => __( 'Example: 20px', STM_POST_TYPE )
		),
		'hero_margin_bot' => array(
			'label'   => __( 'Spacing', STM_POST_TYPE ),
			'type'    => 'text',
			'description' => __( 'Example: 30px', STM_POST_TYPE )
		),
		'hero_bg_image' => array(
			'label'   => __( 'Background Image', STM_POST_TYPE ),
			'type'    => 'image',
		),
		'hero_bg_color' => array(
			'label'   => __( 'Background Color', STM_POST_TYPE ),
			'type'    => 'color_picker',
		),
		'stm_page_bump_enable' => array(
			'label'   => __( 'Bump Enable', STM_POST_TYPE ),
			'type'    => 'checkbox',
		),
		'hero_title_display' => array(
			'label'   => __( 'Title Disable', STM_POST_TYPE ),
			'type'    => 'checkbox',
		),
		'hero_title' => array(
			'label'   => __( 'Title', STM_POST_TYPE ),
			'type'    => 'textarea'
		),
		'hero_title_color' => array(
			'label'   => __( 'Title - Color', STM_POST_TYPE ),
			'type'    => 'color_picker',
		),
		'hero_icon_disable' => array(
			'label'   => __( 'Icon - Disable', STM_POST_TYPE ),
			'type'    => 'checkbox',
		),
		'hero_icon' => array(
			'label'   => __( 'Icon', STM_POST_TYPE ),
			'type'    => 'icon_picker',
			'options' => $hc_icons
		),
		'hero_icon_position' => array(
			'label'   => __( 'Icon - Position', STM_POST_TYPE ),
			'type'    => 'select',
			'options' => array(
				''       => __( 'Default', STM_POST_TYPE ),
				'top'    => __( 'Top', STM_POST_TYPE ),
				'bottom' => __( 'Bottom', STM_POST_TYPE ),
			)
		),
		'hero_icon_spacing' => array(
			'label'   => __( 'Icon - Spacing', STM_POST_TYPE ),
			'type'    => 'text',
			'description' => __( 'Example: 20px', STM_POST_TYPE )
		),
		'hero_icon_size' => array(
			'label'   => __( 'Icon - Size', STM_POST_TYPE ),
			'type'    => 'text',
			'description' => __( 'Example: 20px', STM_POST_TYPE )
		),
		'hero_icon_color' => array(
			'label'   => __( 'Icon - Color', STM_POST_TYPE ),
			'type'    => 'color_picker',
		),
		'main_section' => array(
			'label'   => __( 'Content', STM_POST_TYPE ),
			'type'    => 'separator'
		),
		'main_bottom_spacing' => array(
			'label'   => __( 'Spacing - Bottom', STM_POST_TYPE ),
			'type'    => 'text',
			'description' => __( 'Example: 20px', STM_POST_TYPE )
		),
	)
) );

STM_PostType::addMetaBox( 'event_details', __( 'Event Details', STM_POST_TYPE ), array( 'event' ), '', '', '', array(
	'fields' => array(
		'event_section' => array(
			'label'   => __( 'Contact', STM_POST_TYPE ),
			'type'    => 'separator'
		),
		'event_local' => array(
			'label'   => __( 'Local', STM_POST_TYPE ),
			'type'    => 'textarea'
		),
		'event_email' => array(
			'label'   => __( 'E-Mail', STM_POST_TYPE ),
			'type'    => 'textarea'
		),
		'event_phone_fax' => array(
			'label'   => __( 'Telephone & Fax', STM_POST_TYPE ),
			'type'    => 'textarea'
		),
		'event_time_section' => array(
			'label'   => __( 'Time & Date', STM_POST_TYPE ),
			'type'    => 'separator'
		),
		'event_date' => array(
			'label'   => __( 'Date', STM_POST_TYPE ),
			'type'    => 'date_picker'
		),
		'event_time_start' => array(
			'label'   => __( 'Start', STM_POST_TYPE ),
			'type'    => 'time_picker'
		),
		'event_time_end' => array(
			'label'   => __( 'End', STM_POST_TYPE ),
			'type'    => 'time_picker'
		),
		'event_other_section' => array(
			'label'   => __( 'Other', STM_POST_TYPE ),
			'type'    => 'separator'
		),
		'event_price' => array(
			'label'   => __( 'Event price', STM_POST_TYPE ),
			'type'    => 'depends_field',
			'options' => array(
				'free' => __( 'Free', STM_POST_TYPE ),
				'paid' => __( 'Paid', STM_POST_TYPE ),

			),
			'depends' => 'paid',
		),
		'event_map_lat' => array(
			'label'   => __( 'Map - Lat', STM_POST_TYPE ),
			'type'    => 'text'
		),
		'event_map_lng' => array(
			'label'   => __( 'Map - Lng', STM_POST_TYPE ),
			'type'    => 'text'
		),
	)
) );

function stm_plugin_styles() {
    $plugin_url =  plugins_url('', __FILE__);

    wp_enqueue_style( 'admin-styles', $plugin_url . '/assets/css/admin.css', null, null, 'all' );
    wp_register_style( 'fonticonpicker', $plugin_url . '/assets/css/jquery.fonticonpicker.min.css', null, null, 'all' );
    wp_register_style( 'fonticonpicker-bootstrap', $plugin_url . '/assets/css/jquery.fonticonpicker.bootstrap.min.css', null, null, 'all' );
    wp_register_style( 'datetime-picker', $plugin_url . '/assets/css/jquery.datetimepicker.css', null, null, 'all' );

    wp_register_script( 'datetime-picker', $plugin_url . '/assets/js/jquery.datetimepicker.js', null, null, true );
    wp_register_script( 'fonticonpicker', $plugin_url . '/assets/js/jquery.fonticonpicker.min.js', null, null, true );

    wp_enqueue_style( 'fonticonpicker' );
    wp_enqueue_style( 'fonticonpicker-bootstrap' );
	wp_enqueue_script( 'fonticonpicker');

    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker');

	wp_enqueue_style( 'datetime-picker' );
    wp_enqueue_script( 'datetime-picker');

    wp_enqueue_media();
}

add_action( 'admin_enqueue_scripts', 'stm_plugin_styles' );

add_action( 'admin_menu', 'stm_register_post_types_options_menu' );

if( ! function_exists( 'stm_register_post_types_options_menu' ) ){
	function stm_register_post_types_options_menu(){
		add_submenu_page( 'tools.php', __('STM Post Types', STM_POST_TYPE), __('STM Post Types', STM_POST_TYPE), 'manage_options', 'stm_post_types', 'stm_post_types_options' );
	}
}

if( ! function_exists( 'stm_post_types_options' ) ){
	function stm_post_types_options(){

		if ( ! empty( $_POST['stm_post_types_options'] ) ) {
			update_option( 'stm_post_types_options', $_POST['stm_post_types_options'] );
		}

		$options = get_option('stm_post_types_options');

		$defaultPostTypesOptions = array(
			'testimonial' => array(
				'title' => __( 'Testimonial', STM_POST_TYPE ),
				'plural_title' => __( 'Testimonial', STM_POST_TYPE ),
				'rewrite' => 'testimonial'
			),
			'item' => array(
				'title' => __( 'Qualification', STM_POST_TYPE ),
				'plural_title' => __( 'Qualification', STM_POST_TYPE ),
				'rewrite' => 'item'
			),
			'service' => array(
				'title' => __( 'Service', STM_POST_TYPE ),
				'plural_title' => __( 'Service', STM_POST_TYPE ),
				'rewrite' => 'service'
			),
			'event' => array(
				'title' => __( 'Event', STM_POST_TYPE ),
				'plural_title' => __( 'Event', STM_POST_TYPE ),
				'rewrite' => 'event'
			),
		);

		$options = wp_parse_args( $options, $defaultPostTypesOptions );

		echo '
			<div class="wrap">
		        <h2>' . __( 'Custom Post Type Renaming Settings', STM_POST_TYPE ) . '</h2>

		        <form method="POST" action="">
		            <table class="form-table">
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="testimonial_title">' . __( '"Testimonial" title (admin panel tab name)', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="testimonial_title" name="stm_post_types_options[testimonial][title]" value="' . $options['testimonial']['title'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="testimonial_plural_title">' . __( '"Testimonial" plural title', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="testimonial_plural_title" name="stm_post_types_options[testimonial][plural_title]" value="' . $options['testimonial']['plural_title'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="testimonial_rewrite">' . __( '"Testimonial" rewrite (URL text)', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="testimonial_rewrite" name="stm_post_types_options[testimonial][rewrite]" value="' . $options['testimonial']['rewrite'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top"><th scope="row"></th></tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="item_title">' . __( '"Qualification" title (admin panel tab name)', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="item_title" name="stm_post_types_options[item][title]" value="' . $options['item']['title'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="item_plural_title">' . __( '"Qualification" plural title', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="item_plural_title" name="stm_post_types_options[item][plural_title]" value="' . $options['item']['plural_title'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="item_rewrite">' . __( '"Qualification" rewrite (URL text)', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="item_rewrite" name="stm_post_types_options[item][rewrite]" value="' . $options['item']['rewrite'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top"><th scope="row"></th></tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="service_title">' . __( '"Service" title (admin panel tab name)', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="service_title" name="stm_post_types_options[service][title]" value="' . $options['service']['title'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="service_plural_title">' . __( '"Service" plural title', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="service_plural_title" name="stm_post_types_options[service][plural_title]" value="' . $options['service']['plural_title'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="service_rewrite">' . __( '"Service" rewrite (URL text)', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="service_rewrite" name="stm_post_types_options[service][rewrite]" value="' . $options['service']['rewrite'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top"><th scope="row"></th></tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="event_title">' . __( '"Event" title (admin panel tab name)', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="event_title" name="stm_post_types_options[event][title]" value="' . $options['event']['title'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="event_plural_title">' . __( '"Event" plural title', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="event_plural_title" name="stm_post_types_options[event][plural_title]" value="' . $options['event']['plural_title'] . '"  size="25" />
		                    </td>
		                </tr>
		                <tr valign="top">
		                    <th scope="row">
		                        <label for="event_rewrite">' . __( '"Event" rewrite (URL text)', STM_POST_TYPE ) . '</label>
		                    </th>
		                    <td>
		                        <input type="text" id="event_rewrite" name="stm_post_types_options[event][rewrite]" value="' . $options['event']['rewrite'] . '"  size="25" />
		                    </td>
		                </tr>
		            </table>
		            <p>' . __( "NOTE: After you change the rewrite field values, you'll need to refresh permalinks under Settings -> Permalinks", STM_POST_TYPE ) . '</p>
		            <br/>
		            <p>
						<input type="submit" value="' . __( 'Save settings', STM_POST_TYPE ) . '" class="button-primary"/>
					</p>
		        </form>
		    </div>
		';
	}
}