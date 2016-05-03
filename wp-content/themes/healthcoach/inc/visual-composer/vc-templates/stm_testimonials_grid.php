<?php
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$styles = array();
$style = '';

if( !empty( $testimonials_per_page ) ) {
    $posts_count = $testimonials_per_page;
} else {
    $posts_count = -1;
}

$image_size = '616x548';

$query = new WP_Query( array( 'post_type' => 'testimonial', 'posts_per_page' => $posts_count ) );
?>

<?php if( $query->have_posts() ) : ?>
    <div class="grid-container<?php echo esc_attr( $css_class ); ?>">
        <div class="row">
            <?php while( $query->have_posts() ) : $query->the_post(); ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="testimonial testimonial_type_grid">
                        <?php if( has_post_thumbnail() ) : ?>
                            <?php
                                $attach_id = get_post_thumbnail_id();
                                if( $attach_id > 0 ) {
                                    $attach_image = wpb_getImageBySize( array(
                                        'attach_id'  => $attach_id,
                                        'thumb_size' => $image_size
                                    ) );
                                }
                            ?>
                            <div class="testimonial__thumbnail"><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo wp_kses( $attach_image['thumbnail'], array( 'img' => array( 'src' => array(), 'width' => array(), 'height' => array() ) ) ); ?></a></div>
                        <?php endif; ?>

                        <?php
                            $author = get_post_meta( get_the_ID(), 'testimonial_author', true );
                            $short_desc = get_post_meta( get_the_ID(), 'testimonial_short_desc', true );
                        ?>

                        <?php if( $author || $short_desc ) : ?>
                            <h4><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( $author ); ?></a></h4>
                            <p><?php echo esc_html( $short_desc ); ?></p>
                        <?php else : ?>
                            <h4><a href="<?php echo esc_attr( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a></h4>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <?php $testimonials_count = wp_count_posts('testimonial'); ?>
        <?php if ( $testimonials_count->publish > $posts_count && $posts_count != '-1' ) : ?>

            <nav class="page-pagination">
                <?php if( get_previous_posts_link() ) : ?>
                    <div class="page-prev"><?php previous_posts_link( '<span class="hc-icon-big-arrow-l"></span>' ); ?></div>
                <?php endif; ?>
                <?php
                    echo paginate_links( array(
                        'current'      => max( 1, get_query_var( 'paged' ) ),
                        'total'        => $query->max_num_pages,
                        'prev_next'    => false,
                        'type'         => 'list',
                        'end_size'     => 3,
                        'mid_size'     => 3
                    ) );
                ?>
                <?php if( get_next_posts_link( '', $query->max_num_pages ) ) : ?>
                    <div class="page-next"><?php next_posts_link('<span class="hc-icon-big-arrow-r"></span>', $query->max_num_pages); ?></div>
                <?php endif; ?>
            </nav>

        <?php endif; ?>

        <?php wp_reset_query(); ?>
    </div>
<?php endif; ?>
