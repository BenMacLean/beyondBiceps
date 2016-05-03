<?php get_header(); ?>
<?php
	$post_sidebar = stm_option('post_sidebar');

	if( $post_sidebar == 'left' ) {
		$before_content = '<div class="row"><div class="col-lg-9 col-md-9 col-lg-push-3 col-md-push-3">';
		$after_content = '</div>';
	} else if( $post_sidebar == 'right' ) {
		$before_content = '<div class="row"><div class="col-lg-9 col-md-9">';
		$after_content = '</div>';
	}
?>
<div class="main">
	<?php get_template_part( 'parts/breadcrumbs' ); ?>
	<div class="container">
		<?php
			if( isset( $before_content ) ) {
				echo wp_kses( $before_content, array( 'div' => array( 'class' => array() ) ) );
			}
		?>

			<div class="content content_type_sidebar-<?php echo (( !empty( $post_sidebar ) ) ? esc_attr( $post_sidebar ) : esc_attr('hide')) ?>">
				<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'content-single', get_post_format() );

						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}

					endwhile;
				?>
			</div>

		<?php
			if( isset( $after_content ) ) {
				echo wp_kses( $after_content, array( 'div' => array( 'class' => array() ) ) );
			}
		?>

		<?php
			if( $post_sidebar != 'hide' && is_active_sidebar( 'sidebar-1' ) ) {
				get_sidebar();
			}
		?>
	</div>
</div>
<?php get_footer(); ?>
