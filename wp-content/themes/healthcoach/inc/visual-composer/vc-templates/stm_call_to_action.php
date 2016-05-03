<?php
$output = $icon = $link_icon = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );;


/* Styles */
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$text_styles = array();
$text_style = '';

if( !empty( $text_font_size ) ) {
    $text_styles[] = 'font-size:' . $text_font_size;
}

if( !empty( $text_color ) ) {
    $text_styles[] = 'color:' . $text_color;
}

if( !empty( $text_margin ) ) {
    $text_margin_array = explode( ',', $text_margin );
    $text_margin_css = implode( ' ', $text_margin_array );
    $text_styles[] = 'margin:' . $text_margin_css;
}

if( !empty( $text_styles ) ) {
    $text_style = 'style='. implode( ';', $text_styles ).'';
}

// Icon style
$icon_styles = array();
$icon_style = '';

if( !empty( $icon_size ) ) {
    $icon_styles[] = 'font-size:' . $icon_size;
}

if( !empty( $icon_color ) ) {
    $icon_styles[] = 'color:' . $icon_color;
}

if( !empty( $icon_styles ) ) {
    $icon_style = 'style='. implode( ';', $icon_styles ).'';
}

$subscribe_id = uniqid('cta-subscribe-');

if( !empty( ${'icon_' . $icon_type} ) ) {
    $icon = '<span class="' . esc_attr( ${'icon_' . $icon_type} ) . '"></span>';
}
?>

<div class="call-to-action<?php echo esc_attr( $css_class ); ?>">
<div class="call-to-action-inner clearfix">
<?php if( ! empty( $content ) ) : ?>
   	<div class="call-to-action__text">
    <?php if( !empty( $icon ) ) : ?>
        <div class="call-to-action__text-icon" <?php echo esc_attr( $icon_style ); ?>><?php echo $icon; ?></div>
    <?php endif; ?>
	    <div class="call-to-action__text-body" <?php echo esc_attr( $text_style ); ?>>
		    <?php echo wpb_js_remove_wpautop( $content, true ); ?>
		</div>
    </div>
<?php endif; ?>
<?php if( $cta_type == 'subscribe_form' ): ?>
    <?php mc4wp_show_form(); ?>
<?php endif; ?>



<?php if( $cta_type == 'button' ) : ?>
    <div class="call-to-action__buttons-group">

    <?php if( !empty( $button1 ) ) : ?>
        <?php $button1 = vc_build_link( $button1 ); ?>

        <?php if( $button1['url'] ) : ?>
            <?php
	            if( ! $button1['target'] ) {
                	$button1['target'] = '_self';
            	}
            ?>

            <a href="<?php echo esc_url( $button1['url'] ); ?>"
	           class="btn btn_view_default btn_type_outline"
		       target="<?php echo esc_attr( $button1['target'] ); ?>"><?php echo esc_html( $button1['title'] ); ?></a>
		       
        <?php endif; ?>
    <?php endif; ?>

    <?php if( !empty( $button2 ) ) : ?>
    
        <?php $button2 = vc_build_link( $button2 ); ?>

        <?php if( $button2['url'] ) : ?>
        
            <?php
	            if( ! $button2['target'] ) {
                	$button2['target'] = '_self';
            	}
            ?>

            <a href="<?php echo esc_url( $button2['url'] ); ?>"
	           class="btn btn_view_default"
		       target="<?php echo esc_attr( $button2['target'] ); ?>"><?php echo esc_html( $button2['title'] ); ?></a>
            
        <?php endif; ?>
    <?php endif; ?>

   </div>
<?php endif; ?>



<?php if( $cta_type == 'link' && !empty( $link ) ) : ?>
    <?php $link = vc_build_link( $link ); ?>
    <?php if( $link['url'] ) : ?>
        <?php
	        if( ! $link['target'] ) {
            	$link['target'] = '_self';
        	}

	        if( $link_icon_enable && ${'link_icon_' . $link_icon_type} ) {
	
	            $link_icon_style = '';
	            $link_icon_styles = array();
	
	            if ( !empty( $link_icon_size ) ) {
	                $link_icon_styles[] = 'font-size:' . $link_icon_size;
	            }
	
	            if ( !empty( $link_icon_color ) ) {
	                $link_icon_styles[] = 'color:' . $link_icon_color;
	            }
	
	            if( !empty( $link_icon_styles ) ) {
	                $link_icon_style = 'style=' . esc_attr( implode( ';', $link_icon_styles ) ) . '';
	            }
	
	            $link_icon = '<span class="call-to-action__link-icon" '. esc_attr( $link_icon_style ) .'><span class="' . esc_attr( ${'link_icon_' . $link_icon_type} ) . '"></span></span>';
	        }
	
	        $link_style = '';
	        $link_styles = array();
	
	        if ( !empty( $link_size ) ) {
	            $link_styles[] = 'font-size:' . $link_size;
	        }
	
	        if ( !empty( $link_color ) ) {
	            $link_styles[] = 'color:' . $link_color;
	        }
	
	        if( !empty( $link_icon_styles ) ) {
	            $link_style = 'style=' . esc_attr( implode( ';', $link_styles ) ) . '';
	        }
?>

        <a href="<?php echo esc_url( $link['url'] ); ?>"
	       class="call-to-action__link"
		   target="<?php echo esc_attr( $link['target'] ); ?>" <?php echo esc_attr( $link_style ); ?>>
		   
		   <?php
			   echo esc_html( $link['title'] );
			   echo $link_icon;
			?>
			
		</a>
		
    <?php endif; ?>
<?php endif; ?>
</div>
</div>