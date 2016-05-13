<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
 	
<script type="text/javascript">console.log('eh');</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

<script>    
$(document).ready(function () {
	console.log('jQ working doc ready...');
    $(".thumbnail__caption-action a").attr("href", "http://beyondbiceps.com/?page_id=1906");

$(".thumbnail__caption-title a").attr("href", "http://beyondbiceps.com/?page_id=1906");
});
</script>
    
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
		<script src="<?php echo esc_url( get_template_directory_uri() . '/assets/js/html5.js'); ?>"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="mobile-side-nav" id="js-mobile-nav">
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'mobile-nav-menu', 'fallback_cb' => false, 'after' => '<span class="submenu-toggle"></span>',) ); ?>
		<form role="search" method="get" class="form form_mobile-nav-search" action="<?php echo esc_url( home_url( '/' ) ) ?>">
			<fieldset class="form__fieldset">
				<input type="text" class="form__field-text" value="" placeholder="<?php _e( 'Search...', 'healthcoach' ) ?>" name="s" id="s"/>
				<button type="submit" class="form__field-button"><i class="fa fa-search"></i></button>
			</fieldset>
		</form>
	</div>
	<div class="wrapper">
		<?php
			if( stm_option('top_bar_enable') ) {
				get_template_part('parts/top', 'bar');
			}
		?>
		<div class="mobile-menu">
			<div class="container">
				<a class="mobile-menu-logo" href="<?php echo esc_url( home_url('/') ); ?>"><img class="img-responsive" src="<?php echo esc_url( stm_option( 'logo_default', false, 'url' ) ); ?>" alt="<?php echo bloginfo('name'); ?>"/></a>
				<ul class="mobile-menu-nav">
					<li class="mobile-nav-search" target-data="js-search-fullscreen"><i class="fa fa-search"></i></li>
					<li class="mobile-nav-toggle" target-data="js-mobile-nav">
						<span class="toggle-line diagonal part-1"></span>
						<span class="toggle-line horizontal"></span>
						<span class="toggle-line diagonal part-2"></span>
					</li>
				</ul>
			</div>
		</div>
		<?php
			if( is_home() ) {
				$page_id = get_option('page_for_posts');
			} elseif( ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product_category' ) && is_product_category() ) ) {
				$page_id = wc_get_page_id( 'shop' );
			} else {
				$page_id = get_the_ID();
			}

			$header_class = '';
			$header_classes = array();

			if( $header_style = get_post_meta( $page_id, 'header_style', true ) ) {
				$header_classes[] = 'header_type_' . $header_style;
			} else {
				$header_classes[] = 'header_type_default';
			}

			if( $header_position = get_post_meta( $page_id, 'header_position', true ) ) {
				$header_classes[] = 'header_position_' . $header_position;
			} else {
				$header_classes[] = 'header_position_static';
			}

			if( !empty( $header_classes ) ) {
				$header_class = implode( ' ', $header_classes );
			}
		?>
		<header class="header <?php echo esc_attr( $header_class ); ?>">
			<div class="container">
				<div class="user-menu user-menu_type_header">
					<ul class="user-menu__list clearfix">
						<?php if( stm_option('header_search') ) : ?>
							<li class="user-menu__item user-menu__item_rounded user-menu__item_search-button" target-data="js-search-fullscreen"><i class="fa fa-search"></i></li>
						<?php endif; ?>
						<?php if( class_exists( 'WooCommerce' ) && stm_option('header_cart') ) : ?>
							<li class="user-menu__item user-menu__item_rounded user-menu__item_cart">
								<i class="fa fa-shopping-cart"></i>
								<span class="user-menu__text user-menu__text_cart_count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
								<div class="mini-cart mini-cart_type_user-menu">
									<ul class="mini-cart__products">
									<?php
										if ( sizeof( WC()->cart->get_cart() ) > 0 ) :
											foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
												$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
												$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

												if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) :

												$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
												$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
												$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
											?>
											<li class="mini-cart__product clearfix">
												<div class="mini-cart__product-left">
													<?php if ( ! $_product->is_visible() ) : ?>
														<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
													<?php else : ?>
														<a class="mini-cart__product-link" href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>">
															<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
														</a>
													<?php endif; ?>
												</div>
												<div class="mini-cart__product-body">
													<a class="mini-cart__product-title" href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>"><?php echo esc_html( $product_name ); ?></a>
													<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="mini-cart__product-quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
												</div>
												<?php echo WC()->cart->get_item_data( $cart_item ); ?>
											</li>
										<?php endif; ?>
										<?php endforeach; ?>
									<?php else : ?>
										<li class="mini-cart__empty"><?php _e( 'No products in the cart.', 'healthcoach' ); ?></li>
									<?php endif; ?>
									</ul>
									<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
										<div class="mini-cart__price-total"><?php _e( 'Subtotal', 'healthcoach' ); ?>: <?php echo WC()->cart->get_cart_subtotal(); ?></div>
										<div class="mini-cart__actions">
											<a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="btn btn_size_sm btn_view_primary"><?php _e( 'Checkout', 'healthcoach' ); ?></a>
											<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="mini-cart__action-link"><?php _e( 'View cart', 'healthcoach' ); ?></a>
										</div>
									<?php endif; ?>
								</div>
							</li>
						<?php endif; ?>
					</ul>
				</div>
				<nav class="nav nav_type_header">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav__menu clearfix', 'fallback_cb' => false ) ); ?>
				</nav>
				<a class="logo logo_type_header" href="<?php echo esc_url( home_url('/') ); ?>">
					<img class="logo__image logo__image_header_transparent img-responsive" src="<?php echo esc_url( stm_option( 'logo_transparent', false, 'url' ) ); ?>" alt="<?php echo bloginfo('name'); ?>"/>
					<img class="logo__image logo__image_header_default img-responsive" src="<?php echo esc_url( stm_option( 'logo_default', false, 'url' ) ); ?>" alt="<?php echo bloginfo('name'); ?>"/>
				</a>
			</div>
		</header>