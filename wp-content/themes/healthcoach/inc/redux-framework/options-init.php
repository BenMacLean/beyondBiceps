<?php

/**
 * ReduxFramework Barebones Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 *
 * For a more extensive sample-config file, you may look at:
 * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
 *
 */

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "stm_option";

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
	'opt_name'              => 'stm_option',
	'display_name'          => 'Health Coach',
	'display_version'       => 'v.1.0',
	'page_title'            => __( 'Theme Options', 'healthcoach' ),
	'menu_title'            => __( 'Theme Options', 'healthcoach' ),
	'update_notice'         => false,
	'admin_bar'             => true,
	'dev_mode'              => false,
	'menu_icon'             => 'dashicons-hammer',
	'menu_type'             => 'menu',
	'allow_sub_menu'        => true,
	'page_parent_post_type' => '',
	'default_mark'          => '',
	'hints'                 => array(
		'icon_position' => 'right',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color' => 'light',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'duration' => '500',
				'event'    => 'mouseleave unfocus',
			),
		),
	),
	'output'                => true,
	'output_tag'            => true,
	'compiler'              => true,
	'page_permissions'      => 'manage_options',
	'save_defaults'         => true,
	'database'              => 'options',
	'transient_time'        => '3600',
	'show_import_export'    => true,
	'network_sites'         => true
);

Redux::setArgs( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */


/*
 *
 * ---> START SECTIONS
 *
 */
Redux::setSection( $opt_name, array(
	'title'   => __( 'General', 'healthcoach' ),
	'desc'    => '',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'       => 'favicon',
			'url'      => false,
			'type'     => 'media',
			'title'    => __( 'Site Favicon', 'healthcoach' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/tmp/favicon.ico' ),
			'subtitle' => __( 'Upload a 16x16px .png or .gif image here', 'healthcoach' ),
		),
		array(
			'id'       => 'primary_color',
			'type'     => 'color',
			'title'    => __( 'Primary Color', 'healthcoach' ),
			'default'  => '#2acd35',
			'transparent' => false,
			'validate' => 'color',
			'output'   => array(
				'border-right-color' => '.live-customizer__toggle:before',
				'border-color' => '.stm-info-box-sep.primary-border-color,
								   .drop-caps-square p:first-letter,
								   .widget_tag_cloud .tagcloud a:hover,
								   .widget_tag_cloud .tagcloud a:focus,
								   .btn_type_outline.btn_view_primary,
								   .page-pagination .page-numbers .current,
								   .page-pagination .page-numbers a:focus,
								   .page-pagination .page-numbers a:hover,
								   .page-pagination .page-next a:hover,
								   .page-pagination .page-next a:focus,
								   .page-pagination .page-prev a:hover,
								   .page-pagination .page-prev a:focus,
								   .comment-form input[type="text"]:focus,
								   .comment-form input[type="email"]:focus,
								   .comment-form textarea:focus,
								   .wpcf7-textarea:focus,
								   .wpcf7-text:focus,
								   .vc_btn3.vc_btn3-color-green.vc_btn3-style-outline,
								   .vc_btn3.vc_btn3-color-green.vc_btn3-style-outline:hover,
								   .vc_btn3.vc_btn3-color-green.vc_btn3-style-outline:focus,
								   .vc_btn3.vc_btn3-color-success.vc_btn3-style-outline,
								   .vc_btn3.vc_btn3-color-success.vc_btn3-style-outline:hover,
								   .vc_btn3.vc_btn3-color-success.vc_btn3-style-outline:focus,
								   .woocommerce div.product .woocommerce-tabs ul.tabs li,
								   .vc_tta-color-green.vc_tta-style-outline .vc_tta-tab.vc_active > a,
								   .vc_tta-color-green.vc_tta-style-outline .vc_tta-tab > a,
								   .vc_tta-color-grey.vc_tta-style-outline .vc_tta-controls-icon::before,
								   .vc_tta-color-grey.vc_tta-style-outline .vc_tta-controls-icon::after,
								   .vc_tta-color-grey.vc_tta-style-outline .vc_active .vc_tta-panel-heading .vc_tta-controls-icon::before,
								   .vc_tta-color-grey.vc_tta-style-outline .vc_active .vc_tta-panel-heading .vc_tta-controls-icon::after,
								   .drop-cap-square,
								   .woocommerce form.login,
								   .woocommerce form.register,
								   .woocommerce .woocommece-info-text .woocommerce-info a,
								   .woocommerce-cart .cart-totals-table-wrap',
				'color' => 'a,
							a:hover,
							a:focus,
							.woocommerce ul.cart_list li a.remove,
							.woocommerce .widget_shopping_cart .total .amount,
							.woocommerce.widget_shopping_cart .total .amount,
							.woocommerce-cart .cart_totals .order-total .amount,
							.woocommerce .shipping-calculator-form .button .fa,
							.list-style-fa.primary-color > li:before,
							.list-style-hyphen.primary-color > li:before,
							.select2-container .select2-choice .select2-arrow:before,
							.select2-selection__arrow:before,
							.blog-posts .entry-title a,
							.search-form-button:hover,
							.search-form-button:focus,
							.vc-custom-heading__separator-icon,
							.header_type_transparent.affix .nav__menu > li > a:hover,
							.header_type_transparent.affix .nav__menu > li > a:focus,
							.header_type_transparent.affix .nav__menu > li.current-menu-item > a,
							.header_type_transparent.affix .nav__menu > li.current-menu-parent > a,
							.header_type_default .nav__menu > li > a:focus,
							.header_type_default .nav__menu > li > a:hover,
							.header_type_default .nav__menu > li.current-menu-item > a,
							.header_type_default .nav__menu > li.current-menu-parent > a,
							.nav__menu .sub-menu > li.current-menu-item > a,
							.info-box_type_boxed .info-box__icon,
							.info-box_type_boxed-2 .info-box__icon,
							.btn_type_outline.btn_view_default:focus,
                            .btn_type_outline.btn_view_default:hover,
                            .thumbnail__caption-title a:hover,
                            .thumbnail__caption-title a:focus,
                            .thumbnail__caption-icon,
                            .vc_btn3.vc_btn3-color-white.vc_btn3-style-outline:hover,
                            .vc_btn3.vc_btn3-color-white.vc_btn3-style-outline:focus,
                            .vc_custom_heading a:focus,
							.vc_custom_heading a:hover,
							.slider_type_testimonial .slick-dots li.slick-active button:before,
							.banner__title,
							.banner__link:hover,
							.banner__link:focus,
							.widget_type_footer .widget-socials__item:focus,
							.widget_type_footer .widget-socials__item:hover,
							.nav__menu .sub-menu > li > a:hover,
							.nav__menu .sub-menu > li > a:focus,
							.call-to-action .mc4wp-form .form__button:hover,
							.call-to-action .mc4wp-form .form__button:focus,
							.icon-box__text_border_custom-circle,
							.btn_type_outline.btn_view_primary,
							.pricing-table__price,
							.pricing-table__desc,
							.testimonial__caption-title,
							.page-pagination .page-numbers a:focus,
							.page-pagination .page-numbers a:hover,
							.page-pagination .page-next a:hover,
						    .page-pagination .page-next a:focus,
						    .page-pagination .page-prev a:hover,
						    .page-pagination .page-prev a:focus,
						    .top-bar a:focus,
						    .top-bar a:hover,
						    .top-bar .list__item:before,
						    .main__heading-title:after,
						    .post__thumbnail-icon,
						    .post__title a:hover,
						    .post__title a:focus,
						    .post__meta-item:before,
						    .widget-title,
						    .select2-results li.select2-highlighted,
							.select2-container .select2-results__option[aria-selected="true"],
							.select2-container--default .select2-results__option[aria-selected="true"],
							.widget_recent-posts .recent-post__thumbnail-icon,
							.widget_archive li:before,
							.widget_categories li:before,
							.widget_type_blog.widget_pages li a:hover,
							.widget_type_blog.widget_pages li a:focus,
							.widget_type_blog.widget_archive li a:hover,
							.widget_type_blog.widget_archive li a:focus,
							.widget_type_blog.widget_categories li a:hover,
							.widget_type_blog.widget_categories li a:focus,
							.comments-title,
							.comment-reply-title,
							.comment-author,
							.carousel_type_qualification .slick-dots li.slick-active button:before,
							.stats-counter__value-border,
							.testimonial__icon,
							.wpcf7 .wpcf7-form-control_type_focus:before,
							.event__date-bg,
							.event__title a:hover,
							.event__title a:focus,
							.event__details-item:before,
							.widget_type_event .widget-title .fa,
							.widget_event-contacts .event-contacts__phone:before,
							.widget_type_event .widget-title:before,
							.widget_event-contacts .event-contacts__email,
							.entry-header__author,
							.result-photo__caption,
							.contact-info__list-item_icon:before,
							.entry-title a:hover,
							.entry-title a:focus,
							.entry-video__action,
							.page-title__icon,
							.vc_btn3.vc_btn3-color-success.vc_btn3-style-outline,
							.mobile-nav-menu > li > a:hover,
							.mobile-nav-menu > li > a:focus,
							.mobile-nav-menu > li > ul a:hover,
							.mobile-nav-menu > li > ul a:focus,
							.mobile-nav-menu > li.current-menu-item > a,
							.mobile-nav-menu > li.current-menu-parent > a,
							.woocommerce .quantity .qty,
							.woocommerce .amount,
							.slider_type_testimonial .slick-dots li:hover button:before,
							.slider_type_testimonial .slick-dots li:focus button:before,
							.woocommerce div.product .woocommerce-tabs ul.tabs li a,
							.woocommerce div.product .woocommerce-tabs .entry-content h4,
							.woocommerce .comment .review-author,
							.widget_search .search-form-button,
							.no-results .search-form-button,
							.widget_product_categories > ul > li:before,
							.widget_product_categories a:hover,
							.widget_product_categories a:focus,
							.woocommerce ul.product_list_widget li a:hover,
							.woocommerce ul.product_list_widget li a:focus,
							.woocommerce .widget_shopping_cart .cart_list li a.remove:hover,
							.woocommerce .widget_shopping_cart .cart_list li a.remove:focus,
							body .vc_tta-color-green.vc_tta-style-outline .vc_tta-tab:focus > a,
							body .vc_tta-color-green.vc_tta-style-outline .vc_tta-tab:hover > a,
							.vc_tta-color-grey.vc_tta-style-outline .vc_tta-panel.vc_active .vc_tta-panel-title > a,
							.vc_tta-tabs-position-left.vc_tta-controls-align-left.vc_tta-color-grey.vc_tta-style-outline .vc_tta-tab > a,
							.button_view_default,
							.call-to-action__link-icon,
							.drop-cap,
							.drop-cap-square,
							blockquote cite,
							blockquote.style-1:before,
							.form_search-fullscreen .form__field-button,
							.woocommerce .address .title h4,
							.woocommerce-shipping-fields h4,
							.woocommerce-billing-fields h4,
							.woocommerce-checkout-review-order h4,
							.woocommerce-cart-title,
							.woocommerce-cart table.cart .product-name .product-name-wrap a:hover,
							.woocommerce-cart table.cart .product-name .product-name-wrap a:focus,
							.widget_meta li a:hover,
							.widget_meta li a:focus,
							.widget_recent_entries > ul > li a:hover,
							.widget_recent_entries > ul > li a:focus,
							.widget_recent_comments .recentcomments a:hover,
							.widget_recent_comments .recentcomments a:focus,
							.widget_nav_menu li a:hover,
							.widget_nav_menu li a:focus,
							.mini-cart__price-total .amount,
							.widget_type_footer.widget_calendar th,
							.widget-title,
							.vc-row__bump,
							.top-bar #lang_sel ul ul a:hover,
							.form_mobile-nav-search .form__field-button,
							.subscribe_type_default .form__button:hover,
							.subscribe_type_default .form__button:focus',
				'background-color' => '.woocommerce .quantity-actions span:focus,
									   .woocommerce .quantity-actions span:hover,
									   .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
									   .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
									   .header-nav-cart .cart-items-count,
									    blockquote.style-2,
									   .widget_tag_cloud .tagcloud a:hover,
									   .widget_tag_cloud .tagcloud a:focus,
									   .btn_view_primary,
									   .icon-box_type_icon-left,
									   .btn_type_outline.btn_view_primary:hover,
									   .btn_type_outline.btn_view_primary:focus,
									   .page-pagination .page-numbers .current,
									   .select2-container .select2-results__option--highlighted[aria-selected="false"],
									   .select2-container--default .select2-results__option--highlighted[aria-selected="false"],
									   .comment-form input[type="submit"],
									   .entry-tags > li a:hover,
									   .entry-tags > li a:focus,
									   .widget_event-info .event-info__members,
									   .sticky-post,
									   .vc_btn3.vc_btn3-color-green.vc_btn3-style-outline:hover,
								   	   .vc_btn3.vc_btn3-color-green.vc_btn3-style-outline:focus,
								   	   .vc_btn3.vc_btn3-color-success.vc_btn3-style-outline:hover,
								   	   .vc_btn3.vc_btn3-color-success.vc_btn3-style-outline:focus,
								   	   .mobile-nav-toggle .toggle-line,
								   	   .mobile-nav-menu > li.dropdown_open > a,
								   	   .countdown__counter,
								   	   .subscribe-bar,
								   	   .woocommerce a.added_to_cart:hover,
								   	   .woocommerce a.added_to_cart:focus,
								   	   .product_meta .tagged_as a:hover,
									   .product_meta .tagged_as a:focus,
									   .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
									   .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
									   .woocommerce div.product .woocommerce-tabs ul.tabs li a:focus,
									   .vc_tta-color-green.vc_tta-style-outline .vc_tta-tab.vc_active > a,
									   .vc_btn3.vc_btn3-color-success,
									   .vc_btn3.vc_btn3-color-success.vc_btn3-style-flat,
									   .woocommerce form.login,
									   .woocommerce form.checkout_coupon .form-row .button,
									   .woocommerce-cart .wc-proceed-to-checkout .checkout-button,
									   .post-password-form input[type="submit"],
									   .live-customizer__toggle,
									   .subscribe_type_primary .form__button',
			)
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Top Bar', 'healthcoach' ),
	'desc'    => '',
	'icon'    => 'el el-minus',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'      => 'top_bar_enable',
			'type'    => 'switch',
			'title'   => __( 'Top Bar Enable', 'healthcoach' ),
			'default' => false
		),
		array(
			'id'       => 'top_bar_bg',
			'type'     => 'background',
			'background-repeat' => false,
			'background-attachment' => false,
			'background-position' => false,
			'background-image' => false,
			'background-size' => false,
			'title'    => __('Background', 'healthcoach' ),
			'default'  => array(
				'background-color' => '#444444',
			),
			'output'  => array('.top-bar')
		),
		array(
			'id'       => 'top_bar_color',
			'type'     => 'color',
			'title'    => __( 'Color', 'healthcoach' ),
			'default'  => '#ffffff',
			'validate' => 'color',
			'transparent' => false,
			'output'   => array(
				'color' => '.top-bar,
				.top-bar a,
				.top-bar #lang_sel a.lang_sel_sel,
				.top-bar #lang_sel a.lang_sel_sel:after',
			)
		),
		array(
			'id'      => 'top_bar_schedule_enable',
			'type'    => 'switch',
			'title'   => __( 'Schedule Enable', 'healthcoach' ),
			'default' => false
		),
		array(
			'id'=>'top_bar_schedule',
			'type' => 'multi_text',
			'title' => __('Schedule', 'healthcoach' ),
			'default' => array(
				'Week days: 05:00 &#150; 22:00',
				'Saturday: 08:00 &#150; 18:00',
				'Sunday: CLOSED'
			),
			'required' => array( 'top_bar_schedule_enable', '=', true, ),
		),
		array(
			'id'      => 'top_bar_contacts_enable',
			'type'    => 'switch',
			'title'   => __( 'Contacts Enable', 'healthcoach' ),
			'default' => true
		),
		array(
			'id'       => 'top_bar_email',
			'type'     => 'text',
			'title'    => __('E-Mail', 'healthcoach' ),
			'validate' => 'email',
			'default'  => 'healthcoach@stylemix.net',
			'required' => array( 'top_bar_contacts_enable', '=', true, ),
		),
		array(
			'id'       => 'top_bar_phone',
			'type'     => 'text',
			'title'    => __('Phone', 'healthcoach' ),
			'default'  => '6 800 333 2222',
			'required' => array( 'top_bar_contacts_enable', '=', true, ),
		),
		array(
			'id'      => 'top_bar_socials_enable',
			'type'    => 'switch',
			'title'   => __( 'Social Networks Enable', 'healthcoach' ),
			'default' => true
		),
		array(
			'id'       => 'top_bar_social',
			'type'     => 'checkbox',
			'title'    => __( 'Select Social Media Icons to display', 'healthcoach' ),
			'subtitle' => __( 'The urls for your social media icons will be taken from Social Media settings tab.', 'healthcoach' ),
			'required' => array(
				array( 'top_bar_socials_enable', '=', true, )
			),
			'options'  => array(
				'facebook-square'    => 'Facebook',
				'twitter-square'     => 'Twitter',
				'instagram'          => 'Instagram',
				'google-plus-square' => 'Google Plus',
				'pinterest-square'   => 'Pinterest',
				'youtube-square'     => 'Youtube',
				'linkedin-square'    => 'LinkedIn'
			)
		),
		array(
			'id'      => 'top_bar_language_enable',
			'type'    => 'switch',
			'title'   => __( 'Language Enable', 'healthcoach' ),
			'default' => false
		)
	)
));

Redux::setSection( $opt_name, array(
	'title'   => __( 'Header', 'healthcoach' ),
	'desc'    => '',
	'icon'    => 'el-icon-file',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'       => 'logo_size',
			'type'     => 'dimensions',
			'units'    => array('em','px','%'),
			'title'    => __('Logo Size', 'healthcoach' ),
			'default'  => array(
				'width'   => '224px'
			),
			'output'   => array( '.logo__image' )
		),
		array(
			'id'      => 'header_search',
			'type'    => 'switch',
			'title'   => __( 'Enable Search', 'healthcoach' ),
			'default' => true
		),
		array(
			'id'      => 'header_cart',
			'type'    => 'switch',
			'title'   => __( 'Enable Cart', 'healthcoach' ),
			'default' => true
		),
		array(
			'id'             => 'header_spacing',
			'type'           => 'spacing',
			'left'			 => false,
			'right'			 => false,
			'output'         => array('.header'),
			'mode'           => 'padding',
			'units'          => array('px'),
			'units_extended' => 'false',
			'title'          => __('Spacing ( Top / Bottom )', 'healthcoach'),
			'default'        => array(
				'units'          => 'px',
				'padding-bottom' => '27px',
				'padding-top'    => '27px'
			)
		),
		array(
			'id'             => 'logo_spacing',
			'type'           => 'spacing',
			'left'			 => false,
			'right'			 => false,
			'output'         => array('.logo_type_header'),
			'mode'           => 'margin',
			'units'          => array('px'),
			'units_extended' => 'false',
			'title'          => __('Logo Spacing', 'healthcoach'),
			'default'        => array(
				'units'          => 'px',
				'margin-top' => '-17px'
			)
		),
		array(
			'id'          => 'nav_menu_typography',
			'type'        => 'typography',
			'title'       => __('Typography', 'healthcoach' ),
			'google'         => true,
			'font-backup'    => true,
			'font-weight'    => true,
			'text-align'     => false,
			'text-transform' => true,
			'color'		     => false,
			'line-height'    => false,
			'output'      => array('.nav__menu > li > a'),
			'units'       =>'px',
			'default'     => array(
				'font-weight'     => '600',
				'google'         => true,
				'font-size'      => '14px',
				'text-transform' => 'uppercase',
			),
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Default', 'healthcoach' ),
	'desc'    => '',
	'subsection' => true,
	'fields'  => array(
		array(
			'id'       => 'logo_default',
			'url'      => false,
			'type'     => 'media',
			'title'    => __( 'Logo', 'healthcoach' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/tmp/logo.png' ),
			'subtitle' => __( 'Upload your logo file here.', 'healthcoach' ),
		),
		array(
			'id'       => 'header_background',
			'type'     => 'background',
			'background-repeat' => false,
			'background-attachment' => false,
			'background-position' => false,
			'background-image' => false,
			'background-size' => false,
			'title'    => __('Background', 'healthcoach' ),
			'default'  => array(
				'background-color' => '#ffffff',
			),
			'output'  => array('.header_type_default,
			.mobile-menu,
			.mobile-side-nav,
			.header_type_transparent.affix')
		),
		array(
			'id'       => 'header_color',
			'type'     => 'color',
			'title'    => __( 'Color', 'healthcoach' ),
			'default'  => '#444444',
			'validate' => 'color',
			'transparent' => false,
			'output'   => array(
				'color' => '.header_type_default .user-menu__item,
				.header_type_transparent.affix .user-menu__item,
				.header_type_default .nav__menu > li > a,
				.header_type_transparent.affix .nav__menu > li > a,
				.mobile-nav-menu > li > a,
				.mobile-nav-menu > li > ul a,
				.form_mobile-nav-search .form__field-text',
			)
		),
		array(
			'id'       => 'header_icon_bordercolor',
			'type'     => 'color',
			'title'    => __( 'Icon - Border Color', 'healthcoach' ),
			'default'  => '#dedede',
			'validate' => 'color',
			'transparent' => false,
			'output'   => array(
				'border-color' => '.header_type_default .user-menu__item,
				.header_type_transparent.affix .user-menu__item'
			)
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Transparent', 'healthcoach' ),
	'desc'    => '',
	'subsection' => true,
	'fields'  => array(
		array(
			'id'       => 'logo_transparent',
			'url'      => false,
			'type'     => 'media',
			'title'    => __( 'Logo', 'healthcoach' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/tmp/logo_w.png' ),
			'subtitle' => __( 'Upload your logo file here.', 'healthcoach' ),
		),
		array(
			'id'        => 'header_transparent_background',
			'type'      => 'color_rgba',
			'title'     => 'Background',
			'output'    => array( 'background-color' => '.header_type_transparent' ),
			'default'   => array(
				'color' => '#ffffff',
				'alpha' => '0.0'
			),
		),
		array(
			'id'       => 'header_transparent_color',
			'type'     => 'color',
			'title'    => __( 'Color', 'healthcoach' ),
			'default'  => '#ffffff',
			'validate' => 'color',
			'transparent' => false,
			'output'   => array(
				'color' => '.header_type_transparent .user-menu__item,
				.header_type_transparent .nav__menu > li > a',
			)
		),
		array(
			'id'       => 'header_transparent_icon_bordercolor',
			'type'     => 'color',
			'title'    => __( 'Icon - Border Color', 'healthcoach' ),
			'default'  => '#ffffff',
			'validate' => 'color',
			'transparent' => false,
			'output'   => array(
				'border-color' => '.header_type_transparent .user-menu__item',
			)
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Sub menu', 'healthcoach' ),
	'desc'    => '',
	'subsection' => true,
	'fields'  => array(
		array(
			'id'       => 'header_submenu_width',
			'type'     => 'dimensions',
			'units'    => array('em','px','%'),
			'height'   => false,
			'output'   => array('.nav__menu .sub-menu'),
			'title'    => __('Menu Width', 'healthcoach' ),
			'default'  => array(
				'width'   => '202px',
			),
		),
		array(
			'id'       => 'header_submenu_color',
			'type'     => 'color',
			'title'    => __( 'Background Color', 'healthcoach' ),
			'default'  => '#ffffff',
			'validate' => 'color',
			'transparent' => false,
			'output'   => array(
				'background-color' => '.nav__menu .sub-menu',
				'border-bottom-color'     => '.nav__menu > li > .sub-menu:before',
			)
		),
		array(
			'id'       => 'header_submenu_sep_color',
			'type'     => 'color',
			'title'    => __( 'Separator Color', 'healthcoach' ),
			'default'  => '#eaeaea',
			'validate' => 'color',
			'transparent' => false,
			'output'   => array(
				'border-top-color' => '.nav__menu .sub-menu > li',
			)
		),
		array(
			'id'          => 'header_submenu_typography',
			'type'        => 'typography',
			'title'       => __('Typography', 'healthcoach' ),
			'google'      => false,
			'font-backup' => false,
			'font-style'  => false,
			'font-weight' => true,
			'font-size'   => true,
			'font-family' => false,
			'subsets'     => false,
			'text-align'  => false,
			'color'       => true,
			'line-height' => false,
			'output'      => array('.nav__menu .sub-menu > li > a'),
			'units'       =>'px',
			'default'     => array(
				'color'       => '#444444',
				'font-size'   => '13px',
				'font-weight' => 400,
			),
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Mobile menu', 'healthcoach' ),
	'desc'    => '',
	'subsection' => true,
	'fields'  => array(
		array(
			'id'       => 'mobile_logo_size',
			'type'     => 'dimensions',
			'units'    => array('em','px','%'),
			'title'    => __('Logo Size', 'healthcoach' ),
			'default'  => array(
				'width'   => '206px'
			),
			'output'   => array( '.mobile-menu-logo img' )
		),
		array(
			'id'             => 'mobile_logo_margin',
			'type'           => 'spacing',
			'left'			 => false,
			'right'			 => false,
			'output'         => array('.mobile-menu-logo img'),
			'mode'           => 'margin',
			'units'          => array('px'),
			'units_extended' => 'false',
			'title'          => __('Logo Spacing', 'healthcoach'),
			'default'        => array(
				'units'          => 'px',
				'margin-top' => '-20px'
			)
		),
		array(
			'id'             => 'mobile_menu_spacing',
			'type'           => 'spacing',
			'output'         => array('.mobile-menu'),
			'mode'           => 'padding',
			'units'          => array('em', 'px'),
			'left'	 		 => false,
			'right'	 		 => false,
			'units_extended' => 'false',
			'title'          => __( 'Spacing ( Top / Bottom )', 'healthcoach' ),
			'default'        => array(
				'padding-top'    => '33px',
				'padding-bottom' => '33px',
				'units'          => 'px',
			)
		),
		array(
			'id'       => 'mobile_menu_sep_color',
			'type'     => 'color',
			'title'    => __( 'Separator Color', 'healthcoach' ),
			'default'  => '#e1e2e4',
			'validate' => 'color',
			'transparent' => false,
			'output'   => array(
				'border-bottom-color' => '.mobile-nav-menu > li,
				.form_mobile-nav-search',
			)
		),
		array(
			'id'          => 'mobile_menu_typography',
			'type'        => 'typography',
			'title'       => __('Typography', 'healthcoach' ),
			'google'         => true,
			'font-backup'    => true,
			'font-weight'    => true,
			'text-align'     => false,
			'text-transform' => true,
			'color'		     => false,
			'line-height'    => false,
			'output'      => array('.mobile-nav-menu > li > a'),
			'units'       =>'px',
			'default'     => array(
				'font-style'     => '400',
				'font-size'      => '22px',
				'text-transform' => 'uppercase',
			),
		),
		array(
			'id' => 'mobile_menu_submenu_start',
			'type' => 'section',
			'title' => __( 'Sub menu', 'healthcoach' ),
			'indent' => true
		),
		array(
			'id'          => 'mobile_submenu_typography',
			'type'        => 'typography',
			'title'       => __('Typography', 'healthcoach' ),
			'google'         => false,
			'font-backup'    => false,
			'font-family'    => false,
			'font-weight'    => true,
			'text-align'     => false,
			'text-transform' => true,
			'color'		     => false,
			'line-height'    => false,
			'output'      => array('.mobile-nav-menu > li > ul li'),
			'units'       =>'px',
			'default'     => array(
				'font-weight'    => '400',
				'font-size'      => '18px'
			),
		),
		array(
			'id'     => 'mobile_menu_submenu_end',
			'type'   => 'section',
			'indent' => false,
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Typography', 'healthcoach' ),
	'desc'    => '',
	'icon'    => 'el el-font',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'          => 'general_typography',
			'type'        => 'typography',
			'title'       => __('General', 'healthcoach' ),
			'google'      => true,
			'font-backup' => true,
			'text-align'  => false,
			'font-weight' => false,
			'font-style'  => false,
			'all_styles'  => true,
			'output'      => array('body,
			.vc_tta.vc_tta-accordion .vc_tta-panel-title,
			blockquote.style-2 cite'),
			'units'       => 'px',
			'default'     => array(
				'color'       => '#888888',
				'font-family' => 'Open Sans',
				'google'      => true,
				'font-size'   => '14px',
				'line-height' => '20px',
			),
		),
		array(
			'id'          => 'secondary_font_family',
			'type'        => 'typography',
			'title'       => __('Secondary', 'healthcoach' ),
			'google'      => true,
			'font-backup' => false,
			'text-align'  => false,
			'font-weight' => false,
			'line-height' => false,
			'font-size'   => false,
			'color'   	  => false,
			'font-style'  => false,
			'all_styles'  => true,
			'output'      => array('.page-pagination .page-numbers li,
									.stats-counter__value-number,
									.testimonial__content-text,
									.event__date-day,
									.widget-title,
									.widget_event-contacts .event-contacts__phone,
									.event-info__members-number,
									.testimonial__caption-title,
									.result-photo__caption,
									.mobile-nav-menu > li > a,
									.error404__title,
									.countdown__counter-number,
									.woocommerce div.product p.price,
									.woocommerce div.product span.price,
									.woocommerce ul.products li.product .price,
									.call-to-action__link,
									.drop-cap,
									.drop-cap-square,
									blockquote cite,
									blockquote.style-1 p,
									blockquote.style-2 p,
									.woocommerce-cart .shop_table.cart .product-subtotal .amount,
									.woocommerce-cart .cart-collaterals .order-total .amount'),
			'units'       => 'px',
			'default'     => array(
				'font-family' => 'Oregano',
				'google'      => true,
			),
		),
        array(
            'id'          => 'h1_typography',
            'type'        => 'typography',
            'title'       => __('H1', 'healthcoach' ),
            'google'      => true,
            'font-backup' => false,
            'text-align'  => false,
            'font-weight' => true,
            'font-style'  => true,
            'line-height' => false,
            'font-family' => true,
            'color'       => true,
            'all_styles'  => false,
            'output'      => array('h1, .h1'),
            'units'       =>'px',
            'default'     => array(
                'font-family' => 'Oregano',
                'font-weight' => '400',
                'font-size'   => '72px',
                'color'       => '#444444',
            ),
        ),
		array(
			'id'          => 'h2_typography',
			'type'        => 'typography',
			'title'       => __('H2', 'healthcoach' ),
			'google'      => true,
			'font-backup' => false,
			'text-align'  => false,
			'font-weight' => true,
			'font-style'  => true,
			'line-height' => false,
			'font-family' => true,
			'color'       => true,
			'all_styles'  => false,
			'output'      => array('h2, .h2'),
			'units'       =>'px',
			'default'     => array(
				'font-family' => 'Oregano',
				'font-weight' => '400',
				'font-size'   => '55px',
				'color'       => '#444444',
			),
		),
		array(
			'id'          => 'h3_typography',
			'type'        => 'typography',
			'title'       => __('H3', 'healthcoach' ),
			'google'      => true,
			'font-backup' => false,
			'text-align'  => false,
			'font-weight' => true,
			'font-style'  => true,
			'line-height' => false,
			'font-family' => true,
			'color'       => true,
			'all_styles'  => false,
			'output'      => array('h3, .h3'),
			'units'       =>'px',
			'default'     => array(
				'font-family' => 'Oregano',
				'font-weight' => '400',
				'font-size'   => '40px',
				'color'       => '#444444',
			),
		),
		array(
			'id'          => 'h4_typography',
			'type'        => 'typography',
			'title'       => __('H4', 'healthcoach' ),
			'google'      => true,
			'font-backup' => false,
			'text-align'  => false,
			'font-weight' => true,
			'font-style'  => true,
			'line-height' => false,
			'font-family' => true,
			'color'       => true,
			'all_styles'  => false,
			'output'      => array('h4, .h4'),
			'units'       =>'px',
			'default'     => array(
				'font-family' => 'Oregano',
				'font-weight' => '400',
				'font-size'   => '30px',
				'color'       => '#444444',
			),
		),
		array(
			'id'          => 'h5_typography',
			'type'        => 'typography',
			'title'       => __('H5', 'healthcoach' ),
			'google'      => true,
			'font-backup' => false,
			'text-align'  => false,
			'font-weight' => true,
			'font-style'  => true,
			'line-height' => false,
			'font-family' => true,
			'color'       => true,
			'all_styles'  => false,
			'output'      => array('h5, .h5'),
			'units'       =>'px',
			'default'     => array(
				'font-weight' => '400',
				'font-size'   => '18px',
				'color'       => '#444444',
			),
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Pages', 'healthcoach' ),
	'desc'    => '',
	'icon'	  => 'el el-website',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'       => '404error_bg',
			'type'     => 'background',
			'background-repeat' => true,
			'background-attachment' => false,
			'background-position' => true,
			'background-image' => true,
			'background-size' => true,
			'title'    => __('Page 404 - Background', 'healthcoach' ),
			'default'  => array(
				'background-image' => get_template_directory_uri() . '/assets/images/tmp/404bg.jpg',
				'background-repeat' => 'no-repeat',
				'background-position' => 'center center',
				'background-size' => 'cover',
			),
			'output'  => array('.error404__bg')
		),
		array(
			'id'       => 'coming_soon_bg',
			'type'     => 'background',
			'background-repeat' => true,
			'background-attachment' => false,
			'background-position' => true,
			'background-image' => true,
			'background-size' => true,
			'title'    => __('Page Coming Soon - Background', 'healthcoach' ),
			'default'  => array(
				'background-image' => get_template_directory_uri() . '/assets/images/tmp/coming-soon-bg-min.png',
				'background-repeat' => 'no-repeat',
				'background-position' => 'right top',
				'background-color' => '#d5dae0',
			),
			'output'  => array('.coming-soon__bg')
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Title', 'healthcoach' ),
	'desc'    => '',
	'subsection' => true,
	'fields'  => array(
		array(
			'id'          => 'hero_content_align',
			'type'        => 'typography',
			'title'       => __('Alignment', 'healthcoach' ),
			'google'      => false,
			'font-backup' => false,
			'text-align'  => true,
			'font-weight' => false,
			'font-style'  => false,
			'font-size'   => false,
			'font-family' => false,
			'line-height' => false,
			'color' 	  => false,
			'all_styles'  => false,
			'output'      => array( '.page-title__body' ),
			'units'       =>'px',
			'default'     => array(
				'text-align' => 'center',
			),
		),
		array(
			'id'          => 'hero_title_typography',
			'type'        => 'typography',
			'title'       => __('Title - Typography', 'healthcoach' ),
			'google'      => true,
			'font-backup' => true,
			'text-align'  => false,
			'font-weight' => true,
			'font-style'  => true,
			'text-transform' => true,
			'font-family' => true,
			'line-height' => false,
			'all_styles'  => true,
			'output'      => array( '.page-title__title' ),
			'units'       =>'px',
			'default'     => array(
				'color'       => '#444444',
			),
		),
		array(
			'id'             => 'hero_title_spacing',
			'type'           => 'spacing',
			'output'         => array('.page-title'),
			'mode'           => 'margin',
			'units'          => array('em', 'px'),
			'left'	 		 => false,
			'right'	 		 => false,
			'top'	 		 => false,
			'units_extended' => 'false',
			'title'          => __( 'Title - Spacing', 'healthcoach' ),
			'default'        => array(
				'margin-bottom' => '34px',
				'units'         => 'px',
			)
		),
		array(
			'id'       => 'hero_icon',
			'type'     => 'callback',
			'title'    => __( 'Icon', 'healthcoach' ),
			'callback' => 'stm_iconpicker',
			'default'  => 'hc-icon-smile'
		),
		array(
			'id'          => 'hero_icon_typography',
			'type'        => 'typography',
			'title'       => __( 'Icon - Typography', 'healthcoach' ),
			'google'      => false,
			'font-backup' => false,
			'text-align'  => false,
			'font-weight' => false,
			'font-style'  => false,
			'font-family' => false,
			'line-height' => false,
			'all_styles'  => false,
			'output'      => array( '.page-title__icon' ),
			'units'       =>'px',
			'default'     => array(
				'font-size' => '17px'
			),
		),
		array(
			'id'       => 'hero_icon_position',
			'type'     => 'select',
			'title'    => __( 'Icon - Position', 'healthcoach' ),
			'options'  => array(
				'top'    => 'Top',
				'bottom' => 'Bottom'
			),
			'default'  => 'bottom',
		),
		array(
			'id'             => 'hero_icon_spacing',
			'type'           => 'spacing',
			'output'         => array('.page-title__icon'),
			'mode'           => 'padding',
			'units'          => array('em', 'px'),
			'left'	 		 => false,
			'right'	 		 => false,
			'units_extended' => 'false',
			'title'          => __( 'Icon - Spacing ( Top / Bottom )', 'healthcoach' ),
			'default'        => array(
				'padding-top'    => '13px',
				'units'          => 'px',
			)
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Shop', 'healthcoach' ),
	'desc'    => '',
	'icon'	  => 'el el-shopping-cart',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'       => 'shop_products_title',
			'type'     => 'text',
			'title'    => __('Products Title', 'healthcoach' ),
			'default'  => 'Fitness Store',
		),
		array(
			'id'      => 'subscribe_form_enable',
			'type'    => 'switch',
			'title'   => __( 'Subscribe Form Enable', 'healthcoach' ),
			'default' => true
		),
		array(
			'id'       => 'products_count',
			'type'     => 'spinner',
			'title'    => __('Products Count', 'healthcoach' ),
			'default'  => '8',
			'min'      => '1',
			'step'     => '1',
			'max'      => '100',
		),
		array(
			'id'       => 'products_columns',
			'type'     => 'select',
			'title'    => __('Number of Products Per Row', 'healthcoach' ),
			'options'  => array(
				1  => __('One', 'healthcoach' ),
				2  => __('Two', 'healthcoach' ),
				3  => __('Three', 'healthcoach' ),
				4  => __('Four', 'healthcoach' ),
			),
			'default'  => 4,
		),
		array(
			'id'       => 'shop_sidebar',
			'type'     => 'select',
			'title'    => __('Sidebar - Shop', 'healthcoach' ),
			'options'  => array(
				'left'  => __('Left', 'healthcoach' ),
				'right' => __('Right', 'healthcoach' ),
				'hide'  => __('Hide', 'healthcoach' ),
			),
			'default'  => 'hide',
		),
		array(
			'id'       => 'single_product_sidebar',
			'type'     => 'select',
			'title'    => __('Sidebar - Single Product', 'healthcoach' ),
			'options'  => array(
				'left'  => __('Left', 'healthcoach' ),
				'right' => __('Right', 'healthcoach' ),
				'hide'  => __('Hide', 'healthcoach' ),
			),
			'default'  => 'right',
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Blog', 'healthcoach' ),
	'desc'    => '',
	'icon' 	  => 'el el-pencil',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'       => 'blog_title',
			'type'     => 'text',
			'title'    => __('Title', 'healthcoach' ),
			'default'  => 'Blog',
		),
		array(
			'id'       => 'blog_layout',
			'type'     => 'select',
			'title'    => __('Type', 'healthcoach' ),
			'options'  => array(
				'grid' => __('Grid', 'healthcoach' ),
				'list' => __('List', 'healthcoach' ),
			),
			'default'  => 'grid',
		),
		array(
			'id'       => 'blog_sidebar',
			'type'     => 'select',
			'title'    => __('Sidebar', 'healthcoach' ),
			'options'  => array(
				'left' => __('Left', 'healthcoach' ),
				'right' => __('Right', 'healthcoach' ),
				'hide' => __('Hide', 'healthcoach' ),
			),
			'default'  => 'hide',
		),
		array(
			'id'       => 'post_sidebar',
			'type'     => 'select',
			'title'    => __('Post Sidebar', 'healthcoach' ),
			'options'  => array(
				'left' => __('Left', 'healthcoach' ),
				'right' => __('Right', 'healthcoach' ),
				'hide' => __('Hide', 'healthcoach' ),
			),
			'default'  => 'right',
		),
		array(
			'id'       => 'sticky_text',
			'type'     => 'text',
			'title'    => __('Sticky Text', 'healthcoach' ),
			'default'  => 'STICKY',
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Social networks', 'healthcoach' ),
	'icon'    => 'el-icon-address-book',
	'desc'    => '',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'       => 'facebook-square',
			'type'     => 'text',
			'title'    => __('Facebook', 'healthcoach' ),
			'default'  => 'https://www.facebook.com/',
			'desc'     => __( 'Enter your Facebook URL.', 'healthcoach' ),
		),
		array(
			'id'       => 'twitter-square',
			'type'     => 'text',
			'title'    => __('Twitter', 'healthcoach' ),
			'default'  => 'https://www.twitter.com/',
			'desc'     => __( 'Enter your Twitter URL.', 'healthcoach' ),
		),
		array(
			'id'       => 'instagram',
			'type'     => 'text',
			'title'    => __('Instagram', 'healthcoach' ),
			'default'  => 'https://www.instagram.com/',
			'desc'     => __( 'Enter your Instagram URL.', 'healthcoach' ),
		),
		array(
			'id'       => 'google-plus-square',
			'type'     => 'text',
			'title'    => __('Google Plus', 'healthcoach' ),
			'default'  => 'https://plus.google.com/',
			'desc'     => __( 'Enter your Google Plus URL.', 'healthcoach' ),
		),
		array(
			'id'       => 'pinterest-square',
			'type'     => 'text',
			'title'    => __('Pinterest', 'healthcoach' ),
			'default'  => 'https://www.pinterest.com/',
			'desc'     => __( 'Enter your Pinterest URL.', 'healthcoach' ),
		),
		array(
			'id'       => 'youtube-square',
			'type'     => 'text',
			'title'    => __('Youtube', 'healthcoach' ),
			'default'  => 'https://www.youtube.com/',
			'desc'     => __( 'Enter your Youtube URL.', 'healthcoach' ),
		),
		array(
			'id'       => 'linkedin-square',
			'type'     => 'text',
			'title'    => __('LinkedIn', 'healthcoach' ),
			'default'  => 'https://www.linkedin.com/',
			'desc'     => __( 'Enter your LinkedIn URL.', 'healthcoach' ),
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Buttons', 'healthcoach' ),
	'desc'    => '',
	'icon'    => 'el el-bold',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'          => 'button_typography',
			'type'        => 'typography',
			'title'       => __('Typography', 'healthcoach' ),
			'google'      => false,
			'font-backup' => false,
			'text-align'  => false,
			'font-weight' => true,
			'font-style'  => false,
			'color'       => false,
			'font-size'   => true,
			'line-height' => false,
			'all_styles'  => true,
			'output'      => array(
				'.btn,
				.woocommerce-cart .wc-proceed-to-checkout .checkout-button'
			),
			'units'       =>'px',
			'default'     => array(
				'font-weight' => 700,
				'font-size' => "15px",
			),
		),
		array(
			'id'          => 'button_sm_typography',
			'type'        => 'typography',
			'title'       => __('Typography - Small', 'healthcoach' ),
			'google'      => false,
			'font-backup' => false,
			'text-align'  => false,
			'font-weight' => true,
			'font-style'  => false,
			'color'       => false,
			'font-size'   => true,
			'line-height' => false,
			'all_styles'  => true,
			'output'      => array(
				'.btn.btn_size_sm,
				 .woocommerce a.added_to_cart'
			),
			'units'       =>'px',
			'default'     => array(
				'font-weight' => 700,
				'font-size' => "13px",
			),
		),
		array(
			'id'             => 'button_sm_size',
			'type'           => 'spacing',
			'output'         => array(
				'.btn.btn_size_sm'
			),
			'mode'           => 'padding',
			'units'          => array('em', 'px'),
			'units_extended' => 'false',
			'title'          => __( 'Size - Small', 'healthcoach' ),
			'default'            => array(
				'padding-top'     => '13.5px',
				'padding-right'   => '20px',
				'padding-bottom'  => '13.5px',
				'padding-left'    => '20px',
				'units'          => 'px',
			)
		),
		array(
			'id'             => 'button_normal_size',
			'type'           => 'spacing',
			'output'         => array(
				'.btn,
				.vc_btn3.vc_btn3-size-md.vc_btn3-style-flat,
				.woocommerce-cart .wc-proceed-to-checkout .checkout-button'
			),
			'mode'           => 'padding',
			'units'          => array('em', 'px'),
			'units_extended' => 'false',
			'title'          => __( 'Size - Normal', 'healthcoach' ),
			'default'            => array(
				'padding-top'     => '16px',
				'padding-right'   => '32px',
				'padding-bottom'  => '16px',
				'padding-left'    => '32px',
				'units'          => 'px',
			)
		),
		array(
			'id'             => 'button_outline_sm_size',
			'type'           => 'spacing',
			'output'         => array(
				'.btn.btn_size_sm.btn_type_outline,
				.woocommerce a.added_to_cart'
			),
			'mode'           => 'padding',
			'units'          => array('em', 'px'),
			'units_extended' => 'false',
			'title'          => __( 'Outline Size - Small', 'healthcoach' ),
			'default'            => array(
				'padding-top'     => '12.5px',
				'padding-right'   => '20px',
				'padding-bottom'  => '12.5px',
				'padding-left'    => '20px',
				'units'          => 'px',
			)
		),
		array(
			'id'             => 'button_outline_normal_size',
			'type'           => 'spacing',
			'output'         => array(
				'.btn.btn_type_outline'
			),
			'mode'           => 'padding',
			'units'          => array('em', 'px'),
			'units_extended' => 'false',
			'title'          => __( 'Outline Size - Normal', 'healthcoach' ),
			'default'            => array(
				'padding-top'     => '14px',
				'padding-right'   => '32px',
				'padding-bottom'  => '14px',
				'padding-left'    => '32px',
				'units'          => 'px',
			)
		),
		array(
			'id' => 'button_primary_start',
			'type' => 'section',
			'title' => __( 'Primary', 'healthcoach' ),
			'indent' => true
		),
		array(
			'id' => 'button_primary_bg',
			'type'     => 'background',
			'background-repeat' => false,
			'background-attachment' => false,
			'background-position' => false,
			'background-image' => false,
			'background-size' => false,
			'transparent' => false,
			'title'    => __( 'Hover - Background Color', 'healthcoach' ),
			'description'    => __( 'Default color site "Primary Color"', 'healthcoach' ),
			'output'   => array(
				'.btn_view_primary,
				.vc_btn3.vc_btn3-size-md.vc_btn3-style-flat.vc_btn3-color-success,
				.woocommerce-cart .wc-proceed-to-checkout .checkout-button,
				.post-password-form input[type="submit"],
				.subscribe_type_primary .form__button'
			),
		),
		array(
			'id' => 'button_hover_primary_bg',
			'type'     => 'background',
			'background-repeat' => false,
			'background-attachment' => false,
			'background-position' => false,
			'background-image' => false,
			'background-size' => false,
			'transparent' => false,
			'title'    => __( 'Hover - Background Color', 'healthcoach' ),
			'output'   => array(
				'.btn_view_primary:hover,
				 .btn_view_primary:focus,
				 .vc_btn3.vc_btn3-size-md.vc_btn3-style-flat.vc_btn3-color-success:hover,
				 .vc_btn3.vc_btn3-size-md.vc_btn3-style-flat.vc_btn3-color-success:focus,
				 .woocommerce-cart .wc-proceed-to-checkout .checkout-button:focus,
				 .woocommerce-cart .wc-proceed-to-checkout .checkout-button:hover,
				 .post-password-form input[type="submit"]:hover,
				 .post-password-form input[type="submit"]:focus,
				 .subscribe_type_primary .form__button:hover,
				 .subscribe_type_primary .form__button:focus',
			),
			'default'  => array(
				'background-color' => '#444444',
			)
		),
		array(
			'id'       => 'button_primary_link_regular',
			'type'     => 'color',
			'title'    => __( 'Color - Regular', 'healthcoach' ),
			'default'  => '#ffffff',
			'validate' => 'color',
			'transparent' => false,
			'output'   => array(
				'color' => '.btn_view_primary,
				.vc_btn3.vc_btn3-size-md.vc_btn3-style-flat.vc_btn3-color-success,
				.woocommerce-cart .wc-proceed-to-checkout .checkout-button',
			)
		),
		array(
			'id'       => 'button_primary_link_hover',
			'type'     => 'color',
			'title'    => __( 'Color - Hover and Focus', 'healthcoach' ),
			'default'  => '#ffffff',
			'validate' => 'color',
			'transparent' => false,
			'output'   => array(
				'color' => '.btn_view_primary:hover,
							.btn_view_primary:focus,
							.vc_btn3.vc_btn3-size-md.vc_btn3-style-flat.vc_btn3-color-success:focus,
							.vc_btn3.vc_btn3-size-md.vc_btn3-style-flat.vc_btn3-color-success:hover,
							.woocommerce-cart .wc-proceed-to-checkout .checkout-button:focus,
							.woocommerce-cart .wc-proceed-to-checkout .checkout-button:hover,
							.post-password-form input[type="submit"]:hover,
							.post-password-form input[type="submit"]:focus',
			)
		),
		array(
			'id'     => 'button_primary_end',
			'type'   => 'section',
			'indent' => false,
		),
		array(
			'id' => 'button_default_start',
			'type' => 'section',
			'title' => __( 'Default', 'healthcoach' ),
			'indent' => true
		),
		array(
			'id' => 'button_default_bg',
			'type'     => 'background',
			'background-repeat' => false,
			'background-attachment' => false,
			'background-position' => false,
			'background-image' => false,
			'background-size' => false,
			'transparent' => false,
			'title'    => __( 'Hover - Background Color', 'healthcoach' ),
			'default'    => array(
				'background-color' => '#ffffff'
			),
			'output'   => array(
				'.btn_view_default'
			),
		),
		array(
			'id' => 'button_hover_default_bg',
			'type'     => 'background',
			'background-repeat' => false,
			'background-attachment' => false,
			'background-position' => false,
			'background-image' => false,
			'background-size' => false,
			'transparent' => false,
			'title'    => __( 'Hover - Background Color', 'healthcoach' ),
			'output'   => array(
				'.btn_view_default:hover,
				 .btn_view_default:focus',
			),
			'default'  => array(
				'background-color' => '#444444',
			)
		),
		array(
			'id'       => 'button_default_link_regular',
			'type'     => 'color',
			'title'    => __( 'Color - Regular', 'healthcoach' ),
			'default'  => '',
			'validate' => 'color',
			'transparent' => false,
			'output'   => array(
				'color' => '.btn_view_default',
			)
		),
		array(
			'id'       => 'button_default_link_hover',
			'type'     => 'color',
			'title'    => __( 'Color - Hover and Focus', 'healthcoach' ),
			'default'  => '#ffffff',
			'validate' => 'color',
			'transparent' => false,
			'output'   => array(
				'color' => '.btn_view_default:hover,
							.btn_view_default:focus',
			)
		),
		array(
			'id'     => 'button_default_end',
			'type'   => 'section',
			'indent' => false,
		),
		array(
			'id' => 'button_primary_outline_start',
			'type' => 'section',
			'title' => __( 'Primary - Outline', 'healthcoach' ),
			'indent' => true
		),
		array(
			'id' => 'button_primary_outline_hover_bg',
			'type'     => 'background',
			'background-repeat' => false,
			'background-attachment' => false,
			'background-position' => false,
			'background-image' => false,
			'background-size' => false,
			'transparent' => false,
			'title'    => __( 'Hover - Background Color', 'healthcoach' ),
			'description'    => __( 'Default color site "Primary Color"', 'healthcoach' ),
			'output'   => array(
				'.btn_type_outline.btn_view_primary:hover,
				 .btn_type_outline.btn_view_primary:focus,
				 .woocommerce a.added_to_cart:hover,
				 .woocommerce a.added_to_cart:focus',
			),
			'default'  => ''
		),
		array(
			'id'       => 'button_primary_outline_border',
			'type'     => 'border',
			'title'    => __('Border', 'healthcoach' ),
			'description'    => __('Default Border Color site "Primary Color"', 'healthcoach' ),
			'output'   => array('.btn_type_outline.btn_view_primary,
			.added_to_cart'),
			'default'  => array(
				'border-color'  => '#2acd35',
				'border-style'  => 'solid',
				'border-top'    => '2px',
				'border-right'  => '2px',
				'border-bottom' => '2px',
				'border-left'   => '2px'
			)
		),
		array(
			'id'       => 'button_primary_outline_link_regular',
			'type'     => 'color',
			'title'    => __( 'Color - Regular', 'healthcoach' ),
			'description'    => __( 'Default color site "Primary Color"', 'healthcoach' ),
			'default'  => '',
			'validate' => 'color',
			'transparent' => false,
			'output'   => array(
				'color' => '.btn_type_outline.btn_view_primary,
				.woocommerce a.added_to_cart',
			)
		),
		array(
			'id'       => 'button_primary_outline_link_hover',
			'type'     => 'color',
			'title'    => __( 'Color - Hover and Focus', 'healthcoach' ),
			'default'  => '#ffffff',
			'validate' => 'color',
			'transparent' => false,
			'output'   => array(
				'color' => '.btn_type_outline.btn_view_primary:hover,
				 			.btn_type_outline.btn_view_primary:focus,
				 			.woocommerce a.added_to_cart:hover,
				 			.woocommerce a.added_to_cart:focus',
			)
		),
		array(
			'id'     => 'button_primary_outline_end',
			'type'   => 'section',
			'indent' => false,
		),
		array(
			'id' => 'button_default_outline_section',
			'type' => 'section',
			'title' => __( 'Default - Outline', 'healthcoach' ),
			'indent' => true
		),
		array(
			'id'       => 'button_default_outline',
			'type'     => 'border',
			'title'    => __('Border', 'healthcoach' ),
			'output'   => array('.btn_type_outline.btn_view_default,
			.subscribe_type_default .form__button'),
			'default'  => array(
				'border-color'  => '#ffffff',
				'border-style'  => 'solid',
				'border-top'    => '2px',
				'border-right'  => '2px',
				'border-bottom' => '2px',
				'border-left'   => '2px'
			)
		),
		array(
			'id' => 'button_default_outline_hover_bg',
			'type'     => 'background',
			'title'    => __( 'Background Color', 'healthcoach' ),
			'background-repeat' => false,
			'background-attachment' => false,
			'background-position' => false,
			'background-image' => false,
			'background-size' => false,
			'output'   => array( '.btn_type_outline.btn_view_default:hover,
								  .btn_type_outline.btn_view_default:focus,
								  .subscribe_type_default .form__button:focus,
								  .subscribe_type_default .form__button:hover,
								  .call-to-action .mc4wp-form .form__button:hover,
								  .call-to-action .mc4wp-form .form__button:focus' ),
			'default'  => array(
				'background-color' => '#ffffff',
			)
		),
		array(
			'id'       => 'button_default_outline_link_regular',
			'type'     => 'color',
			'title'    => __( 'Color - Regular', 'healthcoach' ),
			'default'  => '#ffffff',
			'validate' => 'color',
			'transparent' => false,
			'output'   => array(
				'color' => '.btn_type_outline.btn_view_default,
				.subscribe_type_default .form__button',
			)
		),
		array(
			'id'       => 'button_default_outline_link_hover',
			'type'     => 'color',
			'title'    => __( 'Color - Hover and Focus', 'healthcoach' ),
			'description'    => __( 'Default color site "Primary Color"', 'healthcoach' ),
			'default'  => '',
			'validate' => 'color',
			'transparent' => false,
			'output'   => array(
				'color' => '.btn_type_outline.btn_view_default:hover,
							.btn_type_outline.btn_view_default:focus,
							.subscribe_type_default .form__button:focus,
							.subscribe_type_default .form__button:hover',
			)
		),
		array(
			'id'     => 'button_outline_secondary_section_end',
			'type'   => 'section',
			'indent' => false,
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Footer', 'healthcoach' ),
	'desc'    => '',
	'icon'    => 'el-icon-file',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'      => 'enable_footer_banner',
			'type'    => 'switch',
			'title'   => __( 'Enable Banner', 'healthcoach' ),
			'default' => true
		),
		array(
			'id'      => 'enable_footer_widgets',
			'type'    => 'switch',
			'title'   => __( 'Enable Widgets', 'healthcoach' ),
			'default' => true
		),
		array(
			'id'       => 'footer_bg',
			'type'     => 'background',
			'background-repeat' => false,
			'background-attachment' => false,
			'background-position' => false,
			'background-image' => false,
			'background-size' => false,
			'title'    => __('Background', 'healthcoach' ),
			'default'  => array(
				'background-color' => '#222426',
			),
			'output'  => array('.footer-main')
		),
		array(
			'id'          => 'footer_color_1',
			'type'        => 'color',
			'title'       => __( 'Color 1', 'healthcoach' ),
			'default'  	  => '#888888',
			'transparent' => false,
			'validate'    => 'color',
			'output'      => array(
				'color' => '.widget-area_type_footer a,
							.footer-bottom .custom-text,
							.footer-bottom .custom-text a,
							.footer-bottom .copyright,
							.footer-bottom .copyright a,
							.widget_type_footer.widget_featured-pages li:before,
							.widget_type_footer .widget-socials__item',
			)
		),
		array(
			'id'          => 'footer_color_2',
			'type'        => 'color',
			'title'       => __( 'Color 2', 'healthcoach' ),
			'default'  	  => '#e1e2e4',
			'transparent' => false,
			'validate'    => 'color',
			'output'      => array(
				'color' => '.banner_type_footer .banner__text,
							.widget_type_footer,
							.widget_type_footer li a:focus,
							.widget_type_footer li a:hover,
							.widget_type_footer a:focus,
							.widget_type_footer a:hover,
							.footer-bottom .custom-text a:hover,
							.footer-bottom .custom-text a:focus,
							.footer-bottom .copyright a:hover,
							.footer-bottom .copyright a:focus,
							.widget_type_footer.widget_rss .rssSummary,
							.widget_type_footer.widget_tag_cloud .tagcloud a,
							.widget_type_footer.widget_rss .rss-date,
							.widget_type_footer.widget_rss cite,
							.widget_type_footer.widget_recent_entries > ul > li a:hover,
							.widget_type_footer.widget_recent_entries > ul > li a:focus,
							.widget-area_type_footer .widget_recent_comments .recentcomments a:hover,
							.widget-area_type_footer .widget_recent_comments .recentcomments a:focus,
							.widget_type_footer.widget_calendar td,
							.widget_type_footer.widget_calendar caption,
							.widget_type_footer.widget_featured-pages li:hover:before',
			)
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Banner', 'healthcoach' ),
	'desc'    => '',
	'subsection' => true,
	'fields'  => array(
		array(
			'id'       => 'banner_height',
			'type'     => 'dimensions',
			'width'    => false,
			'units'    => array('em','px','%'),
			'title'    => __('Height', 'healthcoach' ),
			'default'  => array(
				'height'   => '262px'
			),
			'output'   => array( '.banner__body_vertical_middle' )
		),
		array(
			'id'       => 'banner_image',
			'url'      => false,
			'type'     => 'media',
			'title'    => __( 'Image', 'healthcoach' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/tmp/banner-image_03-min.png' ),
		),
		array(
			'id'=>'banner_title',
			'type' => 'textarea',
			'title' => __('Title', 'healthcoach' ),
			'validate' => 'html_custom',
			'default' => 'Visit my Shop',
			'allowed_html' => array(
				'a' => array(
					'href' => array(),
					'title' => array()
				),
				'br' => array(),
				'em' => array(),
				'strong' => array()
			)
		),
		array(
			'id'=>'banner_text',
			'type' => 'textarea',
			'title' => __('Text', 'healthcoach' ),
			'validate' => 'html_custom',
			'default' => 'You will find many interesting things for the strengthening of your body',
			'allowed_html' => array(
				'a' => array(
					'href' => array(),
					'title' => array()
				),
				'br' => array(),
				'em' => array(),
				'strong' => array()
			)
		),
		array(
			'id'       => 'banner_url',
			'type'     => 'text',
			'title'    => __('URL', 'healthcoach' ),
			'default'  => '#'
		),
		array(
			'id'          => 'banner_title_typography',
			'type'        => 'typography',
			'title'       => __('Title Typography', 'healthcoach' ),
			'google'      => false,
			'font-backup' => false,
			'font-style'  => false,
			'font-weight' => true,
			'font-size'   => true,
			'font-family' => false,
			'subsets'     => false,
			'text-align'  => false,
			'color'       => true,
			'line-height' => false,
			'output'      => array('.banner__title'),
			'units'       =>'px',
			'default'     => array(
			),
		),
		array(
			'id'          => 'banner_text_typography',
			'type'        => 'typography',
			'title'       => __('Text Typography', 'healthcoach' ),
			'google'      => false,
			'font-backup' => false,
			'font-style'  => false,
			'font-weight' => true,
			'font-size'   => true,
			'font-family' => false,
			'subsets'     => false,
			'text-align'  => false,
			'color'       => true,
			'line-height' => false,
			'output'      => array('.banner__text p'),
			'units'       =>'px',
			'default'     => array(
				'font-size'   => '18px',
				'font-weight' => '300',
			),
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Widget', 'healthcoach' ),
	'subsection' => true,
	'fields'  => array(
		array(
			'id'             => 'footer-widgets',
			'type'           => 'spacing',
			'output'         => array('.widget-area_type_footer'),
			'left'           => false,
			'right'          => false,
			'mode'           => 'padding',
			'units'          => array('em', 'px'),
			'units_extended' => 'false',
			'title'          => __('Widgets Area - Spacing ( Top / Bottom )', 'healthcoach' ),
			'default'            => array(
				'padding-top'    => '51px',
				'padding-bottom' => '41px',
				'units'          => 'px',
			)
		),
		array(
			'id'          => 'footer_widget_title_typography',
			'type'        => 'typography',
			'title'       => __('Widget Title - Typography', 'healthcoach' ),
			'google'      => false,
			'font-backup' => false,
			'font-style'  => false,
			'font-weight' => false,
			'font-size'   => true,
			'text-transform' => true,
			'font-family' => false,
			'subsets'     => false,
			'text-align'  => false,
			'color'       => true,
			'line-height' => false,
			'output'      => array('.widget_type_footer .widget-title'),
			'units'       =>'px',
			'default'     => array(
				'text-transform' => 'uppercase',
				'font-size'      => '18px',
			),
		),
		array(
			'id'             => 'footer_widget_title_margin_b',
			'type'           => 'spacing',
			'output'         => array('.footer-widgets .widget-title'),
			'left'           => false,
			'top'          => false,
			'right'          => false,
			'mode'           => 'margin',
			'units'          => array('em', 'px'),
			'units_extended' => 'false',
			'title'          => __('Widget Title - Spacing ( Bottom )', 'healthcoach' ),
			'default'            => array(
				'margin-bottom'     => '33px',
				'units'          => 'px',
			)
		)
	)
));

Redux::setSection( $opt_name, array(
	'title'   => __( 'Copyright', 'healthcoach' ),
	'desc'    => '',
	'subsection' => true,
	'fields'  => array(
		array(
			'id'             => 'footer_bottom_padding',
			'type'           => 'spacing',
			'output'         => array('.footer-bottom'),
			'left'           => false,
			'right'          => false,
			'mode'           => 'padding',
			'units'          => array('em', 'px'),
			'units_extended' => 'false',
			'title'          => __( 'Padding (Top/Bottom)', 'healthcoach' ),
			'default'            => array(
				'padding-top'     => '26px',
				'padding-bottom'  => '26px',
				'units'          => 'px',
			)
		),
		array(
			'id'       => 'footer_bottom_bg',
			'type'     => 'background',
			'background-repeat' => false,
			'background-attachment' => false,
			'background-position' => false,
			'background-image' => false,
			'background-size' => false,
			'title'    => __( 'Background', 'healthcoach' ),
			'default'  => array(
				'background-color' => '#2e3134',
			),
			'output'  => array( '.footer-bottom' )
		),
		array(
			'id'          => 'footer_copyright_typography',
			'type'        => 'typography',
			'title'       => __('Typography', 'healthcoach' ),
			'google'      => true,
			'font-backup' => false,
			'font-style'  => true,
			'font-weight' => true,
			'font-size'   => true,
			'font-family' => false,
			'subsets'     => false,
			'text-align'  => false,
			'color'       => true,
			'line-height' => false,
			'output'      => array('.copyright'),
			'units'       =>'px',
			'default'     => array(
				'color'       => '#697076',
				'font-weight' => '400',
			),
		),
		array(
			'id'=>'footer_copyright_text',
			'type' => 'textarea',
			'title' => __('Text', 'healthcoach' ),
			'validate' => 'html_custom',
			'default' => __('&copy; 2015 Health Coach | WordPress Theme for a Personal Trainer', 'healthcoach'),
			'allowed_html' => array(
				'a' => array(
					'href' => array(),
					'title' => array()
				),
				'br' => array(),
				'em' => array(),
				'strong' => array()
			)
		),
		array(
			'id'           =>'footer_custom_text',
			'type'         => 'textarea',
			'title' 	   => __( 'Custom Text', 'healthcoach' ),
			'subtitle'     => __( 'Text in right side.', 'healthcoach' ),
			'validate'     => 'html_custom',
			'default'      => __( 'Get Healthy &copy; Fit with <a target="_blank" href="http://www.stylemixthemes.com/">StylemixThemes</a>', 'healthcoach' ),
			'allowed_html' => array(
				'a' => array(
					'href' => array(),
					'title' => array()
				),
				'br' => array(),
				'em' => array(),
				'strong' => array()
			)
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Custom CSS', 'healthcoach' ),
	'icon'    => 'el-icon-css',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'       => 'site_css',
			'type'     => 'ace_editor',
			'title'    => __( 'CSS Code', 'healthcoach' ),
			'subtitle' => __( 'Paste your custom CSS code here.', 'healthcoach' ),
			'mode'     => 'css',
			'default'  => ""
		)
	)
));

Redux::setSection( $opt_name, array(
	'title'   => __( 'Live Customizer', 'healthcoach' ),
	'desc'    => '',
	'icon'    => 'el el-brush',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'      => 'live_customizer_enable',
			'type'    => 'switch',
			'title'   => __( 'Customizer Enable', 'healthcoach' ),
			'default' => false
		)
	)
) );

Redux::setSection( $opt_name, array(
	'icon'       => 'el-refresh',
	'icon_class' => 'el-icon-large',
	'title'      => __('One Click Update', 'healthcoach' ),
	'desc'    => __( 'Let us notify you when new versions of this theme are live on ThemeForest! Update with just one button click and forget about manual updates!<br> If you have any troubles while using auto update ( It is likely to be a permissions issue ) then you may want to manually update the theme as normal.', 'healthcoach' ),
	'submenu'    => true,
	'fields'     => array(
		array(
			'id'       =>'envato_username',
			'type'     => 'text',
			'title'    => __('ThemeForest Username', 'healthcoach' ),
			'subtitle' => '',
			'desc'     => __('Enter here your ThemeForest (or Envato) username account (i.e. Stylemixthemes).', 'healthcoach' ),
		),
		array(
			'id'       =>'envato_api',
			'type'     => 'text',
			'title'    => __('ThemeForest Secret API Key', 'healthcoach' ),
			'subtitle' => '',
			'desc'     => __('Enter here the secret api key you have created on ThemeForest. You can create a new one in the Settings > API Keys section of your profile.', 'healthcoach' ),
		),
	)
));

/*
 * <--- END SECTIONS
 */

if ( ! function_exists( 'stm_option' ) ) {
	function stm_option( $id, $fallback = false, $key = false ) {
		global $stm_option;
		if ( $fallback == false ) {
			$fallback = '';
		}
		$output = ( isset( $stm_option[ $id ] ) && $stm_option[ $id ] !== '' ) ? $stm_option[ $id ] : $fallback;
		if ( ! empty( $stm_option[ $id ] ) && $key ) {
			$output = $stm_option[ $id ][ $key ];
		}

		return $output;
	}
}

if ( ! function_exists( 'stm_iconpicker' ) ) {
	function stm_iconpicker( $field, $value ) {
		$linear_icons_json = file( get_template_directory() . '/assets/json/linearicons.json' );
		$linear_icons_array = json_decode( implode( '', $linear_icons_json ), true );
		$icons = json_decode( file_get_contents( get_template_directory() . '/assets/json/selection.json' ), true );

		foreach ( $icons['icons'] as $icon ) {
			$fonts['healthcoach'][] = 'hc-icon-' . $icon['properties']['name'];
		}

		foreach ( $linear_icons_array['icons'] as $linear_icon ) {
			$fonts['linearicons'][] = 'lnr lnr-' . $linear_icon['properties']['name'];
		}

		?>

		<input type="text" id="<?php echo esc_attr( $field['id'] ); ?>" name="<?php echo esc_attr( $field['name'] ); ?>" value="<?php echo esc_attr( $value ); ?>"/>

		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				$('#<?php echo esc_attr( $field['id'] ); ?>').fontIconPicker({
					theme: 'fip-bootstrap',
					emptyIcon: false,
					source: <?php echo json_encode( $fonts ); ?>
				});
			});
		</script>
	<?php }
}