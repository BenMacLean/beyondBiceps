<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$styles = array();
$style = '';

$wp_posts_per_page = get_option('posts_per_page');

$img_size = '700x300';

$posts = new WP_Query( array( 'post_type' => 'event', 'posts_per_page' => $posts_per_page, 'paged' => get_query_var( 'paged' ) ) ); ?>

<?php if( $posts->have_posts() ) : ?>
    <div class="grid-container<?php echo esc_attr( $css_class ); ?>">
        <div class="row">
            <?php while( $posts->have_posts() ) : $posts->the_post(); ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="event event_type_<?php echo esc_attr( $view ); ?>">
                        <?php
                            if( has_post_thumbnail() ) {
                                $attach_id = get_post_thumbnail_id( get_the_ID() );

                                if( $attach_id > 0 ) {
                                    $post_thumbnail = wpb_getImageBySize( array(
                                        'attach_id'  => $attach_id,
                                        'thumb_size' => $img_size
                                    ) );
                                }
                            }
                        ?>
                        <?php if( isset( $post_thumbnail ) && !empty( $post_thumbnail ) ) :  ?>
                            <div class="event__thumbnail"><?php echo wp_kses( $post_thumbnail['thumbnail'], array( 'img' => array( 'src' => array(), 'width' => array(), 'height' => array() ) ) );  ?></div>
                        <?php endif; ?>
                        <div class="event__body">
                            <div class="event__date event__body-date">
                                <div class="event__date-day"><?php echo date_i18n('j', strtotime( get_post_meta( get_the_ID(), 'event_date', true ) ) ); ?></div>
                                <div class="event__date-month"><?php echo date_i18n('M', strtotime( get_post_meta( get_the_ID(), 'event_date', true ) ) ); ?><span class="event__date-month_dot">.</span></div>
                                <div class="event__date-bg"><span class="hc-icon-paper"></span></div>
                            </div>
                            <div class="event__body-right">
                                <h5 class="event__title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
                                <ul class="event__details">
                                    <?php
                                        // Get event details
                                        $event_time_start = get_post_meta( get_the_ID(), 'event_time_start', true );
                                        $event_time_end = get_post_meta( get_the_ID(), 'event_time_end', true );
                                        $event_local = get_post_meta( get_the_ID(), 'event_local', true )
                                    ?>
                                    <?php if( !empty( $event_time_start ) && !empty( $event_time_end ) ) : ?>
                                        <li class="event__details-item event__details-time"><?php echo esc_html( $event_time_start );  ?> <span class="divider">-</span> <?php echo esc_html( $event_time_end );  ?></li>
                                    <?php endif; ?>
                                    <?php if( !empty( $event_local ) ) : ?>
                                        <li class="event__details-item event__details-location"><?php echo esc_html( $event_local ); ?></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <?php
            $posts_count = wp_count_posts('event');
            if( $posts_count->publish > $posts_per_page ) : ?>
                <nav class="page-pagination page-pagination_type_events">
                    <?php if( get_previous_posts_link() ) : ?>
                        <div class="page-prev"><?php previous_posts_link('<span class="hc-icon-big-arrow-l"></span>'); ?></div>
                    <?php endif; ?>
                    <?php
                    echo paginate_links( array(
                        'format'       => '',
                        'add_args'     => '',
                        'current'      => max( 1, get_query_var( 'paged' ) ),
                        'total'        => $posts->max_num_pages,
                        'prev_next' => false,
                        'type'         => 'list',
                        'end_size'     => 3,
                        'mid_size'     => 3
                    ) );
                    ?>
                    <?php if( get_next_posts_link('', $posts->max_num_pages) ) : ?>
                        <div class="page-next"><?php next_posts_link('<span class="hc-icon-big-arrow-r"></span>', $posts->max_num_pages); ?></div>
                    <?php endif; ?>
                </nav>
        <?php endif; ?>

        <?php wp_reset_query(); ?>
    </div>
<?php endif; ?>

