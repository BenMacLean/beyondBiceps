<?php
add_action( 'vc_before_init', 'stm_vc_set_as_theme' );

function stm_vc_set_as_theme() {
    vc_set_as_theme( true );
}

if( function_exists( 'vc_set_default_editor_post_types' ) ){
	vc_set_default_editor_post_types( array( 'page', 'post', 'sidebar', 'product', 'event', 'testimonial' ) );
}

$dir = get_stylesheet_directory() . '/inc/visual-composer/vc-templates';
vc_set_shortcodes_templates_dir( $dir );

add_action( 'vc_after_init', 'stm_update_existing_shortcodes' );

if( !function_exists('stm_update_existing_shortcodes') ) {
    function stm_update_existing_shortcodes(){
        if ( function_exists( 'vc_add_params' ) ) {

            vc_add_params( 'vc_gmaps', array(
                array(
                    'type'       => 'css_editor',
                    'heading'    => __( 'Css', 'healthcoach' ),
                    'param_name' => 'vc_css',
                    'group'      => __( 'Design options', 'healthcoach' )
                ),
            ));

            vc_add_params( 'vc_row', array(
                array(
                    'type'       => 'checkbox',
                    'heading'    => __( 'Show', 'healthcoach' ),
                    'param_name' => 'show_bump',
                    'group'      => __( 'Bump', 'healthcoach' )
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Position', 'healthcoach' ),
                    'param_name' => 'bump_position',
                    'value' => array(
                        __( 'Top', 'healthcoach' )    => '',
                        __( 'Bottom', 'healthcoach' ) => 'bottom',
                    ),
                    'group'      => __( 'Bump', 'healthcoach' ),
                    'dependency' => array('element' => 'show_bump', 'value' => 'true'),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Offset', 'healthcoach' ),
                    'param_name' => 'bump_offset',
                    'group'      => __( 'Bump', 'healthcoach' ),
                    'dependency' => array('element' => 'show_bump', 'value' => 'true'),
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Color', 'healthcoach' ),
                    'param_name' => 'bump_color',
                    'group'      => __( 'Bump', 'healthcoach' ),
                    'dependency' => array('element' => 'show_bump', 'value' => 'true'),
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Icon - Type', 'healthcoach' ),
                    'param_name' => 'icon_type',
                    'value' => array(
                        __( 'Health Coach', 'healthcoach' ) => 'hc',
                        __( 'Font Awesome', 'healthcoach' ) => 'fontawesome',
                        __( 'Linear Icons', 'healthcoach' ) => 'linearicons',
                    ),
                    'group'      => __( 'Bump', 'healthcoach' ),
                    'dependency' => array('element' => 'show_bump', 'value' => 'true'),
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon - Health Coach', 'healthcoach' ),
                    'param_name' => 'icon_hc',
                    'settings'   => array(
                        'type'       => 'hc'
                        ),
                    'group'      => __( 'Bump', 'healthcoach' ),
                    'dependency' => array( 'element' => 'icon_type', 'value' => 'hc' )
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon - Font Awesome', 'healthcoach' ),
                    'param_name' => 'icon_fontawesome',
                    'settings'   => array(
                        'type'       => 'fontawesome'
                        ),
                    'group'      => __( 'Bump', 'healthcoach' ),
                    'dependency' => array( 'element' => 'icon_type', 'value' => 'fontawesome' )
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon - Linearicons', 'healthcoach' ),
                    'param_name' => 'icon_linearicons',
                    'settings'   => array(
                        'type'       => 'linearicons'
                        ),
                    'group'      => __( 'Bump', 'healthcoach' ),
                    'dependency' => array( 'element' => 'icon_type', 'value' => 'linearicons' )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Icon - Spacing', 'healthcoach' ),
                    'param_name' => 'icon_spacing',
                    'group'      => __( 'Bump', 'healthcoach' ),
                    'dependency' => array('element' => 'show_bump', 'value' => 'true'),
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Icon - Color', 'healthcoach' ),
                    'param_name' => 'icon_color',
                    'group'      => __( 'Bump', 'healthcoach' ),
                    'dependency' => array('element' => 'show_bump', 'value' => 'true'),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Icon - Size', 'healthcoach' ),
                    'param_name' => 'icon_size',
                    'group'      => __( 'Bump', 'healthcoach' ),
                    'dependency' => array('element' => 'show_bump', 'value' => 'true'),
                ),
            ));

            vc_add_params( 'vc_custom_heading', array(
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Type', 'healthcoach' ),
                    'param_name' => 'sep_type',
                    'value' => array(
                        __( 'Icon', 'healthcoach' )  => 'icon',
                        __( 'Image', 'healthcoach' ) => 'image',
                        __( 'Line', 'healthcoach' )  => 'line',
                    ),
                    'group'      => __( 'Separator', 'healthcoach' )
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Icon - Type', 'healthcoach' ),
                    'param_name' => 'icon_type',
                    'value' => array(
                        __( 'Health Coach', 'healthcoach' ) => 'hc',
                        __( 'Font Awesome', 'healthcoach' ) => 'fontawesome',
                        __( 'Linearicons', 'healthcoach' )     => 'linearicons',
                    ),
                    'group'      => __( 'Separator', 'healthcoach' ),
                    'dependency' => array('element' => 'sep_type', 'value' => 'icon')
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon - Health Coach', 'healthcoach' ),
                    'param_name' => 'icon_hc',
                    'settings'   => array(
                        'type'       => 'hc'
                        ),
                    'group'      => __( 'Separator', 'healthcoach' ),
                    'dependency' => array( 'element' => 'icon_type', 'value' => 'hc' )
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon - Font Awesome', 'healthcoach' ),
                    'param_name' => 'icon_fontawesome',
                    'settings'   => array(
                        'type'       => 'fontawesome'
                        ),
                    'group'      => __( 'Separator', 'healthcoach' ),
                    'dependency' => array( 'element' => 'icon_type', 'value' => 'fontawesome' )
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon - Linearicons', 'healthcoach' ),
                    'param_name' => 'icon_linearicons',
                    'settings'   => array(
                        'type'       => 'linearicons'
                        ),
                    'group'      => __( 'Separator', 'healthcoach' ),
                    'dependency' => array( 'element' => 'icon_type', 'value' => 'linearicons' )
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Icon - Color', 'healthcoach' ),
                    'param_name' => 'icon_color',
                    'group'      => __( 'Separator', 'healthcoach' ),
                    'dependency' => array('element' => 'sep_type', 'value' => 'icon'),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Icon - Size', 'healthcoach' ),
                    'param_name' => 'icon_size',
                    'group'      => __( 'Separator', 'healthcoach' ),
                    'dependency' => array('element' => 'sep_type', 'value' => 'icon'),
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Position', 'healthcoach' ),
                    'param_name' => 'sep_position',
                    'value' => array(
                        __( 'Top', 'healthcoach' )    => 'top',
                        __( 'Bottom', 'healthcoach' ) => 'bottom',
                    ),
                    'group'      => __( 'Separator', 'healthcoach' )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Spacing Top', 'healthcoach' ),
                    'param_name' => 'sep_spacing_top',
                    'group'      => __( 'Separator', 'healthcoach' ),
                    'dependency' => array('element' => 'sep_position', 'value' => 'bottom')
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Spacing Bottom', 'healthcoach' ),
                    'param_name' => 'sep_spacing_bot',
                    'group'      => __( 'Separator', 'healthcoach' ),
                    'dependency' => array('element' => 'sep_position', 'value' => 'top')
                ),
            ));
        }


        if( function_exists( 'vc_remove_param' ) ){}

        if( function_exists( 'vc_add_shortcode_param' ) ) {

            vc_add_shortcode_param( 'vc_stm_datepicker', 'vc_stm_datepicker_settings_field' );

            function vc_stm_datepicker_settings_field( $settings, $value ) {
                $uni = uniqid( 'datetimepicker-' . rand() );

                return '<div class="vc_stm_datepicker">'
                .'<input id="'. $uni .'" name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value ' .
                esc_attr( $settings['param_name'] ) . ' ' .
                esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />'
                .'</div>' .
                '<script type="text/javascript">
                    jQuery(document).ready(function(){
                        var datepickerId = "#' . esc_js( $uni ) . '";

                        jQuery( datepickerId ).datetimepicker({
                            timepicker  : false,
                            format : "m/d/Y"
                        });
                    })
                </script>';
            }

        }
    }
}

if ( function_exists( 'vc_map' ) ) {
    add_action( 'init', 'vc_stm_elements' );
}

function vc_stm_elements(){
    $wp_posts_per_page = get_option('posts_per_page');

// Info Box
    vc_map( array(
        'name'        => __( 'Info Box', 'healthcoach' ),
        'base'        => 'hc_info_box',
        'category'    => __( 'STM', 'healthcoach' ),
        'params'      => array(
            array(
                'type'       => 'dropdown',
                'heading'    => __( 'Type', 'healthcoach' ),
                'param_name' => 'info_box_type',
                'value' => array(
                    __( 'Default', 'healthcoach' ) => 'default',
                    __( 'Boxed', 'healthcoach' ) => 'boxed',
                    __( 'Boxed ( Hidden Description )', 'healthcoach' ) => 'boxed-2',
                )
            ),
            array(
                'type'       => 'textfield',
                'heading'    => __( 'Box - Height', 'healthcoach' ),
                'param_name' => 'box_height',
                'dependency' => array( 'element' => 'info_box_type', 'value' => array( 'boxed', 'boxed-2' ) )
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => __( 'Featured', 'healthcoach' ),
                'param_name' => 'box_featured',
                'dependency' => array( 'element' => 'info_box_type', 'value' => array( 'boxed' ) )
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => __( 'Icon - Type', 'healthcoach' ),
                'param_name' => 'icon_type',
                'value' => array(
                    __( 'Health Coach', 'healthcoach' ) => 'hc',
                    __( 'Font Awesome', 'healthcoach' ) => 'fontawesome',
                    __( 'Linear Icons', 'healthcoach' )     => 'linearicons',
                )
            ),
            array(
                'type'       => 'iconpicker',
                'heading'    => __( 'Icon - Health Coach', 'healthcoach' ),
                'param_name' => 'icon_hc',
                'settings'   => array(
                    'type'       => 'hc'
                ),
                'dependency' => array( 'element' => 'icon_type', 'value' => 'hc' )
            ),
            array(
                'type'       => 'iconpicker',
                'heading'    => __( 'Icon - Font Awesome', 'healthcoach' ),
                'param_name' => 'icon_fontawesome',
                'settings'   => array(
                    'type'       => 'fontawesome'
                ),
                'dependency' => array( 'element' => 'icon_type', 'value' => 'fontawesome' )
            ),
            array(
                'type'       => 'iconpicker',
                'heading'    => __( 'Icon - Linearicons', 'healthcoach' ),
                'param_name' => 'icon_linearicons',
                'settings'   => array(
                    'type'       => 'linearicons'
                ),
                'dependency' => array( 'element' => 'icon_type', 'value' => 'linearicons' )
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => __( 'Icon - Color', 'healthcoach' ),
                'param_name' => 'icon_color'
            ),
            array(
                'type'       => 'textfield',
                'heading'    => __( 'Icon - Size', 'healthcoach' ),
                'param_name' => 'icon_size'
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'healthcoach' ),
                'param_name' => 'title',
                'holder' => 'div',
            ),
            array(
                'type' => 'textarea_html',
                'heading' => __( 'Text', 'healthcoach' ),
                'param_name' => 'content',
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'Css', 'healthcoach' ),
                'param_name' => 'css',
                'group'      => __( 'Design options', 'healthcoach' )
            )
        )
    ) );

    vc_map( array(
        'name'        => __( 'Icon Box', 'healthcoach' ),
        'base'        => 'stm_icon_box',
        'category'    => __( 'STM', 'healthcoach' ),
        'params'      => array(
            array(
                'type' => 'dropdown',
                'heading' => __( 'Icon Type:', 'healthcoach' ),
                'param_name' => 'icon_type',
                'value' => array(
                    __( 'Image', 'healthcoach' ) => 'custom_image',
                    __( 'Icon', 'healthcoach' )  => 'icon',
                    __( 'Text', 'healthcoach' )  => 'text',
                ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => __( 'Custom Image', 'healthcoach' ),
                'param_name' => 'image_id',
                'dependency' => array('element' => 'icon_type', 'value' => 'custom_image'),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => __( 'Icon - Type', 'healthcoach' ),
                'param_name' => 'font_icon_type',
                'value' => array(
                    __( 'Health Coach', 'healthcoach' ) => 'hc',
                    __( 'Font Awesome', 'healthcoach' ) => 'fontawesome',
                    __( 'Linear Icons', 'healthcoach' ) => 'linearicons',
                ),
                'dependency' => array('element' => 'icon_type', 'value' => 'icon'),
            ),
            array(
                'type'       => 'iconpicker',
                'heading'    => __( 'Icon - Health Coach', 'healthcoach' ),
                'param_name' => 'icon_hc',
                'settings'   => array(
                    'type'       => 'hc'
                ),
                'dependency' => array( 'element' => 'font_icon_type', 'value' => 'hc' )
            ),
            array(
                'type'       => 'iconpicker',
                'heading'    => __( 'Icon - Font Awesome', 'healthcoach' ),
                'param_name' => 'icon_fontawesome',
                'settings'   => array(
                    'type'       => 'fontawesome'
                ),
                'dependency' => array( 'element' => 'font_icon_type', 'value' => 'fontawesome' )
            ),
            array(
                'type'       => 'iconpicker',
                'heading'    => __( 'Icon - Linearicons', 'healthcoach' ),
                'param_name' => 'icon_linearicons',
                'settings'   => array(
                    'type'       => 'linearicons'
                ),
                'dependency' => array( 'element' => 'font_icon_type', 'value' => 'linearicons' )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Text', 'healthcoach' ),
                'param_name' => 'text',
                'dependency' => array('element' => 'icon_type', 'value' => 'text'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'healthcoach' ),
                'param_name' => 'title',
                'holder' => 'div',
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Box Style:', 'healthcoach' ),
                'param_name' => 'box_style',
                'value' => array(
                    __( 'Icon Top', 'healthcoach' )   => 'icon-top',
                    __( 'Icon Left', 'healthcoach' )  => 'icon-left',
                    __( 'Icon Right', 'healthcoach' ) => 'icon-right',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Text - Margin Bottom', 'healthcoach' ),
                'param_name' => 'text_margin_bot',
                'value' => '22px',
                'description' => __( 'Example: 22px, 1.5em', 'healthcoach' ),
                'group' => __( 'Typography', 'healthcoach' ),
                'dependency' => array( 'element' => 'icon_type', 'value' => 'text' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Text Align:', 'healthcoach' ),
                'param_name' => 'text_align',
                'value' => array(
                    __( 'Center', 'healthcoach' ) => 'center',
                    __( 'Left', 'healthcoach' )   => 'left',
                    __( 'Right', 'healthcoach' )  => 'right',
                ),
                'group' => __( 'Typography', 'healthcoach' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Text - Font Weight:', 'healthcoach' ),
                'param_name' => 'text_font_weight',
                'value' => array(
                    __( 'Normal', 'healthcoach' )   => 400,
                    __( 'Light', 'healthcoach' )  => 300,
                    __( 'Bold', 'healthcoach' ) => 700,
                    __( 'Black', 'healthcoach' ) => 900,
                ),
                'dependency' => array( 'element' => 'icon_type', 'value' => 'text' ),
                'group' => __( 'Typography', 'healthcoach' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Text - Font Size', 'healthcoach' ),
                'param_name' => 'text_font_size',
                'value' => '36px',
                'description' => __( 'Example: 36px, 1.5em', 'healthcoach' ),
                'group' => __( 'Typography', 'healthcoach' ),
                'dependency' => array( 'element' => 'icon_type', 'value' => 'text' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Text - Color', 'healthcoach' ),
                'param_name' => 'text_color',
                'value' => '#ff6445',
                'group' => __( 'Typography', 'healthcoach' ),
                'dependency' => array( 'element' => 'icon_type', 'value' => 'text' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Text Circle - Size', 'healthcoach' ),
                'param_name' => 'text_circle_size',
                'value' => '133px',
                'description' => __( 'Example: 133px, 1.5em', 'healthcoach' ),
                'group' => __( 'Typography', 'healthcoach' ),
                'dependency' => array( 'element' => 'icon_type', 'value' => 'text' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Text Circle - Border:', 'healthcoach' ),
                'param_name' => 'text_border',
                'value' => array(
                    __( 'Solid', 'healthcoach' )  => 'solid',
                    __( 'Dashed', 'healthcoach' ) => 'dashed',
                    __( 'Dotted', 'healthcoach' ) => 'dotted',
                    __( 'Custom', 'healthcoach' ) => 'custom'
                ),
                'dependency' => array( 'element' => 'icon_type', 'value' => 'text' ),
                'group' => __( 'Typography', 'healthcoach' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Text Circle -  Border Width', 'healthcoach' ),
                'param_name' => 'text_border_width',
                'value' => '2px',
                'description' => __( 'Example: 2px, 1.5em', 'healthcoach' ),
                'dependency' => array( 'element' => 'text_border', 'value' => array('solid', 'dashed', 'dotted' ) ),
                'group' => __( 'Typography', 'healthcoach' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Text - Border Color:', 'healthcoach' ),
                'param_name' => 'text_border_color',
                'value' => '#cbd5da',
                'dependency' => array( 'element' => 'text_border', 'value' => array('solid', 'dashed', 'dotted', 'custom' ) ),
                'group' => __( 'Typography', 'healthcoach' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Icon Circle - Size:', 'healthcoach' ),
                'param_name' => 'icon_circle_size',
                'value' => '',
                'description' => __( 'Example: 133px, 1.5em', 'healthcoach' ),
                'group' => __( 'Typography', 'healthcoach' ),
                'dependency' => array( 'element' => 'icon_type', 'value' => array( 'icon', 'custom_image' ) ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Icon Circle - Background Color:', 'healthcoach' ),
                'param_name' => 'icon_bg_color',
                'value' => '',
                'dependency' => array( 'element' => 'icon_type', 'value' => array( 'icon', 'custom_image' ) ),
                'group' => __( 'Typography', 'healthcoach' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Icon Circle - Border:', 'healthcoach' ),
                'param_name' => 'icon_border',
                'value' => array(
                    __( 'None', 'healthcoach' )   => '',
                    __( 'Solid', 'healthcoach' )  => 'solid',
                    __( 'Dashed', 'healthcoach' ) => 'dashed',
                    __( 'Dotted', 'healthcoach' ) => 'dotted',
                ),
                'dependency' => array( 'element' => 'icon_type', 'value' => array( 'icon', 'custom_image' ) ),
                'group' => __( 'Typography', 'healthcoach' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Icon Circle -  Border Width:', 'healthcoach' ),
                'param_name' => 'icon_border_width',
                'value' => '',
                'description' => __( 'Example: 2px, 1.5em', 'healthcoach' ),
                'dependency' => array( 'element' => 'icon_border', 'value' => array('solid', 'dashed', 'dotted' ) ),
                'group' => __( 'Typography', 'healthcoach' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Icon - Border Color:', 'healthcoach' ),
                'param_name' => 'icon_border_color',
                'value' => '',
                'dependency' => array( 'element' => 'icon_border', 'value' => array('solid', 'dashed', 'dotted' ) ),
                'group' => __( 'Typography', 'healthcoach' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Icon - Min Height', 'healthcoach' ),
                'param_name' => 'icon_min_height',
                'value' => '',
                'description' => __( 'Example: 67px, 1.5em', 'healthcoach' ),
                'group' => __( 'Typography', 'healthcoach' ),
                'dependency' => array( 'element' => 'icon_type', 'value' => array( 'icon', 'custom_image' ) ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Icon - Margin Bottom', 'healthcoach' ),
                'param_name' => 'icon_margin_bot',
                'value' => '22px',
                'description' => __( 'Example: 22px, 1.5em', 'healthcoach' ),
                'group' => __( 'Typography', 'healthcoach' ),
                'dependency' => array( 'element' => 'icon_type', 'value' => array( 'icon', 'custom_image' ) ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Icon - Font Size', 'healthcoach' ),
                'param_name' => 'icon_font_size',
                'description' => __( 'Example: 40px, 1.5em', 'healthcoach' ),
                'group' => __( 'Typography', 'healthcoach' ),
                'dependency' => array( 'element' => 'icon_type', 'value' => array( 'icon', 'stm_icon' ) ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Icon - Color', 'healthcoach' ),
                'param_name' => 'icon_color',
                'group' => __( 'Typography', 'healthcoach' ),
                'dependency' => array( 'element' => 'icon_type', 'value' => array( 'icon', 'stm_icon' ) ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Title - Font Weight:', 'healthcoach' ),
                'param_name' => 'title_font_weight',
                'value' => array(
                    __( 'Normal', 'healthcoach' ) => 400,
                    __( 'Light', 'healthcoach' )  => 300,
                    __( 'Bold', 'healthcoach' )   => 700,
                    __( 'Black', 'healthcoach' )  => 900,
                ),
                'group' => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Title - Font Size', 'healthcoach' ),
                'param_name' => 'title_font_size',
                'description' => __( 'Example: 28px, 1em', 'healthcoach' ),
                'group' => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Title - Color', 'healthcoach' ),
                'param_name' => 'title_color',
                'group' => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Title - Padding Left', 'healthcoach' ),
                'param_name' => 'title_padd_left',
                'description' => __( 'Example: 38px, 2em', 'healthcoach' ),
                'group' => __( 'Padding / Margin', 'healthcoach' ),
                'dependency' => array( 'element' => 'box_style', 'value' => 'icon-left' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Title - Padding Right', 'healthcoach' ),
                'param_name' => 'title_padd_right',
                'group' => __( 'Padding / Margin', 'healthcoach' ),
                'description' => __( 'Example: 38px, 2em', 'healthcoach' ),
                'dependency' => array( 'element' => 'box_style', 'value' => 'icon-right' ),
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'Css', 'healthcoach' ),
                'param_name' => 'css',
                'group'      => __( 'Design options', 'healthcoach' )
            ),
        )
    ) );

    vc_map( array(
        'name'        => __( 'STM Info Box', 'healthcoach' ),
        'base'        => 'stm_info_box',
        'category'    => __( 'STM', 'healthcoach' ),
        'params'      => array(
            array(
                'type' => 'dropdown',
                'heading' => __( 'Icon Type:', 'healthcoach' ),
                'param_name' => 'icon_type',
                'value' => array(
                    __( 'Custom Image', 'healthcoach' ) => 'custom_image',
                    __( 'Font Icon', 'healthcoach' )    => 'icon',
                ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => __( 'Custom Image', 'healthcoach' ),
                'param_name' => 'image_id',
                'dependency' => array('element' => 'icon_type', 'value' => 'custom_image'),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Font Icon', 'healthcoach' ),
                'param_name' => 'font_icon',
                'dependency' => array('element' => 'icon_type', 'value' => 'icon'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'healthcoach' ),
                'param_name' => 'title',
                'holder' => 'div',
            ),
            array(
                'type' => 'textarea_html',
                'heading' => __( 'Description', 'healthcoach' ),
                'param_name' => 'content',
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Box Style:', 'healthcoach' ),
                'param_name' => 'box_style',
                'value' => array(
                    __( 'Icon Top', 'healthcoach' )   => 'top',
                    __( 'Icon Left', 'healthcoach' )  => 'left',
                    __( 'Icon Right', 'healthcoach' ) => 'right',
                    __( 'Icon Between Title & Content', 'healthcoach' ) => 'between',
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Text Align:', 'healthcoach' ),
                'param_name' => 'text_align',
                'value' => array(
                    __( 'Center', 'healthcoach' )   => 'center',
                    __( 'Left', 'healthcoach' )  => 'left',
                    __( 'Right', 'healthcoach' )  => 'right',
                ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Featured:', 'healthcoach' ),
                'param_name' => 'box_featured',
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Margin Bottom', 'healthcoach' ),
                'param_name' => 'title_margin_bot',
                'value' => '16px',
                'description' => __( 'Example: 16px, 2em', 'healthcoach' ),
                'group' => __( 'Title Options', 'healthcoach' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Tag:', 'healthcoach' ),
                'param_name' => 'title_tag',
                'value' => array(
                    __( 'h3', 'healthcoach' )   => 'h3',
                    __( 'div', 'healthcoach' )  => 'div',
                    __( 'h1', 'healthcoach' ) => 'h1',
                    __( 'h2', 'healthcoach' ) => 'h2',
                    __( 'h4', 'healthcoach' ) => 'h4',
                ),
                'group' => __( 'Title Options', 'healthcoach' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Font Weight:', 'healthcoach' ),
                'param_name' => 'title_font_weight',
                'value' => array(
                    __( 'Normal', 'healthcoach' ) => 400,
                    __( 'Light', 'healthcoach' )  => 300,
                    __( 'Bold', 'healthcoach' )   => 700,
                    __( 'Black', 'healthcoach' )  => 900,
                ),
                'group' => __( 'Title Options', 'healthcoach' )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Font Size', 'healthcoach' ),
                'param_name' => 'title_font_size',
                'description' => __( 'Example: 28px, 1em', 'healthcoach' ),
                'group' => __( 'Title Options', 'healthcoach' )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Color', 'healthcoach' ),
                'param_name' => 'title_color',
                'group' => __( 'Title Options', 'healthcoach' )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Padding Left', 'healthcoach' ),
                'param_name' => 'title_padd_left',
                'description' => __( 'Example: 38px, 2em', 'healthcoach' ),
                'group' => __( 'Title Options', 'healthcoach' ),
                'dependency' => array( 'element' => 'box_style', 'value' => 'left' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Padding Right', 'healthcoach' ),
                'param_name' => 'title_padd_right',
                'group' => __( 'Title Options', 'healthcoach' ),
                'description' => __( 'Example: 38px, 2em', 'healthcoach' ),
                'dependency' => array( 'element' => 'box_style', 'value' => 'right' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Font Weight:', 'healthcoach' ),
                'param_name' => 'desc_font_weight',
                'value' => array(
                    __( 'Normal', 'healthcoach' )   => 400,
                    __( 'Light', 'healthcoach' )  => 300,
                    __( 'Bold', 'healthcoach' ) => 700,
                    __( 'Black', 'healthcoach' ) => 900,
                ),
                'group' => __( 'Description Options', 'healthcoach' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Font Size', 'healthcoach' ),
                'param_name' => 'desc_font_size',
                'value' => '14px',
                'description' => __( 'Example: 14px, em', 'healthcoach' ),
                'group' => __( 'Description Options', 'healthcoach' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Color', 'healthcoach' ),
                'param_name' => 'desc_color',
                'value' => '#636d72',
                'group' => __( 'Description Options', 'healthcoach' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Margin Bottom', 'healthcoach' ),
                'param_name' => 'icon_margin_bot',
                'value' => '16px',
                'description' => __( 'Example: 16px, 2em', 'healthcoach' ),
                'dependency' => array( 'element' => 'icon_type', 'value' => array( 'icon', 'custom_image' ) ),
                'group' => __( 'Icon Options', 'healthcoach' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Size', 'healthcoach' ),
                'param_name' => 'icon_size',
                'description' => __( 'Example: 40px, 1.5em', 'healthcoach' ),
                'dependency' => array( 'element' => 'icon_type', 'value' => array( 'icon', 'custom_image' ) ),
                'group' => __( 'Icon Options', 'healthcoach' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Color', 'healthcoach' ),
                'param_name' => 'icon_color',
                'group' => __( 'Icon Options', 'healthcoach' ),
                'dependency' => array( 'element' => 'icon_type', 'value' => 'icon' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Border:', 'healthcoach' ),
                'param_name' => 'icon_border',
                'value' => array(
                    __( 'Solid', 'healthcoach' ) => 'solid',
                    __( 'Dotted', 'healthcoach' )  => 'dotted',
                    __( 'Dashed', 'healthcoach' )   => 'dashed',
                    __( 'None', 'healthcoach' )   => 'none',
                ),
                'group' => __( 'Icon Options', 'healthcoach' )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Border Width:', 'healthcoach' ),
                'param_name' => 'icon_border_width',
                'description' => __( 'Example: 6px, em', 'healthcoach' ),
                'value' => '6px',
                'dependency' => array( 'element' => 'icon_border', 'value' => array('solid', 'dotted', 'dashed') ),
                'group' => __( 'Icon Options', 'healthcoach' )
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Border Color Type:', 'healthcoach' ),
                'param_name' => 'icon_border_color_type',
                'value' => array(
                    __( 'Primary', 'healthcoach' ) => 'primary',
                    __( 'Custom', 'healthcoach' ) => 'custom',
                ),
                'dependency' => array( 'element' => 'icon_border', 'value' => array('solid', 'dotted', 'dashed') ),
                'group' => __( 'Icon Options', 'healthcoach' )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Border Color:', 'healthcoach' ),
                'param_name' => 'icon_border_color',
                'value' => '#ffffff',
                'dependency' => array( 'element' => 'icon_border_color_type', 'value' => 'custom' ),
                'group' => __( 'Icon Options', 'healthcoach' )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Border Radius:', 'healthcoach' ),
                'param_name' => 'icon_border_radius',
                'description' => __( 'Example: 25px, em, 50%', 'healthcoach' ),
                'value' => '50%',
                'group' => __( 'Icon Options', 'healthcoach' )
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Style:', 'healthcoach' ),
                'param_name' => 'sep_style',
                'value' => array(
                    __( 'Solid', 'healthcoach' ) => 'solid',
                    __( 'Dotted', 'healthcoach' )  => 'dotted',
                    __( 'Dashed', 'healthcoach' )   => 'dashed',
                    __( 'None', 'healthcoach' )   => 'none',
                ),
                'group' => __( 'Separator Options', 'healthcoach' )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Width:', 'healthcoach' ),
                'param_name' => 'sep_width',
                'description' => __( 'Example: 63px, em', 'healthcoach' ),
                'value' => '63px',
                'dependency' => array( 'element' => 'sep_style', 'value' => array('solid', 'dotted', 'dashed') ),
                'group' => __( 'Separator Options', 'healthcoach' )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Height:', 'healthcoach' ),
                'param_name' => 'sep_height',
                'description' => __( 'Example: 1px, em', 'healthcoach' ),
                'value' => '1px',
                'dependency' => array( 'element' => 'sep_style', 'value' => array('solid', 'dotted', 'dashed') ),
                'group' => __( 'Separator Options', 'healthcoach' )
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Color Type:', 'healthcoach' ),
                'param_name' => 'sep_color_type',
                'value' => array(
                    __( 'Primary', 'healthcoach' ) => 'primary',
                    __( 'Custom', 'healthcoach' ) => 'custom',
                ),
                'dependency' => array( 'element' => 'sep_style', 'value' => array('solid', 'dotted', 'dashed') ),
                'group' => __( 'Separator Options', 'healthcoach' )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Color:', 'healthcoach' ),
                'param_name' => 'sep_color',
                'value' => '#ff6445',
                'dependency' => array( 'element' => 'sep_color_type', 'value' => 'custom' ),
                'group' => __( 'Separator Options', 'healthcoach' )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Margin Bottom', 'healthcoach' ),
                'param_name' => 'sep_margin_bot',
                'value' => '17px',
                'description' => __( 'Example: 17px, 2em', 'healthcoach' ),
                'dependency' => array( 'element' => 'sep_style', 'value' => array('solid', 'dotted', 'dashed') ),
                'group' => __( 'Separator Options', 'healthcoach' ),
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'Css', 'healthcoach' ),
                'param_name' => 'css',
                'group'      => __( 'Design options', 'healthcoach' )
            ),
        )
    ) );

    vc_map( array(
        'name'        => __( 'Pricing Table', 'healthcoach' ),
        'base'        => 'stm_pricing_table',
        'category'    => __( 'STM', 'healthcoach' ),
        'params'      => array(
            array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'healthcoach' ),
                'param_name' => 'title',
                'holder' => 'div',
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Price', 'healthcoach' ),
                'param_name' => 'price',
                'description' => __( 'Example: $29.99', 'healthcoach' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Price Description', 'healthcoach' ),
                'param_name' => 'price_desc',
                'description' => __( 'Example: Per day', 'healthcoach' )
            ),
            array(
                'type' => 'textarea_html',
                'heading' => __( 'Content', 'healthcoach' ),
                'param_name' => 'content',
            ),
            array(
                'type' => 'vc_link',
                'heading' => __( 'Button', 'healthcoach' ),
                'param_name' => 'button',
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Label:', 'healthcoach' ),
                'param_name' => 'label_enable',
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Text', 'healthcoach' ),
                'param_name' => 'label_text',
                'value' => 'Recommended',
                'dependency' => array( 'element' => 'label_enable', 'value' => 'true' ),
                'group' => __( 'Label', 'healthcoach' )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Color', 'healthcoach' ),
                'param_name' => 'label_text_color',
                'value' => '#ffffff',
                'dependency' => array( 'element' => 'label_enable', 'value' => 'true' ),
                'group' => __( 'Label', 'healthcoach' )
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Border:', 'healthcoach' ),
                'param_name' => 'sep_border',
                'value' => array(
                    __( 'Dotted', 'healthcoach' ) => 'dotted',
                    __( 'Dashed', 'healthcoach' )  => 'dashed',
                    __( 'Solid', 'healthcoach' )   => 'solid',
                ),
                'group' => __( 'Separator', 'healthcoach' )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Border Width', 'healthcoach' ),
                'param_name' => 'sep_border_width',
                'value' => '1px',
                'description' => __( 'Example: 1px, 2em', 'healthcoach' ),
                'group' => __( 'Separator', 'healthcoach' )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Border Color', 'healthcoach' ),
                'param_name' => 'sep_border_color',
                'value' => '#e7ebee',
                'group' => __( 'Separator', 'healthcoach' )
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Title - Font Weight:', 'healthcoach' ),
                'param_name' => 'title_font_weight',
                'value' => array(
                    __( 'Normal', 'healthcoach' ) => 400,
                    __( 'Light', 'healthcoach' )  => 300,
                    __( 'Bold', 'healthcoach' )   => 700,
                    __( 'Black', 'healthcoach' )  => 900,
                ),
                'group' => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Title - Font Size', 'healthcoach' ),
                'param_name' => 'title_font_size',
                'value' => '28px',
                'description' => __( 'Example: 28px, 1em', 'healthcoach' ),
                'group' => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Title - Color', 'healthcoach' ),
                'param_name' => 'title_color',
                'value' => '#222426',
                'group' => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Price - Font Weight:', 'healthcoach' ),
                'param_name' => 'price_font_weight',
                'value' => array(
                    __( 'Bold', 'healthcoach' )   => 700,
                    __( 'Normal', 'healthcoach' ) => 400,
                    __( 'Light', 'healthcoach' )  => 300,
                    __( 'Black', 'healthcoach' )  => 900,
                ),
                'group' => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Price - Font Size', 'healthcoach' ),
                'param_name' => 'price_font_size',
                'value' => '42px',
                'description' => __( 'Example: 42px, 2em', 'healthcoach' ),
                'group' => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Price - Color', 'healthcoach' ),
                'param_name' => 'price_color',
                'value' => '#ff6445',
                'group' => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Price Description - Font Weight:', 'healthcoach' ),
                'param_name' => 'price_desc_font_weight',
                'value' => array(
                    __( 'Normal', 'healthcoach' ) => 400,
                    __( 'Light', 'healthcoach' )  => 300,
                    __( 'Bold', 'healthcoach' )   => 700,
                    __( 'Black', 'healthcoach' )  => 900,
                ),
                'group' => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Price - Font Size', 'healthcoach' ),
                'param_name' => 'price_desc_font_size',
                'value' => '14px',
                'description' => __( 'Example: 14px, 2em', 'healthcoach' ),
                'group' => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Price Description - Color', 'healthcoach' ),
                'param_name' => 'price_desc_color',
                'value' => '#ff6445',
                'group' => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Content - Font Size', 'healthcoach' ),
                'param_name' => 'content_font_size',
                'value' => '15px',
                'description' => __( 'Example: 14px, 2em', 'healthcoach' ),
                'group' => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Content - Color', 'healthcoach' ),
                'param_name' => 'content_color',
                'value' => '#636d72',
                'group' => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'Css', 'healthcoach' ),
                'param_name' => 'css',
                'group'      => __( 'Design options', 'healthcoach' )
            ),
        )
    ) );

    $service_categories_terms = get_terms( 'service_categories' );
    $service_categories_array = array();

    if( ! is_wp_error( $service_categories_terms ) ) {
        $service_categories_array[__( 'Select category', 'healthcoach' )] = 0;
        foreach( $service_categories_terms as $service_categories_term ) {
            $service_categories_array[$service_categories_term->name] = $service_categories_term->slug;
        }
    } else {
        $service_categories_array[__( 'No categories', 'healthcoach' )] = 0;
    }

    vc_map( array(
        'name'        => __( 'Services', 'healthcoach' ),
        'base'        => 'stm_services',
        'category'    => __( 'STM', 'healthcoach' ),
        'params'      => array(
            array(
                'type' => 'dropdown',
                'heading' => __( 'Type:', 'healthcoach' ),
                'param_name' => 'service_type',
                'value' => array(
                    __( 'Recent', 'healthcoach' )  => 'recent',
                    __( 'Archive', 'healthcoach' ) => 'archive'
                ),
                'holder' => 'div'
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Columns:', 'healthcoach' ),
                'param_name' => 'cols',
                'value' => array(
                    __( 'Two', 'healthcoach' )   => 2,
                    __( 'Three', 'healthcoach' ) => 3,
                    __( 'Four', 'healthcoach' )  => 4,
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Thumbnail Size:', 'healthcoach' ),
                'param_name' => 'thumbnail_size',
                'description' => __( 'Default size: 350x258, Example: 500x500', 'healthcoach' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Categories:', 'healthcoach' ),
                'param_name' => 'category',
                'value' => $service_categories_array,
                'group'     => __( 'Query settings', 'healthcoach' )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Count:', 'healthcoach' ),
                'param_name' => 'count',
                'description' => __( 'Leave empty for display all services', 'healthcoach' ),
                'group'     => __( 'Query settings', 'healthcoach' )
            ),
            array(
                "type" => "checkbox",
                "class" => "",
                "heading" => __( "Pagination", 'healthcoach' ),
                "param_name" => "pagination_enable",
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'Css', 'healthcoach' ),
                'param_name' => 'css',
                'group'     => __( 'Design options', 'healthcoach' )
            ),
        )
    ) );

    vc_map( array(
        'name'        => __( 'Stats Counter', 'healthcoach' ),
        'base'        => 'stm_stats',
        'category'    => __( 'STM', 'healthcoach' ),
        'params'      => array(
            array(
                'type'       => 'dropdown',
                'heading'    => __( 'Counter Position', 'healthcoach' ),
                'param_name' => 'stats_style',
                'value'      => array(
                    __( 'Top', 'healthcoach' ) => 'top',
                    __( 'Left', 'healthcoach' ) => 'left',
                    __( 'Right', 'healthcoach' ) => 'right',
                )
            ),
            array(
                'type'       => 'textfield',
                'heading'    => __( 'Value', 'healthcoach' ),
                'param_name' => 'value',
            ),
            array(
                'type'       => 'textfield',
                'heading'    => __( 'Duration', 'healthcoach' ),
                'param_name' => 'duration',
                'value'      => '2.5'
            ),
            array(
                'type'       => 'textarea',
                'heading'    => __( 'Description', 'healthcoach' ),
                'param_name' => 'desc',
                'holder'     => 'div',
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => __( 'Description Color', 'healthcoach' ),
                'value'      => '#ffffff',
                'param_name' => 'desc_color',
                'group'      => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type'       => 'textfield',
                'heading'    => __( 'Description Font Size', 'healthcoach' ),
                'value'      => '18px',
                'param_name' => 'desc_font_size',
                'group'      => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => __( 'Value Color', 'healthcoach' ),
                'value'      => '#ffffff',
                'param_name' => 'value_color',
                'group'      => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type'       => 'textfield',
                'heading'    => __( 'Value Font Size', 'healthcoach' ),
                'value'      => '55px',
                'param_name' => 'value_font_size',
                'group'      => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type'       => 'textfield',
                'heading'    => __( 'Size', 'healthcoach' ),
                'param_name' => 'value_container_size',
                'value'      => '133px',
                'group'      => __( 'Value Container', 'healthcoach' )
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => __( 'Border - color', 'healthcoach' ),
                'param_name' => 'value_container_color',
                'value'      => '',
                'group'      => __( 'Value Container', 'healthcoach' )
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'Css', 'healthcoach' ),
                'param_name' => 'css',
                'group'      => __( 'Design options', 'healthcoach' )
            ),
        )
    ) );

    $category_terms = get_terms( 'category' );
    $categories_array = array();
    if( ! is_wp_error( $category_terms ) ) {
        $categories_array[__( 'Select category', 'healthcoach' )] = 0;
        foreach( $category_terms as $category_term ) {
            $categories_array[$category_term->name] = $category_term->slug;
        }
    } else {
        $categories_array[__( 'No categories', 'healthcoach' )] = 0;
    }

    vc_map( array(
        'name'        => __( 'Recent Posts', 'healthcoach' ),
        'base'        => 'stm_recent_posts',
        'category'    => __( 'STM', 'healthcoach' ),
        'params'      => array(
            array(
                'type'       => 'dropdown',
                'heading'    => __( 'Columns per row', 'healthcoach' ),
                'param_name' => 'columns_per_row',
                'value'      => array(
                    __( 'Three', 'healthcoach' ) => 3,
                    __( 'Two', 'healthcoach' )   => 2,
                    __( 'Four', 'healthcoach' )  => 4,
                )
            ),
            array(
                'type'       => 'textfield',
                'heading'    => __( 'Thumbnail Size', 'healthcoach' ),
                'param_name' => 'thumbnail_size',
                'description' => __( 'Default size: 350x270; Example: 500x500', 'healthcoach' ),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => __( 'Post format', 'healthcoach' ),
                'param_name' => 'posts_format',
                'value'      => array(
                    __( 'Standard', 'healthcoach' ) => 0,
                    __( 'Video', 'healthcoach' )    => 'video'
                ),
                'group'      => __( 'Query settings', 'healthcoach' )
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => __( 'Post categories', 'healthcoach' ),
                'param_name' => 'posts_category',
                'value'      => $categories_array,
                'group'      => __( 'Query settings', 'healthcoach' )
            ),
            array(
                'type'       => 'textfield',
                'heading'    => __( 'Post count', 'healthcoach' ),
                'param_name' => 'posts_count',
                'description' => __( 'Leave empty for display all posts', 'healthcoach' ),
                'group'      => __( 'Query settings', 'healthcoach' ),
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'Css', 'healthcoach' ),
                'param_name' => 'css',
                'group'      => __( 'Design options', 'healthcoach' )
            ),
        )
    ) );

    $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

    $contact_forms = array();
    if ( $cf7 ) {
        foreach ( $cf7 as $cform ) {
            $contact_forms[ $cform->post_title ] = $cform->ID;
        }
    } else {
        $contact_forms[ __( 'No contact forms found', 'healthcoach' ) ] = 0;
    }

    vc_map( array(
        'name'        => __( 'Contact Form 7', 'healthcoach' ),
        'base'        => 'stm_contact_form7',
        'category'    => __( 'STM', 'healthcoach' ),
        'params'      => array(
            array(
                'type' => 'textfield',
                'heading' => __( 'Form title', 'healthcoach' ),
                'param_name' => 'title',
                'description' => __( 'What text use as form title. Leave blank if no title is needed.', 'healthcoach' )
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Select contact form', 'healthcoach' ),
                'param_name' => 'form_id',
                'admin_label' => true,
                'value' => $contact_forms,
                'description' => __( 'Choose previously created contact form from the drop down list.', 'healthcoach' )
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'Css', 'healthcoach' ),
                'param_name' => 'css',
                'group'      => __( 'Design options', 'healthcoach' )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Border Radius', 'healthcoach' ),
                'param_name' => 'container_border_radius',
                'description' => __( '1.Top Left, 2.Top Right, 3.Bottom Right, 4.Bottom Left. Example: 9px;9px;0;0', 'healthcoach' ),
                'group'      => __( 'Design options', 'healthcoach' )
            ),
        )
    ) );

    vc_map( array(
        'name'        => __( 'Events', 'healthcoach' ),
        'base'        => 'stm_events',
        'category'    => __( 'STM', 'healthcoach' ),
        'params'      => array(
            array(
                'type' => 'dropdown',
                'heading' => __( 'View', 'healthcoach' ),
                'param_name' => 'view',
                'value' => array(
                    __( 'Grid', 'healthcoach' ) => 'grid',
                    __( 'List', 'healthcoach' ) => 'list',
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Posts Per Page', 'healthcoach' ),
                'param_name' => 'posts_per_page',
                'value' => $wp_posts_per_page,
                'description' => __('Default value set from Wordpress "General->Reading->Blog pages show at most"', 'healthcoach')
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'Css', 'healthcoach' ),
                'param_name' => 'css',
                'group'      => __( 'Design options', 'healthcoach' )
            ),
        )
    ) );

    $stm_sidebars_array = get_posts( array( 'post_type' => 'sidebar', 'posts_per_page' => -1 ) );
    $stm_sidebars = array( __( 'Select', 'healthcoach' ) => 0 );
    if( ! is_wp_error( $stm_sidebars_array ) ){
        foreach( $stm_sidebars_array as $val ){
            $stm_sidebars[ get_the_title( $val ) ] = $val->ID;
        }
    }

    vc_map( array(
        'name'        => __( 'STM Sidebar', 'healthcoach' ),
        'base'        => 'stm_sidebar',
        'category'    => __( 'STM', 'healthcoach' ),
        'params'      => array(
            array(
                'type'       => 'dropdown',
                'heading'    => __( 'Sidebars', 'healthcoach' ),
                'param_name' => 'sidebar',
                'value'      => $stm_sidebars,
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'Css', 'healthcoach' ),
                'param_name' => 'css',
                'group' => __( 'Design options', 'healthcoach' )
            )
        )
    ) );

    vc_map( array(
        'name'        => __( 'Recent Posts', 'healthcoach' ),
        'base'        => 'stm_recent_posts_widget',
        'category'    => __( 'STM Widgets', 'healthcoach' ),
        'params'      => array(
            array(
                'type' => 'textfield',
                'holder' => 'div',
                'heading' => __( 'Title', 'healthcoach' ),
                'param_name' => 'title'
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Count', 'healthcoach' ),
                'param_name' => 'count'
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'Css', 'healthcoach' ),
                'param_name' => 'css',
                'group'      => __( 'Design options', 'healthcoach' )
            )
        )
    ) );

    vc_map( array(
        'name'        => __( 'Countdown', 'healthcoach' ),
        'base'        => 'stm_countdown_widget',
        'category'    => __( 'STM Widgets', 'healthcoach' ),
        'params'      => array(
            array(
                'type' => 'textfield',
                'holder' => 'div',
                'heading' => __( 'Title', 'healthcoach' ),
                'param_name' => 'title'
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Description', 'healthcoach' ),
                'param_name' => 'text'
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Date', 'healthcoach' ),
                'param_name' => 'date'
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'Css', 'healthcoach' ),
                'param_name' => 'css',
                'group'      => __( 'Design options', 'healthcoach' )
            )
        )
    ) );

    vc_map( array(
        'name'        => __( 'Contact Information', 'healthcoach' ),
        'base'        => 'stm_contact_info',
        'category'    => __( 'STM', 'healthcoach' ),
        'params'      => array(
            array(
                'type' => 'textfield',
                'holder' => 'div',
                'heading' => __( 'Title', 'healthcoach' ),
                'param_name' => 'title'
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Time', 'healthcoach' ),
                'param_name' => 'time'
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Address', 'healthcoach' ),
                'param_name' => 'address'
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'E-Mail', 'healthcoach' ),
                'param_name' => 'email'
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Phone, Fax', 'healthcoach' ),
                'param_name' => 'phone'
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'Css', 'healthcoach' ),
                'param_name' => 'css',
                'group'      => __( 'Design options', 'healthcoach' )
            )
        )
    ) );

    $categories = get_terms('item_categories');
    $categories_array = array();
    $categories_array['Select'] = 0;

    if( ! is_wp_error( $categories ) ) {
        foreach( $categories as $category ) {
            $categories_array[$category->name] = $category->slug;
        }
    }

    vc_map( array(
        'name'        => __( 'Qualification - Carousel', 'healthcoach' ),
        'base'        => 'stm_items_carousel',
        'category'    => __( 'STM', 'healthcoach' ),
        'params'      => array(
            array(
                'type'       => 'dropdown',
                'heading'    => __( 'Categories', 'healthcoach' ),
                'param_name' => 'category_slug',
                'value'      => $categories_array
            ),
            array(
                'type'       => 'textfield',
                'heading'    => __( 'Count', 'healthcoach' ),
                'param_name' => 'count_posts',
            ),
            array(
                'type'       => 'textfield',
                'heading'    => __( 'Title Font Size', 'healthcoach' ),
                'param_name' => 'title_font_size',
                'value'      => '14px',
                'group'      => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => __( 'Title Color', 'healthcoach' ),
                'param_name' => 'title_color',
                'value'      => '#636d72',
                'group'      => __( 'Typography', 'healthcoach' )
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => __( 'Navigation - Bullets', 'healthcoach' ),
                'param_name' => 'carousel_bullets',
                'value'      => array(
                    __( 'Enable', 'healthcoach' ) => 'enable',
                    __( 'Disable', 'healthcoach' ) => 'disable',
                ),
                'group'      => __( 'Carousel Settings', 'healthcoach' )
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'Css', 'healthcoach' ),
                'param_name' => 'css',
                'group'      => __( 'Design options', 'healthcoach' )
            ),
        )
    ) );

    vc_map (
        array(
            "name" => __( "Testimonial", 'healthcoach' ),
            "base" => "stm_testimonial",
            "class" => "",
            "icon" => "",
            "category" => "STM",
            "params" => array(
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __( "Author", 'healthcoach' ),
                    "param_name" => "author",
                    "holder" => 'div',
                ),
                array(
                    "type" => "textarea_html",
                    "class" => "",
                    "heading" => __( "Text", 'healthcoach' ),
                    "param_name" => "content",
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Icon - Type', 'healthcoach' ),
                    'param_name' => 'icon_type',
                    'value' => array(
                        __( 'Health Coach', 'healthcoach' ) => 'hc',
                        __( 'Font Awesome', 'healthcoach' ) => 'fontawesome',
                        __( 'Linear Icons', 'healthcoach' ) => 'linearicons',
                    ),
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon - Health Coach', 'healthcoach' ),
                    'param_name' => 'icon_hc',
                    'settings'   => array(
                        'type'       => 'hc'
                    ),
                    'dependency' => array( 'element' => 'icon_type', 'value' => 'hc' )
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon - Font Awesome', 'healthcoach' ),
                    'param_name' => 'icon_fontawesome',
                    'settings'   => array(
                        'type'       => 'fontawesome'
                    ),
                    'dependency' => array( 'element' => 'icon_type', 'value' => 'fontawesome' )
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon - Linearicons', 'healthcoach' ),
                    'param_name' => 'icon_linearicons',
                    'settings'   => array(
                        'type'       => 'linearicons'
                    ),
                    'dependency' => array( 'element' => 'icon_type', 'value' => 'linearicons' )
                ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => __( "Place:", 'healthcoach' ),
                    "param_name" => "icon_place",
                    "value" => array(
                        __( 'Top', 'healthcoach' )    => 'top',
                        __( 'Left', 'healthcoach' )   => 'left',
                        __( 'Right', 'healthcoach' )  => 'right',
                        __( 'Bottom', 'healthcoach' ) => 'bottom',
                    ),
                    "group" => __("Icon Options", 'healthcoach'),
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __( "Color", 'healthcoach' ),
                    "param_name" => "icon_color",
                    "value" => "",
                    "group" => __( "Icon Options", 'healthcoach' ),
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __( "Size", 'healthcoach' ),
                    "param_name" => "icon_size",
                    "description" => __( "Example: 14px, em, %", 'healthcoach' ),
                    "group" => __( "Icon Options", 'healthcoach' ),
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __( "Margin", 'healthcoach' ),
                    "param_name" => "icon_margin",
                    "description" => __( "1. Top, 2. Right, 3. Bottom, 4. Left. Example: 10px,15px,12px,0px", 'healthcoach' ),
                    "group" => __( "Icon Options", 'healthcoach' )
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __( "Padding", 'healthcoach' ),
                    "param_name" => "icon_padding",
                    "description" => __( "1. Top, 2. Right, 3. Bottom, 4. Left. Example: 10px,15px,12px,0px", 'healthcoach' ),
                    "group" => __( "Icon Options", 'healthcoach' )
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __( "Color", 'healthcoach' ),
                    "param_name" => "author_color",
                    "value" => "",
                    "group" => __( "Author Options", 'healthcoach' )
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __( "Size", 'healthcoach' ),
                    "param_name" => "author_font_size",
                    "description" => __( "Example: 14px, em, %", 'healthcoach' ),
                    "group" => __( "Author Options", 'healthcoach' )
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __( "Color", 'healthcoach' ),
                    "param_name" => "text_color",
                    "value" => "",
                    "group" => __( "Text Options", 'healthcoach' )
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __( "Size", 'healthcoach' ),
                    "param_name" => "text_font_size",
                    "description" => __( "Example: 14px, em, %", 'healthcoach' ),
                    "group" => __( "Text Options", 'healthcoach' )
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __( "Margin", 'healthcoach' ),
                    "param_name" => "text_margin",
                    "description" => __( "1. Top, 2. Right, 3. Bottom, 4. Left. Example: 10px,15px,12px,0px", 'healthcoach' ),
                    "group" => __( "Text Options", 'healthcoach' )
                ),
                array(
                    'type'       => 'css_editor',
                    'heading'    => __( 'Css', 'healthcoach' ),
                    'param_name' => 'css',
                    'group'      => __( 'Design options', 'healthcoach' )
                ),

            ),
        ) );

    vc_map (
        array(
            "name" => __( "Call To Action", 'healthcoach' ),
            "base" => "stm_call_to_action",
            "class" => "",
            "icon" => "",
            "category" => "STM",
            "params" => array(
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Type', 'healthcoach' ),
                    'param_name' => 'cta_type',
                    'value' => array(
                        __( 'Subscribe Form', 'healthcoach' ) => 'subscribe_form',
                        __( 'Button', 'healthcoach' ) => 'button',
                        __( 'Link', 'healthcoach' ) => 'link',
                    )
                ),
                array(
                    'type'       => 'textarea_html',
                    'heading'    => __( 'Text', 'healthcoach' ),
                    'param_name' => 'content',
                    'holder'     => 'div'
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Icon - Type', 'healthcoach' ),
                    'param_name' => 'icon_type',
                    'value' => array(
                        __( 'Health Coach', 'healthcoach' ) => 'hc',
                        __( 'Font Awesome', 'healthcoach' ) => 'fontawesome',
                        __( 'Linear Icons', 'healthcoach' ) => 'linearicons',
                    ),
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon - Health Coach', 'healthcoach' ),
                    'param_name' => 'icon_hc',
                    'settings'   => array(
                        'type'       => 'hc'
                    ),
                    'dependency' => array( 'element' => 'icon_type', 'value' => 'hc' )
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon - Font Awesome', 'healthcoach' ),
                    'param_name' => 'icon_fontawesome',
                    'settings'   => array(
                        'type'       => 'fontawesome'
                    ),
                    'dependency' => array( 'element' => 'icon_type', 'value' => 'fontawesome' )
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon - Linearicons', 'healthcoach' ),
                    'param_name' => 'icon_linearicons',
                    'settings'   => array(
                        'type'       => 'linearicons'
                    ),
                    'dependency' => array( 'element' => 'icon_type', 'value' => 'linearicons' )
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Icon - Color', 'healthcoach' ),
                    'param_name' => 'icon_color',
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Icon - Size', 'healthcoach' ),
                    'param_name' => 'icon_size',
                ),
                array(
                    'type'       => 'vc_link',
                    'heading'    => __( 'Button 1', 'healthcoach' ),
                    'param_name' => 'button1',
                    'group'      => __( 'Button', 'healthcoach' ),
                    'dependency' => array( 'element' => 'cta_type', 'value' => 'button' )
                ),
                array(
                    'type'       => 'vc_link',
                    'heading'    => __( 'Button 2', 'healthcoach' ),
                    'param_name' => 'button2',
                    'group'      => __( 'Button', 'healthcoach' ),
                    'dependency' => array( 'element' => 'cta_type', 'value' => 'button' )
                ),
                array(
                    'type'       => 'vc_link',
                    'heading'    => __( 'Link', 'healthcoach' ),
                    'param_name' => 'link',
                    'group'      => __( 'Link', 'healthcoach' ),
                    'dependency' => array( 'element' => 'cta_type', 'value' => 'link' )
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Color', 'healthcoach' ),
                    'param_name' => 'link_color',
                    'group'      => __( 'Link', 'healthcoach' ),
                    'dependency' => array( 'element' => 'cta_type', 'value' => 'link' )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Size', 'healthcoach' ),
                    'param_name' => 'link_size',
                    'group'      => __( 'Link', 'healthcoach' ),
                    'dependency' => array( 'element' => 'cta_type', 'value' => 'link' )
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => __( 'Icon', 'healthcoach' ),
                    'param_name' => 'link_icon_enable',
                    'group'      => __( 'Link', 'healthcoach' ),
                    'dependency' => array( 'element' => 'cta_type', 'value' => 'link' )
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Icon - Type', 'healthcoach' ),
                    'param_name' => 'link_icon_type',
                    'value' => array(
                        __( 'Health Coach', 'healthcoach' ) => 'hc',
                        __( 'Font Awesome', 'healthcoach' ) => 'fontawesome',
                        __( 'Linear Icons', 'healthcoach' ) => 'linearicons',
                    ),
                    'group'      => __( 'Link', 'healthcoach' ),
                    'dependency' => array( 'element' => 'link_icon_enable', 'value' => 'true' )
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon - Health Coach', 'healthcoach' ),
                    'param_name' => 'link_icon_hc',
                    'settings'   => array(
                        'type'       => 'hc'
                    ),
                    'group'      => __( 'Link', 'healthcoach' ),
                    'dependency' => array( 'element' => 'link_icon_type', 'value' => 'hc' )
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon - Font Awesome', 'healthcoach' ),
                    'param_name' => 'link_icon_fontawesome',
                    'settings'   => array(
                        'type'       => 'fontawesome'
                    ),
                    'group'      => __( 'Link', 'healthcoach' ),
                    'dependency' => array( 'element' => 'link_icon_type', 'value' => 'fontawesome' )
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => __( 'Icon - Linearicons', 'healthcoach' ),
                    'param_name' => 'link_icon_linearicons',
                    'settings'   => array(
                        'type'       => 'linearicons'
                    ),
                    'group'      => __( 'Link', 'healthcoach' ),
                    'dependency' => array( 'element' => 'link_icon_type', 'value' => 'linearicons' )
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Icon - Color', 'healthcoach' ),
                    'param_name' => 'link_icon_color',
                    'group'      => __( 'Link', 'healthcoach' ),
                    'dependency' => array( 'element' => 'link_icon_enable', 'value' => 'true' )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Icon - Size', 'healthcoach' ),
                    'param_name' => 'link_icon_size',
                    'group'      => __( 'Link', 'healthcoach' ),
                    'dependency' => array( 'element' => 'link_icon_enable', 'value' => 'true' )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Font Size', 'healthcoach' ),
                    'param_name' => 'text_font_size',
                    'group'      => __( 'Text style', 'healthcoach' )
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Color', 'healthcoach' ),
                    'param_name' => 'text_color',
                    'group'      => __( 'Text style', 'healthcoach' )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Margin', 'healthcoach' ),
                    'param_name' => 'text_margin',
                    'group'      => __( 'Text style', 'healthcoach' ),
                    'description' => __( '1.Top, 2.Right, 3.Bottom, 4.Left; Example: 3px,5px,3px,10px', 'healthcoach' )
                ),
                array(
                    'type'       => 'css_editor',
                    'heading'    => __( 'Css', 'healthcoach' ),
                    'param_name' => 'css',
                    'group'      => __( 'Design options', 'healthcoach' )
                ),

            ),
        ) );

    vc_map (
        array(
            "name" => __( "Image Gallery", 'healthcoach' ),
            "base" => "stm_image_gallery",
            "class" => "",
            "icon" => "",
            "category" => "STM",
            "params" => array(
                array(
                    'type'       => 'attach_images',
                    'heading'    => __( 'Images', 'healthcoach' ),
                    'param_name' => 'images',
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Image Size', 'healthcoach' ),
                    'param_name' => 'image_size',
                    'value'      => '512x324'
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Columns', 'healthcoach' ),
                    'param_name' => 'cols',
                    'value' => array(
                        __( 'Two', 'healthcoach' )   => '2',
                        __( 'Three', 'healthcoach' ) => '3',
                        __( 'Four', 'healthcoach' )  => '4',
                    )
                ),
                array(
                    'type'       => 'css_editor',
                    'heading'    => __( 'Css', 'healthcoach' ),
                    'param_name' => 'css',
                    'group'      => __( 'Design options', 'healthcoach' )
                ),

            ),
        ) );

    vc_map (
        array(
            "name" => __( "Testimonials - Grid", 'healthcoach' ),
            "base" => "stm_testimonials_grid",
            "class" => "",
            "icon" => "",
            "category" => "STM",
            "params" => array(
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Testimonials Per Page', 'healthcoach' ),
                    'param_name' => 'testimonials_per_page',
                    'descripton' => __( 'Example: 3', 'healthcoach' ),
                ),
                array(
                    'type'       => 'css_editor',
                    'heading'    => __( 'Css', 'healthcoach' ),
                    'param_name' => 'css',
                    'group'      => __( 'Design options', 'healthcoach' )
                ),

            ),
    ) );

    $testimonials_categories_terms = get_terms('testimonial_categories');
    $testimonials_categories_array = array();

    if( ! is_wp_error( $testimonials_categories_terms ) ) {
        $testimonials_categories_array[__('Select category', 'healthcoach' )] = 0;
        foreach($testimonials_categories_terms as $testimonials_categories_term) {
            $testimonials_categories_array[$testimonials_categories_term->name] = $testimonials_categories_term->slug;
        }
    } else {
        $testimonials_categories_array[__('No categories', 'healthcoach' )] = 0;
    }

    vc_map (
        array(
            "name" => __( "Testimonials - Slider", 'healthcoach' ),
            "base" => "stm_testimonials_slider",
            "class" => "",
            "icon" => "",
            "category" => "STM",
            "params" => array(
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Testimonials count', 'healthcoach' ),
                    'param_name' => 'testimonials_count',
                    'group'      => __( 'Query settings', 'healthcoach' )
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Testimonials categories', 'healthcoach' ),
                    'param_name' => 'testimonials_categories',
                    'value'      => $testimonials_categories_array,
                    'group'      => __( 'Query settings', 'healthcoach' )
                ),
                array(
                    'type'       => 'css_editor',
                    'heading'    => __( 'Css', 'healthcoach' ),
                    'param_name' => 'css',
                    'group'      => __( 'Design options', 'healthcoach' )
                ),

            ),
        ) );

    vc_map( array(
        'name'        => __( 'Personal Info', 'healthcoach' ),
        'base'        => 'stm_personal_info',
        'category'    => __( 'STM', 'healthcoach' ),
        "as_parent" => array('only' => 'stm_personal_info_item'),
        "content_element" => true,
        "show_settings_on_create" => false,
        "is_container" => false,
        'params'      => array(
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'Css', 'healthcoach' ),
                'param_name' => 'css',
            ),
        ),
        "js_view" => 'VcColumnView'
    ) );

    vc_map (
        array(
            "name" => __( "Personal Info Item", 'healthcoach' ),
            "base" => "stm_personal_info_item",
            "class" => "",
            "icon" => "",
            "category" => "STM",
            "as_child" => array('only' => 'stm_personal_info'),
            "content_element" => true,
            "params" => array(
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title', 'healthcoach' ),
                    'param_name' => 'title',
                    'holder'     => 'div'
                ),
                array(
                    "type"       => "textarea",
                    "class"      => "",
                    "heading"    => __( "Text", 'healthcoach' ),
                    "param_name" => "text",
                    "value"      => "",
                ),
            ),
        ) );

    vc_map( array(
        'name'        => __( 'Personal Result - Photo', 'healthcoach' ),
        'base'        => 'stm_personal_result_photo',
        'class'       => "",
        'category'    => __( 'STM', 'healthcoach' ),
        'params'      => array(
            array(
                'type'       => 'dropdown',
                'heading'    => __( 'Border:', 'healthcoach' ),
                'param_name' => 'border_style',
                'value'      => array(
                    __( 'Solid', 'healthcoach' ) => 'solid',
                    __( 'Dashed', 'healthcoach' ) => 'dashed',
                    __( 'Dotted', 'healthcoach' ) => 'dotted',
                    __( 'None', 'healthcoach' ) => 'none',
                ),
                'group'      => __( 'Image options', 'healthcoach' ),
                "dependency" => array( 'element' => 'image_style', 'value' => 'caption' )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Border - Width:', 'healthcoach' ),
                'param_name'  => 'border_width',
                'description' => __( 'Example: 2px, em, %', 'healthcoach' ),
                'group'       => __( 'Image options', 'healthcoach' ),
                "dependency"  => array( 'element' => 'border_style', 'value' => array( 'solid', 'dashed', 'dotted' ) )
            ),
            array(
                'type'        => 'colorpicker',
                'heading'     => __( 'Border - Color:', 'healthcoach' ),
                'param_name'  => 'border_color',
                'group'       => __( 'Image options', 'healthcoach' ),
                "dependency"  => array( 'element' => 'border_style', 'value' => array( 'solid', 'dashed', 'dotted' ) )
            ),
            array(
                'type'       => 'textfield',
                'heading'    => __( 'Title - Font size:', 'healthcoach' ),
                'param_name' => 'title_font_size',
                'group'      => __( 'Caption options', 'healthcoach' ),
                "dependency" => array( 'element' => 'image_style', 'value' => 'caption' )
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => __( 'Title - Color:', 'healthcoach' ),
                'param_name' => 'title_color',
                'group'      => __( 'Caption options', 'healthcoach' ),
                "dependency" => array( 'element' => 'image_style', 'value' => 'caption' )
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'Css', 'healthcoach' ),
                'param_name' => 'css',
                'group'      => __( 'Design options', 'healthcoach' )
            ),
        ),
    ) );
    vc_map( array(
        'name'        => __( 'Countdown', 'healthcoach' ),
        'base'        => 'stm_countdown',
        'class'       => "",
        'category'    => __( 'STM', 'healthcoach' ),
        'params'      => array(
            array(
                'type'       => 'textfield',
                'heading'    => __( 'Title', 'healthcoach' ),
                'param_name' => 'title',
            ),
            array(
                'type'       => 'vc_stm_datepicker',
                'heading'    => __( 'Date', 'healthcoach' ),
                'param_name' => 'date_countdown',
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'Css', 'healthcoach' ),
                'param_name' => 'css',
                'group'      => __( 'Design options', 'healthcoach' )
            ),
        ),
    ) );

    vc_map( array(
        'name'        => __( 'Thumbnail', 'healthcoach' ),
        'base'        => 'stm_thumbnail',
        'class'       => "",
        'category'    => __( 'STM', 'healthcoach' ),
        'params'      => array(
            array(
                'type'       => 'textfield',
                'heading'    => __( 'Size', 'healthcoach' ),
                'param_name' => 'thumbnail_size',
                'description' => __( 'Example: 382x374', 'healthcoach' )
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'Css', 'healthcoach' ),
                'param_name' => 'css',
                'group'      => __( 'Design options', 'healthcoach' )
            ),
        ),
    ) );

    vc_map( array(
        'name'        => __( 'Subscribe', 'healthcoach' ),
        'base'        => 'stm_subscribe',
        'class'       => "",
        'category'    => __( 'STM', 'healthcoach' ),
        'params'      => array(
            array(
                'type'       => 'textfield',
                'heading'    => __( 'Title', 'healthcoach' ),
                'param_name' => 'title',
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => __( 'Css', 'healthcoach' ),
                'param_name' => 'css',
                'group'      => __( 'Design options', 'healthcoach' )
            ),
        ),
    ) );


}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Stm_Thumbnail extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Hc_Info_Box extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Image_Gallery extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Icon_Box extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Pricing_Table extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Services extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Info_Box extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Recent_Posts extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Contact_Form7 extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Events extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Sidebar extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Recent_Posts_Widget extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Countdown_Widget extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Contact_Info extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Stats extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Link extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Items_Carousel extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Testimonial extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Call_To_Action extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Testimonials_Grid extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Personal_Info_Item extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Personal_Result_Photo extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Countdown extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Subscribe extends WPBakeryShortCode {
    }
    class WPBakeryShortCode_Stm_Testimonials_Slider extends WPBakeryShortCode {
    }
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Stm_Personal_Info extends WPBakeryShortCodesContainer {
    }
}

add_filter( 'vc_iconpicker-type-hc', 'vc_iconpicker_type_hc' );

if( !function_exists('vc_iconpicker_type_hc') ) {
    function vc_iconpicker_type_hc( $icons ) {
        include( get_template_directory() . '/inc/icons/hc-icons.php' );
        return array_merge( $icons, $stm_icons );
    }
}

add_filter( 'vc_iconpicker-type-linearicons', 'vc_iconpicker_type_linearicons' );

if( !function_exists('vc_iconpicker_type_linearicons') ) {
    function vc_iconpicker_type_linearicons( $icons ) {
        include( get_template_directory() . '/inc/icons/linearicons.php' );
        return array_merge( $icons, $stm_icons );
    }
}

