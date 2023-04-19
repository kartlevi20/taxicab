<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Google Maps Shortcode
 */

$args['width'] = '100%';

echo '<div id="lte-google-map-'.mt_rand().'" data-marker="'.esc_url(get_template_directory_uri()).'/assets/images/location.png" class="lte-google-maps" data-lng="'. esc_attr($args['lng']) .'"	 data-lat="'. esc_attr($args['lat']) .'" data-zoom="'. esc_attr($args['zoom']['size']) .'" style="width: '.esc_attr($args['width']).'; height: '.esc_attr($args['height']['size'].$args['height']['unit']).';"></div>';

