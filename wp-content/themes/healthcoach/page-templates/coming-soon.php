<?php
/*
	Template Name: Coming Soon
*/
?>
<?php get_header('blank'); ?>
<section class="main">
	<div class="content content_type_coming-soon">
		<div class="container">
			<?php
				while ( have_posts() ) : the_post();
					the_content();
				endwhile;
			?>
		</div>
	</div>
	<div class="coming-soon__bg"></div>
</section>
<?php get_footer('blank'); ?>
