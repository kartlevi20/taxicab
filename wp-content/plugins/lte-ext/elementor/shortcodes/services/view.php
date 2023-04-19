<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Services Shortcode
 */

if ( $args['layout'] == 'grid' ) {

	$args['limit'] = 5;
}

$query_args = array(
	'post_type' => 'services',
	'post_status' => 'publish',
	'posts_per_page' => (int)($args['limit']),
);

if ( !empty($args['cat']) ) {

	$query_args['tax_query'] = 	array(
		array(
            'taxonomy'  => 'services-category',
            'field'     => 'if', 
            'terms'     => array(esc_attr($args['cat'])),
		)
    );
}

if ( !empty($args['orderby']) ) {

	$query_args['orderby'] = $args['orderby'];
}

$query = new WP_Query( $query_args );
if ( $query->have_posts() ) {

	$swiper_item_class = '';
	if ( !empty($args['swiper']) OR $args['layout'] == 'slider' ) {

		$atts['swiper_pagination'] = 'fraction';
		$swiper_item_class = 'swiper-slide';
		echo lte_vc_swiper_get_the_container('lte-services-sc', $atts, $class, $id);
		echo '<div class="swiper-wrapper">';
	}
		else {

		echo '<div class="lte-lte-services-sc-wrapper lte-services-sc lte-layout-'.esc_attr($args['layout']).'"><div class="row">';

	}	

	$x = 0;
	while ( $query->have_posts() ) {

		$query->the_post();
		$x++;

		$subheader = fw_get_db_post_option(get_The_ID(), 'subheader');
		$cut = fw_get_db_post_option(get_The_ID(), 'cut');
		$image = fw_get_db_post_option(get_The_ID(), 'image');
		$header = get_the_title();
		$link = fw_get_db_post_option(get_The_ID(), 'link');

		if ( empty($link) ) {

			$link = get_the_permalink();
		}		

		$item_class = '';

		if ( $args['layout'] == 'grid' ) {

			echo '<div class="col-lg-4 col-md-12 col-xs-12"><div class="lte-item">';
		?>
			<a href="<?php echo esc_url( $link ); ?>" class="lte-photo">
				<?php the_post_thumbnail('limme-tiny-square'); ?>
			</a>
			<div class="lte-item-inner">
	            <h5 class="lte-header"><a href="<?php echo esc_url( $link ); ?>"><?php echo wp_kses_post($header); ?></a></h5>
	            <?php
	            if ( !empty($cut) ) {

	            	echo '<span class="lte-descr">'.wp_kses_post($cut).'</span>';
	            }

	            ?>
			</div>
			<?php

			echo '</div></div>';
		}
			else
		if ( $args['layout'] == 'photos' ) {

			$swiper_item_class = ' col-lg-4 col-md-4 ';			
			?>
			<div class="lte-item <?php echo esc_attr($swiper_item_class); ?>">
				<div class="lte-item-inner">
					<?php get_template_part( 'tmpl/content', 'services' ); ?>
				</div>
			</div>
			<?php
		}
	}

	if ( !empty($args['swiper']) OR $args['layout'] == 'slider' ) {

		echo '</div>';	
		echo '<div class="swiper-pagination"></div>';
	}
		

	echo '</div></div>';


	wp_reset_postdata();
}

