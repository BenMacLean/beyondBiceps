<?php get_header('blank'); ?>
<section class="main main_error404">
	<div class="container">
		<div class="content content_error404">
			<div class="text-center">
			<div class="error404__title"><?php _e('404', 'healthcoach'); ?></div>
			<p class="error404__desc"><?php _e( 'The page you are looking for does not exist.', 'healthcoach' );?></p>
			<a href="<?php echo esc_url( home_url('/') ); ?>" class="btn btn_view_default btn_type_outline"><?php _e('Back to main page', 'healthcoach' ); ?></a>
			</div>
		</div>
	</div>
	<div class="error404__bg"></div>
</section>
<?php get_footer('blank'); ?>
