<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Testimonials Shortcode
 */

$query_args = array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'posts_per_page' => $args['limit'],
);

if ( !empty($args['ids']) ) $query_args['post__in'] = explode(',', esc_attr($args['ids']));
	else
if ( !empty($args['cat']) ) $query_args['category__in'] = $args['cat'];

if ( !empty($args['orderby']) ) {

	$query_args['orderby'] = $args['orderby'];
}		

if ( !empty($args['orderway']) ) {

	$query_args['order'] = $args['orderway'];
}

$query = new WP_Query( $query_args );

if ( $query->have_posts() ) {

	set_query_var( 'lte_display_excerpt', false );
	if ( !empty($args['excerpt_display']) ) {

		set_query_var( 'lte_display_excerpt', true );
	}	

	set_query_var( 'lte_sc_excerpt_size', false );
	if ( !empty( $args['excerpt'] ) ) {

		set_query_var( 'lte_sc_excerpt_size', $args['excerpt'] );
	}	

	$cols = '';
	if ( $args['columns'] == 1) {

		$cols = 'col-xs-12';
	}
		else
	if ( $args['columns'] == 2) {

		$cols = 'col-lg-6 col-md-12 col-sm-12 col-ms-12 col-xs-12';
	}
		else
	if ( $args['columns'] == 3) {

		$cols = 'col-lg-4 col-md-4 col-sm-6 col-ms-12 col-xs-12';
	}
		else
	if ( $args['columns'] == 4) {

		$cols = 'col-lg-3 col-md-6 col-sm-6 col-ms-12 col-xs-12';
	}


	$class = array();
	$class[] = 'layout-'.$args['layout'];
	$class[] = 'layout-cols-'.$args['columns'];

	set_query_var( 'limme_layout', $args['layout'] );

	echo '<div class="blog lte-blog-sc row centered '.esc_attr(implode(' ', $class)).'">';

	$x = 0;
	while ( $query->have_posts() ) {

		$query->the_post();	
		$x++;

		if ( in_array($args['layout'], array('featured', 'featured-rows')) ) {

			$class = '';
			if ( $x == 1 ) {

				echo '<div class="lte-featured-large col-xl-8 col-lg-7 col-md-12 col-sm-12 col-ms-12 col-xs-12">';
			}

/*
				set_query_var( 'lte_display_excerpt', true );
				set_query_var( 'lte_blog_thumb', 'limme-blog-featured' );

				if ( $args['layout'] == 'featured' ) {

					add_filter('excerpt_length', function() { return (int)fw_get_db_settings_option( 'excerpt_auto' ); }, 999 );
				}
					else {

					add_filter('excerpt_length', function() { return 25; }, 999 );
				}
*/

								
				
/*
				set_query_var( 'lte_display_excerpt', false );
				set_query_var( 'lte_blog_thumb', false );
*/				

				if ( $x <= 2  ) {
				
					echo get_template_part( 'tmpl/post-formats/list' );
				}

				if ( $x == 2 ) {

					echo '</div><div class="lte-featured-small col-xl-4 col-lg-5 col-md-12 col-sm-12 col-ms-12 col-xs-12">';
				}
/*
				if ( $args['layout'] == 'featured' ) {
				
					set_query_var( 'lte_display_excerpt', true );
				}

				add_filter('excerpt_length', function() { return (int)fw_get_db_settings_option( 'excerpt_masonry_auto' ); }, 999 );
*/
				if ( $x > 2 ) {

					echo get_template_part( 'tmpl/post-formats/list-inline' );
				}

				if ( $x == 5 OR $x == $query->post_count ) {

					echo '</div>';
				}

				set_query_var( 'lte_display_excerpt', false );
		}
			else {

				echo '<div class="items '.esc_attr($cols).'">';
					echo get_template_part( 'tmpl/post-formats/list' );
				echo '</div>';
		}

	}

	echo '</div>';
	echo '<div class="clearfix"></div>';

	wp_reset_postdata();
	set_query_var( 'lte_display_excerpt', false );
	set_query_var( 'lte_sc_excerpt_size', false );
}

