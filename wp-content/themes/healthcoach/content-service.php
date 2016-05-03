<article id="service-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if( is_single() ) : ?>
		<div class="entry-content"><?php the_content(); ?></div>
	<?php else : ?>
		<header class="entry-header">
			<div class="entry-icon"></div>
			<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<div class="entry-price"></div>
		</header>
		<?php if( has_post_thumbnail() ) : ?>
			<div class="entry-thumb"><?php the_post_thumbnail(); ?></div>
		<?php endif; ?>
		<div class="entry-summary"><?php the_excerpt(); ?></div>
		<footer class="entry-footer"><a class="entry-button" href="<?php the_permalink() ?>"><?php _e( 'More info', 'healthcoach' ) ?></a></footer>
	<?php endif; ?>
</article>
