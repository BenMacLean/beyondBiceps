<?php
	$post_sidebar = stm_option('post_sidebar');

	if( $post_sidebar == 'left' ) {
		$before_content = '<div class="row"><div class="col-lg-9 col-md-9 col-lg-push-3 col-md-push-3">';
		$after_content = '</div>';
	} else if( $post_sidebar == 'right' ) {
		$before_content = '<div class="row"><div class="col-lg-9 col-md-9">';
		$after_content = '</div>';
	}

	if( get_post_meta( get_the_ID(), 'stm_page_title_enable', true ) ) {
		get_template_part( 'parts/page', 'title' );
	}
?>

<div class="main">
	<?php
		if( ! get_post_meta( get_the_ID(), 'breadcrumbs_disable', true ) ) {
			get_template_part( 'parts/breadcrumbs' );
		}
	?>
	<div class="container">

		<?php
			 if ( isset( $before_content ) ) {
				 echo wp_kses( $before_content, array( 'div' => array( 'class' => array() ) ) );
			}
		?>

		<div class="content content_type_single-event <?php echo ( ( $post_sidebar != 'hide' ) ? 'has-' . esc_attr( $post_sidebar ) . '-sidebar' : '' ) ?>">
			<article id="event-<?php the_ID(); ?>" <?php post_class( array('article_type_single') ); ?>>
				<?php
					$vc_status = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true);
					$entry_content_class = '';

					if( $vc_status == 'false' ) {
						$vc_status = false;
					}

					if( ! $vc_status ) {
						$entry_content_class = 'entry-content_standard';
					}
				?>
				<div class="entry-content <?php echo esc_attr( $entry_content_class ); ?>"><?php the_content(); ?></div>
				<div class="entry-footer clearfix">
					<?php the_tags('<ul class="entry-tags"><li>', '</li><li>', '</li></ul>'); ?>
					<?php get_template_part('parts/share'); ?>
				</div>
			</article>
			<?php
				if ( comments_open() || get_comments_number() )  {
					comments_template();
				}
			?>
		</div>

		<?php
			if( isset( $after_content ) ) {
				echo wp_kses( $after_content, array( 'div' => array( 'class' => array() ) ) );
			}
		?>

		<?php
			if( $post_sidebar != 'hide' && is_active_sidebar( 'sidebar-2' ) ) {
				get_sidebar('event');
			}
		?>
	</div>
</div>
