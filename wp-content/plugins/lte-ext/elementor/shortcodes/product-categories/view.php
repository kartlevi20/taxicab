<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Product Categories Shortcode
 */

$query_args = array(
     'taxonomy'     => 'product_cat',
     'orderby'      => 'menu_order',
     'show_count'   => 0,
     'pad_counts'   => 0,
     'hierarchical' => 1,
     'title_li'     => '',
     'hide_empty'   => 0
);

if ( !empty($args['cat']) ) {

	$query_args['include'] = $args['cat'];
}

$query_args['orderby'] = 'menu_order';

if ( !empty($args['limit'])) {

	$query_args['number'] = $args['limit'];
}


$cats = array();
$list = get_categories( $query_args );

foreach ($list as $cat) {

	if (esc_html($cat->name) == 'Uncategorized' OR empty($cat->name) ) continue;

	$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true ); 
    if ( !empty($thumbnail_id) ) {

    	$image = wp_get_attachment_image_src($thumbnail_id, 'limme-wc-cat');
    }
    	else {

    	$image = null;
    }

//	if ($cat->category_parent == 0) {

	    $cats[$cat->term_id]['href'] = get_term_link($cat->slug, 'product_cat');
	    $cats[$cat->term_id]['name'] = $cat->name;
	    $cats[$cat->term_id]['description'] = $cat->description;
	    $cats[$cat->term_id]['image'] = $image;
	    $cats[$cat->term_id]['image_id'] = $thumbnail_id;
/*
	}
		else {

	    $cats[$cat->category_parent]['child'][$cat->term_id] = array(

	    	'href' => get_term_link($cat->slug, 'product_cat'),
	    	'name' => $cat->name,
	    	'image' => $image,
	    );		    
	}
*/	
}	

$cols = '';
if ( $args['columns'] == 1) {

	$cols = 'col-xs-12';
}
	else
if ( $args['columns'] == 2) {

	$cols = 'col-lg-6 col-md-6 col-sm-6 col-ms-12 col-xs-12';
}
	else
if ( $args['columns'] == 3) {

	$cols = 'col-lg-4 col-md-6 col-sm-6 col-ms-12 col-xs-12';
}
	else
if ( $args['columns'] == 4) {

	$cols = 'col-lg-3 col-md-6 col-sm-6 col-ms-12 col-xs-12';
}
	else
if ( $args['columns'] == 5) {

	$cols = '.col-lg-5ths col-md-6 col-sm-6 col-ms-12 col-xs-12';
}
	else
if ( $args['columns'] == 6) {

	$cols = 'col-lg-2 col-md-4 col-sm-6 col-ms-6 col-xs-6';
}

$columns_class = array();
foreach ( array('xl', 'lg', 'md', 'sm', 'ms', 'xs') as $bp ) {

	if ( !empty( $args['columns_' . $bp] ) ) {

		$cols = $args['columns_' . $bp];
		$args['swiper_breakpoint_' . $bp] = $args['columns_' . $bp];
	}

	//$columns_class[] = 'lte-cols-'.$bp.'-' . esc_attr( $cols );
}

if ( !empty($cats) ) {

	if ( empty($args['layout'])) $args['layout'] = '';


	$swiper_item_class = '';
	if ( !empty($args['slider']) ) {

		$args['swiper_slides_per_group'] = -1;
		$args['swiper_arrows'] = 'sides-outside';
//		$args['swiper_pagination'] = 'bullets';
		$args['swiper_autoplay'] = 2000;

		if ( $args['slider-effect'] == 'coverflow' ) {

			$args['swiper_effect'] = 'coverflow';
		}

		$swiper_item_class = 'swiper-slide';
		echo lte_swiper_get_the_container('lte-products-cats-sc lte-layout-'.esc_attr($args['layout']), $args );
		echo '<div class="swiper-wrapper">';
	}
		else {

		echo '<div class="lte-products-cats-sc row lte-layout-'.esc_attr($args['layout']).'">';	
		$swiper_item_class = $cols;
	}	



	$x = 0;
	foreach ( $cats as $tid => $item ) {

		$x++;

		$icon = fw_get_db_term_option($tid, 'product_cat', 'icon');
		$header = fw_get_db_term_option($tid, 'product_cat', 'header');
		$bgcolor = fw_get_db_term_option($tid, 'product_cat', 'bg-color');
		if ( empty($header) ) {

			$header = $item['name'];
		}

		echo '<div class="'.esc_attr($swiper_item_class).'">';

			echo '<a href="'.esc_url($item['href']).'" class="lte-item lte-bg-'.esc_attr($bgcolor).'">';

				if ( !empty($item['image']) ) {

					echo '<span class="lte-image-wrapper">';

						echo wp_get_attachment_image( $item['image_id'], 'limme-wc-cat' );
						
					echo '</span>';
				}
					else
				if ( !empty($icon['icon-class']) ) {

					echo '<span class="lte-icon-wrapper"><span class="'.esc_attr($icon['icon-class']).'"></span></span>';
				}
					else
				if ( $icon['type'] == 'custom-upload' ) {

					echo '<span class="lte-image-wrapper"><span class="lte-image"><img src="'.esc_url($icon['url']).'" alt="'.esc_attr($header).'"></span></span>';
				}

			
				echo '<h6 class="lte-header">'.wp_kses_post(lte_string_parse($header)).'</h6>';

				if ( !empty($item['description'])) {

					echo '<span class="lte-excerpt">';

						echo wp_kses_post($item['description']);

					echo '</span>';
				}

				echo '<span class="lte-arrow-right"></span>';
			
			echo '</a>';

		echo '</div>';		
	} 

	if ( !empty($args['slider']) ) {

		echo '</div></div>';	
	}

	echo '</div>';
}


