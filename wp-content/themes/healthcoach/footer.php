    <footer class="footer">
        <div class="footer-main">
            <div class="container">
                <?php if( stm_option('enable_footer_banner') ) : ?>
                    <div class="banner banner_type_footer clearfix">
                        <?php if( $banner_image_url = stm_option( 'banner_image', false, 'url' ) ) : ?>
                            <div class="col-lg-4 col-md-4 hidden-sm hidden-xs">
                                <div class="banner__image text-center">
                                    <img class="img-responsive" src="<?php echo esc_url( $banner_image_url ); ?>" alt=""/>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-lg-8 col-md-8">
                            <div class="banner__body banner__body_vertical_middle">
                                <?php if( $banner_title = stm_option('banner_title') ) : ?>
                                    <h3 class="banner__title"><span class="banner__title-icon lnr lnr-cart"></span><?php echo esc_html( $banner_title ); ?></h3>
                                <?php endif; ?>
                                <?php if( $banner_text = stm_option('banner_text') ) : ?>
                                    <div class="banner__text"><?php echo wpautop( esc_html( $banner_text ) ); ?></div>
                                <?php endif; ?>
                                <?php if( $banner_url = stm_option( 'banner_url' ) ) : ?>
                                    <a class="banner__link banner__link_type_icon" href="<?php echo esc_url( $banner_url ); ?>"><i class="hc-icon-arrow-r"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; // End Banner ?>

                <?php if( stm_option('enable_footer_widgets') ) : ?>
                    <div class="widget-area widget-area_type_footer grid-container">
                        <div class="row">
                        <?php if ( is_active_sidebar( 'footer-widget-col-1' ) ) { ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?php dynamic_sidebar( 'footer-widget-col-1' ); ?></div>
                        <?php } ?>
                        <?php if ( is_active_sidebar( 'footer-widget-col-2' ) ) { ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?php dynamic_sidebar( 'footer-widget-col-2' ); ?></div>
                        <?php } ?>
                        <?php if ( is_active_sidebar( 'footer-widget-col-3' ) ) { ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?php dynamic_sidebar( 'footer-widget-col-3' ); ?></div>
                        <?php } ?>
                        <?php if ( is_active_sidebar( 'footer-widget-col-4' ) ) { ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?php dynamic_sidebar( 'footer-widget-col-4' ); ?></div>
                        <?php } ?>
                        </div>
                    </div>
                <?php endif; // End Widgets ?>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <?php if( $copyright_text = stm_option('footer_copyright_text') ) : ?>
                                <p class="copyright"><?php echo wp_kses( $copyright_text, array( 'a' => array( 'href' => array() ), 'strong' => array(), 'br' => array() ) ); ?></p>
                        <?php endif;?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <?php if( $custom_text = stm_option('footer_custom_text') ) : ?>
                            <p class="custom-text">
                                <?php echo wp_kses( $custom_text, array( 'a' => array( 'href' => array() ), 'strong' => array(), 'br' => array() ) ); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- .footer -->
</div><!-- .wrapper -->
<div class="search-fullscreen" id="js-search-fullscreen">
    <div class="search-fullscreen-inner">
        <div class="container">
            <form role="search" method="get" class="form form_search-fullscreen" action="<?php echo esc_url( home_url( '/' ) ) ?>">
                <fieldset class="form__fieldset">
                    <input type="text" class="form__field-text" value="" placeholder="<?php _e( 'New search...', 'healthcoach' ) ?>" name="s" id="s"/>
                    <button type="submit" class="form__field-button"><i class="fa fa-search"></i></button>
                </fieldset>
            </form>
        </div>
    </div>
</div><!-- SEARCH -->
<div class="overlay-fullscreen"></div><!-- OVERLAY -->
    <?php
        if( $live_customizer_enable = stm_option('live_customizer_enable') ) {
            get_template_part('inc/customizer/live', 'customizer');
        }
    ?>
<?php wp_footer(); ?>
</body>
</html>