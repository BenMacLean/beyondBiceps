<?php
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$styles = array();
$style = '';

$post = get_post( $sidebar );

if( $post ) {
?>
    <div class="vc-stm-sidebar<?php echo esc_attr( $css_class ); ?>">
        <?php echo apply_filters( 'the_content' , $post->post_content); ?>
    </div>
<?php } ?>
