<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Video Popup Shortcode
 */

echo '<a href="'. esc_url($args['href']['url']) .'" class="lte-video-popup lte-style-'.esc_attr($args['style']).' swipebox">';
		echo '<span></span>';

		if ( !empty($args['header']) ) {

			echo '<h6>'.esc_html($args['header']).'</h6>';
		}

echo '</a>';


