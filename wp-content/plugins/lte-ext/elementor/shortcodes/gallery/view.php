<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Gallery Shortcode
 */

$list = fw_get_db_post_option( $args['album'], 'photos' );

if ( !empty($list) ) {

	$item_class = [];
	$item_class[] = 'swipebox lte-photo lte-gallery';

	if ( $args['layout'] == 'slider' AND empty($_GET['action']) ) {

		$args['swiper_breakpoint_xl'] = 6;
		$args['swiper_breakpoint_lg'] = 6;
		$args['swiper_breakpoint_md'] = 5;
		$args['swiper_breakpoint_sm'] = 4;
		$args['swiper_breakpoint_ms'] = 4;
		$args['swiper_breakpoint_xs'] = 2;
		$args['swiper_slides_per_group'] = -1;
		$args['swiper_arrows'] = 'false';
		$args['swiper_pagination'] = 'false';
		$args['space_between'] = 3;
		$args['swiper_autoplay'] = 1000;
		$args['swiper_speed'] = 1500;
		$args['swiper_loop'] = true;


		$item_class[] = 'swiper-slide';
		echo lte_swiper_get_the_container('lte-gallery-sc lte-gallery-slider swipebox-gallery', $args);
		echo '<div class="swiper-wrapper">';
	}
		else {

		if ( !empty($_GET['action']) AND $_GET['action'] == 'elementor' ) {

			$args['limit'] = 6;
		}

		echo '<div class="lte-gallery-sc lte-gallery-grid swipebox-gallery">';
	}


		$x = 0;
		foreach ( $list as $item ) {

			$x++;
			
			echo '<a href="'.esc_url( $item['url'] ).'" class="'.esc_attr(implode(' ', $item_class)).'">';
				echo '<span>' . wp_get_attachment_image( $item['attachment_id'], 'limme-gallery-grid' ) . '</span>' ;
			echo '</a>';

			if ( !empty($args['limit']) AND $args['limit'] == $x ) {

				break;
			}
		}


	if ( !empty($args['layout'] == 'slider') ) {

		echo '</div>';	
	}		

	echo '</div>';
}

