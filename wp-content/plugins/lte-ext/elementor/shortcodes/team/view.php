<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Team Shortcode
 */

$query_args = array(
	'post_type' => 'team',
	'post_status' => 'publish',
	'posts_per_page' => (int)($args['limit']),
);

if ( !empty($args['cat']) ) {

	$query_args['tax_query'] = 	array(
			array(
	            'taxonomy'  => 'team-category',
	            'field'     => 'if', 
	            'terms'     => array(esc_attr($args['cat'])),
			)
    );
}

$query = new WP_Query( $query_args );

if ( $query->have_posts() ) {

	$swiper_item_class = '';
	if ( $args['layout'] == 'swiper' ) {

		$swiper_item_class = 'swiper-slide';
		echo lte_swiper_get_the_container('lte-team-list', $args);
		echo '<div class="swiper-wrapper">';
	}
		else {

		echo '<div class="lte-team-list-wrapper"><div class="lte-team-list"><div class="row">';
	}

	while ( $query->have_posts() ) {

		$query->the_post();

//		echo '<div class="lte-item '.esc_attr($swiper_item_class).'">';
			get_template_part( 'tmpl/content', 'team' );
//		echo '</div>';			
	}

	if ( !empty($args['layout'] == 'swiper') ) {

		echo '</div>';	
	}
		
	echo '</div></div></div>';

	wp_reset_postdata();
}

