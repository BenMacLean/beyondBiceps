<?php
global $theme_info;
$theme_info = wp_get_theme();

// Define
define( 'STM_THEME_VERSION', ( WP_DEBUG ) ? time() : $theme_info->get( 'Version' ) );

// Content width
if ( ! isset( $content_width ) ) {
	$content_width = 1110;
}

// Setup theme
if ( ! function_exists( 'stm_setup' ) ) :

	function stm_setup() {

		load_theme_textdomain( 'healthcoach', get_template_directory() . '/languages' );

		add_theme_support( 'title-tag' );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'post-thumbnails' );
		add_image_size( 'thumb-795x300', 795, 300, true );
		add_image_size( 'thumb-255x175', 255, 175, true );
		add_image_size( 'thumb-255x104', 255, 104, true );

		register_nav_menus( array(
			'primary'   => __( 'Top primary menu', 'healthcoach' ),
		) );

		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );

		add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
		) );

		add_theme_support( 'woocommerce' );

	}
endif;
add_action( 'after_setup_theme', 'stm_setup' );

// Scripts
function stm_scripts() {
	/* Register Styles */
	wp_register_style( 'stm-fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.css', null, STM_THEME_VERSION, 'all');
	wp_register_style( 'stm-fancybox-buttons', get_template_directory_uri() . '/assets/css/helpers/jquery.fancybox-buttons.css', null, STM_THEME_VERSION, 'all');
	wp_register_style( 'stm-fancybox-thumbs', get_template_directory_uri() . '/assets/css/helpers/jquery.fancybox-thumbs.css', null, STM_THEME_VERSION, 'all');
	wp_register_style( 'stm-datetimepicker', get_template_directory_uri() . '/assets/css/jquery.datetimepicker.css', null, STM_THEME_VERSION, 'all');
	wp_register_style( 'stm-select2', get_template_directory_uri() . '/assets/css/select2.min.css', null, STM_THEME_VERSION, 'all');
	wp_register_style( 'stm-font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', null, STM_THEME_VERSION, 'all');
	wp_register_style( 'stm-linearicons', get_template_directory_uri() . '/assets/css/linearicons.css', null, STM_THEME_VERSION, 'all');
	wp_register_style( 'stm-hc-icons', get_template_directory_uri() . '/assets/css/font-hc.css', null, STM_THEME_VERSION, 'all');
	wp_register_style( 'stm-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', null, STM_THEME_VERSION, 'all');
	wp_register_style( 'stm-slick', get_template_directory_uri() . '/assets/css/slick.css', null, STM_THEME_VERSION, 'all');
	wp_register_style( 'stm-slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css', null, STM_THEME_VERSION, 'all');
	wp_register_style( 'stm-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css', null, STM_THEME_VERSION, 'all');
	wp_register_style( 'stm-vc', get_template_directory_uri() . '/assets/css/vc.css', null, STM_THEME_VERSION, 'all');
	wp_register_style( 'stm-media', get_template_directory_uri() . '/assets/css/media.css', null, STM_THEME_VERSION, 'all');

	/* Enqueue Styles */
	wp_enqueue_style( 'stm-bootstrap' );
	wp_enqueue_style( 'stm-font-awesome' );
	wp_enqueue_style( 'stm-linearicons' );
	wp_enqueue_style( 'stm-hc-icons' );
	wp_enqueue_style( 'stm-select2' );
	wp_enqueue_style( 'stm-slick' );
	wp_enqueue_style( 'stm-slick-theme' );
	wp_enqueue_style( 'stm-woocommerce' );
	wp_enqueue_style( 'stm-vc' );
	wp_enqueue_style( 'stm-style', get_stylesheet_uri(), null, STM_THEME_VERSION, 'all' );
	wp_enqueue_style( 'stm-media' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/* Register Scripts */
	wp_register_script( 'stm-countdown', get_template_directory_uri() . '/assets/js/jquery.countdown.min.js', array( 'jquery' ), STM_THEME_VERSION, true );
	wp_register_script( 'stm-fancybox', get_template_directory_uri() . '/assets/js/jquery.fancybox.js', array( 'jquery' ), STM_THEME_VERSION, true );
	wp_register_script( 'stm-fancybox-buttons', get_template_directory_uri() . '/assets/js/helpers/jquery.fancybox-buttons.js', array( 'jquery' ), STM_THEME_VERSION, true );
	wp_register_script( 'stm-fancybox-media', get_template_directory_uri() . '/assets/js/helpers/jquery.fancybox-media.js', array( 'jquery' ), STM_THEME_VERSION, true );
	wp_register_script( 'stm-fancybox-thumbs', get_template_directory_uri() . '/assets/js/helpers/jquery.fancybox-thumbs.js', array( 'jquery' ), STM_THEME_VERSION, true );
	wp_register_script( 'stm-slick', get_template_directory_uri() . '/assets/js/slick.min.js', array( 'jquery' ), STM_THEME_VERSION, true );
	wp_register_script( 'stm-datetimepicker', get_template_directory_uri() . '/assets/js/jquery.datetimepicker.js', array( 'jquery' ), STM_THEME_VERSION, true );
	wp_register_script( 'stm-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), STM_THEME_VERSION, true );
	wp_register_script( 'stm-count-up', get_template_directory_uri() . '/assets/js/countUp.min.js', array( 'jquery' ), STM_THEME_VERSION, true );

	/* Enqueue Scripts */
	wp_enqueue_script( 'jquery-effects-core' );
	wp_enqueue_script( 'stm-slick' );
	wp_enqueue_script( 'stm-select2', get_template_directory_uri() . '/assets/js/select2.min.js', array( 'jquery' ), STM_THEME_VERSION, true );
	wp_enqueue_script( 'stm-bootstrap');
	wp_enqueue_script( 'stm-script', get_template_directory_uri() . '/assets/js/script.js', array( 'jquery' ), STM_THEME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'stm_scripts' );

function stm_admin_scripts() {
	wp_enqueue_style( 'stm-admin-style', get_template_directory_uri() . '/assets/css/admin.css', null, STM_THEME_VERSION, 'all' );
	wp_enqueue_style( 'stm-admin-fonticonpicker', get_template_directory_uri() . '/assets/css/jquery.fonticonpicker.min.css', null, STM_THEME_VERSION, 'all' );
	wp_enqueue_style( 'stm-admin-fonticonpicker-bootstrap', get_template_directory_uri() . '/assets/css/jquery.fonticonpicker.bootstrap.min.css', null, STM_THEME_VERSION, 'all' );
	wp_enqueue_style( 'stm-admin-hc-icons', get_template_directory_uri() . '/assets/css/font-hc.css', null, STM_THEME_VERSION, 'all' );
	wp_enqueue_style( 'stm-admin-linear-icons', get_template_directory_uri() . '/assets/css/linearicons.css', null, STM_THEME_VERSION, 'all' );

	wp_enqueue_script( 'stm-admin-fonticonpicker', get_template_directory_uri() . '/assets/js/jquery.fonticonpicker.min.js', array( 'jquery' ), STM_THEME_VERSION, true );
}

add_action( 'admin_enqueue_scripts', 'stm_admin_scripts' );

// Widgets Init
function stm_widgets_init() {
	require get_template_directory() . '/inc/widgets/widgets.php';
	register_widget( 'STM_About_Widget' );
	register_widget( 'STM_Contact_Widget' );
	register_widget( 'STM_Recent_Posts' );
	register_widget( 'STM_Event_Details' );
	register_widget( 'STM_Event_Contacts' );
	register_widget( 'STM_Event_Info' );
	register_widget( 'STM_Widget_Pages' );

	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'healthcoach' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Blog sidebar that appears on the left/right.', 'healthcoach' ),
		'before_widget' => '<div id="%1$s" class="widget widget_type_blog %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Event Sidebar', 'healthcoach' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Event sidebar that appears on the left/right.', 'healthcoach' ),
		'before_widget' => '<div id="%1$s" class="event-widget widget widget_type_event %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'healthcoach' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Appears in the footer section of the site.', 'healthcoach' ),
		'before_widget' => '<div id="%1$s" class="widget widget_type_shop %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widgets - Column 1', 'healthcoach' ),
		'id'            => 'footer-widget-col-1',
		'description'   => __( 'Appears in the footer section of the site.', 'healthcoach' ),
		'before_widget' => '<div id="%1$s" class="widget widget_type_footer %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widgets - Column 2', 'healthcoach' ),
		'id'            => 'footer-widget-col-2',
		'description'   => __( 'Appears in the footer section of the site.', 'healthcoach' ),
		'before_widget' => '<div id="%1$s" class="widget widget_type_footer %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widgets - Column 3', 'healthcoach' ),
		'id'            => 'footer-widget-col-3',
		'description'   => __( 'Appears in the footer section of the site.', 'healthcoach' ),
		'before_widget' => '<div id="%1$s" class="widget widget_type_footer %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widgets - Column 4', 'healthcoach' ),
		'id'            => 'footer-widget-col-4',
		'description'   => __( 'Appears in the footer section of the site.', 'healthcoach' ),
		'before_widget' => '<div id="%1$s" class="widget widget_type_footer %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'stm_widgets_init' );

// WP Title
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function stm_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}

	add_action( 'wp_head', 'stm_render_title' );
}

// Favicon
if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
	function stm_site_icon() {
		if ( $favicon = stm_option( 'favicon', false, 'url' ) ) {
			echo '<link rel="shortcut icon" type="image/x-icon" href="' . esc_url( $favicon ) . '" />' . "\n";
		} else {
			echo '<link rel="shortcut icon" type="image/x-icon" href="' . get_template_directory_uri() . '/assets/images/tmp/favicon.ico" />' . "\n";
		}
	}

	add_action( 'wp_head', 'stm_site_icon' );
}

// Requires
require_once get_template_directory() . '/inc/redux-framework/admin-init.php';
require_once get_template_directory() . '/inc/tgm/tgm-plugin-registration.php';

if ( defined( 'WPB_VC_VERSION' ) ) {
	require_once get_template_directory() . '/inc/visual-composer/visual-composer.php';
}

require_once get_template_directory() . '/inc/custom.php';

if ( class_exists( 'WooCommerce' ) ) {
	require_once get_template_directory() . '/inc/woocommerce-hooks.php';
}