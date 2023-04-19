<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Woocommerce Hooks
 */

/**
 * Changing WooCommerce archive wrapper
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
add_action('woocommerce_before_main_content', 'limme_wc_wrapper_start', 10);

if ( !function_exists( 'limme_wc_wrapper_start' ) ) {

	function limme_wc_wrapper_start() {

		$limme_sidebar = limme_get_wc_sidebar_pos();

		$cols = 3;
		$classes = [];
		$page_width = 'narrow';

		if ( function_exists('FW') ) {
			
			foreach ( array('xl', 'lg', 'md', 'sm', 'ms', 'xs') as $bp ) {

				if ( !empty( fw_get_db_settings_option('wc_columns_' . $bp) ) ) {

					$cols = fw_get_db_settings_option('wc_columns_' . $bp);
				}

				$classes[] = 'lte-cols-'.$bp.'-' . esc_attr( $cols );
			}

			$page_width = fw_get_db_settings_option( 'shop_page_width' );
		}

		if ( is_active_sidebar( 'sidebar-wc' ) AND !empty( $limme_sidebar ) ) {

	  		echo '<div class="lte-wc-wrapper margin-default '.implode(' ', $classes).'">
	  				<div class="row lte-sidebar-position-'.esc_attr($limme_sidebar).'">';
	  		
	  		if ( $limme_sidebar == 'left' ) {

		  		echo '<div class="col-xl-9 col-lg-8 col-md-12 col-xs-12 lte-text-page products-column-with-sidebar">';
	  		}
	  			else {

	  			echo '<div class="col-xl-9 col-lg-8 col-md-12 col-xs-12 lte-text-page products-column-with-sidebar" >';
  			}
		}
			else {

	  		echo '<div class="lte-wc-wrapper margin-default '.implode(' ', $classes).'">
	  		
	  				<div class="row centered">';
	  					
	  			if ( $page_width == 'narrow' ) {

		  			echo '<div class="col-xl-9 col-lg-12 col-ms-12 col-xs-12">';
	  			}
	  				else {

		  			echo '<div class="col-xl-12 col-lg-12 col-ms-12 col-xs-12">';
  				}
		}	  
	}
}

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_after_main_content', 'limme_wc_wrapper_end', 10);

if ( !function_exists( 'limme_wc_wrapper_end' ) ) {

	function limme_wc_wrapper_end() {

		echo '</div>';
	}
}

/**
 * Ordering Wrapper
 */

add_action( 'woocommerce_before_shop_loop',	'limme_woocommerce_ordering_wrapper_start', 15 );

if ( !function_exists( 'limme_woocommerce_ordering_wrapper_start' ) ) {

	function limme_woocommerce_ordering_wrapper_start() {

		echo '<div class="lte-wc-order">';
	}
}

add_action( 'woocommerce_before_shop_loop',	'limme_woocommerce_ordering_wrapper_end', 35 );

if ( !function_exists( 'limme_woocommerce_ordering_wrapper_end' ) ) {

	function limme_woocommerce_ordering_wrapper_end() {

		echo '</div>';
	}
}

/**
 * Archive Products and Catagories Wrapper
 */
add_action( 'woocommerce_before_subcategory',	'limme_woocommerce_product_wrapper_start', 5 );
add_action( 'woocommerce_before_shop_loop_item', 'limme_woocommerce_product_wrapper_start', 5 );

if ( !function_exists( 'limme_woocommerce_product_wrapper_start' ) ) {

	function limme_woocommerce_product_wrapper_start() {

		echo '<div class="lte-item">';
	}
}


/**
 * Displays Thumbnail with opened link hook
 */
add_action( 'woocommerce_before_subcategory', 'limme_woocommerce_image_wrapper_start', 7 );
add_action( 'woocommerce_before_shop_loop_item', 'limme_woocommerce_image_wrapper_start', 7 );
if ( !function_exists( 'limme_woocommerce_image_wrapper_start' ) ) {

	function limme_woocommerce_image_wrapper_start() {

		echo '<div class="lte-image">';
		
			// Additional button in image wrapper
			echo limme_woocommerce_get_add_to_cart();
	}
}


remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'limme_woocommerce_archive_image', 10);
if ( !function_exists( 'limme_wc_archive_image' ) ) {

	function limme_woocommerce_archive_image() {

		global $product;

		$wc_id = $product->get_id();

		$style = '';
		if ( function_exists('FW') ) {

			$featured = fw_get_db_post_option($wc_id, 'featured');
			$style = fw_get_db_settings_option( 'wc_product_style' );
		}

		$style_query = get_query_var('wc_prod_style');
		if ( $style == 'circle' OR $style_query == 'circle' ) {

			echo woocommerce_get_product_thumbnail( 'limme-gallery-grid' );
		}
			else
		if ( !empty($featured) ) {

			echo woocommerce_get_product_thumbnail('limme-wc-featured');
		}	
			else {

			echo woocommerce_get_product_thumbnail();

			// Adding alternative images on hover
			if ( function_exists('FW') ) {

				$wc_hover = fw_get_db_settings_option( 'wc_hover_gallery' );
				if ( !empty($product) AND $wc_hover == 'enabled' ) {

					$item = new WC_product($wc_id);
					$attachment_ids = $item->get_gallery_image_ids();

					if ( !empty($attachment_ids) AND !empty($attachment_ids[0]) ) {

						$image_size = apply_filters( 'single_product_archive_thumbnail_size', 'woocommerce_thumbnail' );

						echo '<span class="lte-wc-photo-alt">' . wp_get_attachment_image($attachment_ids[0], $image_size) . '</span>';
					}
				}
			}
		}
	}
}

/**
 * Image link closing
 */
add_action( 'woocommerce_before_subcategory_title', 'woocommerce_template_loop_category_link_close', 12 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 12 );

add_action( 'woocommerce_before_subcategory_title', 'limme_woocommerce_image_wrapper_end', 15 );
add_action( 'woocommerce_before_shop_loop_item_title', 'limme_woocommerce_image_wrapper_end', 15 );
if ( !function_exists( 'limme_woocommerce_image_wrapper_end' ) ) {

	function limme_woocommerce_image_wrapper_end() {

		echo '</div>';
	}
}



/**
 * Archive Products and Categories title wrapper
 */
add_action( 'woocommerce_before_subcategory_title',	'woocommerce_template_loop_category_link_open', 20 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

add_action( 'woocommerce_before_shop_loop_item_title', 'limme_woocommerce_product_title_wrapper_start', 20 );

add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating', 21 );

add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 22 );

if ( !function_exists( 'limme_woocommerce_product_title_wrapper_start' ) ) {

	function limme_woocommerce_product_title_wrapper_start($cat='') {

		echo '<div class="lte-item-descr">';
	}
}

add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

/**
 * Displaying excerpt
 */
add_action( 'woocommerce_after_shop_loop_item_title', 'limme_woocommerce_title_wrapper_end', 7);
if ( !function_exists( 'limme_woocommerce_title_wrapper_end' ) ) {

	function limme_woocommerce_title_wrapper_end() {

		global $product;

		woocommerce_template_loop_product_link_close();

		limme_woocommerce_the_attr();

	    $cut = 10;
		$display_excerpt = 'enabled';
		if ( function_exists('FW') ) {

			$display_excerpt = fw_get_db_settings_option( 'wc_show_list_excerpt' );
			$cut = (int) fw_get_db_settings_option( 'excerpt_wc_auto' );
		}

		$display_excerpt = apply_filters('lte_wc_display_excerpt', $display_excerpt);

		if ( $display_excerpt != 'disabled' ) {

			$cut = apply_filters('lte_wc_excerpt_size', $cut);

			echo '<div class="lte-excerpt">';

			if ( $cut == -1 ) {

				echo apply_filters('the_excerpt', get_the_excerpt());
			}
				else {

				echo limme_cut_words(apply_filters('the_excerpt', get_the_excerpt()), $cut);
			}
			echo '</div>';
		}		
	}
}

add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

/**
 * Changing default WooCommerce buttons
 * We are using buffering method to support correct WooCommerce hooks without changing templates
 */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'limme_woocommerce_template_loop_add_to_cart', 10 );
if ( !function_exists( 'limme_woocommerce_get_add_to_cart' ) ) {

	function limme_woocommerce_get_add_to_cart( $args = array() ) {

		ob_start();
		woocommerce_template_loop_add_to_cart();
		$add_to_cart_escaped = ob_get_contents();
		ob_end_clean();

		$add_to_cart_escaped = str_replace(array('"button', ' button', '">', '</a>'), array('"lte-btn btn-xs', ' lte-btn btn-xs', '"><span class="lte-btn-inner"><span class="lte-btn-before"></span>', '<span class="lte-btn-after"></span></span></a>'), $add_to_cart_escaped);

		return $add_to_cart_escaped;
	}
}

if ( !function_exists( 'limme_woocommerce_template_loop_add_to_cart' ) ) {

	function limme_woocommerce_template_loop_add_to_cart() {

		echo limme_woocommerce_get_add_to_cart();
	}
}

/**
 * Product and Category wrapper end
 */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
add_action( 'woocommerce_after_shop_loop_item',	'limme_woocommerce_product_wrapper_end', 20 );
if ( !function_exists( 'limme_woocommerce_product_wrapper_end' ) ) {

	function limme_woocommerce_product_wrapper_end($cat='') {

		global $product;

		$wc_show_more = 'disabled';
		if ( function_exists('FW') )  {

			$wc_show_more = fw_get_db_settings_option( 'wc_show_more' );
			$more_query = get_query_var('wc_show_more');
			if ( $wc_show_more == 'enabled'  OR !empty($more_query) ) {

				echo '<a href="'.get_permalink( $product->get_id() ).'" class="lte-btn-more lte-btn">'.
						esc_html__('More Info', 'limme').
				'</a>';
			}
		}
		
		echo '</div>
		</div>';
	}
}

remove_action( 'woocommerce_after_subcategory',	'woocommerce_template_loop_category_link_close', 10);
add_action( 'woocommerce_after_subcategory', 'limme_woocommerce_category_wrapper_end', 20 );
if ( !function_exists( 'limme_woocommerce_category_wrapper_end' ) ) {

	function limme_woocommerce_category_wrapper_end($cat='') {

		echo '</a></div>';
	}
}


/**
 * Replaces image size for featured products and adds alternative image
 */
add_filter( 'post_class', 'limme_filter_product_post_class', 10, 3 );
if ( !function_exists( 'limme_filter_product_post_class' ) ) {

	function limme_filter_product_post_class( $classes, $class, $post_id ){

		global $product;

	    if ( !empty(get_The_ID()) AND get_post_type(get_The_ID()) == 'product' AND function_exists('FW')) {

			$featured = fw_get_db_post_option(get_The_ID(), 'featured');
			if ( !empty($featured) ) {

			    $classes[] = 'lte-featured-product';
			}

			$wc_hover = fw_get_db_settings_option( 'wc_hover_gallery' );
			$item = new WC_product($product->get_id());
			$attachment_ids = $item->get_gallery_image_ids();
			if ( $wc_hover == 'enabled' AND !empty($attachment_ids) ) {

				$classes[] = 'lte-product-hover-gallery';
			}
	    }

		return $classes;
		
	}
}

/**
 * Displays attributes table in product description
 */
if ( !function_exists( 'limme_woocommerce_the_attr' ) ) {

	function limme_woocommerce_the_attr() {

		global $product;

		if ( !function_exists('FW') ) {

			return false;
		}

		$attr = fw_get_db_settings_option( 'wc_show_list_attr' );
		if ( $attr == 'enabled' )  {

			$attributes = $product->get_attributes();

			if ( !empty($attributes) ) {

				echo '<div class="lte-wc-attr-list">';

				foreach ( $attributes as $attribute ) {

					if ( !empty($attribute['value']) ) {

				        $product_attributes = array();
				        $product_attributes = explode('|', $attribute['value']);

						$items = array();
				        foreach ( $product_attributes as $pa ) {
				            $items[] = trim($pa);
				        }

				        echo '<div class="item">'.$attribute['name'] . ": <span>" . implode(', ', $items).'</span></div>';
				    }   
				    	else {

				    	echo '<div class="item">';
							echo wc_attribute_label($attribute->get_name(), $product). ": <span>".$product->get_attribute ( $attribute->get_name() )."</span>";
				    	echo '</div>';
				   	}	   	
				}

				echo '</div>';
			}
		}
	}
}

/**
 * Adding New label
 */
add_action( 'woocommerce_before_shop_loop_item_title', 'limme_woocommerce_product_loop_new_label', 9 );
if ( !function_exists('limme_woocommerce_product_loop_new_label') ) {

	function limme_woocommerce_product_loop_new_label() {

		$product_date = strtotime( get_the_time( 'Y-m-d' ) );

		if ( function_exists('FW') ) {

			$new_days = fw_get_db_settings_option( 'wc_new_days' );
		}
		
		$item = wc_get_product( get_the_ID() );
		if ( empty($new_days)) {

			$new_days = 0;
		}

		if ( !$item->is_on_sale() AND ( time() - ( 60 * 60 * 24 * $new_days ) ) < $product_date ) {

			echo '<span class="lte-wc-new">' . esc_html__( 'New', 'limme' ) . '</span>';
		}
	}
}

/**
 * Changing Sale label
 */
add_filter('woocommerce_sale_flash', 'limme_custom_sale_text', 10, 3);
if ( !function_exists('limme_custom_sale_text')) {

	function limme_custom_sale_text($text, $post, $_product) {

	    return '<span class="onsale">' . esc_html__( 'Sale', 'limme' ) . '</span>';
	}
}


/**
 * Removing default H1 title for products
 */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
add_action('woocommerce_single_product_summary', 'limme_woocommerce_title', 5);
add_filter( 'woocommerce_show_page_title', '__return_false' );
if ( ! function_exists( 'limme_woocommerce_title' ) ) {

	function limme_woocommerce_title() {
  		
		return false;
  	}
}

/**
 * Changing default WooCommerce columns to custom with support of responsive values from theme settings
 */
add_filter('loop_shop_columns', 'limme_wc_loop_columns');
if (!function_exists('limme_wc_loop_columns')) {

	function limme_wc_loop_columns() {

	    if ( function_exists('FW') ){

			$cols = fw_get_db_settings_option( 'wc_columns' );
			return 128; // Used for custom number columns
	    }		
	    	else {

			return 3;
    	}
	}
}

add_filter( 'loop_shop_per_page', 'limme_wc_loop_shop_per_page', 20 );
if (!function_exists('limme_wc_loop_shop_per_page')) {

	function limme_wc_loop_shop_per_page( $cols ) {

	    if ( function_exists('FW') ){

			$rows = fw_get_db_settings_option( 'wc_per_page' );
			return $rows;
	    }		
	    	else {

			return 6;
    	}
	}
}

add_filter( 'woocommerce_output_related_products_args', 'limme_related_products_args', 20 );
if ( !function_exists('limme_related_products_args') ) {

	function limme_related_products_args( $args ) {

	    if ( function_exists('FW') ){

			$args['posts_per_page'] = fw_get_db_settings_option( 'wc_related_total' );
			$args['columns'] = fw_get_db_settings_option( 'wc_related_columns' );
	    }		
	    	else {

			$args['posts_per_page'] = 3;
			$args['columns'] = 3;
    	}

		return $args;
	}
}

add_filter('woocommerce_cross_sells_total', 'limme_crossell_total');
if ( !function_exists('limme_crossell_total') ) {

	function limme_crossell_total($total) {

	    if ( function_exists('FW') ){

			return fw_get_db_settings_option( 'wc_cross_sells_total' );
	    }		
	    	else {

			return 2;
    	}
	}
}

if ( function_exists('FW') ) {

	$wc_cross_sell = fw_get_db_settings_option( 'wc_cross_sell' );
	if ( $wc_cross_sell == 'disabled' ) {

		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
	}

	$wc_related = fw_get_db_settings_option( 'wc_related' );
	if ( $wc_related == 'disabled' ) {
	
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	}
}


add_filter( 'woocommerce_add_to_cart_fragments', 'limme_refresh_mini_cart_count');
if ( !function_exists('limme_refresh_mini_cart_count') ) {

	function limme_refresh_mini_cart_count($fragments){
	    
		$fragments['.lte-count'] = limme_get_mini_cart_count();

	    return $fragments;
	}
}

if ( !function_exists('limme_get_mini_cart_count') ) {

	function limme_get_mini_cart_count(){

		$count = 0;
		if ( !is_null(WC()->cart) ) {

			$count = WC()->cart->get_cart_contents_count();
		}
	    
	    $out = '<span class="lte-count lte-items-'.esc_attr($count).'">'.esc_html($count).'</span>';

	    return $out;
	}
}


