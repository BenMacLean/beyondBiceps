<?php
class STM_Event_Info extends WP_Widget {

    public function __construct() {
        parent::__construct( 'widget_stm_event_info', __( 'STM Event Info', 'healthcoach' ), array(
            'classname'   => 'widget_event-info',
            'description' => __( 'Event Info', 'healthcoach' ),
        ) );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        ?>
        <div class="event-info__members">
            <div class="event-info__members-inner">
                <div class="event-info__members-icon"><i class="fa fa-user"></i></div>
                <?php $event_members = get_post_meta( get_the_ID(), 'event_members', true ); ?>
                <div class="event-info__members-number"><?php echo ( ( $event_members > 0 ) ? '+' . esc_html( $event_members ) : 0 ); ?></div>
            </div>
        </div>
        <div class="event-info__description"><p><?php _e( 'People attended the event', 'healthcoach' ); ?></p></div>
        <?php
            $event_price = get_post_meta( get_the_ID(), 'event_price', true );
            if( $event_price ) {
                if( $event_price['type'] != 'paid' || empty( $event_price['type'] ) ) {
                    $event_button_text = __( 'Join', 'healthcoach' );
                } else {
                    $event_button_text = __( 'Join', 'healthcoach' );
                }
            }
        ?>
        <?php if( isset( $event_button_text ) ) : ?>
            <a href="#" class="btn btn_view_primary event-info__button" id="js-event-join"><?php echo esc_html( $event_button_text ); ?></a>
        <?php endif; ?>

        <script>
            (function($) {
                var postId = <?php echo esc_js( get_the_ID() ) ?>,
                    eventId = localStorage.getItem("event_" + postId ),
                    $eventButton = $("#js-event-join");

                if( parseInt( eventId ) === postId ) {
                    $eventButton.addClass("joined");
                }

                $eventButton.on('click', function() {
                    var $this = $(this),
                        eventId = localStorage.getItem( "event_" + postId ),
                        $members = $this.closest('.widget_event-info').find('.event-info__members-number');

                    if( parseInt( eventId ) !== postId ) {
                        $this.addClass("joined");
                        $members.html( "+" + ( parseInt( $members.text() ) + 1));

                        $.ajax({
                            type: "POST",
                            url: ajaxurl,
                            dataType : "json",
                            data: "event_id=" + postId + "&action=stm_event_join",
                            success: function( result ){
                            }
                        });

                        localStorage.setItem( "event_" + postId, postId );
                    }

                    return false;

                });
            })(jQuery);
        </script>
        <?php
        echo $args['after_widget'];

    }

    function update( $new_instance, $instance ) {
        $instance['title'] = strip_tags( $new_instance['title'] );

        return $instance;
    }

    function form( $instance ) {
        $title  = empty( $instance['title'] ) ? __( 'Info', 'healthcoach' ) : esc_attr( $instance['title'] );

        ?>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'healthcoach' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>
    <?php
    }
}

class STM_Widget_Pages extends WP_Widget {

    public function __construct() {
        $widget_ops = array('classname' => 'widget_featured-pages', 'description' => __( 'A list of your site&#8217;s Pages.', 'healthcoach') );
        parent::__construct('stm_pages', __('STM Pages', 'healthcoach'), $widget_ops);
    }

    public function widget( $args, $instance ) {

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Pages', 'healthcoach' ) : $instance['title'], $instance, $this->id_base );

        $sortby = empty( $instance['sortby'] ) ? 'menu_order' : $instance['sortby'];
        $include = empty( $instance['include'] ) ? '' : $instance['include'];

        if ( $sortby == 'menu_order' )
            $sortby = 'menu_order, post_title';

        $out = wp_list_pages( apply_filters( 'stm_widget_pages_args', array(
            'title_li'    => '',
            'echo'        => 0,
            'sort_column' => $sortby,
            'depth' => -1,
            'include'     => $include
        ) ) );

        if ( ! empty( $out ) ) {
            echo $args['before_widget'];
            if ( $title ) {
                echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
            }
            ?>
            <ul>
                <?php echo $out; ?>
            </ul>
            <?php
            echo $args['after_widget'];
        }
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        if ( in_array( $new_instance['sortby'], array( 'post_title', 'menu_order', 'ID' ) ) ) {
            $instance['sortby'] = $new_instance['sortby'];
        } else {
            $instance['sortby'] = 'menu_order';
        }

        $instance['include'] = strip_tags( $new_instance['include'] );

        return $instance;
    }

    public function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'sortby' => 'post_title', 'title' => '', 'include' => '') );
        $title = esc_attr( $instance['title'] );
        $include = esc_attr( $instance['include'] );
        ?>
        <p><label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', 'healthcoach'); ?></label> <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('sortby') ); ?>"><?php _e( 'Sort by:', 'healthcoach' ); ?></label>
            <select name="<?php echo esc_attr( $this->get_field_name('sortby') ); ?>" id="<?php echo esc_attr( $this->get_field_id('sortby') ); ?>" class="widefat">
                <option value="post_title"<?php selected( $instance['sortby'], 'post_title' ); ?>><?php _e('Page title', 'healthcoach'); ?></option>
                <option value="menu_order"<?php selected( $instance['sortby'], 'menu_order' ); ?>><?php _e('Page order', 'healthcoach'); ?></option>
                <option value="ID"<?php selected( $instance['sortby'], 'ID' ); ?>><?php _e( 'Page ID', 'healthcoach' ); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('include') ); ?>"><?php _e( 'Include:', 'healthcoach' ); ?></label> <input type="text" value="<?php echo esc_attr( $include ); ?>" name="<?php echo esc_attr( $this->get_field_name('include') ); ?>" id="<?php echo esc_attr( $this->get_field_id('include') ); ?>" class="widefat" />
            <br />
            <small><?php _e( 'Page IDs, separated by commas.', 'healthcoach' ); ?></small>
        </p>
        <?php
    }

}

class STM_Event_Contacts extends WP_Widget {

    public function __construct() {
        parent::__construct( 'widget_stm_event_contacts', __( 'STM Event Contacts', 'healthcoach' ), array(
            'classname'   => 'widget_event-contacts',
            'description' => __( 'Event Contacts Info', 'healthcoach' ),
        ) );
    }

    public function widget( $args, $instance ) {
        wp_enqueue_script( 'stm-fancybox' );
        wp_enqueue_style( 'stm-fancybox' );
        wp_enqueue_script( 'stm-fancybox-media' );

        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        // Map
        $event_map_lat = get_post_meta( get_the_ID(), 'event_map_lat', true );
        $event_map_lng = get_post_meta( get_the_ID(), 'event_map_lng', true );

        $event_map_fancybox = uniqid('map-fancybox-');
        $event_map = uniqid('event-map-');

        echo '<ul class="event-contacts__details">';
        // Local
        $event_local = get_post_meta( get_the_ID(), 'event_local', true );
        if( $event_local ) {
            echo '<li class="event-contacts__details-item event-contacts__location">';
            echo '<p>';
            echo wp_kses( $event_local, array( 'a' => array( 'href' => array() ), 'br' => array(), 'b' => array(), 'strong' => array() ) );
            if( !empty( $event_map_lat ) && !empty( $event_map_lng ) ) {
                echo '<span class="event-contacts__location-dot">.</span> <a class="event-contacts__map-link" id="'. esc_attr( $event_map_fancybox ) .'" href="#'. esc_attr( $event_map ) .'">'. __( 'View on map', 'healthcoach' ) .' <i class="fa fa-external-link"></i></a>';
            }
            echo '</p>';
            echo '</li>';
        }

        // Phone & Fax
        $event_phone_fax = get_post_meta( get_the_ID(), 'event_phone_fax', true );
        if( $event_phone_fax ) {
            $event_phone_fax_array = explode( ';', $event_phone_fax );
            echo '<li class="event-contacts__details-item event-contacts__phone">';
            foreach( $event_phone_fax_array as $number ) {
                echo '<p>'. wp_kses( $number, array( 'a' => array( 'href' => array() ), 'br' => array(), 'b' => array(), 'strong' => array() ) ) .'</p>';
            }
            echo '</li>';
        }

        // Email
        $email_enable = $instance['email_enable'];

        $event_email = get_post_meta( get_the_ID(), 'event_email', true );
        if( !empty( $event_email ) && $email_enable && $email_enable == '1' ) {
            $event_email_array = explode( ';', $event_email );
            echo '<li class="event-contacts__details-item event-contacts__email">';
            foreach( $event_email_array as $email ) {
                echo '<p><a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a></p>';
            }
            echo '</li>';
        }

        echo '</ul>';
        ?>

        <script>
            function initialize() {
                var eventMapLng = <?php echo esc_js( $event_map_lng ); ?>,
                    eventMapLat = <?php echo esc_js( $event_map_lat ); ?>,
                    mapLatLng = new google.maps.LatLng(eventMapLat, eventMapLng),
                    mapOptions = {
                        zoom: 12,
                        center: mapLatLng
                    },
                    eventMap = '<?php echo esc_js( $event_map ) ?>',
                    map = new google.maps.Map(document.getElementById(eventMap),
                        mapOptions),
                    marker = new google.maps.Marker({
                        position: mapLatLng,
                        map: map
                    });
            }

            function loadScript() {
                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.src = 'http://maps.googleapis.com/maps/api/js?v=3.exp' +
                    '&signed_in=true&callback=initialize';
                document.body.appendChild(script);
            }

            window.onload = loadScript;

            jQuery(document).ready(function($) {
                var eventMapFancybox = '<?php echo "#" . esc_js( $event_map_fancybox ) ?>';
                if( $( eventMapFancybox ).length ) {
                    $( eventMapFancybox ).on( "click", function () {
                        $.fancybox({
                            href : $(this).attr('href'),
                            maxWidth	: 800,
                            maxHeight	: 600,
                            fitToView	: false,
                            width		: '70%',
                            height		: '70%',
                            autoSize	: false,
                            closeClick	: false,
                            openEffect	: 'none',
                            closeEffect	: 'none',
                            afterShow: function () {
                                initialize();
                            }

                        });

                        return false;
                    });
                }
            });
        </script>

        <div class="event-contacts__map-canvas" id="<?php echo esc_attr( $event_map ); ?>"></div>

        <?php
        echo $args['after_widget'];

    }

    function update( $new_instance, $instance ) {
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['email_enable'] = strip_tags( $new_instance['email_enable'] );

        return $instance;
    }

    function form( $instance ) {
        $title        = empty( $instance['title'] ) ? __( 'Venue', 'healthcoach' ) : esc_attr( $instance['title'] );
        $email_enable = empty( $instance['email_enable'] ) ? '' : esc_attr( $instance['email_enable'] );

        ?>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'healthcoach' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'email_enable' ) ); ?>"><?php _e( 'Email:', 'healthcoach' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'email_enable' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'email_enable' ) ); ?>" type="checkbox" <?php checked( '1', $email_enable ); ?> value="1"></p>
    <?php
    }
}

class STM_Event_Details extends WP_Widget {

    public function __construct() {
        parent::__construct( 'widget_stm_event_details', __( 'STM Event Details', 'healthcoach' ), array(
            'classname'   => 'widget_event-details',
            'description' => __( 'Event Details', 'healthcoach' ),
        ) );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
        }
        echo '<dl>';
        // Date
        $event_date = get_post_meta( get_the_ID(), 'event_date', true );
        if( $event_date ) {
            echo '<dt>' . __( 'Date', 'healthcoach' ) . ':</dt>';
            echo '<dd>' . esc_html( $event_date ) . '</dd>';
        }
        // Time
        $event_time_start = get_post_meta( get_the_ID(), 'event_time_start', true );
        $event_time_end = get_post_meta( get_the_ID(), 'event_time_end', true );
        $event_time_end = get_post_meta( get_the_ID(), 'event_time_end', true );
        $event_event_price = get_post_meta( get_the_ID(), 'event_price' );

        if( $event_time_start || $event_time_end ) {
            echo '<dt>' . __( 'Time', 'healthcoach' ) . ':</dt>';
            echo '<dd class="text-lowercase">' . esc_html( $event_time_start ) . ' <span class="divider">-</span> ' . esc_html( $event_time_end ) .'</dd>';
        }
        // Categories
        $terms = get_terms( 'event_categories' );
        if( $terms ) {
            echo '<dt>' . __( 'Categories', 'healthcoach' ) . ':</dt>';

            $categories = array();

            foreach( $terms as $term ) {
                $categories[] = $term->name;
            }

            echo '<dd>' . implode(', ', $categories ) . '</dd>';
        }
		if( $event_event_price ) {
			if( $event_event_price[0]['type'] == 'paid' && $event_event_price[0]['paid'] ){
				echo '<dt>' . __( 'Price', 'healthcoach' ) . ': <b class="text-lowercase">' . $event_event_price[0]['paid'] .'</b>' .'</dt>';
			}else{
				echo '<dd>' . __( 'Free', 'healthcoach' ) .'</dd>';
			}
        }

        echo '</dl>';


        ?>
        <?php
        echo $args['after_widget'];

    }

    function update( $new_instance, $instance ) {
        $instance['title'] = strip_tags( $new_instance['title'] );

        return $instance;
    }

    function form( $instance ) {
        $title  = empty( $instance['title'] ) ? __( 'Details', 'healthcoach' ) : esc_attr( $instance['title'] );

        ?>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'healthcoach' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>
    <?php
    }
}

class STM_Recent_Posts extends WP_Widget {

    public function __construct() {
        parent::__construct( 'widget_stm_recent_posts', __( 'STM Recent Posts', 'healthcoach' ), array(
            'classname'   => 'widget_recent-posts',
            'description' => __( 'Recent posts', 'healthcoach' ),
        ) );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
        }

        $posts = new WP_Query(array(
            'posts_per_page' => $instance['count'],
            'order' => 'DESC',
            'orderby' => 'date',

        ));

        if( $posts->have_posts() ) {
            echo '<ul>';

            while( $posts->have_posts() ) {
                $posts->the_post();
                echo '<li class="recent-post_type_widget">';
                if( has_post_thumbnail() ) {

					if( get_post_format() == 'video' ) {
						$caption_icon = 'film-play';
					} elseif( get_post_format() == 'image' ) {
						$caption_icon = 'picture';
					} else {
						$caption_icon = 'text-align-left';
					}

                    echo '<div class="recent-post__thumbnail">';
                    echo '<a href="' . esc_url( get_the_permalink() ) . '">'. get_the_post_thumbnail( get_the_ID(), 'thumb-255x104' ) . '</a>';
                    echo '<div class="recent-post__thumbnail-bump"></div>';
                    echo '<div class="recent-post__thumbnail-icon"><span class="lnr lnr-'. ( (isset( $caption_icon ) ) ? esc_attr( $caption_icon ) : '') .'"></span></div>';
                    echo '</div>';
                }
                echo get_the_title();
                echo '</li>';
            }

            echo '</ul>';

            wp_reset_postdata();
        }
        ?>
        <?php
        echo $args['after_widget'];

    }

    function update( $new_instance, $instance ) {
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['count'] = strip_tags( $new_instance['count'] );

        return $instance;
    }

    function form( $instance ) {
        $title  = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
        $count  = empty( $instance['count'] ) ? '' : esc_attr( $instance['count'] );

        ?>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'healthcoach' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php _e( 'Count:', 'healthcoach' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>"></p>
    <?php
    }
}

class STM_About_Widget extends WP_Widget {


    public function __construct() {
        parent::__construct( 'widget_stm_about', __( 'STM About', 'healthcoach' ), array(
            'classname'   => 'widget-stm-about',
            'description' => __( 'About info', 'healthcoach' ),
        ) );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
        }
        ?>
        <?php if( $instance['text'] != '' ) { ?>
            <div class="widget-text"><?php echo wp_kses( $instance['text'], array( 'a' => array( 'href' => array() ), 'br' => array(), 'b' => array(), 'strong' => array() ) ); ?></div>
        <?php } ?>
        <?php if( $instance['social_twitter'] != '' || $instance['social_facebook'] != '' ||  $instance['social_instagram'] != '' ||  $instance['social_custom_url'] != '' &&  $instance['social_custom_icon'] != '' ) { ?>
            <div class="widget-socials">
                <?php
                    if( $instance['social_twitter'] != '' ) {
                        echo '<a class="widget-socials__item" href="'. esc_url( $instance['social_twitter'] ) .'"><i class="fa fa-twitter-square"></i></a>';
                    }
                    if( $instance['social_facebook'] != '' ) {
                        echo '<a class="widget-socials__item" href="'. esc_url( $instance['social_facebook'] ) .'"><i class="fa fa-facebook-square"></i></a>';
                    }
                    if( $instance['social_instagram'] != '' ) {
                        echo '<a class="widget-socials__item" href="'. esc_url( $instance['social_instagram'] ) .'"><i class="fa fa-instagram"></i></a>';
                    }
                    if( $instance['social_custom_url'] != '' ) {
                        echo '<a href="'. esc_url( $instance['social_custom_url'] ) .'"><i class="fa fa-'. esc_attr( $instance['social_custom_icon'] ) .'"></i></a>';
                    }
                ?>
            </div>
        <?php } ?>
        <?php
            echo $args['after_widget'];

    }

    function update( $new_instance, $instance ) {
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['text'] = balanceTags( $new_instance['text'] );
        $instance['social_facebook'] = balanceTags( $new_instance['social_facebook'] );
        $instance['social_twitter'] = balanceTags( $new_instance['social_twitter'] );
        $instance['social_instagram'] = balanceTags( $new_instance['social_instagram'] );
        $instance['social_custom_url'] = balanceTags( $new_instance['social_custom_url'] );
        $instance['social_custom_icon'] = balanceTags( $new_instance['social_custom_icon'] );

        return $instance;
    }

    function form( $instance ) {
        $title  = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
        $text  = empty( $instance['text'] ) ? '' : esc_attr( $instance['text'] );
        $social_facebook  = empty( $instance['social_facebook'] ) ? '' : esc_attr( $instance['social_facebook'] );
        $social_twitter  = empty( $instance['social_twitter'] ) ? '' : esc_attr( $instance['social_twitter'] );
        $social_instagram  = empty( $instance['social_instagram'] ) ? '' : esc_attr( $instance['social_instagram'] );
        $social_custom_url  = empty( $instance['social_custom_url'] ) ? '' : esc_attr( $instance['social_custom_url'] );
        $social_custom_icon  = empty( $instance['social_custom_icon'] ) ? '' : esc_attr( $instance['social_custom_icon'] );

        ?>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'healthcoach' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php _e( 'Text:', 'healthcoach' ); ?></label>
            <textarea id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"><?php echo esc_attr( $text ); ?></textarea></p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'social_facebook' ) ); ?>"><?php _e( 'Facebook:', 'healthcoach' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'social_facebook' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'social_facebook' ) ); ?>" type="text" value="<?php echo esc_attr( $social_facebook ); ?>"></p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'social_twitter' ) ); ?>"><?php _e( 'Twitter:', 'healthcoach' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'social_twitter' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'social_twitter' ) ); ?>" type="text" value="<?php echo esc_attr( $social_twitter ); ?>"></p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'social_instagram' ) ); ?>"><?php _e( 'Instagram:', 'healthcoach' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'social_instagram' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'social_instagram' ) ); ?>" type="text" value="<?php echo esc_attr( $social_instagram ); ?>"></p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'social_custom_icon' ) ); ?>"><?php _e( 'Custom Icon:', 'healthcoach' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'social_custom_icon' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'social_custom_icon' ) ); ?>" type="text" value="<?php echo esc_attr( $social_custom_icon ); ?>"></p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'social_custom_url' ) ); ?>"><?php _e( 'Custom Url:', 'healthcoach' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'social_custom_url' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'social_custom_url' ) ); ?>" type="text" value="<?php echo esc_attr( $social_custom_url ); ?>"></p>

    <?php
    }
}

class STM_Contact_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct( 'widget_stm_contact', __( 'STM Contact', 'healthcoach' ), array(
            'classname'   => 'widget-stm-contact',
            'description' => __( 'Contact info', 'healthcoach' ),
        ) );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
        }
        ?>
        <?php if( $instance['address'] != '' ) { ?>
            <div class="widget-address"><?php echo wp_kses( $instance['address'], array( 'br' => array(), 'b' => array(), 'strong' => array() ) ); ?></div>
        <?php } ?>
        <?php if( $instance['telephone_number'] != '' || $instance['fax_number'] != '' ) { ?>
            <div class="widget-contact-numbers">
                <?php
                    if( $instance['telephone_number'] != '' ) {
                        echo '<div class="widget-telephone"><span class="widget-number-title">'. __( 'Tel', 'healthcoach' ) .': </span><span class="widget-number">'. esc_html( $instance['telephone_number'] ) .'</span></div>';
                    }
                    if( $instance['fax_number'] != '' ) {
                        echo '<div class="widget-fax"><span class="widget-number-title">'. __( 'Fax', 'healthcoach' ) .': </span><span class="widget-number">'. esc_html( $instance['fax_number'] ) .'</span></div>';
                    }
                ?>
            </div>
        <?php } ?>
        <?php if( $instance['email'] != '' ) { ?>
            <div class="widget-email"><?php echo wp_kses( $instance['email'], array( 'a' => array( 'href' => array() ) ) ); ?></div>
        <?php } ?>
        <?php
        echo $args['after_widget'];

    }

    function update( $new_instance, $instance ) {
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['address'] = strip_tags( $new_instance['address'] );
        $instance['telephone_number'] = strip_tags( $new_instance['telephone_number'] );
        $instance['fax_number'] = strip_tags( $new_instance['fax_number'] );
        $instance['email'] = strip_tags( $new_instance['email'] );

        return $instance;
    }

    function form( $instance ) {
        $title  = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
        $address  = empty( $instance['address'] ) ? '' : esc_html( $instance['address'] );
        $telephone_number  = empty( $instance['telephone_number'] ) ? '' : esc_html( $instance['telephone_number'] );
        $fax_number  = empty( $instance['fax_number'] ) ? '' : esc_html( $instance['fax_number'] );
        $email = empty( $instance['email'] ) ? '<a href="mailto:info@stylemixthemes.com">info@stylemixthemes.com</a>' : esc_html( $instance['email'] );

        ?>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'healthcoach' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php _e( 'Address:', 'healthcoach' ); ?></label>
            <textarea id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>"><?php echo esc_html( $address ); ?></textarea></p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'telephone_number' ) ); ?>"><?php _e( 'Telephone Number:', 'healthcoach' ); ?></label>
            <textarea id="<?php echo esc_attr( $this->get_field_id( 'telephone_number' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'telephone_number' ) ); ?>"><?php echo esc_html( $telephone_number ); ?></textarea></p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'fax_number' ) ); ?>"><?php _e( 'Fax Number:', 'healthcoach' ); ?></label>
            <textarea id="<?php echo esc_attr( $this->get_field_id( 'fax_number' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'fax_number' ) ); ?>"><?php echo esc_html( $fax_number ); ?></textarea></p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php _e( 'Email:', 'healthcoach' ); ?></label>
            <textarea id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>"><?php echo esc_html( $email ); ?></textarea></p>

    <?php
    }
}