<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The template for displaying the footer
 */
    do_action( 'limme_wrapper_close' );
    do_action('limme_content_close');
    
    if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
        
        do_action('limme_footer_open');

            limme_the_subscribe_block();

            /* Footer widgets area */
            limme_the_footer_widgets();

            /* Copyright */
            limme_the_copyrights_section();

        do_action('limme_footer_close');
    }

    wp_footer();
?>
</body>
</html>
