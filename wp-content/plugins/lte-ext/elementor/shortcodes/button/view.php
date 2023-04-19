<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Button Shortcode
 */

$class = array();
if ( !empty($args['size']) AND $args['size'] != 'default' ) {

	$class[] = 'btn-'.$args['size'];
}

if ( !empty($args['color']) AND $args['color'] != 'default' ) {

	$class[] = 'btn-'.$args['color'];
}

if ( !empty($args['hover_color']) ) {

	$class[] = 'color-hover-'.$args['hover_color'];
}

$target = '';
if ( $args['target'] == 'blank') {

	$target = ' target="_blank" ';
}
	else
if ( $args['target'] == 'popup') {

	$class[] = 'swipebox';

}

echo '<div class="lte-btn-wrap">
	<a href="'. esc_url($args['href']['url']) .'" '.$target.' class="lte-btn '. esc_attr( implode( ' ', $class ) ) .'">';
		echo '<span class="lte-btn-inner">';
			echo  '<span class="lte-btn-before"></span>';

			if ( !empty($args['icon']['value']) ) {

				echo  '<span class="lte-icon">';
				\Elementor\Icons_Manager::render_icon( $args['icon'], [ 'aria-hidden' => 'true' ] );
				echo  '</span>';
			}

			echo esc_html( $args['header'] );
			echo  '<span class="lte-btn-after"></span>';
		echo '</span>';
echo '</a></div>';


