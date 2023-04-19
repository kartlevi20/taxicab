<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Effects Shortcode
 */

if ( $args['type'] == 'smoke' ) {

	echo '<div class="lte-effect-smoke">';

		for ( $x = 1; $x <= 6; $x++ ) {

			echo '<img src="'.esc_url($args['image']['url']).'" class="lte-effect-item-'.esc_attr($x).'" alt=".">';
		}

	echo '</div>';
}
	else
if ( $args['type'] == 'square' ) {

	echo '<div class="lte-effect-square lte-animation-'.esc_attr($args['square-animation']).'"><span><span></span></span></div>';
}	
	else
if ( $args['type'] == 'square-large' ) {

	echo '<div class="lte-effect-square-large lte-animation-'.esc_attr($args['square-animation']).'"><span><span></span></span></div>';
}	
