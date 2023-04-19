<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * CountUp Shortcode
 */

echo '<div class="lte-countup layout-default container-fluid">';
	echo '<div class="row">';

		$div_class = '';
		if ( sizeof($args['list']) == 6 ) $div_class = ' col-md-2 ';
			else
		if ( sizeof($args['list']) == 4 ) $div_class = ' col-lg-3 col-md-6 col-ms-12  col-xs-12 ';
			else
		if ( sizeof($args['list']) == 3 ) $div_class = ' col-md-4 col-sm-4 ';
			else
		if ( sizeof($args['list']) == 2 ) $div_class = ' col-md-6 col-xs-12 ';

		$id = 'lte-countup-'.mt_rand();

		foreach ( $args['list'] as $k => $item ) {

			$item['header'] = lte_string_parse($item['header']);
			if ( !empty($item['prefix']) ) $prefix = $item['prefix']; else $prefix = '';
			if ( !empty($item['suffix']) ) $suffix = $item['suffix']; else $suffix = '';

			if ( $args['style'] == 'default' ) {

				$item_class = 'lte-countup-animation';
			}
				else
			if ( $args['animation'] == 'static' ) {

				$item_class = '';
			}


			echo '
				<div class="'.esc_attr($div_class).' col-sm-12 col-ms-12 col-xs-12 center-flex countUp-wrap">
					<div class=" countUp-item item">';

						if ( !empty($item['icon']) ) {

							\Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] );
						}

						echo '<h2 class="lte-header">'.
							esc_html($prefix).
							'<span class="'.esc_attr($item_class).'">'.
								esc_html($item['ending_number']).
							'</span>'.
							esc_html($suffix).
						'</h2>
						<h4 class="lte-subheader">'.wp_kses_post($item['header']).'</h4>';
					echo '
					</div>					
				</div>';
		}


	echo '</div>';
echo '</div>';

