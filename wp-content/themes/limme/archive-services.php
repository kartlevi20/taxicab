<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * The Services template file
 *
 */

$limme_sidebar_hidden = true;
$limme_sidebar = 'hidden';
$wrap_class = 'col-lg-12 col-md-12 col-xs-12';

if ( function_exists( 'FW' ) ) {

	$limme_sidebar = fw_get_db_settings_option( 'services_list_sidebar' );

	if ( $limme_sidebar == 'hidden' ) {

		$limme_sidebar_hidden = true;
	}


	if ( $limme_sidebar == 'left' ) {

		$wrap_class = 'col-xl-8 col-xl-push-4 col-lg-9 col-lg-push-3 col-lg-offset-0 col-md-12 col-xs-12';
	}
}

get_header(); ?>
<div class="lte-services-archive inner-page margin-default">
	<div class="row <?php if ( $limme_sidebar_hidden ) { echo 'centered'; } ?>">
        <div class="<?php echo esc_attr( $wrap_class ); ?>">
				<?php

				if ( get_query_var( 'paged' ) ) {

					$paged = get_query_var( 'paged' );

				} elseif ( get_query_var( 'page' ) ) {

					$paged = get_query_var( 'page' );
					
				} else {

					$paged = 1;
				}

				$wp_query = new WP_Query( array(
					'post_type' => 'services',
					'paged' => (int) $paged,
				) );

            	echo '<div class="row">';
				if ( $wp_query->have_posts() ) :

					while ( $wp_query->have_posts() ) :

						the_post();

						echo '<div class="col-lg-3">';
							get_template_part( 'tmpl/content-services' );
						echo '</div>';

					endwhile;

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'tmpl/content', 'none' );
				endif;
				echo '</div>';
				?>
			<?php
			if ( have_posts() ) {

				limme_paging_nav();
			}
            ?>	        
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
