<?php
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
add_action( 'stm_wc_sale_flash', 'woocommerce_show_product_sale_flash', 10);

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);


remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 35);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 40);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 50);

add_action('stm_wc_title_section', 'woocommerce_template_single_title', 5);

add_action('stm_wc_price_section', 'woocommerce_template_single_price', 5);
add_action('stm_wc_price_section', 'woocommerce_template_single_rating', 10);

add_action('woocommerce_before_main_content', 'stm_wc_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'stm_wc_wrapper_end', 10);

function stm_wc_wrapper_start() {
    $product_single_sidebar = stm_option( 'single_product_sidebar' );
    $shop_sidebar = stm_option( 'shop_sidebar' );
    $products_columns = stm_option( 'products_columns' );

    if( is_shop() || is_archive() ) {
        echo '<section class="main">';
        echo '<div class="woocommerce woocommerce-shop columns-'. esc_attr( $products_columns ) .'">';
    } else {
        echo '<section class="main">';
        echo '<div class="woocommerce woocommerce-page '. ( ($product_single_sidebar != 'hide') ? esc_attr('has-sidebar') : '' ) .'">';
    }

    echo '<div class="container">';
}

function stm_wc_wrapper_end() {
    echo '</div>';
    echo '</div>';
    echo '</section>';
}

function stm_wc_products_count() {
    $products_count = stm_option('products_count');

    add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $products_count . ';' ), 20 );
}
add_action('init', 'stm_wc_products_count');

add_filter( 'woocommerce_add_to_cart_fragments', 'stm_cart_fragments' );
function stm_cart_fragments() {
	ob_start();
	?>
	<span class="user-menu__text_cart_count">
	<?php echo WC()->cart->get_cart_contents_count(); ?>
	</span>
	<?php

	$fragments['.user-menu__text_cart_count'] = ob_get_clean();

	return $fragments;
}