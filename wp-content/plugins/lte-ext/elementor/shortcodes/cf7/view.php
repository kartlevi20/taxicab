<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Contact_Form_7 Shortcode
 */

$class = array();

//$class[] = 'lte-background-'.$args['background'];
$class[] = 'lte-padding-'.$args['padding'];
//$class[] = 'lte-btn-'.$args['button-color'];
$class[] = 'lte-full-width-'.$args['button-full'];

if ( !empty($args['form-id'] ) ) {

	echo '<div class="lte-contact-form-7 '.esc_attr(implode(' ', $class)).'">';

		if ( !empty($args['header']) ) {

			echo '<h4 class="lte-header">'. wp_kses_post( lte_string_parse($args['header'])).'</h4>';
		}

		if ( !empty($args['subheader']) ) {

			echo '<h6 class="lte-header">'.esc_html($args['subheader']).'</h6>';
		}

		if ( !empty($args['text']) ) {

			echo '<span class="lte-descr">'.esc_html($args['text']).'</span>';
		}

		echo do_shortcode('[contact-form-7 id="'.esc_attr($args['form-id']).'"]');
		
	echo '</div>';
}

