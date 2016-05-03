<?php
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$args = array( 'post_type' => 'service', 'posts_per_page' => -1 );

if( !empty( $count ) ) {
    $args['posts_per_page'] = $count;
}

if( !empty( $category ) ) {
    $args['service_categories'] = $category;
}

$posts_query = new WP_Query( $args );

if( !empty( $thumbnail_size ) ) {
    $thumbnail_size = $thumbnail_size;
} else {
    $thumbnail_size = '795x544';
}

if( $posts_query->have_posts() ) {

    $output .= '<div class="grid-container'. esc_attr( $css_class ) .'">';
    $output .= '<div class="row">';

    while( $posts_query->have_posts() ) {
        $posts_query->the_post();

        if( $cols == 2 ) {
            $columns_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
        }
        if( $cols == 3 ) {
            $columns_class = 'col-lg-4 col-md-4 col-sm-12 col-xs-12';
        }
        if( $cols == 4 ) {
            $columns_class = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
        }

        $output .= '<div class="'. esc_attr( $columns_class ) .'">';
        $output .= '<div class="thumbnail thumbnail_type_'. esc_attr( $service_type ) .'-service">';

        $thumbnail_id = get_post_thumbnail_id( get_the_ID() );

        if( $thumbnail_id > 0 ) {

            $post_thumbnail = wpb_getImageBySize( array(
                'attach_id'  => $thumbnail_id,
                'thumb_size' => $thumbnail_size
            ) );

            if( has_post_thumbnail() ) {
                $output .= '<div class="thumbnail__image-container">' . wp_kses( $post_thumbnail['thumbnail'], array( 'img' => array( 'src' => array(), 'width' => array(), 'height' => array() ) ) ) . '</div>';
            }
        }
        $output .= '<div class="thumbnail__caption">';
        $output .= '<div class="thumbnail__caption-bump"></div>';
        if( $icon = get_post_meta(get_the_ID(), 'service_font_icon', true ) ) {
            $output .= '<div class="thumbnail__caption-icon"><i class="'. esc_attr( $icon ) .'"></i></div>';
        } else {
            $output .= '<div class="thumbnail__caption-icon"><i class="hc-icon-heart-o"></i></div>';
        }
        $output .= '<h5 class="thumbnail__caption-title"><a href="'. esc_url( get_the_permalink() ) .'" title="'. esc_attr( get_the_title() ) .'">'. esc_html( get_the_title() ) .'</a></h5>';
        $output .= '<div class="thumbnail__caption-action"><a class="btn btn_view_primary btn_size_sm" href="'. esc_url( get_the_permalink() ) .'">'. __( 'More info', 'healthcoach' ) .'</a></div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
    }

    $output .= '</div>';
    $output .= '</div>';

    if( $pagination_enable ) {
        $posts_count = wp_count_posts('service');

        if( $posts_count->publish > $count ) {
            $output .= '<nav class="page-pagination">';

            if( get_previous_posts_link() ) {
                $output .= '<div class="page-prev">' . get_previous_posts_link( '<span class="hc-icon-big-arrow-l"></span>' ) . '</div>';
            }

            $output .= paginate_links( array(
                'current'      => max( 1, get_query_var( 'paged' ) ),
                'total'        => $posts_query->max_num_pages,
                'prev_next'    => false,
                'type'         => 'list',
                'end_size'     => 3,
                'mid_size'     => 3
            ) );

            if( get_next_posts_link( '', $posts_query->max_num_pages ) ) {
                $output .= '<div class="page-next">' . get_next_posts_link( '<span class="hc-icon-big-arrow-r"></span>', $posts_query->max_num_pages ) . '</div>';
            }

            $output .= '</nav>';
        }
    }

    wp_reset_query();
}

echo $output;