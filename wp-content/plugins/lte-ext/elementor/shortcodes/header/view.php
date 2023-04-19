<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Heading Shortcode
 */

$class = array();

if ( !empty($args['size']) AND $args['size'] != 'default' ) $class[] = 'lte-size-'.$args['size'];
if ( !empty($args['style']) ) $class[] = 'lte-style-'.$args['style'];
if ( !empty($args['style_add']) ) $class[] = 'lte-'.$args['style_add'];
if ( !empty($args['color']) AND $args['color'] != 'default' ) $class[] = 'lte-color-'.$args['color'];
if ( !empty($args['subcolor']) AND $args['subcolor'] != 'default' ) $class[] = 'lte-subcolor-'.$args['subcolor'];
if ( !empty($args['margin']) AND $args['margin'] == 'yes' ) $class[] = 'lte-margin';

if ( !empty($args['subheader'] ) ) $class[] = 'has-subheader';
if ( !empty($args['watermark']) ) $class[] = 'has-watermark';

if ( !empty($args['icon']['value']) ) {

	$class[] = 'hasIcon';
	$class[] = 'lte-icon-size-' . $args['icon-size'];
	$class[] = 'lte-icon-shadow-' . $args['icon-shadow'];
}

if ( !empty($args['type']) ) $tag = $args['type']; else $tag = 'h2';
if ( !empty($args['subtype']) ) $subtag = $args['subtype'];

if ( empty($subtag) ) {

	$subtag = 'h4';
}

$class[] = 'heading-tag-'. $tag;
$class[] = 'heading-subtag-'. $subtag;


if ( !empty($args['href']['url']) ) {

	$class[] = 'hasLink';

	echo '<a class="lte-heading '. esc_attr( implode(' ', $class ) ) .'" href="'.esc_url($args['href']['url']).'">';
}
	else {

	echo '<div class="lte-heading '. esc_attr( implode(' ', $class ) ) .'">';
}

if ( !empty($args['icon']['value']) ) {

	\Elementor\Icons_Manager::render_icon( $args['icon'], [ 'aria-hidden' => 'true' ] );

}

echo '<div class="lte-heading-content">';

if ( !empty($args['subheader']) ) {

	$subclass_add = '';
/*
	if ( $args['sr'] == 'default' ) $subclass_add .= 'lte-sr-id-'.$args['id'].mt_rand().' lte-sr lte-sr-effect-slide_from_bottom lte-sr-el-block lte-sr-delay-200 lte-sr-duration-500 lte-sr-sequences-50';
*/
	echo '<'. esc_attr($subtag) .' class="lte-subheader'.esc_attr($subclass_add).'">'. wp_kses_post( trim( lte_string_parse($args['subheader']) ) ) .'</'. esc_attr($subtag) .'>';
}

if (!empty($args['header'])) {

	$header_class_add = '';
/*	
	if ( $args['sr'] == 'default' ) {

		$header_class_add = 'lte-sr-id-'.$args['id'].mt_rand().' lte-sr lte-sr-effect-fade_in lte-sr-el-block lte-sr-delay-0 lte-sr-duration-1000 lte-sr-sequences-0';
	}
*/
	echo '<'. esc_attr($tag) .' class="lte-header'.esc_attr($header_class_add).'">';

		echo nl2br( wp_kses_post( lte_string_parse($args['header']) ) );

	echo '</'. esc_attr($tag) .'>';
}

if ( !empty($args['watermark']) ) {

	echo '<span class="lte-watermark">'. wp_kses_post( trim( lte_string_parse($args['watermark']) ) ) .'</span>';
}

echo '</div>';

if ( !empty($args['href']['url']) ) {

	echo '</a>';
}
	else {

	echo '</div>';
}

