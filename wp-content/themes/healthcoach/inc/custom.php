<?php
if ( !function_exists( 'stm_after_content_import' ) ) {

    function stm_after_content_import( $demo_active_import , $demo_directory_path ) {

        reset( $demo_active_import );
        $current_key = key( $demo_active_import );

        $locations = get_theme_mod('nav_menu_locations');
        $menus     = wp_get_nav_menus();

        if(!empty($menus))
        {
            foreach($menus as $menu)
            {
                if(is_object($menu) && $menu->name == 'Main Menu')
                {
                    $locations['primary'] = $menu->term_id;
                }
            }
        }

        set_theme_mod('nav_menu_locations', $locations);

        update_option( 'show_on_front', 'page' );

        update_option('large_size_w', 795);
        update_option('large_size_h', 544);

        $front_page = get_page_by_title( 'Home' );
        if ( isset( $front_page->ID ) ) {
            update_option( 'page_on_front', $front_page->ID );
        }
        $blog_page = get_page_by_title( 'Blog' );
        if ( isset( $blog_page->ID ) ) {
            update_option( 'page_for_posts', $blog_page->ID );
        }

        $shop_page = get_page_by_title( 'Healthy Shop' );

        if ( isset( $shop_page->ID ) ) {
            update_option( 'woocommerce_shop_page_id', $shop_page->ID );
        }

        if ( class_exists( 'RevSlider' ) ) {

            $wbc_sliders_array = array(
                'demo' => 'home_slider.zip'
            );

            if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
                $wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];

                if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
                    $slider = new RevSlider();
                    $slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
                }
            }
        }

    }
    add_action( 'wbc_importer_after_content_import', 'stm_after_content_import', 10, 2 );
}

/* Custom body class */
add_filter( 'body_class', 'stm_body_class' );
if( !function_exists('stm_body_class') ) {
    function stm_body_class( $classes ) {
        if( wp_is_mobile() ) {
            $classes[] = 'is-mobile';
        }

        return $classes;
    }
}

/* Custom post class */
add_filter( 'post_class', 'stm_post_class' );
if( !function_exists('stm_post_class') ) {
    function stm_post_class( $classes ) {
        if( is_single() && comments_open() || get_comments_number() ) {
            $classes[] = 'has-comment-form';
        }

        return $classes;
    }
}

if( !function_exists('stm_comment_template') ) {
    function stm_comment_template($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        extract( $args, EXTR_SKIP );

        if ( 'div' == $args['style'] ) {
            $tag = 'div';
            $add_below = 'comment';
        } else {
            $tag = 'li';
            $add_below = 'div-comment';
        }
        ?>
        <<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>">
        <div class="comment-inner">
        <div class="comment-avatar">
            <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        </div>
        <?php if ( 'div' != $args['style'] ) : ?>
            <div class="comment-body" id="div-comment-<?php comment_ID() ?>">
        <?php endif; ?>
        <header class="comment-heading clearfix">
            <div class="comment-author">
                <?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
            </div><!-- .comment-author -->
            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .replay -->
            <div class="comment-meta">
                    <?php
                        $comment_time = get_comment_time();
                        $comment_date = get_comment_date();
                        printf( '%1$s' , $comment_date ); ?><?php edit_comment_link( __( '(Edit)', 'healthcoach' ), '  ', '' );
                    ?>

            </div><!-- .comment-meta -->
        </header><!-- .comment-heading -->
        <?php if ( $comment->comment_approved == '0' ) : ?>
            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'healthcoach' ); ?></em>
            <br />
        <?php endif; ?>

        <div class="comment-content"><?php comment_text(); ?></div>

        <?php if ( 'div' != $args['style'] ) : ?>
            </div>
        <?php endif; ?>
        </div>
    <?php
    }
}

if( !function_exists('js_variables') ) {
    function js_variables() {
        ?>
        <script type="text/javascript">
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        </script>
    <?php
    }
}
add_action('wp_head','js_variables');

if( !function_exists('stm_excerpt_more') ) {
    function stm_excerpt_more( $more ) {
        return '...';
    }
}
add_filter('excerpt_more', 'stm_excerpt_more');

if( !function_exists('stm_excerpt_length') ) {
    function stm_excerpt_length( $length ) {
        return 15;
    }
}
add_filter( 'excerpt_length', 'stm_excerpt_length', 999 );

function stm_event_join_func() {
    $event_id = intval( $_REQUEST['event_id'] );
    $result = array();

    $total_members = get_post_meta( $event_id, 'event_members', true );
    update_post_meta( $event_id, 'event_members', $total_members + 1 );
    $result["members"] = get_post_meta( $event_id, 'event_members', true );

    echo json_encode( $result );
    exit;
}

add_action( 'wp_ajax_stm_event_join', 'stm_event_join_func' );
add_action( 'wp_ajax_nopriv_stm_event_join', 'stm_event_join_func' );

if( !function_exists('stm_upload_mimes') ) {
    function stm_upload_mimes ( $existing_mimes = array() ) {

        $existing_mimes['svg'] = 'mime/type';

        return $existing_mimes;
    }
}
add_filter('upload_mimes', 'stm_upload_mimes');

if ( ! function_exists( 'stm_updater' ) ) {
    function stm_updater() {
        global $stm_option;
        if( isset( $stm_option['envato_username'] ) && isset( $stm_option['envato_api'] ) ){
            $envato_username = trim( $stm_option['envato_username'] );
            $envato_api_key  = trim( $stm_option['envato_api'] );
            if ( ! empty( $envato_username ) && ! empty( $envato_api_key ) ) {
                load_template( get_template_directory() . '/inc/updater/envato-theme-update.php' );

                if ( class_exists( 'Envato_Theme_Updater' ) ) {
                    Envato_Theme_Updater::init( $envato_username, $envato_api_key, 'StylemixThemes' );
                }
            }
        }
    }
    add_action( 'after_setup_theme', 'stm_updater' );
}

// Redux field for demo
function stm_redux_field_value( $field ) {
    $field_value = stm_option( $field );

    if( isset( $_REQUEST[$field] ) && $_REQUEST[$field] != $field_value ) {
        $field_value = $_REQUEST[$field];
    }
    return $field_value;
}

function stm_custom_css() {
 $site_css = stm_option( 'site_css' );
 $output   = "\n<style id=\"stm_custom_css\" type=\"text/css\">\n" . preg_replace( '/\s+/', ' ', $site_css ) . "\n</style>\n";
 if ( ! empty( $site_css ) ) {
  echo $output;
 }
}

add_action( 'wp_head', 'stm_custom_css' );