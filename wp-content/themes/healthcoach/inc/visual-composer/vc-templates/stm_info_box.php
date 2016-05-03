<?php
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$styles = array();
$style = '';

if( $text_align ) {
    $styles[] = 'text-align:' . $text_align;
}

if( !empty( $styles ) ) {
    $style = 'style=' . implode( ';', $styles ) . '';
}

// Title styles

$title_style = array();
$title_styles = '';

if( $title_font_weight ) {
    $title_style[] = 'font-weight:' . $title_font_weight;
}

if( $title_font_size ) {
    $title_style[] = 'font-size:' . $title_font_size;
}

if( $title_color ) {
    $title_style[] = 'color:' . $title_color;
}

if( $title_margin_bot ) {
    $title_style[] = 'margin-bottom:' . $title_margin_bot;
}

if( !empty( $title_style ) ) {
    $title_styles = 'style=' . implode( ';', $title_style ) . '';
}

// Separator styles

$sep_wrap_style = array();
$sep_wrap_styles = '';

if( $sep_width ) {
    $sep_wrap_style[] = 'width:' . $sep_width;
}

if( $text_align == 'center' ) {
    $sep_wrap_style[] = 'margin-right:auto';
    $sep_wrap_style[] = 'margin-left:auto';
}

if( $sep_margin_bot ) {
    $sep_wrap_style[] = 'margin-bottom:' . $sep_margin_bot;
}

if( $text_align == 'right' ) {
    $sep_wrap_style[] = 'float:right';
}

if( !empty( $sep_wrap_style ) ) {
    $sep_wrap_styles = 'style=' . implode( ';', $sep_wrap_style ) . '';
}

$sep_css_style = array();
$sep_css_styles = '';

if( !empty( $sep_style ) && $sep_style != 'none' ) {

    $sep_css_style[] = 'border-bottom-style:'. $sep_style;

    if( $sep_height ) {
        $sep_css_style[] = 'border-bottom-width:' . $sep_height;
    }

    if( !empty( $sep_color ) && $sep_color_type == 'custom' ) {
        $sep_css_style[] = 'border-bottom-color:' . $sep_color;
    }
}

if( !empty( $sep_css_style ) ) {
    $sep_css_styles = 'style=' . implode( ';', $sep_css_style ) . '';
}

$sep_classes = array();
$sep_class = '';

if( $sep_color_type == 'primary' ) {
    $sep_classes[] = 'primary-border-color';
}

if( !empty( $sep_classes ) ) {
    $sep_class = ' ' . implode( ' ', $sep_classes );
}

// Icon Styles

$icon_wrap_style = array();
$icon_wrap_styles = '';

if( $icon_margin_bot ) {
    $icon_wrap_style[] = 'margin-bottom:' . $icon_margin_bot;
}

if( $icon_size ) {
    $icon_wrap_style[] = 'font-size:' . $icon_size;
}

if( $icon_color ) {
    $icon_wrap_style[] = 'color:' . $icon_color;
}

if( !empty( $icon_wrap_style ) ) {
    $icon_wrap_styles = 'style=' . implode( ';', $icon_wrap_style ) . '';
}

$icon_styles = array();
$icon_style = '';

if( $icon_border != 'none' && !empty( $icon_border ) ) {
    $icon_styles[] = 'border-style:' . $icon_border;

    if( $icon_border_width ) {
        $icon_styles[] = 'border-width:' . $icon_border_width;
    }

    if( $icon_border_color_type == 'custom' && !empty( $icon_border_color ) ) {
        $icon_styles[] = 'border-color:' . $icon_border_color;
    }
}

if( $icon_border_radius ) {
    $icon_styles[] = 'border-radius:' . $icon_border_radius;
}

if( !empty( $icon_styles ) ) {
    $icon_style = 'style=' . implode( ';', $icon_styles ) . '';
}


$icon_classes = array();
$icon_class = '';

// Separator styles

$desc_style = array();
$desc_styles = '';

if( $desc_font_size ) {
    $desc_style[] = 'font-size:' . $desc_font_size;
}

if( $desc_font_weight ) {
    $desc_style[] = 'font-weight:' . $desc_font_weight;
}

if( $desc_color ) {
    $desc_style[] = 'color:' . $desc_color;
}

if( !empty( $desc_style ) ) {
    $desc_styles = 'style=' . implode( ';', $desc_style ) . '';
}

// Icon
$icon = '';

if( $icon_type == 'custom_image' && ! empty( $image_id ) ) {
    $icon = wp_get_attachment_image( $image_id, 'full', false, $icon_style );
}

if( $icon_type == 'icon' && ! empty( $font_icon ) ) {
    $icon = '<span class="' . esc_attr( $font_icon ) . '"></span>';
}

if( $box_featured ) {
    $box_classes = ' stm-info-box-featured';
}

$output .= '<div class="stm-info-box'. ( ( isset( $box_classes ) ) ? $box_classes : '' ) .''. esc_attr( $css_class ) .'" '. esc_attr( $style ) .'>';
if( $box_style == 'top' ) {
    $output .= '<div class="stm-info-box-icon" ' . esc_attr( $icon_wrap_styles ) . '>' . $icon . '</div>';
}
$output .= '<div class="stm-info-box-body">';
if( !empty( $title ) ) {
    $output .= '<'. esc_html( $title_tag ) .' class="stm-info-box-title" ' . esc_attr( $title_styles ) . '>' . esc_html( $title ) . '</'. esc_html( $title_tag ) .'>';
}

if( $box_style == 'between' ) {
    $output .= '<div class="stm-info-box-icon" ' . esc_attr( $icon_wrap_styles ) . '>' . $icon . '</div>';
}
if( $sep_style != 'none' ) {
    $output .= '<div class="clearfix" ' . esc_attr( $sep_wrap_styles ) . '><div class="stm-info-box-sep'. $sep_class .'" ' . esc_attr( $sep_css_styles ) . '></div></div>';
}
if( !empty( $content ) ) {
    $output .= '<div class="stm-info-box-content" ' . esc_attr( $desc_styles ) . '>' . wpb_js_remove_wpautop( $content, true ) . '</div>';
}
$output .= '</div>';
$output .= '</div>';

echo $output;