<?php
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'stm-countdown' );

/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$styles = array();
$style = '';

if( !empty($styles) ) {
    $style = 'style=' . implode( ';', $styles ) . '';
}

$uniq_id = uniqid('countdown-');

$output .= '<div class="countdown'. esc_attr( $css_class ) .'" '. esc_attr( $style ) .' id="'. esc_attr( $uniq_id ) .'">';
$output .= '</div>';
echo $output;
?>
<script>
    jQuery(document).ready(function($){
        var countdownDate = "<?php echo esc_js( $date_countdown ); ?>",
            countdownId = '<?php echo esc_attr( '#' . $uniq_id ); ?>';
        if( new Date() < new Date( countdownDate ) ) {
            $(countdownId).countdown( countdownDate, function(event) {
                $(this).html(
                    event.strftime(''
                        + '<div class="row">'
                        + '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><div class="countdown__counter"><span class="countdown__counter-number">%D</span><span class="countdown__counter-title"><?php _e( 'Days', 'healthcoach' ); ?></span></div></div>'
                        + '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><div class="countdown__counter"><span class="countdown__counter-number">%H</span><span class="countdown__counter-title"><?php _e( 'Hours', 'healthcoach' ); ?></span></div></div>'
                        + '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><div class="countdown__counter"><span class="countdown__counter-number">%M</span><span class="countdown__counter-title"><?php _e( 'Minutes', 'healthcoach' ); ?></span></div></div>'
                        + '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><div class="countdown__counter"><span class="countdown__counter-number">%S</span><span class="countdown__counter-title"><?php _e( 'Seconds', 'healthcoach' ); ?></span></div></div>'
                        + '</div>'
                    )
                );
            });
        } else {
            $(countdownId).html(''
                + '<p><?php _e( 'This offer has expired!', 'healthcoach' ); ?></p>'
            )
        }
    });
</script>