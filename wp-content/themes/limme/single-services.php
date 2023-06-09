<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The Template for displaying all single services posts
 */

$limme_sidebar_hidden = false;
$limme_sidebar = 'hidden';
$blog_wrap_class = 'col-xl-8 col-lg-8 col-md-12 col-xs-12';

if ( function_exists( 'FW' ) ) {

	$limme_sidebar = fw_get_db_settings_option( 'services_post_sidebar' );

	if ( $limme_sidebar == 'left' ) {

		$blog_wrap_class = 'col-xl-8 col-xl-push-4 col-lg-9 col-lg-push-3 col-lg-offset-0 col-md-12 col-xs-12';	
	}
		else
	if ( $limme_sidebar == 'hidden' ) {

		$blog_wrap_class = 'col-xl-8 col-lg-10 col-md-12 col-xs-12';	
		$limme_sidebar_hidden = true;
	}
}

get_header();

?>
<div class="inner-page margin-default">
    <div class="row <?php if ( $limme_sidebar_hidden ) echo 'centered'; ?>">  
        <div class="<?php echo esc_attr( $blog_wrap_class ); ?>">
            <section class="blog-post">
				<?php
					while ( have_posts() ) : 

						the_post();

						get_template_part( 'tmpl/content-services-full', get_post_format() );

						if ( comments_open() || get_comments_number() ) {

							comments_template();
						}

					endwhile;
				?>                    
            </section>
        </div>
	    <?php
	    if ( !$limme_sidebar_hidden ) {

            if ( $limme_sidebar == 'left' ) {

            	get_sidebar( 'left' );
            }
            	else  {

            	get_sidebar();
            }
	    }
	    ?>
    </div>
</div>
<?php

get_footer();
