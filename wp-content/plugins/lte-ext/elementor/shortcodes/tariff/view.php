<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Tariff Shortcode
 */


$class = [];
$bg_image_style = '';
if ( !empty($args['bg-image']['url']) ) {

	$bg_image_style = ' style="background-image: url('.$args['bg-image']['url'].');"';
	$class[] = 'hasBackground';
}


if ( !empty($args['vip']) ) {

	$class[] = 'lte-vip';
}

echo '<div class="lte-tariff-item '.esc_attr(implode(' ', $class)).'">';

	echo '<div class="lte-tariff-inner" '.$bg_image_style.'>';

	echo '<div class="lte-header-wrapper">';
/*
		$btn_color = ' btn-main color-hover-black';
		if ( !empty($args['vip']) ) {

			echo '<span class="label-vip">'. esc_html($args['vip_text']) .'<span class="ltx-triangle"></span></span>';
			$btn_color = ' btn-main color-hover-white';
		}

		if ( !empty($args['icon_text']) ) {
	 
			echo '<span class="icon-text countUp-item" style="'.$icon_image_style.'">'. wp_kses_post(str_replace('<span>', '<span class="countUp" id="'.esc_attr( $args['id'].'-count' ).'">', $args['icon_text']))	 .'</span>';
		}

		if ( !empty($args['subheader']) ) {

			echo '<h6 class="subheader">'. wp_kses_post(ltx_header_parse($args['subheader'])) .'</h6>';
		}
*/
		if ( !empty($args['header']) ) {

			echo '<h5 class="lte-header">'. wp_kses_post($args['header']) .'</h5>';
		}

		if ( !empty($args['price']) ) echo '<div class="lte-price">' . wp_kses_post(lte_string_parse($args['price'])) . '</div>';

	echo '</div>';	
/*
	if ( !empty($args['icon']) ) {

		echo '<div class="image"><span class="heading-icon-fa '.esc_attr($args['icon']).' "></span></div>';
	}
		else
	if ( !empty($args['image'])) {

		$image = ltx_get_attachment_img_url( $args['image'] );
		if ( !empty($image[0])) {
		
			echo '<div class="image"><img src="' . $image[0] . '" class="full-width" alt="'. esc_attr($args['header']) .'"></div>';
		}
	}

	if ( !empty($args['descr']) ) echo '<div class="descr">'.wp_kses_post($args['descr']).'</div>';
*/
/*
	$limit = 0;
	$limit_class = '';
	if ( !empty($args['limit_list']) ) {

		$limit = $args['limit_list'];
		$limit_class = ' ltx-limit';
	}
*/

	$list = explode("\n", $args['text']);
	foreach ( $list as $k => $l ) {

		if ( empty($l) ) unset($list[$k]);
	}

	if ( !empty($list) ) {

		echo '<ul class="lte-tariff-list"><li>'. wp_kses_post(lte_string_parse(implode('</li><li>', $list ))) .'</li></ul>';
	}
/*
	if ( !empty($args['limit_list']) ) {

		echo '<div class="ltx-tariff-spoiler"><span>'.esc_html($args['spoiler_text']).'</span></div>';
		echo '<div class="ltx-tariff-spoiler-less"><span>'.esc_html($args['spoiler_less']).'</span></div>';
	}

	if ( !empty($args['icons']) ) {

		echo '<ul class="ltx-tariff-icons">';

			foreach ( $args['icons'] as $icon ) {

				if ( !empty($icon['icon']) ) {

					echo '<li><span class="ltx-icon '.esc_attr($icon['icon']).'"></span>'.esc_html($icon['header']).'</li>';
				}
			}

		echo '</ul>';
	}

*/	
	if ( !empty($args['btn-header']) ) {

        echo '<div class="lte-btn-wrap">
            <a href='. esc_url($args['btn-href']) .'"" class="lte-btn btn-lg"><span class="lte-btn-inner"><span class="lte-btn-before"></span>'. esc_html($args['btn-header']) .'<span class="lte-btn-after"></span></span></a>
        </div>';
	}

	echo '</div>';

echo '</div>';

