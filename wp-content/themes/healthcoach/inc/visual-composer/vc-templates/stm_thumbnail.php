<?php
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if( !empty( $thumbnail_size ) ) {
    $image_size = $thumbnail_size;
} else {
    $image_size = '382x374';
}

$attach_id = get_post_thumbnail_id();

if( $attach_id > 0 ) {
    $attach_image = wpb_getImageBySize( array(
        'attach_id'  => $attach_id,
        'thumb_size' => $image_size
    ) );
}

?>

<?php if( isset( $attach_image ) ) : ?>
    <div class="single-thumbnail<?php echo esc_attr( $css_class ); ?>"><?php echo wp_kses( $attach_image['thumbnail'], array( 'img' => array( 'src' => array(), 'width' => array(), 'height' => array() ) ) ); ?></div>
<?php endif; ?>


