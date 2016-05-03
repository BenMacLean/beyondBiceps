<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $show_bump
 * @var $bump_color
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$output = $after_output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);
$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width"></div>';
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = ' vc_row-o-full-height';
	if ( ! empty( $content_placement ) ) {
		$css_classes[] = ' vc_row-o-content-' . $content_placement;
	}
}

// use default video if user checked video, but didn't chose url
if ( ! empty( $video_bg ) && empty( $video_bg_url ) ) {
	$video_bg_url = 'https://www.youtube.com/watch?v=lMJXxhRFO1k';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_image = $video_bg_url;
	$css_classes[] = ' vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="1.5"'; // parallax speed
	$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if ( strpos( $parallax, 'fade' ) !== false ) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( strpos( $parallax, 'fixed' ) !== false ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

if ( ! empty ( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . ''. ( ( $show_bump ) ? ' vc-row_type_bump' : '' ) .'"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
// Bump
if( $show_bump ) {

	$bump_styles = $icon_styles = array();
	$bump_style = $bump_icon = $icon_style = '';
	
	if( !empty($bump_position) ) {
		$bump_position = $bump_position;
	} else {
		$bump_position = 'top';
	}

	if( !empty( $bump_color ) ) {
		$bump_styles[] = 'background-color:' . $bump_color;
	}
	
	if( !empty( $bump_offset ) && $bump_position == 'top' ) {
		$bump_styles[] = 'bottom: auto;top:' . $bump_offset;
	}
	
	if( !empty( $bump_offset ) && $bump_position == 'bottom' ) {
		$bump_styles[] = 'top: auto;bottom:' . $bump_offset;
	}
	
	if( !empty( $icon_spacing ) ) {
		$bump_styles[] = 'padding-top:' . $icon_spacing;
	}

	if( !empty( $bump_styles ) ) {
		$bump_style = 'style="' . esc_attr( implode( ';' , $bump_styles ) ) . '"';
	}
		
	if( !empty( $icon_size ) ) {
		$icon_styles[] = 'font-size:' . $icon_size;
	}
	
	if( !empty( $icon_color ) ) {
		$icon_styles[] = 'color:' . $icon_color;
	}
	
	if( !empty( $icon_styles ) ) {
		$icon_style = 'style="' . esc_attr( implode( ';' , $icon_styles ) ) . '"';
	}
	
	if( !empty( ${'icon_'. $icon_type} ) ) {
		$bump_icon = '<span class="'. ${'icon_'. $icon_type} .'" '. $icon_style .'></span>';
	}
	
	$output .= '<div class="vc-row__bump vc_row__bump_position_'. ( ( !empty( $bump_position ) ) ? $bump_position : 'top' ) .'" '. $bump_style .'>'. $bump_icon .'</div>';
}
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= $after_output;
$output .= $this->endBlockComment( $this->getShortcode() );

echo $output;