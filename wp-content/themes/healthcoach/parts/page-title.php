<?php
/* Page ID */
$page_id = $hero_icon = $hero_icon_position = '';

if( ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product_category' ) && is_product_category() ) ) {
    $page_id = wc_get_page_id( 'shop' );
} else if( is_home() ) {
    $page_id = get_option('page_for_posts');
} else {
    $page_id = get_the_ID();
}

/* Options */
$hero_title = get_post_meta( $page_id, 'hero_title', true );
$hero_title_disable = get_post_meta( $page_id, 'hero_title_display', true );
$hero_title_color = get_post_meta( $page_id, 'hero_title_color', true );
$hero_bg_image_id = get_post_meta( $page_id, 'hero_bg_image', true );
$hero_bg_color = get_post_meta( $page_id, 'hero_bg_color', true );

$hero_icon_disable = get_post_meta( $page_id, 'hero_icon_disable', true );

if( get_post_meta( $page_id, 'hero_icon', true ) ) {
    $hero_icon = get_post_meta( $page_id, 'hero_icon', true );
} elseif( stm_option('hero_icon') ) {
    $hero_icon = stm_option('hero_icon');
}

$hero_icon_spacing = get_post_meta( $page_id, 'hero_icon_spacing', true );

if( get_post_meta( $page_id, 'hero_icon_position', true ) ) {
    $hero_icon_position = get_post_meta( $page_id, 'hero_icon_position', true );
} elseif ( stm_option('hero_icon_position') ) {
    $hero_icon_position = stm_option('hero_icon_position');
}

$hero_icon_color = get_post_meta( $page_id, 'hero_icon_color', true );
$hero_icon_size = get_post_meta( $page_id, 'hero_icon_size', true );
$hero_margin_bot = get_post_meta( $page_id, 'hero_margin_bot', true );
$hero_padd_top = get_post_meta( $page_id, 'hero_padd_top', true );
$hero_padd_bot = get_post_meta( $page_id, 'hero_padd_bot', true );
$stm_page_bump_enable = get_post_meta( $page_id, 'stm_page_bump_enable', true );


/* Styles */

/* Hero styles */
$hero_wrapper_styles = array();
$hero_wrapper_style = '';

if( !empty( $hero_bg_image_id ) ) {
    $hero_bg_image = wp_get_attachment_image_src( $hero_bg_image_id, 'full' );
    $hero_wrapper_styles[] = 'background-image:url("' . $hero_bg_image[0] . '")';
}

if( !empty( $hero_bg_color ) ) {
    $hero_wrapper_styles[] = 'background-color:' . $hero_bg_color;
}

if( !empty( $hero_wrapper_styles ) ) {
    $hero_wrapper_style = 'style=' . implode( ';', $hero_wrapper_styles ) . '';
}

$hero_styles = array();
$hero_style = '';

if( !empty( $hero_margin_bot ) ) {
    $hero_styles[] = 'margin-bottom:' . $hero_margin_bot;
}

if( !empty( $hero_styles ) ) {
    $hero_style = 'style=' . implode( ';', $hero_styles ) . '';
}

$hero_content_styles = array();
$hero_content_style = '';

if( !empty( $hero_padd_top ) ) {
    $hero_content_styles[] = 'padding-top:' . $hero_padd_top;
}

if( !empty( $hero_padd_bot ) ) {
    $hero_content_styles[] = 'padding-bottom:' . $hero_padd_bot;
}

if( !empty( $hero_content_styles ) ) {
    $hero_content_style = 'style=' . implode( ';', $hero_content_styles ) . '';
}

/* Icon styles */
$icon_styles = array();
$icon_style = '';

if( !empty( $hero_icon_size ) ) {
    $icon_styles[] = 'font-size:' . $hero_icon_size;
}

if( !empty( $hero_icon_color ) ) {
    $icon_styles[] = 'color:' . $hero_icon_color;
}

if( !empty( $hero_icon_spacing ) && $hero_icon_position == 'top' ) {
    $icon_styles[] = 'padding-bottom:' . $hero_icon_spacing;
}

if( !empty( $hero_icon_spacing ) && $hero_icon_position == 'bottom' ) {
    $icon_styles[] = 'padding-top:' . $hero_icon_spacing;
}

if( !empty( $icon_styles ) ) {
    $icon_style = 'style=' . implode( ';', $icon_styles ) . '';
}

/* Icon styles */
$title_styles = array();
$title_style = '';

if( !empty( $hero_title_color ) ) {
    $title_styles[] = 'color:' . $hero_title_color;
}

if( !empty( $title_styles ) ) {
    $title_style = 'style=' . implode( ';', $title_styles ) . '';
}

?>
<section class="page-title" <?php echo esc_attr( $hero_style ); ?>>
    <div class="page-title-inner" <?php echo esc_attr( $hero_wrapper_style ); ?>>
        <div class="container">
            <div class="page-title__body" <?php echo esc_attr( $hero_content_style ); ?>>
                <?php if( get_post_type() == 'event' && is_single() ) : ?>
                    <div class="page-title__heading page-title__heading_date_left">
                        <div class="page-title__date">
                            <div class="event__date event__date_size_large">
                                <div class="event__date-day"><?php echo date_i18n('j', strtotime( get_post_meta( get_the_ID(), 'event_date', true ) ) ); ?></div>
                                <div class="event__date-month"><?php echo date_i18n('M', strtotime( get_post_meta( get_the_ID(), 'event_date', true ) ) ); ?><span class="event__date-month_dot">.</span></div>
                                <div class="event__date-bg"><span class="hc-icon-paper"></span></div>
                            </div>
                        </div>
                        <?php the_title('<h2 class="page-title__title" ' . esc_attr( $title_style ). '><span class="page-title__title-inner">', '</span></h2>'); ?>
                    </div>
                <?php else: ?>
                    <?php $show_on_front = get_option('show_on_front'); ?>

                    <?php if( is_home() && $show_on_front == 'posts' && $blog_title = stm_option('blog_title') ) : ?>
                        <?php if( !empty( $hero_icon ) && $hero_icon_position == 'top' ) : ?>
                            <div class="page-title__icon page-title__icon_position_top"><span class="<?php echo esc_attr( $hero_icon ); ?>"></span></div>
                        <?php endif; ?>
                        <h1 class="page-title__title"><?php echo esc_html( $blog_title ); ?></h1>
                        <?php if( !empty( $hero_icon ) && $hero_icon_position == 'bottom' ) : ?>
                            <div class="page-title__icon page-title__icon_position_bottom"><span class="<?php echo esc_attr( $hero_icon ); ?>"></span></div>
                        <?php endif; ?>
						
                    <?php elseif ( is_archive() ) : ?>
						<?php if ( class_exists( 'WooCommerce' ) && is_shop() && apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                            <h1 class="page-title__title" <?php echo esc_attr( $title_style ); ?>><?php woocommerce_page_title(); ?></h1>
						<?php elseif ( class_exists( 'WooCommerce' ) && function_exists( 'is_product_category' ) && is_product_category() ) : ?>
                            <h1 class="page-title__title" <?php echo esc_attr( $title_style ); ?>><?php echo single_cat_title( '', false ); ?></h1>
						<?php else: ?>
							<?php echo '<h1 class="page-title__title" '. esc_attr( $title_style ) .'>'; if( is_category() ) single_cat_title(); else post_type_archive_title(); echo '</h1>'; ?>
							<div class="page-title__icon page-title__icon_position_bottom"><span class="hc-icon-smile"></span></div>
						 <?php endif; ?>
										
                    <?php elseif ( ! $hero_title_disable ) : ?>

                        <?php if( ! $hero_icon_disable && !empty( $hero_icon ) && $hero_icon_position == 'top' ) : ?>
                            <div class="page-title__icon page-title__icon_position_top" <?php echo esc_attr( $icon_style ); ?>><span class="<?php echo esc_attr( $hero_icon ); ?>"></span></div>
                        <?php endif; ?>

                        <?php if ( is_home() ) : ?>
                            <h1 class="page-title__title" <?php echo esc_attr( $title_style ); ?>><?php echo get_the_title( $page_id ); ?></h1>
                        <?php elseif ( class_exists( 'WooCommerce' ) && is_shop() && apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                            <h1 class="page-title__title" <?php echo esc_attr( $title_style ); ?>><?php woocommerce_page_title(); ?></h1>
						<?php elseif ( class_exists( 'WooCommerce' ) && function_exists( 'is_product_category' ) && is_product_category() ) : ?>
                            <h1 class="page-title__title" <?php echo esc_attr( $title_style ); ?>><?php echo single_cat_title( '', false ); ?></h1>
                        <?php else : ?>
                            <h1 class="page-title__title" <?php echo esc_attr( $title_style ); ?>><?php echo get_the_title( $page_id ); ?></h1>
                        <?php endif; ?>

                        <?php if( ! $hero_icon_disable && !empty( $hero_icon ) && $hero_icon_position == 'bottom' ) : ?>
                            <div class="page-title__icon page-title__icon_position_bottom" <?php echo esc_attr( $icon_style ); ?>><span class="<?php echo esc_attr( $hero_icon ); ?>"></span></div>
                        <?php endif; ?>

                    <?php endif; ?>

                <?php endif; ?>
            </div>
        </div>
        <?php if( $stm_page_bump_enable ) : ?>
            <div class="page-title__bump"></div>
        <?php endif; ?>
    </div>
</section>
