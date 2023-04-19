<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * LT-Ext Post Categories Functions
 */

if (!function_exists('lteGetCats')) {
	function lteGetCats($taxonomy) {

		if ( empty($taxonomy) ) {

			return false;
		}

		$orderby      = 'name';  
		$show_count   = 0;
		$pad_counts   = 0;
		$hierarchical = 1;
		$title        = '';  
		$empty        = 0;

		$args = array(
		     'taxonomy'     => $taxonomy,
		     'orderby'      => $orderby,
		     'show_count'   => $show_count,
		     'pad_counts'   => $pad_counts,
		     'hierarchical' => $hierarchical,
		     'title_li'     => $title,
		     'hide_empty'   => $empty
		);

		$cats = array();
		$all_categories = get_categories( $args );
		foreach ($all_categories as $cat) {

			if (esc_html($cat->name) == 'Uncategorized' OR empty($cat->name) ) continue;

			if ($cat->category_parent == 0) {

			    $cats[$cat->term_id]['href'] = get_term_link($cat->slug, $taxonomy);
			    $cats[$cat->term_id]['name'] = $cat->name;
			}
				else {

			    $cats[$cat->category_parent]['child'][$cat->term_id] = array(

			    	'href' => get_term_link($cat->slug, $taxonomy),
			    	'name' => $cat->name,
			    );		    
			}
		}	

		wp_reset_postdata();

		return $cats;
	}
}

if (!function_exists('lteGetGalleryPosts')) {
	function lteGetGalleryPosts() {

		$posts = get_posts( array(
			'nopaging'                  => true,
			'post_type' => 'gallery',
			'posts_per_page'	=>	100,
		) );

		$cat = array();

		if ( !empty($posts) ) {

			foreach ( $posts as $post ) {

				$cat[$post->ID] = $post->post_title;
			}
		}

		wp_reset_postdata();

		return $cat;
	}
}


