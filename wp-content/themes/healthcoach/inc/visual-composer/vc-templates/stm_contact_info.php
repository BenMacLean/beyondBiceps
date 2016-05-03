<?php
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$styles = array();
$style = '';

if( !empty($styles) ) {
    $style = 'style=' . implode( ';', $styles ) . '';
}

$output .= '<div class="contact-info contact-info_two_columns '. esc_attr( $css_class ) .'"'. esc_attr( $style ) .'>';
$output .= '<ul class="contact-info__list">';
if( ! empty( $time ) ) {
    $output .= '<li class="contact-info__list-item contact-info__list-item_icon contact-info__list-item_icon-time">'. wp_kses( $time, array('strong' => array()) ) .'</li>';
}
if( ! empty( $address ) ) {
    $output .= '<li class="contact-info__list-item contact-info__list-item_icon contact-info__list-item_icon-address">'. wp_kses( $address, array('strong' => array(), 'br' => array()) ) .'</li>';
}
$output .= '</ul>';
$output .= '<ul class="contact-info__list">';
if( ! empty( $email ) ) {
    $output .= '<li class="contact-info__list-item contact-info__list-item_icon contact-info__list-item_icon-email"><a href="mailto:'. esc_attr( $email ) .'">'. esc_html( $email ) .'</a></li>';
}
if( ! empty( $phone ) ) {
    $phone_array = explode( ';', $phone );
    $output .= '<li class="contact-info__list-item contact-info__list-item_icon contact-info__list-item_icon-phone"></i>';
    foreach( $phone_array as $phone_val ) {
        $output .= '<p>' . esc_html( $phone_val ) . '</p>';
    }
    $output .= '</li>';
}
$output .= '</ul>';
$output .= '</div>';

echo $output;