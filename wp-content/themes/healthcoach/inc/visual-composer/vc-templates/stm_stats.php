<?php
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'stm-count-up' );

/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

// Value Container styles
$value_container_styles = array();
$value_container_style = '';

if( $value_container_size != '' ) {
    $value_container_styles[] = 'width:' . $value_container_size;
    $value_container_styles[] = 'height:' . $value_container_size;
}

if( $value_container_styles ) {
    $value_container_style = 'style=' . implode( ';', $value_container_styles ) . '';
}

// Value Border styles
$value_border_styles = array();
$value_border_style = '';

if( $value_container_size != '' ) {
    $value_border_styles[] = 'font-size:' . $value_container_size;
}

if( !empty( $value_container_color ) ) {
    $value_border_styles[] = 'color:' . $value_container_color;
}

if( $value_border_styles ) {
    $value_border_style = 'style=' . implode( ';', $value_border_styles ) . '';
}

// Value styles
$value_styles = array();
$value_style = '';

if( $value_font_size != '' ) {
    $value_styles[] = 'font-size:' . $value_font_size;
}

if( $value_color != '' ) {
    $value_styles[] = 'color:' . $value_color;
}

if( $value_styles ) {
    $value_style = 'style=' . implode( ';', $value_styles ) . '';
}

// Description styles
$desc_styles = array();
$desc_style = '';

if( $desc_font_size != '' ) {
    $desc_styles[] = 'font-size:' . $desc_font_size;
}

if( $desc_color != '' ) {
    $desc_styles[] = 'color:' . $desc_color;
}

if( $desc_styles ) {
    $desc_style = 'style=' . implode( ';', $desc_styles ) . '';
}

$id = rand();

$output .= '<div class="stats-counter stats-counter_value-' . esc_attr( $stats_style ) .''. esc_attr( $css_class ) .'">';
$output .= '<div class="stats-counter-inner">';

if( !empty( $desc ) && $stats_style == 'right' ) {
    $output .= '<div class="stats-counter__desc" '. esc_attr( $desc_style ) .'>'. esc_html( $desc ) .'</div>';
}

if( !empty( $value ) ) {
    $output .= '<div class="stats-counter__value" '. esc_attr( $value_container_style ) .'><span class="stats-counter__value-border" ' . esc_attr( $value_border_style ) . '><i class="hc-icon-circle"></i></span><div class="stats-counter__value-inner"><span class="stats-counter__value-number" id="counter_' . esc_attr( $id ) . '" ' . esc_attr( $value_style ) . '>' . esc_html( $value ) . '</span></div></div>';
}

if( !empty( $desc ) && $stats_style != 'right' ) {
    $output .= '<div class="stats-counter__desc" ' . esc_attr( $desc_style ) . '>' . esc_html( $desc ) . '</div>';
}
$output .= '</div>';
$output .= '</div>';
echo $output;
?>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var counterId       = '<?php echo esc_js( $id ); ?>',
            counterValue    = '<?php echo esc_js( $value ); ?>',
            counterDuration = '<?php echo esc_js( $duration ); ?>',
            counter = {};

        var counter = new countUp("counter_" + counterId, 0, counterValue , 0, counterDuration, {
            useEasing: true,
            useGrouping: false
        });

        $(window).load(function () {
            if ($("#counter_" + counterId).is_on_screen()) {
                counter.start();
            }
        });

        $(window).scroll(function () {
            if ($("#counter_" + counterId).is_on_screen()) {
                counter.start();
            }
        });
    });
</script>
