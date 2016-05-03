<?php
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

wp_enqueue_script( 'stm-fancybox' );
wp_enqueue_style( 'stm-fancybox' );
wp_enqueue_script( 'stm-fancybox-thumbs' );
wp_enqueue_style( 'stm-fancybox-thumbs' );

$styles = array();
$style = '';

if( !empty( $styles ) ) {
    $style = 'style=' . implode( ';', $styles ) . '';
}

if( !empty( $image_size ) ) {
    $img_size = $image_size;
} else {
    $img_size = '512x324';
}

$fancybox = uniqid("image-gallery__fancybox-");

$images = explode( ',', $images );

$output .= '<div class="image-gallery'. esc_attr( $css_class ) .'" '. esc_attr( $style ) .'>';
$output .= '<div class="row">';
foreach ( $images as $attach_id ) {
    if ( $attach_id > 0 ) {
        $post_thumbnail = wpb_getImageBySize( array(
            'attach_id'  => $attach_id,
            'thumb_size' => $img_size
        ) );
    }
    if( $cols == 2 ) {
        $col_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
    } elseif( $cols == 3 ) {
        $col_class = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
    } else {
        $col_class = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
    }

    $output .= '<div class="' . esc_attr( $col_class ) . '">';
    $output .= '<a class="' . esc_attr( $fancybox ) . '" rel="' . esc_attr( $fancybox ) . '" href="'. esc_url( $post_thumbnail['p_img_large'][0] ) .'">' . wp_kses( $post_thumbnail['thumbnail'], array( 'img' => array( 'src' => array(), 'width' => array(), 'height' => array() ) ) ) . '</a>';
    $output .= '</div>';
}
$output .= '</div>';
$output .= '</div>';
$output .= '<script>
    jQuery(document).ready(function($) {
        "use strict";
        var fancyboxId = ".' . esc_js( $fancybox ) . '";

        if( $( fancyboxId ).length ) {
            $( fancyboxId ).fancybox({
                prevEffect: "fade",
                nextEffect: "fade",
                helpers	: {
                    thumbs	: {
                        width	: 50,
                        height	: 50
                    }
                }
            });
        }
    });
</script>';

echo $output;