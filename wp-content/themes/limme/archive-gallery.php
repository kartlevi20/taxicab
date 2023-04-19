<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Gallery page
 */

// Getting gallery layout
if ( function_exists( 'fw_get_db_settings_option' ) ) {

	$limme_layout = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'gallery-layout' );
	if ( empty($limme_layout) ) $limme_layout = fw_get_db_settings_option( 'gallery_layout' );
}
?>
<?php get_header(); ?>

<div class="gallery-page inner-page margin-default gallery-<?php echo esc_attr( $limme_layout ); ?>">
	<div class="row ">

		<?php
			if ( get_query_var( 'paged' ) ) {

				$paged = get_query_var( 'paged' );
			} elseif ( get_query_var( 'page' ) ) {

				$paged = get_query_var( 'page' );
			} else {

				$paged = 1;
			}

			$wp_query = new WP_Query( array(
				'post_type' => 'gallery',
				'paged' => (int) $paged,
			) );


			if ( ! empty($limme_layout) && $limme_layout == 'col-3' ) {

				$limme_grid = 3;
			}
				elseif ( ! empty($limme_layout) && $limme_layout == 'col-4' ) {

				$limme_grid = 4;
			}
				else {

				$limme_grid = 2;
			}

			set_query_var( 'limme_gallery_grid', $limme_grid );

			if ( $wp_query->have_posts() ) :
				while ( $wp_query->have_posts() ) : 

					$wp_query->the_post();

					get_template_part( 'tmpl/content', 'lte-gallery' );

				endwhile;
			else :
				// If no content, include the "No posts found" template.
				get_template_part( 'tmpl/content', 'none' );

			endif;
		?>  
	</div>
	<?php
	if ( have_posts() ) {

		limme_paging_nav();
	}
	?>        
</div>            
<?php get_footer(); ?>
