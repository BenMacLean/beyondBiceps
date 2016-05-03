<?php
	$breadcrumbs_position = get_post_meta( get_the_ID(), 'breadcrumbs_position', true );
	$breadcrumbs_disable  = get_post_meta( get_the_ID(), 'breadcrumbs_disable', true );
	$page_title_enable    = get_post_meta( get_the_ID(), 'stm_page_title_enable', true );

	if( $breadcrumbs_position == 'bottom' ) {
		if( $page_title_enable ) {
			get_template_part( 'parts/page', 'title' );
		}
		if( ! $breadcrumbs_disable ) {
			get_template_part( 'parts/breadcrumbs' );
		}
	} else {
		if( ! $breadcrumbs_disable ) {
			get_template_part( 'parts/breadcrumbs' );
		}

		if( $page_title_enable ) {
			get_template_part( 'parts/page', 'title' );
		}
	}
?>
<div class="main">
	<div class="container">
		<div class="content"><?php the_content(); ?></div>
	</div>
</div>
