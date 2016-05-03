<?php get_header(); ?>
<?php
	$blog_sidebar = stm_redux_field_value('blog_sidebar');
	$blog_layout = stm_redux_field_value('blog_layout');

	$blog_id = get_option('page_for_posts');

	if( $blog_sidebar == 'left' ) {
		$before_content = '<div class="row"><div class="col-lg-9 col-md-9 col-lg-push-3 col-md-push-3">';
		$after_content = '</div>';
	} else if( $blog_sidebar == 'right' ) {
		$before_content = '<div class="row"><div class="col-lg-9 col-md-9">';
		$after_content = '</div>';
	}
?>
<section class="main">
	<?php get_template_part( 'parts/breadcrumbs' ); ?>
	<?php get_template_part( 'parts/page', 'title' ); ?>
	<div class="container">
		<?php
			if( isset( $before_content ) ) {
				echo wp_kses( $before_content, array( 'div' => array( 'class' => array() ) ) );
			}
		?>
			<div class="content <?php echo ( ( !empty( $blog_sidebar ) ) ? 'content_type_sidebar-' . esc_attr( $blog_sidebar ) : 'content_type_sidebar-hide' ) ?>" role="main">
				<?php if ( have_posts() ) : ?>
					<div class="blog-posts">
						<?php if( $blog_layout == 'grid' ) : ?>
							<div class="row">
						<?php endif; ?>

						<?php while ( have_posts() ) : the_post(); ?>
							<?php
								if( $blog_layout == 'grid' ) :
									if( $blog_sidebar == 'hide' ) :
							?>
										<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<?php else : ?>
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<?php endif; ?>
								<?php get_template_part( 'content', get_post_format() ); ?>
							</div>
							<?php else : ?>
								<?php get_template_part( 'content', get_post_format() ); ?>
							<?php endif; ?>
						<?php endwhile; ?>

						<?php if( $blog_layout == 'grid' ) : ?>
							</div>
						<?php endif; ?>
					</div>
						<?php
							$count_posts = wp_count_posts();
							$posts_per_page = get_option('posts_per_page');

							if( $count_posts->publish > $posts_per_page ) {
								get_template_part( 'parts/page', 'pagination' );
							}
						?>
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>
			</div>
		<?php
			if ( isset( $after_content ) ) {
				echo wp_kses( $after_content, array( 'div'=> array( 'class' => array() ) ) );
			}

			if( $blog_sidebar != 'hide'  ) {
				get_sidebar();
			}
		?>
	</div>
</section>
<?php get_footer(); ?>
