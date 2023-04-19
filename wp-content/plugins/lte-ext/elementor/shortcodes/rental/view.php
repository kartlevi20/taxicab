<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Rental Shortcode
 */

$query_args = array(
	'post_type' => 'rental',
	'post_status' => 'publish',
	'posts_per_page' => (int)($args['limit']),
);

if ( !empty($args['ids']) ) {

	$query_args['post__in'] = explode(',', str_replace(' ', '', $args['ids']));
}
	else
if ( !empty($args['cat']) ) {

	$query_args['tax_query'] = 	array(
		array(
            'taxonomy'  => 'rental-category',
            'field'     => 'if', 
            'terms'     => array(esc_attr($args['cat'])),
		)
    );
}

if ( !empty($args['orderby']) ) {

	$query_args['orderby'] = $args['orderby'];
}

$query = new WP_Query( $query_args );
if ( $query->have_posts() ) {

	set_query_var('lte_rental_layout', $args['layout']);
	if ( !empty($args['btn_text']) ) {

		set_query_var('lte_rental_btn', $args['btn_text']);
	}

	echo '<div class="lte-rental-sc">';

		if ( $args['layout'] == 'single') {

			while ( $query->have_posts() ) {

				$query->the_post();

				$item = fw_get_db_post_option(get_The_ID());

				$link = fw_get_db_post_option(get_The_ID(), 'link');

				if ( empty($link) ) {

				    $link = get_the_permalink();
				}   

				?><article class="lte-rental-item lte-rental-large row">
			    <a href="<?php echo esc_url($link); ?>" class="lte-photo col-lg-6" style="background-image: url(<?php echo wp_get_attachment_image_url( get_post_thumbnail_id( get_The_ID()) , 'full' ); ?>);">
			        <?php

			        	if ( !empty($args['label']) ) {

			        		echo '<span class="lte-label"><span>'.esc_html($args['label']).'</span></span>';
			        	}

			        	echo wp_get_attachment_image( get_post_thumbnail_id( get_The_ID()) , 'limme-gallery-big' );
			        ?>
			    </a>
			    <div class="lte-rental-inner col-lg-6">
			    <?php

					if ( !empty(get_the_title()) ) {

						echo '<h5 class="lte-header"><a href="'.esc_url($link).'">'.get_the_title().'</a></h5>';
					}

			    	if ( !empty($item['price_full']) ) {

						echo '<div class="lte-price lte-price-full lte-price-large">';
							echo wp_kses_post(lte_string_parse($item['price_full']));
						echo '</div>';
					}


					if ( !empty($item['cut']) ) {

						echo '<p class="lte-excerpt">'.wp_kses_post( $item['cut'] ).'</p>';
					}

					$tags = wp_get_post_terms( get_The_ID(), 'rental-post_tag' );
					if ( !empty($tags) ) {

						echo '<ul class="lte-icons-tags">';
						$x = 0;
						foreach ( $tags as $item ) {

							$x++;
							$icon = fw_get_db_term_option($item->term_id, 'rental-post_tag', 'icon-v2');
							if ( !empty( $icon ) ) {

								echo '<li><span class="lte-icon '.esc_attr($icon['icon-class']).'"></span>'.esc_html($item->name).'</li>';
							}
								else {

								echo '<li>'.esc_html($item->name).'</li>';
							}

							if ( $x == 3 ) break; 
						}
						echo '</ul>';
					}

					echo '<div class="lte-rental-footer">';

					$btn_text = $args['btn_text'];

					if ( empty($btn_text) ) {

						$btn_text = esc_html__( 'Order Car', 'limme' );
					}

					echo '<a href="'.esc_url($link).'" class="lte-btn btn-lg color-hover-white"><span class="lte-btn-inner"><span class="lte-btn-before"></span>'.esc_html($btn_text).'<span class="lte-btn-after"></span></span></a>';
			    ?>
				</div>
			</article>
			<?php
			}
		}
			else {

			echo '<div class="lte-rental-list row centered lte-layout-'.esc_attr($args['layout']).'">';

			while ( $query->have_posts() ) {

				$query->the_post();

				get_template_part( 'tmpl/content-rental' );
			}
		}

	set_query_var('lte_rental_layout', false);

	wp_reset_postdata();

		echo '</div>';
	echo '</div>';

	wp_reset_postdata();
}

