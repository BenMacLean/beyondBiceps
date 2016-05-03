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

if( !empty( $text_align ) ) {
    $styles[] = 'text-align:' . $text_align;
}

if( !empty( $styles ) ) {
    $style = 'style=' . implode( ';', $styles ) . '';
}

// Title Styles

$title_style = array();
$title_styles = '';

if( !empty( $title_font_weight ) ) {
    $title_style[] = 'font-weight:' . $title_font_weight;
}

if( !empty( $title_font_size ) ) {
    $title_style[] = 'font-size:' . $title_font_size;
}

if( !empty( $title_color ) ) {
    $title_style[] = 'color:' . $title_color;
}

if( !empty( $title_padd_left ) ) {
    $title_style[] = 'padding-left:' . $title_padd_left;
}

if( !empty( $title_padd_right ) ) {
    $title_style[] = 'padding-right:' . $title_padd_right;
}

if( !empty( $title_style ) ) {
    $title_styles = 'style=' . implode( ';', $title_style ) . '';
}

// Icon Styles

$icon_style = array();
$icon_styles = '';

if( !empty( $icon_font_size ) ) {
    $icon_style[] = 'font-size:' . $icon_font_size;
}

if( !empty( $icon_color ) ) {
    $icon_style[] = 'color:' . $icon_color;
}

if( !empty( $icon_min_height ) ) {
    $icon_style[] = 'height:' . $icon_min_height;
}

if( !empty( $icon_margin_bot ) && $box_style == 'icon-top' ) {
    $icon_style[] = 'margin-bottom:' . $icon_margin_bot;
}

if( !empty( $icon_style ) ) {
    $icon_styles = 'style=' . implode( ';', $icon_style ) . '';
}

// Text Wrap Styles

$text_wrap_style = array();
$text_wrap_styles = '';

if( !empty( $text_circle_size ) ) {
    $text_wrap_style[] = 'height:' . $text_circle_size;
    $text_wrap_style[] = 'width:' . $text_circle_size;
}

if( !empty( $text_border ) && $text_border != 'custom' ) {
    $text_wrap_style[] = 'border:' . $text_border_width . ' ' . $text_border . ' ' . $text_border_color . '';
}

if( $text_align == 'center' ) {
    $text_wrap_style[] = 'margin-right:auto';
    $text_wrap_style[] = 'margin-left:auto';
}

if( !empty( $text_margin_bot ) ) {
    $text_wrap_style[] = 'margin-bottom:' . $text_margin_bot;
}

if( ! empty( $text_wrap_style ) ) {
    $text_wrap_styles = 'style=' . implode( ';', $text_wrap_style ) . '';
}

// Custom circle
$custom_circle_styles = array();
$custom_circle_style = '';

if( !empty( $text_circle_size ) ) {
    $custom_circle_styles[] = 'font-size:' . $text_circle_size;
}

if( !empty( $text_border_color ) ) {
    $custom_circle_styles[] = 'color:' . $text_border_color;
}

if( !empty( $custom_circle_styles ) ) {
    $custom_circle_style = 'style=' . implode( ';', $custom_circle_styles ) . '';
}

// Text Styles
$text_style = array();
$text_styles = '';

if( !empty( $text_font_weight ) ) {
    $text_style[] = 'font-weight:' . $text_font_weight;
}

if( !empty( $text_font_size ) ) {
    $text_style[] = 'font-size:' . $text_font_size;
}

if( !empty( $text_color ) ) {
    $text_style[] = 'color:' . $text_color;
}

if( !empty( $text_style ) ) {
    $text_styles = 'style=' . implode( ';', $text_style ). '';
}

// Icon Circle
$icon_circle_styles = array();
$icon_circle_style = '';

if( !empty( $icon_circle_size ) ) {
    $icon_circle_styles[] = 'height:' . $icon_circle_size;
    $icon_circle_styles[] = 'width:' . $icon_circle_size;
    $icon_circle_styles[] = 'line-height:' . $icon_circle_size;
    $icon_circle_styles[] = 'border-radius:50%';
}

if( !empty( $icon_bg_color ) ) {
    $icon_circle_styles[] = 'background-color:' . $icon_bg_color;
}

if( !empty( $icon_border ) ) {
    $icon_circle_styles[] = 'border-style:' . $icon_border;
}

if( !empty( $icon_border_width ) ) {
    $icon_circle_styles[] = 'border-width:' . $icon_border_width;
}

if( !empty( $icon_border_color ) ) {
    $icon_circle_styles[] = 'border-color:' . $icon_border_color;
}

if( !empty( $icon_circle_styles ) ) {
    $icon_circle_style = 'style=' . implode( ';', $icon_circle_styles ) . '';
}

// Icon
$icon = '';
if( $icon_type == 'custom_image' && !empty( $image_id ) ) {
    $icon = wp_get_attachment_image( $image_id, 'full' );
}

if( $icon_type == 'icon' && !empty( ${'icon_'.$font_icon_type} ) ) {
    $icon = '<i class="' . esc_attr( ${'icon_'.$font_icon_type} ) . '" '. esc_attr( $icon_circle_style ) .'></i>';
}

$output .= '<div class="icon-box icon-box_type_' . esc_attr( $box_style ) . ''. esc_attr( $css_class ) .'" '. esc_attr( $style ) .'>';
$output .= '<div class="icon-box-inner">';

if( $icon_type == 'text' && !empty( $text ) && $box_style != 'icon-right' ) {
    $output .= '<div class="icon-box__text-wrap" ' . esc_attr( $text_wrap_styles ) . '>';
    $output .= '<div class="icon-box__text-inner">';
    $output .= '<h3 class="icon-box__text" '. esc_attr( $text_styles ) .'>' . esc_html( $text ) . '</h3>';
    $output .= '</div>';
    if( !empty( $text_border ) && $text_border == 'custom' ) {
        $output .= '<div class="icon-box__text_border_custom-circle" '. esc_attr( $custom_circle_style ) .'><i class="hc-icon-circle"></i></div>';
    }
    $output .= '</div>';
}

if( !empty( $icon ) && $box_style != 'icon-right' ) {
    $output .= '<div class="icon-box__icon" ' . esc_attr( $icon_styles ) . '>';
    if( $box_style == 'icon-top' ) {
        $output .= '<div class="icon-box__icon-inner">' . $icon . '</div>';
    } else {
        $output .= $icon;
    }
    $output .= '</div>';
}

if( !empty( $title ) ) {
    $output .= '<div class="icon-box__body">';
    $output .= '<h5 class="icon-box__title" ' . esc_attr( $title_styles ) . '>' . esc_html( $title ) . '</h5>';
    $output .= '</div>';
}

if( $icon_type == 'text' && !empty( $text ) && $box_style == 'icon-right' ) {
    $output .= '<div class="stm-icon-box-text-wrap" ' . esc_attr( $text_wrap_styles ) . '>';
    $output .= '<div class="stm-icon-box-text-inner">';
    $output .= '<span class="stm-icon-box-text">' . esc_html( $text ) . '</span>';
    $output .= '</div>';
    $output .= '</div>';
}

if( !empty( $icon ) && $box_style == 'icon-right' ) {
    $output .= '<div class="icon-box__icon" ' . esc_attr( $icon_styles ) . '>' . $icon . '</div>';
}

$output .= '</div>';
$output .= '</div>';

echo $output;