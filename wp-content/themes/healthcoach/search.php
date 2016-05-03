<?php get_header(); ?>
<div class="main">
	<?php get_template_part('parts/breadcrumbs');  ?>
	<div class="container">
		<div class="content content_search" role="main">
			<?php
				if ( have_posts() ) {

					while ( have_posts() ) {
						the_post();
						get_template_part( 'content', 'search' );
					}

					$count_posts = wp_count_posts();
					$posts_per_page = get_option('posts_per_page');

					if( $count_posts->publish > $posts_per_page ) {
						get_template_part( 'parts/page', 'pagination' );
					}

				} else {
					 get_template_part( 'content', 'none' );
				}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
