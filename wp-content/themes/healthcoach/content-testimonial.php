<?php $blog_style = stm_option('blog_style'); ?>

<article id="testimonial-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		$testimonial_author = get_post_meta( get_the_ID(), 'testimonial_author', true );
		$testimonial_desc   = get_post_meta( get_the_ID(), 'testimonial_short_desc', true );
	?>

	<?php if( !empty( $testimonial_author ) && !empty( $testimonial_desc ) ) : ?>

		<div class="entry-header text-center">
			<h1 class="entry-header__author"><?php echo esc_html( $testimonial_author ); ?></h1>
			<div class="entry-header__desc"><?php echo esc_html( $testimonial_desc ); ?></div>
		</div>

	<?php endif; ?>

	<?php if( is_single() ) : ?>

		<?php
			$vc_status = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true);
			$entry_content_class = '';

			if( $vc_status == 'false' ){
				$vc_status = false;
			}

			if( ! $vc_status ) {
				$entry_content_class = 'entry-content_standard';
			}
		?>

		<div class="entry-content  <?php echo esc_attr( $entry_content_class ); ?>">
			<?php
				the_content();

				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'healthcoach' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>
		</div>

		<div class="entry-footer clearfix">
			<?php the_tags('<ul class="entry-tags"><li>', '</li><li>', '</li></ul>') ?>
			<?php get_template_part('parts/share'); ?>
		</div>

	<?php else : ?>

		<?php if( get_the_title() ) : ?>
			<div class="entry-summary"><?php the_excerpt(); ?></div>
		<?php else: ?>
			<div class="entry-summary"><a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a></div>
		<?php endif; ?>

	<?php endif; ?>
</article>
