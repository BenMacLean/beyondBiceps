<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}
?>
<div class="page-fullwidth-divider"></div>
<nav class="page-pagination">
	<?php if( get_previous_posts_link() ) : ?>
		<div class="page-prev"><?php previous_posts_link('<span class="hc-icon-big-arrow-l"></span>'); ?></div>
	<?php endif; ?>
	<?php
		echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
			'format'       => '',
			'add_args'     => '',
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'prev_next' => false,
			'type'         => 'list',
			'end_size'     => 3,
			'mid_size'     => 3
		) ) );
	?>
	<?php if( get_next_posts_link() ) : ?>
		<div class="page-next"><?php next_posts_link('<span class="hc-icon-big-arrow-r"></span>'); ?></div>
	<?php endif; ?>
</nav>
