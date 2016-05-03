<?php
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$styles = array();
$style = '';

if( !empty( $styles ) ) {
    $style = 'style=' . implode( ';', $styles ) . '';
}

$icon_styles = array();
$icon_style = '';

if( !empty( $icon_size ) ) {
    $icon_styles[] = 'font-size:' . $icon_size;
}

if( !empty( $icon_styles ) ) {
    $icon_style = 'style=' . implode( ';', $icon_styles ) . '';
}

$box_inner_style = '';
$box_inner_styles = array();

if( !empty( $box_height ) && $info_box_type == 'boxed' || !empty( $box_height ) && $info_box_type == 'boxed-2' ) {
    $box_inner_styles[] = 'height:' . $box_height;
}

if( !empty( $box_inner_styles ) ) {
    $box_inner_style = 'style=' . implode( ';', $box_inner_styles ) . '';
}

$info_box_modifiers = array();
$info_box_modifier = '';

if( !empty( $info_box_type ) ) {
    $info_box_modifiers[] = 'info-box_type_' . $info_box_type;
}

if( $box_featured ) {
    $info_box_modifiers[] = 'info-box_view_featured';
}

if( !empty( $info_box_modifiers ) ) {
    $info_box_modifier = implode( ' ', $info_box_modifiers );
}

$output .= '<div class="info-box '. esc_attr( $info_box_modifier ) .''. esc_attr( $css_class ) .'"'. esc_attr( $style ) .'>';
$output .= '<div class="info-box__inner" '. esc_attr( $box_inner_style ) .'>';
if( !empty( ${'icon_'.$icon_type} ) ) {
    $output .= '<div class="info-box__icon" ' . esc_attr( $icon_style ) . '><i class="' .esc_attr( ${'icon_' . $icon_type} ) . '"></i></div>';
}

if( !empty( $title ) ) {
    if( $info_box_type == 'boxed-2' ) {
        $output .= '<h5 class="info-box__title">' . esc_html( $title ) . '</h5>';
    }
    if( $info_box_type == 'boxed' ) {
        $output .= '<h4 class="info-box__title">' . esc_html( $title ) . '</h4>';
    }
}
if( !empty( $content ) ) {
    $output .= '<div class="info-box__desc">';
    if( $info_box_type == 'boxed-2' ) {
        $output .= '<span class="info-box__desc-dots"><span class="info-box__desc-dot info-box__desc-dot_first"></span><span class="info-box__desc-dot info-box__desc-dot_second"></span><span class="info-box__desc-dot info-box__desc-dot_third"></span></span>';
    }
    $output .= wpb_js_remove_wpautop( $content, true );
    $output .= '</div>';
}
$output .= '</div>';
$output .= '</div>';

echo $output;