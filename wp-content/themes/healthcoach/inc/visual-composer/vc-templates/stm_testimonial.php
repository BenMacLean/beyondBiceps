<?php
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* Styles */
// VC Styles
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

// Custom styles

$styles = array();
$style = '';

if( ! empty( $styles ) ) {
    $style = 'style=' . implode( ';', $styles ) . '';
}

// Icon styles
$icon_styles = array();
$icon_style = '';

if( !empty( $icon_margin ) ) {
    $icon_margin_array = explode( ',', $icon_margin );
    $icon_margin_css = implode( ' ', $icon_margin_array );
    $icon_styles[] = 'margin:' . $icon_margin_css;
}

if( !empty( $icon_padding ) ) {
    $icon_padding_array = explode( ',', $icon_padding );
    $icon_padding_css = implode( ' ', $icon_padding_array );
    $icon_styles[] = 'padding:' . $icon_padding_css;
}

if( !empty( $icon_size ) ) {
    $icon_styles[] = 'font-size:' . $icon_size;
}

if( !empty( $icon_color ) ) {
    $icon_styles[] = 'color:' . $icon_color;
}

if( ! empty( $icon_styles ) ) {
    $icon_style = 'style=' . implode( ';', $icon_styles ) . '';
}

// Author styles
$author_styles = array();
$author_style = '';

if( $author_color ) {
    $author_styles[] = 'color:' . $author_color;
}

if( $author_font_size ) {
    $author_styles[] = 'font-size:' . $author_font_size;
}

if( ! empty( $author_styles ) ) {
    $author_style = 'style=' . implode( ';', $author_styles ) . '';
}

// Text styles
$text_styles = array();
$text_style = '';

if( $text_color ) {
    $text_styles[] = 'color:' . $text_color;
}

if( $text_font_size ) {
    $text_styles[] = 'font-size:' . $text_font_size;
}

if( !empty( $text_margin ) ) {
    $text_margin_array = explode( ',', $text_margin );
    $text_margin_css = implode( ' ', $text_margin_array );
    $text_styles[] = 'margin:' . $text_margin_css;
}

if( ! empty( $text_styles ) ) {
    $text_style = 'style=' . implode( ';', $text_styles ) . '';
}

// Icon
$icon = '';

if( !empty( ${'icon_'.$icon_type} ) ) {
    $icon = '<span class="' . esc_attr( ${'icon_'.$icon_type} ) . '"></span>';
}

// Testimonial classes
$testimonial_classes = array();
$testimonial_class = '';

if( ! empty( $icon_place ) && !empty( $icon ) ) {
    $testimonial_classes[] = 'testimonial_icon-' . $icon_place;
}

if( ! empty( $testimonial_classes ) ) {
    $testimonial_class = ' ' . esc_attr( implode( ' ', $testimonial_classes ) ) . '';
}

$output .= '<div class="testimonial' . $testimonial_class . ''. esc_attr( $css_class ) .' clearfix" '. esc_attr( $style ) .'>';
if( !empty( $icon ) && $icon_place == 'left' || !empty( $icon ) && $icon_place == 'top' ) {
    $output .= '<div class="testimonial__icon" ' . esc_attr( $icon_style ) . '>' . $icon . '</div>';
}
$output .= '<div class="testimonial__content">';
if( $content ) {
    $output .= '<div class="testimonial__content-text" ' . esc_attr( $text_style ) . '>' . wpb_js_remove_wpautop( $content, true ) . '</div>';
}
if( $author ) {
    $output .= '<div class="testimonial__content-author" ' . esc_attr( $author_style ) . '>'. esc_html( $author ) .'</div>';
}
$output .= '</div>';
if( !empty( $icon ) && $icon_place == 'right' || !empty( $icon ) && $icon_place == 'bottom' ) {
    $output .= '<div class="stm-testimonial-icon" ' . esc_attr( $icon_style ) . '>'. $icon .'</div>';
}
$output .= '</div>';

echo $output;