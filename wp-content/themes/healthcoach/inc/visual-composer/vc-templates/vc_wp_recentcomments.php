<?php
$output = $title = $number = $el_class = '';
extract( shortcode_atts( array(
	'title' => __( 'Recent Comments', 'healthcoach' ),
	'number' => 5,
	'el_class' => ''
), $atts ) );

$el_class = $this->getExtraClass( $el_class );

$output = '<div class="vc_wp_recentcomments wpb_content_element' . $el_class . '">';
$type = 'WP_Widget_Recent_Comments';
$args = array(
	'before_title'  => '<h4 class="widget-title">',
	'after_title'   => '</h4>'
);

ob_start();
the_widget( $type, $atts, $args );
$output .= ob_get_clean();

$output .= '</div>' . $this->endBlockComment( 'vc_wp_recentcomments' ) . "\n";

echo $output;