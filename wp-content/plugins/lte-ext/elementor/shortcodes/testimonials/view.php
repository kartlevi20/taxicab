<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Testimonials Shortcode
 */

$query_args = array(
	'post_type' => 'testimonials',
	'post_status' => 'publish',
	'posts_per_page' => (int)($args['limit']),
);

if ( !empty($args['cat']) ) {

	$query_args['tax_query'] = 	array(
			array(
	            'taxonomy'  => 'testimonials-category',
	            'field'     => 'if', 
	            'terms'     => array(esc_attr($args['cat'])),
			)
    );
}

$query = new WP_Query( $query_args );

if ( $query->have_posts() ) {

	$swiper_item_class = '';
	if ( $args['layout'] == 'swiper' ) {

		$args['swiper_breakpoint_xl'] = 1;


		if ( $args['columns'] == 3 ) {

			$args['swiper_breakpoint_xl'] = 3;
			$args['swiper_breakpoint_lg'] = 3;
			$args['swiper_breakpoint_md'] = 2;
		}

		if ( $args['columns'] == 2 ) {

			$args['swiper_breakpoint_xl'] = 2;
			$args['swiper_breakpoint_lg'] = 2;
		}

		$args['swiper_arrows'] = 'false';
		$args['swiper_pagination'] = 'bullets';

		$swiper_item_class = 'swiper-slide';
		echo lte_swiper_get_the_container('lte-testimonials-list lte-cols-'.$args['swiper_breakpoint_xl'], $args);
		echo '<div class="swiper-wrapper">';
	}
		else {

		echo '<div class="lte-testimonials-list-wrapper><div class="lte-testimonials-list">';
	}

	set_query_var( 'lte-testimonials-sc', true );

	while ( $query->have_posts() ) {

		$query->the_post();

		$subheader = fw_get_db_post_option(get_The_ID(), 'subheader');
		$rate = fw_get_db_post_option(get_The_ID(), 'rate');

		if ( !empty($args['cut'])) {

			set_query_var( 'lte-testimonials-sc-cut', $args['cut'] );
		}

		echo '<div class="lte-item '.esc_attr($swiper_item_class).'">';
			get_template_part( 'tmpl/content', 'testimonials' );
		echo '</div>';			
	}

	if ( !empty($args['layout'] == 'swiper') ) {

		echo '</div>';	
	}
		
	echo '</div></div>';

	set_query_var( 'lte-testimonials-sc', false);
	set_query_var( 'lte-testimonials-sc-cut', false );

	wp_reset_postdata();
}

