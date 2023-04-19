<?php
/**
 * The Template for displaying all single rental posts
 */

get_header();

?>
<div class="inner-page margin-post">

	<?php
		get_template_part( 'tmpl/rental-form' );
	?>

    <div class="lte-rental-single lte-rental-sc row centered">  
        <div class="col-xl-8 col-lg-10 col-md-12 col-xs-12">
            <section class="rental-post">
				<?php
					while ( have_posts() ) : 

						the_post();

						get_template_part( 'tmpl/content-rental-full' );

						$args = fw_get_db_post_option(get_The_ID());
						if ( shortcode_exists('booking') AND !empty($args['booking_enabled']) ) {

							echo do_shortcode('[booking type="'.$args['booking_id'].'"]');
						}
						
					endwhile;
				?>                    
            </section>
        </div>
    </div>
</div>
<?php

get_footer();
