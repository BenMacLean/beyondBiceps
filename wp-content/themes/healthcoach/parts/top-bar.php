<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="list_alignment_left">
                    <?php $top_bar_schedule = stm_option( 'top_bar_schedule' ); ?>
                    <?php if( $top_bar_schedule && stm_option('top_bar_schedule_enable') ) : ?>
                        <ul class="list list_type_schedule clearfix">
                            <?php foreach( $top_bar_schedule as $schedule_item ) : ?>
                                <li class="list__item"><?php echo esc_html( $schedule_item ); ?></li>
                                <li class="list__item list__item_separator">.</li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <?php if( stm_option('top_bar_contacts_enable') ) : ?>
                        <ul class="list list_type_contacts clearfix">
                            <?php if( $top_bar_email = stm_option( 'top_bar_email' ) ) : ?>
                                <li class="list__item list__item_email"><a href="mailto:<?php echo esc_attr( $top_bar_email ) ?>"><?php echo esc_html( $top_bar_email ); ?></a></li>
                            <?php endif; ?>
                            <?php if( $top_bar_phone = stm_option( 'top_bar_phone' ) ) : ?>
                                <li class="list__item list__item_phone"><?php echo esc_html__( $top_bar_phone ); ?></li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="list_alignment_right">
                    <?php if( stm_option('top_bar_socials_enable') && $top_bar_social = stm_option('top_bar_social') ) : ?>
                        <ul class="list list_type_socials clearfix">
                            <?php foreach( $top_bar_social as $key => $value) : ?>
                                <?php $social_url = stm_option( $key ); ?>
                                <?php if( !empty( $value ) && $value == 1 ) : ?>
                                    <li class="list__item"><a href="<?php echo esc_url( $social_url ); ?>"><i class="fa fa-<?php echo esc_attr( $key ); ?>"></i></a></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <?php
                        if ( defined( 'ICL_SITEPRESS_VERSION' ) && stm_option('top_bar_language_enable') || (bool) get_option( '_wpml_inactive' ) === true && stm_option('top_bar_language_enable') ) {
                            do_action('wpml_add_language_selector');
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>