<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Instagram Shortcode
 */

$list = $args['items'];
$limit = $args['limit'];

if ( !empty($list) ) {

	echo '<div class="lte-gallery-sc lte-gallery-grid">';

		if ( !empty($args['header'])) {

			if ( !empty($args['header-link'])) {

				echo '<a href="'.esc_url($args['header-link']['url']).'" class="lte-gallery-header-link">';
			}

			echo '<span class="lte-gallery-header">'.wp_kses_post(lte_string_parse($args['header'])).'</span>';

			if ( !empty($args['header-link'])) {

				echo '</a>';
			}
		}

		$x = 0;
		foreach ( $list as $item ) {
			$x++;

			echo '<span class="lte-photo">';
				echo '<img src="'.esc_url($item[2]['src']).'">';
			echo '</span>';

			if ( $x >= $limit ) {

				break;
			}
		}

	echo '</div>';
}
