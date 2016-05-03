<?php
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* Styles */

// VC Styles
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );


// Caption Title Styles
$title_styles = array();
$title_style = '';

if( !empty( $title_font_size ) ) {
    $itle_styles[] = 'font-size:' . $title_font_size;
}

if( !empty( $title_color ) ) {
    $title_styles[] = 'color:' . $title_color;
}

if( !empty( $title_styles ) ) {
    $title_style = 'style="' . implode( ';', $title_styles ) . '"';
}

// Caption Styles
$image_wrap_styles = array();
$image_wrap_style = '';

if( !empty( $border_style ) && $border_style != 'none' ) {
    $image_wrap_styles[] = 'border-style:' . $border_style;

    if( !empty( $border_width ) ) {
        $image_wrap_styles[] = 'border-width:' . $border_width;
    }

    if( !empty( $border_color ) ) {
        $image_wrap_styles[] = 'border-color:' . $border_color;
    }
}

if( !empty( $image_wrap_styles ) ) {
    $image_wrap_style = 'style=' . implode( ';', $image_wrap_styles ) . '';
}

$photo_before_id = get_post_meta( get_the_ID(), 'testimonial_photo_before', true );
$photo_after_id = get_post_meta( get_the_ID(), 'testimonial_photo_after', true );

if( $photo_before_id ) {
    $photo_before = wpb_getImageBySize( array(
        'attach_id'  => $photo_before_id,
        'thumb_size' => '360x340'
    ) );
}

if( $photo_after_id ) {
    $photo_after = wpb_getImageBySize( array(
        'attach_id'  => $photo_after_id,
        'thumb_size' => '360x340'
    ) );
}

$output .= '<div class="personal-result-photo' . esc_attr( $css_class ) . '">';
$output .= '<div class="personal-result-photo-inner clearfix">';
if( isset( $photo_before ) ) {
    $output .= '<div class="result-photo result-photo_before">';
    $output .= '<div class="result-photo-inner">';
    $output .= wp_kses( $photo_before['thumbnail'], array( 'img' => array( 'src' => array(), 'width' => array(), 'height' => array() ) ) );
    $output .= '<div class="result-photo__caption">';
    $output .= '<div class="result-photo__caption-title">'. __( 'Before', 'healthcoach' ) .'</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
}
if( isset( $photo_after ) ) {
    $output .= '<div class="result-photo result-photo_after">';
    $output .= '<div class="result-photo-inner">';
    $output .= wp_kses( $photo_after['thumbnail'], array( 'img' => array( 'src' => array(), 'width' => array(), 'height' => array() ) ) );
    $output .= '<div class="result-photo__caption">';
    $output .= '<div class="result-photo__caption-title">'. __( 'After', 'healthcoach' ) .'</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
}
$output .= '</div>';
$output .= '</div>';

echo $output;