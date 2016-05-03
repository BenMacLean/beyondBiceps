<?php
    $breadcrumbs_classes = array();
    $breadcrumbs_class = '';

    if( is_single() && get_post_type() == 'post' ){
        $breadcrumbs_classes[] = 'breadcrumbs_type_single-post';
    }

    if( !empty( $breadcrumbs_classes ) ) {
        $breadcrumbs_class = implode( ' ', $breadcrumbs_classes );
    }

    $breadcrumbs_styles = array();
    $breadcrumbs_style = '';

    if( $breadcrumbs_margin_bot = get_post_meta( get_the_ID(), 'breadcrumbs_margin_bot', true ) ) {
        $breadcrumbs_styles[] = 'margin-bottom:' . $breadcrumbs_margin_bot;
    }

    if( !empty( $breadcrumbs_styles ) ) {
        $breadcrumbs_style = 'style=' . implode( ';', $breadcrumbs_styles ) . '';
    }
?>
<?php if( function_exists( 'bcn_display' ) ) : ?>
	<div class="breadcrumbs <?php echo esc_attr( $breadcrumbs_class ); ?>" <?php echo esc_attr( $breadcrumbs_style ); ?>>
		<div class="container">
			<div class="breadcrumbs-inner">
				<?php bcn_display(); ?>
			</div>
		</div>
	</div>
<?php endif; ?>