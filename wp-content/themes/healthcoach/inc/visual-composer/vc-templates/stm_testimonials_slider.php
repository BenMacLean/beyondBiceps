<?php
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$uni = uniqid( 'js-slider-' . rand() );

$args = array( 'post_type' => 'testimonial', 'posts_per_page' => -1 );

if( $testimonials_count ) {
    $args['posts_per_page']  = $testimonials_count;
}

if( $testimonials_categories ) {
    $args['testimonial_categories'] = $testimonials_categories;
}

$query = new WP_Query( $args );

if( $query->have_posts() ) {
    $output .= '<div class="slider slider_type_testimonial recent-testimonials-carousel'. esc_attr( $css_class ) .'" id="'. esc_attr( $uni ).'">';

    while( $query->have_posts() ) {
        $output .= '<div class="slider-item testimonials-carousel-item">';
        $query->the_post();

        $photo_before_id = get_post_meta( get_the_ID(), 'testimonial_photo_before', true );
        $photo_after_id = get_post_meta( get_the_ID(), 'testimonial_photo_after', true );

        $photo_before = wpb_getImageBySize( array(
            'attach_id'  => $photo_before_id,
            'thumb_size' => '250x223'
        ) );

        $photo_after = wpb_getImageBySize( array(
            'attach_id'  => $photo_after_id,
            'thumb_size' => '250x223'
        ) );

        $output .= '<div class="testimonial testimonial_type_slider">';
        $output .= '<div class="row">';
        $output .= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
        $output .= '<div class="testimonial-images">';
        $output .= '<div class="testimonial-images-inner">';
        $output .= '<div class="testimonial-image testimonial-image-first">';
        $output .= wp_kses( $photo_before['thumbnail'], array( 'img' => array( 'src' => array(), 'width' => array(), 'height' => array() ) ) );
        $output .= '<div class="testimonial-image-caption"><h4 class="testimonial__caption-title">'. __( 'Before', 'healthcoach' ) .'</h4></div>';
        $output .= '</div>';
        $output .= '<div class="testimonial-image testimonial-image-second">';
        $output .= wp_kses( $photo_after['thumbnail'], array( 'img' => array( 'src' => array(), 'width' => array(), 'height' => array() ) ));
        $output .= '<div class="testimonial-image-caption"><div class="testimonial__caption-title">'. __( 'After', 'healthcoach' ) .'</div></div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
        $output .= '<div class="testimonial-content">';
        $output .= '<h5 class="testiomonial__title"><a href="'. esc_url( get_the_permalink() ) .'">'. esc_html( get_the_title() ) .'</a></h5>';
        $output .=  wpautop( get_the_excerpt() );
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
    }

    wp_reset_query();

    $output .= '</div>';
    $output .= '<script>
                    jQuery(document).ready(function($) {
                        "use strict";
                        var sliderId = "#' . esc_js( $uni) . '";

                        if( sliderId.length ) {
                            $( sliderId ).slick({
                                dots: true,
                                speed: 1000,
                                arrows: false
                            });
                        }
                    });
                </script>';
}

echo $output;
