<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Rental Shortcode
 */

set_query_var('lte_form_style', $args['style']);

get_template_part( 'tmpl/rental-form' );

