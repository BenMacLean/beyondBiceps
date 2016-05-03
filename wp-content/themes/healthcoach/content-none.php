<div class="no-results not-found">
<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'healthcoach' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

<?php elseif ( is_search() ) : ?>
	<div class="no-results-search">
		<p><?php _e( 'Sorry, nothing found.', 'healthcoach' ); ?></p>
		<?php get_search_form(); ?>
	</div>
<?php else : ?>

	<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'healthcoach' ); ?></p>
	<?php get_search_form(); ?>

<?php endif; ?>
</div>


