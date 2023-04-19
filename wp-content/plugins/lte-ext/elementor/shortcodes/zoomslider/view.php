<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Like Slider Shortcode
 */

$query_args = array(
	'post_type' => 'sliders',
	'post_status' => 'publish',
	'posts_per_page' => 0,	
);

if ( !empty($args['cat']) ) {

	$query_args['tax_query'] = 	array(
		array(
            'taxonomy'  => 'sliders-category',
            'field'     => 'if', 
            'terms'     => array(esc_attr($args['cat'])),
		)
    );
}

if ( $args['type'] == 'swiper' ) {

	$query = new WP_Query( $query_args );
	if ( $query->have_posts() ) {

		$args['swiper_effect'] = 'fade';
//		$args['swiper_loop'] = 'true';

		echo lte_swiper_get_the_container('lte-slider-swiper', $args);

			echo '<div class="swiper-wrapper">';

			while ( $query->have_posts() ) {

				$query->the_post();		

				echo '<div class="swiper-slide">';

		            $pluginElementor = \Elementor\Plugin::instance();
		            $out = $pluginElementor->frontend->get_builder_content(get_the_ID(), true);
		            echo preg_replace('~<style(.*?)</style>~Usi', "", $out);

				echo '</div>';
			}

			echo '</div>';
		
		echo '</div>
		</div>';

		wp_reset_postdata();
	}

}
	else
if ( $args['type'] == 'zs' ) {

	$class[] = ' zoom-'. esc_attr($args['zoom']);
	$class[] = ' zoom-origin-'. esc_attr($args['zs-origin']);
	$class[] = ' lte-zs-overlay-'. esc_attr($args['overlay']);

	if ($args['zoom'] == 'out' OR $args['zoom'] == 'fade') {

		$init_zoom = '1.0';
	}
		else {

		$init_zoom = '1.2';
	}


	$query = new WP_Query( $query_args );
	if ( $query->have_posts() ) {

		$json = array();
		$html = array();
		$key = 0;

		$lte_custom_css = '';
		while ( $query->have_posts() ) {

			$query->the_post();		

			$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
			if ( !empty($image) ) {

				$json[] = $image[0];
			}
				else {

				$json[] = '';
			}

	        if (class_exists("\\Elementor\\Plugin")) {

	        	if ( isset( $_GET['action'] ) || isset($_GET['elementor-preview']) ) {

		            $contentElementor = \Elementor\Plugin::instance()->frontend->get_builder_content(get_the_ID(), true);
	            }
	            	else {

		       		
		            $contentElementor = \Elementor\Plugin::instance()->frontend->get_builder_content(get_the_ID(), false);
		       	}

				$html[] = $contentElementor;
	        }
		}

		$json = json_encode( $json );

		$args['arrow_left'] = '';
		$args['arrow_right'] = '';

		if ( !empty($args['arrows']) AND $args['arrows'] === 'default' ) {
		
			$args['arrows'] = 'true';
		}

		if ( !empty($args['bullets']) AND $args['bullets'] === 'default' ) {
		
			$args['bullets'] = 'true';
		}

		echo '<div class="lte-slider-zoom lte-background-black '. esc_attr( implode(' ', $class) ) .'" data-zs-prev="'. esc_attr( $args['arrow_left'] ) .'" data-zs-next="'. esc_attr( $args['arrow_right'] ) .'" data-zs-overlay="'. esc_attr( $args['overlay'] ) .'" data-zs-initzoom="'. esc_attr( $init_zoom ) .'" data-zs-speed="'. esc_attr($args['zs-speed']) .'" data-zs-interval="'. esc_attr($args['zs-interval']) .'" data-zs-switchSpeed="'. esc_attr($args['zs-switch']) .'" data-zs-arrows="'.esc_attr($args['arrows']).'" data-zs-bullets="'.esc_attr($args['bullets']).'" data-zs-src=\''. filter_var( $json, FILTER_SANITIZE_SPECIAL_CHARS ) .'\'>';

			if ( !empty($args['tagline']) AND $args['tagline'] === 'default' ) {
			
				echo do_shortcode('[lte-header-tagline]');
			}

			if ( !empty($args['overlay-lines']) AND $args['overlay-lines'] === 'vertical-lines' ) {

				echo '<div class="lte-overlay-lines lte-background-overlay"></div>';
			}

			if ( !empty($args['social']) AND $args['social'] === 'true' ) {

				echo do_shortcode('[lte-social]');
			}

			echo '<div class="container lte-zs-slider-wrapper">';
				
				foreach ( $html as $key => $item_escaped ) {

					if ( $key == 0 ) $class = ' inited visible '; else $class = '';
					if ( sizeof($html) == 1 ) $class .= ' single';
					echo '<div class="lte-zs-slider-inner '.$class.' lte-zs-slide-'.esc_attr($key).'" data-index="'.esc_attr($key).'">';
						echo $item_escaped;
					echo '</div>';				
				}

			echo '</div>';

		echo '</div>';
		
	}
}

wp_reset_postdata();

