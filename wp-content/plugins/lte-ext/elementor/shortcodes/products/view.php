<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Products Shortcode
 */

if ( !lte_is_wc('wc_active') ) {

	return false;
}

$limit = $args['limit'];

if ( ($args['layout'] == 'slider-filter' OR $args['layout'] == 'simple-filter') ) {

	$limit = 400;
}

$query_args = array(
	'post_type' => 'product',
	'post_status' => 'publish',
	'posts_per_page' => (int)($limit),
);

if ( !empty($args['ids']) ) {

	$query_args['post__in'] = explode(',', str_replace(' ', '', $args['ids']));
}


if ( !empty($args['cat']) ) {

	$query_args['tax_query'] = 	array(
			array(
	            'taxonomy'  => 'product_cat',
	            'field'     => 'if', 
	            'terms'     => $args['cat'],
			),
		    array(
		        'taxonomy' => 'product_visibility',
		        'field'    => 'name',
		        'terms'    => 'exclude-from-catalog',
		        'operator' => 'NOT IN',
		    ),			
    );

	$query_args['posts_per_page'] = (int)($limit);
}

if ( !empty($args['orderby']) ) {

	$query_args['orderby'] = $args['orderby'];
	$query_args['order'] = $args['orderway'];
}		

if ( !empty($args['featured']) ) {

	$query_args['post__in'] = wc_get_featured_product_ids();
}

$cols = 4;
if ( !empty($args['cols']) ) {

	$cols = $args['cols'];
}

if ( !function_exists('lte_wc_sc_enable_excerpt') ) {

	function lte_wc_sc_enable_excerpt() { return 'enabled'; }
}

if ( !function_exists('lte_wc_sc_set_excerpt') ) {

	function lte_wc_sc_set_excerpt() { return get_query_var('lte_excerpt_size'); }
}

if ( $args['excerpt'] == 'enabled' ) {
	
	add_filter('lte_wc_display_excerpt', 'lte_wc_sc_enable_excerpt' );	
}

if ( $args['excerpt'] == 'enabled' && (!empty($args['excerpt_size']) ) ) {

	set_query_var('lte_excerpt_size', $args['excerpt_size']);

	add_filter('lte_wc_excerpt_size', 'lte_wc_sc_set_excerpt' );
}

if ( $args['style'] == 'circle' ) {

	set_query_var('wc_prod_style', 'circle' );
}

if ( $args['style'] == 'descr-right' ) {

	set_query_var('wc_show_more', true );
}

$query = new WP_Query( $query_args );
if ( $query->have_posts() ) {

	$woocommerce_wrapper_class = [];
	$woocommerce_wrapper_class[] = 'woocommerce lte-products-sc';
	$woocommerce_wrapper_class[] = 'lte-product-style-'.esc_attr($args['style']);

	if ( $args['layout'] == 'slider' OR $args['layout'] == 'slider-filter' ) {

		$args['swiper'] = true;
		$woocommerce_wrapper_class[] = 'lte-products-slider';
   	}

	$item_class = array();
	$item_class[] = 'product';

	$filter_out_escaped = '';
	if ( in_array($args['layout'], ['simple-filter', 'slider-filter']) ) {

		if ( !empty($args['cat']) ) {

			$cats = get_categories( [ 'taxonomy' => 'product_cat', 'include' => $args['cat'] ] );
		}
			else {

			$cats = get_categories( [ 'taxonomy' => 'product_cat'] );
		}

		if ( !empty($cats) AND sizeof($cats) > 1 ) {

			$products_filter_container = array();
			$filter_out_escaped .= '<ul class="lte-tabs-cats lte-slider-filter lte-tabs-align-'.esc_attr($args['categories-align']).' lte-tabs-active-'.esc_attr($args['categories-active-color']).'">';
			foreach ($cats as $cat) {

				$filter_out_escaped .= '<li><span class="lte-tab" data-filter="'.esc_attr($cat->term_id).'">'.esc_html($cat->name).'</span></li>';
				$products_filter_container[$cat->term_id] = array();

			}

			$filter_out_escaped .= '</ul>';
		}
	}

	$columns_class = array();
	foreach ( array('xl', 'lg', 'md', 'sm', 'ms', 'xs') as $bp ) {

		if ( !empty( $args['columns_' . $bp] ) ) {

			$cols = $args['columns_' . $bp];
			$args['swiper_breakpoint_' . $bp] = $args['columns_' . $bp];
		}

		$columns_class[] = 'lte-cols-'.$bp.'-' . esc_attr( $cols );
	}

	if ( empty($args['padding']) ) {

		$args['padding'] = 'no';
	}

	$columns_class[] = 'lte-padding-'.esc_attr($args['padding']);

	if ( (!empty($args['swiper']) OR in_array($args['layout'], ['simple-filter', 'slider-filter']) ) ) {

		$args['swiper_slides_per_group'] = -1;
//		$args['swiper_arrows'] = 'bottom';	
		//$args['swiper_pagination'] = 'bullets';

		$woocommerce_wrapper_class[] = 'lte-wc-wrapper';
		$woocommerce_wrapper_class = array_merge($columns_class, $woocommerce_wrapper_class);

		if ( !empty($filter_out_escaped) ) {

			echo '<div class="lte-filter-container">';
			echo $filter_out_escaped;

			foreach ( $products_filter_container as $filterId => $container ) {

				if ( $args['layout'] == 'slider-filter' ) {

					ob_start();
					lte_swiper_get_the_container(implode(' ', $woocommerce_wrapper_class), $args);
					$out_escaped = ob_get_contents();
					ob_end_clean();
				}
					else {

					$out_escaped = '<div class="'.esc_attr(implode(' ', $woocommerce_wrapper_class)).'">';
				}

				$products_filter_container[$filterId][] = $out_escaped;

				if ( $args['layout'] == 'slider-filter' ) {

					$products_filter_container[$filterId][] = '<ul class="products columns-128 swiper-wrapper lte-filter-items">';
				}
					else {

					$products_filter_container[$filterId][] = '<ul class="products columns-128 lte-filter-items">';
				}
			}
		}
			else {

			echo lte_swiper_get_the_container('woocommerce lte-products-slider lte-products-sc ' . 'lte-padding-'.esc_attr($args['padding']), $args);
			echo '<ul class="products columns-128 swiper-wrapper">';
		}

		$item_class[] = 'swiper-slide';
	}
		else {

		$woocommerce_wrapper_class[] = 'lte-wc-wrapper';
		$woocommerce_wrapper_class = array_merge($columns_class, $woocommerce_wrapper_class);

		echo '<div class="'.esc_attr(implode(' ', $woocommerce_wrapper_class)).'">';

		if ( !empty($filter_out_escaped) ) {

			echo $filter_out_escaped;
		}

		$ul_class = [];
		$ul_class[] = 'products columns-128 lte-products-sc lte-products-sc-'.esc_attr($args['layout']);

		echo '<ul class="'.esc_attr(implode(' ', $ul_class)).'">';
	}

	$products_filter_items = [];

	while ( $query->have_posts() ):

		$query->the_post();

		$cats = get_the_terms( get_the_ID(), 'product_cat' );

		if ( isset($single_cat->term_id) ) $current_cat = $single_cat->term_id;
		if ( empty($current_cat) ) $current_cat = '';

		$product = $item = wc_get_product( get_the_ID() );

		ob_start();

		?>
		<li id="post-<?php the_ID(); ?>" <?php post_class(esc_attr(implode(' ', $item_class))); ?>>
			<?php
				do_action( 'woocommerce_before_shop_loop_item' );

				do_action( 'woocommerce_before_shop_loop_item_title' );

				do_action( 'woocommerce_shop_loop_item_title' );

				do_action( 'woocommerce_after_shop_loop_item_title' );

				do_action( 'woocommerce_after_shop_loop_item' );
			?>
		</li>
		<?php 

		$out_escaped = ob_get_contents();
		ob_end_clean();

		if ( in_array($args['layout'], ['simple-filter', 'slider-filter']) ) {
			
			foreach ( $cats as $cat ) {

				if ( !empty( $products_filter_container[$cat->term_id] ) ) {

					$products_filter_items[$cat->term_id][] = $out_escaped;
				}
			}
		}
			else {

			echo $out_escaped;
		}

		?>
	<?php
	endwhile;

	if ( $args['layout'] == 'simple-filter' ) {

		foreach ( $products_filter_items as &$items ) {

			$items = array_slice($items, 0, $args['limit']);
		}

		unset($items);
	}

	if ( !empty( $products_filter_container ) ) {
		
		foreach ( $products_filter_container as $filterId => $container ) {

			if ( !empty($products_filter_items[$filterId]) ) $products_filter_container[$filterId][] = implode($products_filter_items[$filterId]);

			if ( $args['layout'] == 'simple-filter' ) {

				$products_filter_container[$filterId][] = '</ul></div>';
			}
				else {

				$products_filter_container[$filterId][] = '</ul></div></div>';
			}
		}

		foreach ( $products_filter_container as $filterId => $container ) {

			echo '<div class="lte-filter-item lte-filter-id-'.esc_attr($filterId).'">';

				echo implode($container);

			echo '</div>';
		}

		echo '</div>';
	}
		else {

		echo '</ul></div>';	
	}

	wp_reset_postdata();
}

remove_filter('lte_wc_display_excerpt', 'lte_wc_sc_enable_excerpt', 10);
set_query_var('lte_excerpt_size', false);
set_query_var('lte_wc_image_alt', false );
set_query_var('wc_show_more', false );
set_query_var('wc_prod_style', false );

