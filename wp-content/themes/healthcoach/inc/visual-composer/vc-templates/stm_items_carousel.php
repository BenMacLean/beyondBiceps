<?php
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'stm-fancybox' );
wp_enqueue_style( 'stm-fancybox' );

/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

// Title styles
$title_styles = array();
$title_style = '';

if( $title_font_size != '' ) {
    $title_styles[] = 'font-size:' . $title_font_size;
}

if( $title_color != '' ) {
    $title_styles[] = 'color:' . $title_color;
}

if( $title_styles ) {
    $title_style = 'style=' . implode( ';', $title_styles ) . '';
}

$posts = get_posts( array( 'post_type' => 'item', 'posts_per_page' => $count_posts, 'item_categories' => $category_slug ) );

$carousel_id = uniqid("js-carousel-");
$fancybox_id = uniqid("js-fancybox-qualification-");

$output .= '<div class="carousel-container'. esc_attr( $css_class ) .'">';
$output .= '<div class="carousel carousel_type_qualification" id="'. esc_attr( $carousel_id ) .'">';
if( $posts ) {
    foreach( $posts as $post ) {
        if( has_post_thumbnail( $post->ID ) ) {
            $output .= '<div class="carousel__item carousel__item_type_qualification">';
            $attach_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
            $output .= '<div class="qualification qualification_type_carousel">';
            $output .= '<div class="qualification__image"><a class="'. esc_attr( $fancybox_id ) .'" href="' . esc_url( $attach_image[0] ) . '">' . get_the_post_thumbnail( $post->ID , 'full', array( 'class' => 'img-responsive' ) ) . '</a></div>';
            $output .= '<div class="qualification__title" '. esc_attr( $title_style ) .'>' . get_the_title( $post->ID ) . '</div>';
            $output .= '</div>';
            $output .= '</div>';
        }
    }
}
$output .= '</div>';
$output .= '</div>';
echo $output;
?>
<script>
    jQuery(document).ready(function($) {
        "use strict";
        var carouselId = "#<?php echo esc_attr( $carousel_id ); ?>",
            fancyboxId = ".<?php echo esc_attr( $fancybox_id ); ?>",
            dotsEnable = <?php echo ( ( $carousel_bullets == 'enable' ) ? "true" : "false" ); ?>;

        $( carouselId ).slick({
            dots: dotsEnable,
            speed: 600,
            slidesToShow: 3,
            slidesToScroll: 3,
            arrows: false,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        if( $(fancyboxId).length ) {
            $(fancyboxId).fancybox();
        }
    });
</script>
