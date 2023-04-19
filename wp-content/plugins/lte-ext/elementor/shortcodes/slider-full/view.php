<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode
 */

$categories = get_categories( [ 'taxonomy' => 'sliders-full-category' ]);
if ( !empty($categories) ) {

	$bg = '';
	if ( !empty($args['black-pattern']) ) {

		$bg = ' style="background-image: url('.esc_url($args['black-pattern']['url']).')" ';
	}

	echo '<div class="lte-slider-fc-menu"'.$bg.'>';

		echo '<ul>';
		foreach ($categories as $item) {

 			echo '<li><span data-id="'.esc_attr($item->term_id).'">'.esc_html($item->name).'</span></li>';
		}		
		echo '</ul>';

	echo '</div>';
}

if ( !empty($categories) ) {

	echo '<div class="lte-wrapper">';

	foreach ($categories as $item) {

		echo '<div class="lte-wrapper-item lte-wrapper-item-'.esc_attr($item->term_id).'">';

		$query_args = array(

			'post_type' 	=> 'sliders-full',
			'post_status' 	=> 'publish',
			'order'			=>	'date',
		);

		$query_args['tax_query'] = 	array(
			array(
	            'taxonomy'  => 'sliders-full-category',
	            'field'     => 'if', 
	            'terms'     => array(esc_attr($item->term_id)),
			)
	    );

		$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) {

			$pagination = [];
			while ( $query->have_posts() ) {

				$query->the_post();

				$cats = [];
				$terms = wp_get_post_terms( get_the_ID(), 'sliders-full-category' );
				if ( !empty($terms) ) {

					foreach ( $terms as $term ) {

						$cats[] = 'lte-page-cat-'.$term->term_id;
					}
				}

				$pagination[] = array(

					'image'		=>	get_the_post_thumbnail_url(get_the_ID(), 'limme-pages'),
					'header'	=>	get_the_title(),
					'cats'		=>	implode(' ', $cats),
				);
			}

			$args['swiper-pagination-custom'] = $pagination;
			$args['swiper_effect'] = 'fade';

			$swiper_item_class = 'swiper-slide';
			echo lte_swiper_get_the_container('lte-sliders-full-list', $args);
			echo '<div class="swiper-wrapper">';

			while ( $query->have_posts() ) {

				$query->the_post();

				$button_header = fw_get_db_post_option(get_The_ID(), 'button-header');
				$button_link = fw_get_db_post_option(get_The_ID(), 'button-link');
				$price = fw_get_db_post_option(get_The_ID(), 'price');

				$header = fw_get_db_post_option(get_The_ID(), 'header');
				if ( empty($header) ) {

					$header = get_the_title();
				}

				$cats = [];
				$terms = wp_get_post_terms( get_the_ID(), 'sliders-full-category' );
				if ( !empty($terms) ) {

					foreach ( $terms as $term ) {

						$cats[] = 'lte-cat-'.$term->term_id;
					}
				}
				echo '<div class="lte-item '.esc_attr($swiper_item_class).' '.implode(' ', $cats).'">';
					echo '<div class="row">';
						echo '<div class="col-lg-5 lte-content">';
							echo '<h2>'.wp_kses_post(lte_string_parse($header)).'</h2>';

							if ( !empty($price) ) {

								echo '<span class="lte-price lte-price-mobile">'.wp_kses_post(lte_string_parse($price)).'</span>';
							}

							echo get_the_content();
							if ( !empty($button_header) ) {

								echo '<div><a href="'.esc_url($button_link).'" class="lte-btn btn-lg btn-black color-hover-white">';

									echo '<span class="lte-btn-inner">';
										echo  '<span class="lte-btn-before"></span>';

											echo esc_html($button_header);

										echo  '<span class="lte-btn-after"></span>';
									echo '</span>';

								echo '</a></div>';
							}
						echo '</div>';
						echo '<div class="col-lg-7 lte-image" style="background-image: url('.get_the_post_thumbnail_url(get_the_ID(), 'full').')">';

							if ( !empty($price) ) {

								echo '<span class="lte-price lte-price-desktop">'.wp_kses_post(lte_string_parse($price)).'</span>';
							}

							$bg = '';
							if ( !empty($args['black-pattern']) ) {

								$bg = ' style="background-image: url('.esc_url($args['black-pattern']['url']).')" ';
							}

							echo '<div class="lte-copy lte-copy-desktop"'.$bg.'>';

								limme_the_copyrights();

							echo '</div>';

						echo '</div>';
					echo '</div>';
				echo '</div>';			
			}

			echo '</div><div class="swiper-pagination-custom"></div></div></div>';

			wp_reset_postdata();
		}

		echo '</div>';
	}

	echo '</div>';

		echo '<div class="lte-copy lte-copy-mobile">';

			limme_the_copyrights();

		echo '</div>';	
}

