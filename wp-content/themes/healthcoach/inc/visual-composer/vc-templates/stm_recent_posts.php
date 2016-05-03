<?php
    $css = '';
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );

    /* Styles */
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

    $styles = array();
    $style = '';

    // Query
    $args = array( 'posts_per_page' => -1, 'ignore_sticky_posts' => true ) ;

    if( $posts_count ) {
        $args['posts_per_page'] = $posts_count;
    }

    if( $posts_category ) {
        $args['category_name'] = $posts_category;
    }

    if( $posts_format ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'post_format',
                'field'    => 'slug',
                'terms'    => array( 'post-format-'. $posts_format )
            )
        );
    }

    $posts = new WP_Query( $args );

    // Columns Class
    if( $columns_per_row == 2 ) {
        $column_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
    }

    if( $columns_per_row == 3 ) {
        $column_class = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
    }

    if( $columns_per_row == 4 ) {
        $column_class = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
    }

    if( !empty( $thumbnail_size ) ) {
        $img_size = $thumbnail_size;
    } else {
        $img_size = '795x544';
    }
?>

<?php if( $posts->have_posts() ) {
    $output .= '<div class="grid-container'. esc_attr( $css_class ) .'">';
    $output .= '<div class="row">';

    while( $posts->have_posts() ) {
        $posts->the_post();
        $output .= '<div class="'. esc_attr( $column_class ).'">';
        $output .= '<div class="thumbnail thumbnail_type_recent-post thumbnail_js_hover">';
        if( has_post_thumbnail() ) {
            $attach_id = get_post_thumbnail_id( get_the_ID() );

            if( $attach_id > 0 ) {
                $post_thumbnail = wpb_getImageBySize( array(
                    'attach_id'  => $attach_id,
                    'thumb_size' => $img_size
                ) );
				
				$post_thumbnail_large = wpb_getImageBySize( array(
                    'attach_id'  => $attach_id,
                    'thumb_size' => '795x500'
                ) );

                $output .= '<div class="thumbnail__image-container hidden-sm hidden-xs">' . wp_kses( $post_thumbnail['thumbnail'], array( 'img' => array( 'src' => array(), 'width' => array(), 'height' => array() ) ) ) . '</div>';
				$output .= '<div class="thumbnail__image-container hidden-lg hidden-md">' . wp_kses( $post_thumbnail_large['thumbnail'], array( 'img' => array( 'src' => array(), 'width' => array(), 'height' => array() ) ) ) . '</div>';
            }
			
        } else {
            $output .= '<div class="thumbnail__image-container thumbnail__image-container_holder"></div>';
        }
        $output .= '<div class="thumbnail__caption">';
        $output .= '<div class="thumbnail__caption-bump"></div>';

        if( get_post_format() == 'video' ) {
            $caption_icon = 'film-play';
        } elseif( get_post_format() == 'image' ) {
            $caption_icon = 'picture';
        } else {
            $caption_icon = 'text-align-left';
        }

        if( isset( $caption_icon ) ) {
            $output .= '<div class="thumbnail__caption-icon thumbnail__caption-icon_type_recent-post"><span class="lnr lnr-'. esc_attr( $caption_icon ) .'"></span></div>';
        }
        $output .= '<h5 class="thumbnail__caption-title thumbnail__caption-title_type_recent-post">'. esc_html( mb_substr( get_the_title(), 0, 57 ) )  .'</h5>';
        $output .= '<div class="thumbnail__caption-text thumbnail__caption-text_view_hide">' . wpautop( mb_substr( get_the_excerpt(), 0, 127 ) ) . '</div>';
        $output .= '</div>';
        $output .= '<a class="thumbnail__link thumbnail__link_type_cover" href="'. esc_url( get_the_permalink() ) .'">'. esc_html( get_the_title() ) .'</a>';
        $output .= '</div>';
        $output .= '</div>';

    }

    wp_reset_query();

    $output .= '</div>';
    $output .= '</div>';

    echo $output;
}
