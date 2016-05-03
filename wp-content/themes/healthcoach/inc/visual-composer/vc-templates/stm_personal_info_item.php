<?php
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* Styles */
$output .= '<tr>';
$output .= '<th>'. esc_html( $title ) .'</th>';
if( !empty( $text ) ) {
    $output .= '<td>' . esc_html( $text ) . '</td>';
}
$output .= '</tr>';
echo $output;