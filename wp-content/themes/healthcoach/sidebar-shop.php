<?php
	$sidebar = '';

	if( is_single() ) {
		$sidebar = stm_option( 'single_product_sidebar' );
	} else if ( is_shop() || is_archive() ) {
		$sidebar = stm_option('shop_sidebar');
	}

	if( $sidebar == 'left' ) {
		$before_sidebar = '<div class="col-lg-3 col-md-3 col-lg-pull-9 col-md-pull-9">';
		$after_sidebar = '</div></div>';
	} else if( $sidebar == 'right' ) {
		$before_sidebar = '<div class="col-lg-3 col-md-3">';
		$after_sidebar = '</div></div>';
	}
?>

<?php
	if( isset( $before_sidebar ) ) {
		echo wp_kses( $before_sidebar, array( 'div' => array( 'class' => array() ) ) );
	}
?>

	<aside class="sidebar woocommerce-sidebar hidden-sm hidden-xs" role="complementary">
			<div id="widget-area" class="widget-area">
				<?php dynamic_sidebar( 'sidebar-4' ); ?>
			</div>
	</aside>

<?php
	if( isset( $after_sidebar ) ) {
		echo wp_kses( $after_sidebar, array( 'div' => array( 'class' => array() ) ) );
	}
?>

