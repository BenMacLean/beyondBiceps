<?php
	$page_id = $entry_content_class = '';

	if( is_home() ) {
		$page_id = get_option('page_for_posts');
	} else {
		$page_id = get_the_ID();
	}
	
	$main_style  = '';
	$main_styles = array();
	
	$main_bottom_spacing = get_post_meta( $page_id, 'main_bottom_spacing', true );
	
	if( !empty( $main_bottom_spacing ) ) {
		$main_styles[] = 'padding-bottom:' . $main_bottom_spacing;
	}
	
	if( !empty( $main_styles ) ) {
		$main_style = 'style=' . implode( ';', $main_styles ) .'';
	}
?>
<section class="main" <?php echo esc_attr( $main_style ); ?>>
	<?php
		$breadcrumbs_position = get_post_meta( $page_id, 'breadcrumbs_position', true );
		$breadcrumbs_disable  = get_post_meta( $page_id, 'breadcrumbs_disable', true );
		$page_title_enable    = get_post_meta( $page_id, 'stm_page_title_enable', true );

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

		$vc_status = get_post_meta( $page_id, '_wpb_vc_js_status', true);

		if( $vc_status == 'false' ){
			$vc_status = false;
		}

		if( ! $vc_status ) {
			$entry_content_class = 'entry-content_standard';
		}

	?>
	<div class="container">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content <?php echo esc_attr( $entry_content_class ); ?>">
				<?php the_content(); ?>
			</div>

		</article>
		<?php
			if ( ! is_front_page() && comments_open() || get_comments_number()  ) {
				comments_template();
			}
		?>
	</div>
</section>
