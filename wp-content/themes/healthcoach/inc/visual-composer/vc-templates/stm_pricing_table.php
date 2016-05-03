<?php
$output  = '';

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

if( ! empty( $title_style ) ) {
    $title_styles = 'style=' . implode( ';', $title_style ) . '';
}

// Price styles

$price_style = array();
$price_styles = '';

if( $price_font_weight ) {
    $price_style[] = 'font-weight:' . $price_font_weight;
}

if( $price_font_size ) {
    $price_style[] = 'font-size:' . $price_font_size;
}

if( $price_color ) {
    $price_style[] = 'color:' . $price_color;
}

if( ! empty( $price_style ) ) {
    $price_styles = 'style=' . implode( ';', $price_style ) . '';
}

// Price description styles

$price_desc_style = array();
$price_desc_styles = '';

if( $price_desc_font_weight ) {
    $price_desc_style[] = 'font-weight:' . $price_desc_font_weight;
}

if( $price_desc_font_size ) {
    $price_desc_style[] = 'font-size:' . $price_desc_font_size;
}

if( $price_desc_color ) {
    $price_desc_style[] = 'color:' . $price_desc_color;
}

if( ! empty( $price_desc_style ) ) {
    $price_desc_styles = 'style=' . implode( ';', $price_desc_style ) . '';
}

// Head styles

$sep_style = array();
$sep_styles = '';

if( $sep_border ) {
    $sep_style[] = 'border-bottom:' . $sep_border_width . ' ' . $sep_border . ' ' . $sep_border_color . '';
}

if( ! empty( $sep_style ) ) {
    $sep_styles = 'style=' . implode( ';', $sep_style ) . '';
}

// Content styles

$content_style = array();
$content_styles = '';

if( $content_font_size ) {
    $content_style[] = 'font-size:' . $content_font_size;
}

if( $content_color ) {
    $content_style[] = 'color:' . $content_color;
}

if( ! empty( $content_style ) ) {
    $content_styles = 'style=' . implode( ';', $content_style ) . '';
}

// Button
$button = vc_build_link( $button );

if( $button['url'] ) {
    if( ! $button['target']  ) {
        $button['target'] = '_self';
    }
}

$output .= '<div class="pricing-table'. esc_attr( $css_class ) .'" ' . esc_attr( $style ) .'>';
$output .= '<div class="pricing-table-inner">';
$output .= '<div class="pricing-table__head">';

if( ! empty( $title ) ) {
    $output .= '<h5 class="pricing-table__title" ' . esc_attr( $title_styles ) . '>' . esc_html( $title ) . '</h5>';
}

if( ! empty( $price ) ) {
    $output .= '<div class="pricing-table__price-section">';
    $output .= '<h2 class="pricing-table__price" ' . esc_attr( $price_styles ) . '>' . esc_html( $price ) . '</h2>';
    if( !empty( $price_desc ) ) {
        $output .= '<div class="pricing-table__desc" ' . esc_attr( $price_desc_styles ) . '>' . esc_html( $price_desc ) . '</div>';
    }
    $output .= '</div>';
}

$output .= '</div>';
$output .= '<div class="pricing-table__separator" '. esc_attr( $sep_styles ) .'></div>';
if( ! empty( $content ) ) {
    $output .= '<div class="pricing-table__content"' . esc_attr( $content_styles ) . '>' . wpb_js_remove_wpautop( $content, true ) . '</div>';
}

if( ! empty( $button['url'] ) ) {
    $output .= '<div class="pricing-table__footer">';
    $output .= '<a href="' . esc_url( $button['url'] ) . '" class="btn btn_view_primary btn_type_outline" target="' . esc_attr( $button['target'] ) . '">' . esc_html( $button['title'] ) . '</a>';
    $output .= '</div>';
}

$output .= '</div>';
if( $label_enable ) {
    $output .= '<div class="pricing-table__label"><span class="pricing-table__label-text">' . esc_html( $label_text ) . '</span></div>';
}
$output .= '</div>';

echo $output;