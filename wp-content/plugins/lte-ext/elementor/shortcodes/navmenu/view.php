<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Navbar Menu Shortcode
 */

$nav_menu = ! empty( $args['menu'] ) ? wp_get_nav_menu_object( $args['menu'] ) : false;

if ( ! $nav_menu ) {

	return;
}

$nav_menu_args = array(
	'fallback_cb'	=> '',
	'depth'			=> 1,
	'menu'       	=> $nav_menu
);

echo '<div class="lte-navmenu-sc">';
	wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu ) );
echo '</div>';


