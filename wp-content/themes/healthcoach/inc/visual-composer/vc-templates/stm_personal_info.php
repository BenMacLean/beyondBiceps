<?php
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$output .= '<div class="personal-info'. esc_attr( $css_class ) .'">';
$output .= '<table class="table table-striped table_type_personal-info">';
$output .= wpb_js_remove_wpautop( $content, false );
$output .= '</table>';
$output .= '</div>';

echo $output;