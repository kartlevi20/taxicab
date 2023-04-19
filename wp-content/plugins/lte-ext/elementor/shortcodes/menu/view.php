<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Menu Shortcode
 */


if ( !empty($args['cat']) ) {

	echo '<div class="lte-lte-menu-sc-wrapper lte-menu-sc lte-filter-container lte-layout-'.esc_attr($args['layout']).' lte-scroll-'.esc_attr($args['scroll']).'">';

		$cats = get_categories( [ 'taxonomy' => 'lte-menu-category', 'include' => $args['cat'] ] );

		if ( !empty($cats) ) {

			echo '<ul class="lte-tabs-cats">';

			$x = 0;
			foreach ( $cats as $cat ) {

				$x++;

				$class = '';
				if ( $x == 1 ) $class = ' active';

				echo '<li><span class="lte-tab'.esc_attr($class).'" data-filter="'.esc_attr($cat->term_id).'">'.esc_html($cat->name).'</span></li>';
			}

			echo '</ul>';
		}

		echo '<div class="lte-items">';	

			foreach ( $args['cat'] as $cat ) {

				$query_args = array(
					'post_type' => 'lte-menu',
					'post_status' => 'publish',
					'posts_per_page' => $args['limit'],
				);

				if ( !empty($args['orderby']) ) {

					$query_args['orderby'] = $args['orderby'];
				}

				$query_args['tax_query'] = [

					[
			            'taxonomy'  => 'lte-menu-category',
			            'field'     => 'if', 
			            'terms'     => array(esc_attr($cat)),
					]
			    ];

				echo '<div class="lte-filter-item lte-filter-id-'.$cat.'">';
				
				$query = new WP_Query( $query_args );
				if ( $query->have_posts() ) {

					$x = 0;
					while ( $query->have_posts() ) {

						$query->the_post();

						$price = fw_get_db_post_option(get_The_ID(), 'price');

						?>
						<div class="lte-item">
							<div class="lte-image">
								<?php the_post_thumbnail('limme-tiny-square'); ?>
							</div>
						    <div class="lte-description">
						    	<div class="lte-title">
					        		<h6 class="lte-header"><?php echo esc_html(get_the_title()); ?></h6>
					        		<span class="lte-dots"></span>
					        		<h6 class="lte-header lte-price"><?php echo esc_html($price); ?></h6>
					        	</div>
					        	<div class="lte-descr">
					        		<?php the_content(); ?>
					        	</div>
						    </div>
						</div>
						<?php
					}
				}

				echo '</div>';
			}

		echo '</div>';

	echo '</div>';
}

wp_reset_postdata();

