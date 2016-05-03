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
?>
<?php if( function_exists( 'mc4wp_form' ) ) : ?>
    <div class="subscribe subscribe_type_primary subscribe-inline<?php echo esc_attr( $css_class ); ?>" <?php echo esc_attr( $style ); ?>>
        <?php mc4wp_show_form(); ?>
    </div>
<?php endif; ?>
