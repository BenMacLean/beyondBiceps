<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if( has_post_thumbnail() ) : ?>
            <?php if( get_post_format() == 'video' && $embed_code = get_post_meta( get_the_ID(), 'embed_code', true ) ) : ?>
                <?php
                    if( !empty( $embed_code ) ) {
                        $attach_video = $embed_code;
                    }
                ?>
                <div class="entry-video">
                    <?php $attach_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
                    <div class="entry-video__preview" style="<?php echo esc_attr( 'background-image: url(' . $attach_image[0] . ')' ) ?>">
                        <a class="entry-video__preview-play" href="#"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/icons/video-play.svg' ) ?>" alt=""></a>
                    </div>
                    <?php echo wp_kses( $attach_video, array( 'iframe' => array( 'width' => array(), 'height' => array(), 'src' => array(), 'frameborder' => array(), 'allowfullscreen' => array() ) ) ); ?>
                </div>
            <?php else : ?>
                <div class="entry-thumbnail">
                    <?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive') ); ?>
                    <?php if( is_sticky() ) : ?>
                        <?php if( $sticky_text = stm_option('sticky_text') ) : ?>
                            <span class="sticky-post sticky-post_type_thumbnail"><?php echo esc_html( $sticky_text ); ?></span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
    <?php endif; ?>
    <h2 class="entry-title"><?php the_title(); ?></h2>
    <div class="post__meta">
        <ul class="post__meta-list post__meta-list_inline">
            <li class="post__meta-item post__meta-date"><?php echo esc_html( get_the_date() ); ?></li>
            <li class="post__meta-item post__meta-author"><?php _e('By:', 'healthcoach' ); ?> <?php echo esc_html( get_the_author() ); ?></li>
            <?php if( get_the_category() ) : ?>
                <li class="post__meta-item post__meta-category"><?php _e('Category:', 'healthcoach' ); ?> <?php echo wp_kses( get_the_category_list(', '), array( 'a' => array( 'href' => array(), 'rel' => array() ) ) ); ?></li>
            <?php endif; ?>
            <li class="post__meta-item post__meta-comments"><?php _e('Comments:', 'healthcoach' ); ?> <?php comments_number( '0', '1', '%' ); ?></li>
        </ul>
    </div>

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

    <?php if( get_the_content() ) : ?>
        <div class="entry-content <?php echo esc_attr( $entry_content_class ); ?>">
            <?php the_content(); ?>
            <?php
                wp_link_pages( array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'healthcoach' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ) );
            ?>
        </div>
    <?php endif; ?>

    <div class="entry-footer clearfix">
        <?php the_tags('<ul class="entry-tags"><li>', '</li><li>', '</li></ul>') ?>
        <?php get_template_part('parts/share'); ?>
    </div>
</article>
