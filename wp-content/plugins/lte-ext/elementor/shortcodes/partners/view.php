<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Partners Shortcode
 */

echo '<div class="container-fluid lte-partners lte-hover-logos lte-hover-effect-'.esc_attr($args['hover']).'">';
	echo '<div class="row centered">';

		$div_class = '';

		if ( sizeof($args['list']) > 6 ) $div_class = ' col-lg-2 col-md-4  col-ms-4 col-xs-6 ';
			else
		if ( sizeof($args['list']) == 6 ) $div_class = ' col-md-2  col-ms-6 col-xs-6';
			else
		if ( sizeof($args['list']) == 5 ) $div_class = ' col-lg-5ths  col-ms-6 col-xs-6';
			else				
		if ( sizeof($args['list']) == 4 ) $div_class = ' col-md-3  col-ms-6 col-xs-6';
			else
		if ( sizeof($args['list']) == 3 ) $div_class = ' col-md-4  col-ms-6 col-xs-6';

		$target = '';
		if ( $args['target'] == 'blank') {

			$target = ' target="_blank" ';
		}

		foreach ( $args['list'] as $k => $item ) {

			if ( empty($item['image']) ) {

				continue;
			}

			if ( empty( $item['header'] ) ) {

				$item['header'] = '.';
			}

			echo '
				<div class="'.esc_attr($div_class).' col-sm-4  partners-wrap  center-flex">
					<div class="partners-item item center-flex">';

						if ( !empty($item['image']) ) {

							if ( !empty($item['href']['url']) ) {

								echo '<a href="'.esc_url( $item['href']['url'] ).'"><img src="' . esc_url( $item['image']['url'] ) . '" class="image" alt="'.esc_attr($item['header']).'"></a>';
							}
								else {

								echo '<div class="photo"><img src="' . esc_url($item['image']['url']) . '" class="image" alt="'.esc_attr($item['header']).'"></div>';
							}
						}

					echo '</div>
				</div>';
		}
	echo '</div>';
echo '</div>';

