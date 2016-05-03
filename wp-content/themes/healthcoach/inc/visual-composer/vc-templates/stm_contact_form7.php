<?php
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$styles = array();
$style = '';

if( !empty( $container_border_radius ) ) {
    $container_border_radius_arr = explode( ';', $container_border_radius );

    $styles[] = 'border-radius:' . implode( ' ', $container_border_radius_arr );
}

if( !empty( $styles ) ) {
    $style = 'style=' . esc_attr( implode( ';', $styles ) ) . '';
}

$output .= '<div class="wpcf7-form-container'. esc_attr( $css_class ) .'" '. esc_attr( $style ) .'>';
$output .= do_shortcode( '[contact-form-7 id="' . esc_attr( $form_id ) . '"]' );
$output .= '</div>';

echo $output;