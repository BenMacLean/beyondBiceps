<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $text
 * @var $link
 * @var $google_fonts
 * @var $font_container
 * @var $text
 * @var $css
 * @var $font_container_data - returned from $this->getAttributes
 * @var $google_fonts_data - returned from $this->getAttributes
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Custom_heading
 */
$output = $output_text = $css_class = $style = '';
$sep_position = $icon_size = $sep_type = $icon_class = '';
$link = $text = $google_fonts = $font_container = $el_class = $css = $font_container_data = $google_fonts_data = '';
extract( $this->getAttributes( $atts ) );

extract( shortcode_atts( array(
		'sep_type'         => 'icon',
		'icon_type'        => 'hc',
		'icon_hc'          => '',
		'icon_fontawesome' => '',
		'icon_linecons'    => '',
		'icon_color'   	   => '',
		'icon_size'        => '',
		'sep_position'     => 'top',
		'sep_spacing_top'  => '',
		'sep_spacing_bot'  => '',
),$atts ) );

extract( $this->getStyles( $el_class, $css, $google_fonts_data, $font_container_data, $atts ) );

$settings = get_option( 'wpb_js_google_fonts_subsets' );
$subsets = '';
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
}
if ( ! empty( $google_fonts_data ) && isset( $google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}

if ( ! empty( $styles ) ) {
	$style = 'style="' . esc_attr( implode( ';', $styles ) ) . '"';
}

if( !empty(${'icon_'.$icon_type}) && $sep_type == 'icon' ) {

	$icon = '<i class="' . esc_attr( ${'icon_'.$icon_type} ) .'"></i>';

	$icon_style = '';
	$icon_styles = array();

	if( !empty( $icon_color ) ) {
		$icon_styles[] = 'color:' . $icon_color;
	}

	if( !empty( $icon_size ) ) {
		$icon_styles[] = 'font-size:' . $icon_size;
	}

	if( !empty( $icon_styles ) ) {
		$icon_style = 'style=' . esc_attr( implode( ';' , $icon_styles ) ) . '';
	}
}

$sep_style = '';
$sep_styles = array();

if( !empty( $font_container_data['values']['text_align'] ) ) {
	$sep_styles[] = 'text-align:' . $font_container_data['values']['text_align'];
}

if( !empty( $sep_spacing_top ) && $sep_position == 'bottom' ) {
	$sep_styles[] = 'padding-top:' . $sep_spacing_top;
}

if( !empty( $sep_spacing_bot ) && $sep_position == 'top' ) {
	$sep_styles[] = 'padding-bottom:' . $sep_spacing_bot;
}

if( !empty( $sep_styles ) ) {
		$sep_style = 'style=' . esc_attr( implode( ';' , $sep_styles ) ) . '';
	}

$output_text = $text;
if ( ! empty( $link ) ) {
	$link = vc_build_link( $link );
	$output_text = '<a href="' . esc_attr( $link['url'] ) . '"'
	               . ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' )
	               . ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' )
	               . '>' . $text . '</a>';
}

$output .= '<div class="' . esc_attr( $css_class ) . '" >';
if( isset( $icon ) && $sep_position == 'top' ) {
	$output .= '<div class="vc-custom-heading__separator" '. esc_attr( $sep_style ) .'><span class="vc-custom-heading__separator-icon" '. esc_attr( $icon_style ) .'>'. $icon .'</span></div>';
}
$output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' >';
$output .= $output_text;
$output .= '</' . $font_container_data['values']['tag'] . '>';
if( isset( $icon ) && $sep_position == 'bottom' ) {
	$output .= '<div class="vc-custom-heading__separator" '. esc_attr( $sep_style ) .'><span class="vc-custom-heading__separator-icon" '. esc_attr( $icon_style ) .'>'. $icon .'</span></div>';
}
$output .= '</div>';
$output .= $this->endBlockComment( $this->getShortcode() );

echo $output;