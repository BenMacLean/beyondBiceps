<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$type = 'STM_Countdown_Widget';
$args = array(
    'before_widget' => '<div class="vc_stm_countdown wpb_content_element vc_stm_widget' . $css_class . '">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>'
);
?>

<?php the_widget( $type, $atts, $args ); ?>