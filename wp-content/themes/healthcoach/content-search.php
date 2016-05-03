<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if( get_the_title() ) : ?>
        <h4 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
        <div class="post__meta">
            <ul class="post__meta-list post__meta-list_inline">
                <li class="post__meta-item post__meta-date"><?php echo esc_html( get_the_date() ); ?></li>
                <li class="post__meta-item post__meta-author"><?php _e('By:', 'healthcoach' ); ?> <?php echo esc_html( get_the_author() ); ?></li>
                <?php if( get_the_category() ) : ?>
                    <li class="post__meta-item post__meta-category"><?php _e('Category:', 'healthcoach' ); ?> <?php echo wp_kses( get_the_category_list(', '), array( 'a' => array( 'href' => array(), 'rel' => array() ) ) ); ?></li>
                <?php endif; ?>
                <li class="post__meta-item post__meta-comments"><?php _e('Comments', 'healthcoach' ); ?>: <?php comments_number( '0', '1' , '%' ); ?></li>
            </ul>
        </div>
    <?php endif; ?>
</article>
