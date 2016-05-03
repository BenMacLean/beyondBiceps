<nav class="page-pagination">
    <?php if( get_previous_posts_link() ) : ?>
        <div class="page-prev"><?php previous_posts_link('<span class="hc-icon-big-arrow-l"></span>'); ?></div>
    <?php endif; ?>
    <?php
    echo paginate_links( array(
        'prev_next' => false,
        'type'      => 'list',
    ) );
    ?>
    <?php if( get_next_posts_link() ) : ?>
        <div class="page-next"><?php next_posts_link('<span class="hc-icon-big-arrow-r"></span>'); ?></div>
    <?php endif; ?>
</nav>