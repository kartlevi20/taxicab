<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Block Icons Shortcode
 */

$icons_count = sizeof($args['list']);

$class = '';
foreach ( $args['list'] as $item ) {

	if ( !empty($item['descr']) ) {

		$class .= ' has-descr ';
		break;
	}	
}

$ul_class = array();
$ul_class[] = $class;
$ul_class[] = 'icons-count-' . $icons_count;
$ul_class[] = 'lte-icon-space-' . $args['space'];
$ul_class[] = 'lte-icon-shape-' . $args['icon-shape'];
$ul_class[] = 'lte-icon-background-' . $args['icon-bg-color'];
$ul_class[] = 'lte-icon-border-' . $args['icon-border-color'];
$ul_class[] = 'lte-icon-color-' . $args['icon-color'];
$ul_class[] = 'lte-icon-divider-' . $args['divider'];
$ul_class[] = 'lte-icon-inner-padding-' . $args['inner-padding'];
if ( $args['icon-shape'] != 'default' ) $ul_class[] = 'lte-icon-padding-' . $args['icon-padding'];
$ul_class[] = 'lte-icon-size-' . $args['icon-size'];
$ul_class[] = 'lte-header-color-' . $args['header-color'];
$ul_class[] = 'lte-icon-type-' . $args['type'];
$ul_class[] = 'lte-icon-align-' . $args['align'];
if ( !empty($args['hover-animation']) ) $ul_class[] = 'lte-hover-animation-' . $args['hover-animation'];
$ul_class[] = $args['layout'];

$ul_class[] = 'lte-additional-'.esc_attr($args['additional']);



$tag = esc_attr($args['header-tag']);

echo '<ul class="lte-block-icon'.esc_attr(implode(' ', $ul_class)).'">';

	$x = 0;
	foreach ( $args['list'] as $item ) {

		$x++;
		$li_class = '';

		if ($args['layout'] == 'layout-cols1') {

			$li_class .= 'col-xl-12 col-xs-12';
		}
			else
		if ($args['layout'] == 'layout-cols2') {

			$li_class .= 'col-xl-6 col-lg-6 col-md-6 col-sm-6 col-ms-6 col-xs-12';
		}
			else
		if ($args['layout'] == 'layout-cols3') {

			$li_class .= ' col-lg-4 col-md-4 col-sm-4 col-ms-6 col-xs-6';
		}
			else
		if ($args['layout'] == 'layout-cols4') {

			$li_class .= ' col-lg-3 col-md-3 col-sm-6 col-ms-6 col-xs-6';
		}
			else
		if ($args['layout'] == 'layout-cols6') {

			$li_class .= ' col-xl-2 col-lg-4 col-md-4 col-sm-4 col-ms-6 col-xs-6';
		}

		if ( empty($item['header'])) {

			$item['header'] = '';
		}

		$item['header'] = lte_string_parse($item['header']);


		if ($args['layout'] == 'layout-inline') {

			$in_class = '';
			$in_class = 'lte-inner';
		}
			else {

			$in_class = 'lte-inner';
		}

		if ( !empty($item['header']) ) {

			//$item['header'] = ' <'. esc_attr($tag) .' class="lte-header lte-'.esc_attr($tag).'"> ' . wp_kses_post( nl2br($item['header']) )  .  ' </'. esc_attr($tag) .'> ';

			$item['header'] = ' <span class="lte-header lte-'.esc_attr($tag).'"> ' . wp_kses_post( nl2br($item['header']) )  .  ' </span> ';
		}

		if ( empty($item['descr'])) {

			$item['descr'] = '';
		}

		$descr = '';
		if ( !empty($item['descr']) ) {

			$descr = '<span class="lte-descr">'. nl2br(wp_kses_post( lte_string_parse( $item['descr'] ) )) . '</span>';
		}

		if ( !empty($item['href']['url']) ) {

			$wrap_tag1 = 'a href="'. esc_url( $item['href']['url'] ) .'" ';
			if ( $args['target'] == 'blank' ) {

				$wrap_tag1 .= ' target="_blank" ';
			}

			if ( $args['target'] == 'swipebox' ) {

				$in_class .= ' swipebox ';
			}


			$wrap_tag2 = '</a>';
		}
			else {

			$wrap_tag1 = 'div ';
			$wrap_tag2 = '</div>';
		}

		echo '<li class="'.$li_class.'">';

			echo '<'.$wrap_tag1. '  class="'.esc_attr($in_class).'">';

				if ( !empty($item['icon-text']) ) {

					echo '<i class="lte-icon-text">'.esc_html($item['icon-text']).'</i>';
				}
					else
				if ( !empty($item['icon']) ) {

					\Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] );
				}

				echo '<span class="lte-icon-content">' . $item['header'] . wp_kses_post( $descr ) . '</span>';

			echo $wrap_tag2;

		echo '</li>';
	}

echo '</ul>';


