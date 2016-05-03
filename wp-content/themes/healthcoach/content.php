<?php
	$blog_sidebar = stm_redux_field_value('blog_sidebar');
	$blog_layout = stm_redux_field_value('blog_layout');

	if( get_post_format() == 'video' ) {
		$caption_icon = '<span class="lnr lnr-film-play"></span>';
	} elseif( get_post_format() == 'image' ) {
		$caption_icon = '<span class="lnr lnr-picture"></span>';
	} else {
		$caption_icon = '<span class="lnr lnr-text-align-left"></span>';
	}

?>

<?php if( $blog_layout == 'grid' ) : ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'thumbnail', 'thumbnail_type_grid-post', 'thumbnail_js_hover' ) ); ?>>

		<?php if( has_post_thumbnail() ) : ?>
		<?php
			$attach_id = get_post_thumbnail_id( get_the_ID() );

            if( $attach_id > 0 ) :
                $post_thumbnail = wpb_getImageBySize( array(
                    'attach_id'  => $attach_id,
                    'thumb_size' => '350x240'
                ) );
				
				$post_thumbnail_large = wpb_getImageBySize( array(
                    'attach_id'  => $attach_id,
                    'thumb_size' => '795x500'
                ) );
			?>

                <div class="thumbnail__image-container hidden-sm hidden-xs">
					<?php echo wp_kses( $post_thumbnail['thumbnail'], array( 'img' => array( 'src' => array(), 'width' => array(), 'height' => array() ) ) ); ?>
					
					<?php if( is_sticky() ) : ?>
						<?php if( $sticky_text = stm_option('sticky_text') ) : ?>
							<span class="sticky-post sticky-post_type_thumbnail"><?php echo esc_html( $sticky_text ); ?></span>
						<?php endif; ?>
					<?php endif; ?>
				</div>
				
				<div class="thumbnail__image-container hidden-lg hidden-md">
					<?php echo wp_kses( $post_thumbnail_large['thumbnail'], array( 'img' => array( 'src' => array(), 'width' => array(), 'height' => array() ) ) ); ?>
					
					<?php if( is_sticky() ) : ?>
						<?php if( $sticky_text = stm_option('sticky_text') ) : ?>
							<span class="sticky-post sticky-post_type_thumbnail"><?php echo esc_html( $sticky_text ); ?></span>
						<?php endif; ?>
					<?php endif; ?>
				</div>
				
            <?php endif; ?>
			
		<?php else: ?>
			<div class="thumbnail__image-container thumbnail__image-container_holder">
				<?php if( is_sticky() ) : ?>
					<?php if( $sticky_text = stm_option('sticky_text') ) : ?>
						<span class="sticky-post sticky-post_type_thumbnail"><?php echo esc_html( $sticky_text ); ?></span>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="thumbnail__caption">
			<div class="thumbnail__caption-bump"></div>

			<?php if( isset( $caption_icon ) ) : ?>
				<div class="thumbnail__caption-icon thumbnail__caption-icon_type_recent-post"><?php echo $caption_icon; ?></div>
			<?php endif; ?>

			<h5 class="thumbnail__caption-title thumbnail__caption-title_type_recent-post"><?php echo mb_substr( get_the_title(), 0, 57 ); ?></h5>
			<div class="thumbnail__caption-text thumbnail__caption-text_view_hide"><?php echo wpautop(mb_substr( get_the_excerpt(), 0, 127 )); ?></div>
		</div>
		<a class="thumbnail__link thumbnail__link_type_cover" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</article>

<?php else: ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'post_type_list', 'post_view_sidebar-' . $blog_sidebar ) ); ?>>

		<?php if( has_post_thumbnail() ) : ?>

			<div class="post__thumbnail">
				<?php the_post_thumbnail( 'thumb-795x300', array( 'class' => 'img-responsive' ) ); ?>
				<div class="post__thumbnail-bump"></div>
				<?php if( isset( $caption_icon ) ) : ?>
					<div class="post__thumbnail-icon"><?php echo $caption_icon; ?></div>
				<?php endif; ?>
				<?php if( is_sticky() ) : ?>
					<?php if( $sticky_text = stm_option('sticky_text') ) : ?>
						<span class="sticky-post sticky-post_type_thumbnail"><?php echo esc_html( $sticky_text ); ?></span>
					<?php endif; ?>
				<?php endif; ?>
			</div>

		<?php endif; ?>

		<h3 class="post__title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
		<div class="post__meta">
			<ul class="post__meta-list post__meta-list_inline">
				<li class="post__meta-item post__meta-date"><?php echo esc_html( get_the_date() ); ?></li>
				<li class="post__meta-item post__meta-author"><?php _e('By:', 'healthcoach' ); ?> <?php echo esc_html( get_the_author() ); ?></li>
				<?php if( get_the_category() ) : ?>
					<li class="post__meta-item post__meta-category"><?php _e( 'Category:', 'healthcoach' ); ?> <?php echo wp_kses( get_the_category_list(', '), array( 'a' => array( 'href' => array(), 'rel' => array() ) ) ); ?></li>
				<?php endif; ?>
				<li class="post__meta-item post__meta-comments"><?php _e ('Comments', 'healthcoach' ); ?>: <?php comments_number( '0', '1', '%' ); ?></li>
			</ul>
		</div>
		<div class="post__summary"><?php echo wpautop( get_the_excerpt() ); ?></div>
	</article>

<?php endif; ?>