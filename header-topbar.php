<?php
    global $shopkeeper_theme_options;
?>

<div id="site-top-bar">

    <?php if ( (isset($shopkeeper_theme_options['header_width'])) && ($shopkeeper_theme_options['header_width'] == "custom") ) : ?>
    <div class="row">       
        <div class="large-12 columns">
    <?php endif; ?>

        <div class="site-top-bar-inner" style="max-width:<?php echo esc_html($header_max_width_style); ?>">
            
            <div class="site-top-message"><?php if ( isset($shopkeeper_theme_options['top_bar_text']) ) _e( $shopkeeper_theme_options['top_bar_text'], 'shopkeeper' ); ?></div> 
            
            <?php if ( (isset($shopkeeper_theme_options['top_bar_social_icons'])) && ($shopkeeper_theme_options['top_bar_social_icons'] == "1") ) : ?>
            
            <div class="site-social-icons-wrapper">
                <div class="site-social-icons">
                    <ul>           
                        <?php do_action('getbowtied_social_media'); ?>
                    </ul>
                </div>
            </div>
            
            <?php endif; ?>
            
            <nav id="site-navigation-top-bar" class="main-navigation" role="navigation">                    
                <?php 
                    wp_nav_menu(array(
                        'theme_location'  => 'top-bar-navigation',
                        'fallback_cb'     => false,
                        'container'       => false,
                        'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
                    ));
                ?>

                <ul><li><a href="tel:0236496857" class="call_us_link"><?php _e('Apelează-ne', 'woocommerce');?></a></li><li><a href="/despre-noi/" class="about_us_link"><?php _e('Despre Noi', 'woocommerce');?></a></li><li><a href="#" class="manufacturers_link"><?php _e('Producători', 'woocommerce');?></a></li><li><a href="#" class="informations_link"><?php _e('Informaţii', 'woocommerce');?></a></li></ul>
                
                <?php if ( is_user_logged_in() && class_exists('WooCommerce') ) { ?>
                    <ul class="account-navigation"><li><a href="<?php echo wc_logout_url(); ?>" class="logout_link"><?php _e('Deloghează-te', 'woocommerce'); ?></a></li></ul>
                <?php } else { ?>          
                    <ul class="account-navigation"><li><a href="/my-account/" class="login_link"><?php _e('Autentificare', 'woocommerce'); ?></a></li><li><a href="/my-account/" class="register_link"><?php _e('Creați-vă Cont Nou', 'woocommerce'); ?></a></li></ul>
                <?php } ?>
            </nav><!-- #site-navigation -->
            
        </div><!-- .site-top-bar-inner -->
    
    <?php if ( (isset($shopkeeper_theme_options['header_width'])) && ($shopkeeper_theme_options['header_width'] == "custom") ) : ?>
        </div><!-- .columns -->
    </div><!-- .row -->
    <?php endif; ?>
    
</div><!-- #site-top-bar -->