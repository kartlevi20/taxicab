<?php
/**
 * Rental List
 */

$args = fw_get_db_post_option(get_The_ID());
$layout = get_query_var('lte_rental_layout');
$btn_text = get_query_var('lte_rental_btn');


if ( empty($layout) ) {

	$layout = 'car';
}

if ( !empty($_GET['rental_style']) AND $_GET['rental_style'] == 'gray' ) {

	$layout = 'buy';
}

$link = fw_get_db_post_option(get_The_ID(), 'link');

if ( empty($link) ) {

    $link = get_the_permalink();
}   

?>
<div class="col-lg-4 col-md-6 col-sm-6">
	<article class="lte-rental-item">
	    <a href="<?php echo esc_url($link); ?>" class="lte-photo">
	        <?php
	        	echo wp_get_attachment_image( get_post_thumbnail_id( get_The_ID()) , 'limme-gallery-big' );
	        ?>
	    </a>
	    <?php
			if ( !empty($args['price']) ) {

				echo '<div class="lte-price lte-price-top">';
					echo esc_html($args['price']);
					echo '<span class="lte-price-postfix">'.esc_html($args['price_postfix']).'</span>';
				echo '</div>';
			}
	    ?>
	    <div class="lte-rental-inner">
	    <?php

			if ( $layout == 'limo' AND !empty($args['ratio']) ) {

				echo '<div class="lte-ratio">';

					echo '<span class="lte-stars">';

						for ( $x = 1; $x <= 5; $x++ )  {
						
							echo '<span></span>';
						}

					echo '</span>';
					echo '<span class="lte-stars-active">';

						for ( $x = 1; $x <= $args['ratio']; $x++ )  {

							echo '<span></span>';
						}

					echo '</span>';
				echo '</div>';
			}

			if ( !empty(get_the_title()) ) {

				echo '<h5 class="lte-header"><a href="'.esc_url($link).'">'.get_the_title().'</a></h5>';
			}

			if ( !empty($args['subheader']) ) {

				echo '<h4 class="lte-subheader">'.esc_html($args['subheader']).'</h4>';
			}

			if ( !empty($args['cut']) ) {

				echo '<p class="lte-excerpt">'.wp_kses_post( $args['cut'] ).'</p>';
			}

			if ( !empty($args['icons']) AND $layout == 'lim' ) {

				echo '<ul class="lte-icons">';
				foreach ($args['icons'] as $item) {

					echo '<li><span class="'.esc_attr( $item['icon']['icon-class'] ) .'"></span>'.esc_html($item['val']).'</li>';
				}
				echo '</ul>';
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

			if ( !empty($args['list']) AND $layout == 'lim' ) {

				echo '<ul class="lte-list">';
				foreach ($args['list'] as $item) {

					echo '<li>'.esc_html($item['val']).'</li>';
				}
				echo '</ul>';
			}

			echo '<div class="lte-rental-footer">';

			if ( $layout == 'buy' && !empty($args['price_full']) ) {

				echo '<div class="lte-price lte-price-full lte-price-bottom">';
					echo esc_html($args['price_full']);
				echo '</div>';
			}
				else
			if ( !empty($args['price']) ) {

				echo '<div class="lte-price lte-price-bottom">';
					echo esc_html($args['price']);
					echo '<span class="lte-price-postfix">'.esc_html($args['price_postfix']).'</span>';
				echo '</div>';
			}

			if ( $layout == 'buy' AND !empty($args['mileage']) ) {

				echo '<div class="lte-mileage"><span>'.esc_html__('Mileage:', 'limme').'</span> '.wp_kses_post($args['mileage']).'</div>';
			}
				else
			if ( ($layout == 'car' || $layout == 'buy')  AND !empty($args['ratio']) ) {


				echo '<div class="lte-ratio">';

					echo '<span class="lte-stars">';

						for ( $x = 1; $x <= 5; $x++ )  {
						
							echo '<span></span>';
						}

					echo '</span>';
					echo '<span class="lte-stars-active">';

						for ( $x = 1; $x <= $args['ratio']; $x++ )  {

							echo '<span></span>';
						}

					echo '</span>';
				echo '</div>';
			}

			echo '</div>';

			if ( empty($btn_text) ) {

				$btn_text = esc_html__( 'Order Car', 'limme' );
			}

			echo '<a href="'.esc_url($link).'" class="lte-btn btn-lg"><span class="lte-btn-inner"><span class="lte-btn-before"></span>'.esc_html($btn_text).'<span class="lte-btn-after"></span></span></a>';
	    ?>
		</div>
	</article>
</div>