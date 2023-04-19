<?php
/**
 * Full rental post
 */

$args = fw_get_db_post_option(get_The_ID());

?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
			if ( has_post_thumbnail() ) {

				echo '<div class="lte-image">';
				the_post_thumbnail( 'limme-post' );
				echo '</div>';
			}
		?>
	    <div class="lte-description">
				<?php


					if ( !empty($args['ratio']) ) {

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


					echo '<div class="lte-header-wrapper">';

						echo '<h2 class="lte-header">'.get_the_title().'</h4>';

						if ( !empty($args['price']) ) {

							echo '<div class="lte-price lte-price-bottom">';
								echo esc_html($args['price']);
								echo '<span class="lte-price-postfix">'.esc_html($args['price_postfix']).'</span>';
							echo '</div>';
						}	

					echo '</div>';

					if ( !empty($args['subheader']) ) {
					
						echo '<h6 class="lte-subheader">'.wp_kses_post( $args['subheader'] ).'</h5>';
					}

					echo '<div class="lte-content">';

						the_content();

					echo '</div>';

					$tags = wp_get_post_terms( get_The_ID(), 'post_tag' );
					if ( !empty($tags) ) {

						echo '<ul class="lte-icons-tags">';
						$x = 0;
						foreach ( $tags as $item ) {

							$x++;
							$icon = fw_get_db_term_option($item->term_id, 'post_tag', 'icon-v2');
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

				?>

	    </div>	    
	</article>

	