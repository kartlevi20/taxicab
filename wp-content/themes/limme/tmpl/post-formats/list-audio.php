<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Audio Post Format
 */

$post_class = '';
$display_excerpt = 'visible';

$limme_layout = get_query_var( 'limme_layout' );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr($post_class) ); ?>>
	<div class="lte-wrapper">
		<?php

		if ( has_post_thumbnail() ) {

			$limme_photo_class = 'lte-photo';

		    echo '<a href="'.esc_url(get_the_permalink()).'" class="'.esc_attr($limme_photo_class).'">';

				the_post_thumbnail('full');

		    echo '</a>';
		}

		$mp3 = limme_find_http(get_the_content());

		echo wp_audio_shortcode(
			
			array('src'	=>	esc_url($mp3))
		);
	?>
	</div>
    <div class="lte-description"> 
        <?php 
			limme_the_post_info( );
        ?>  
        <a href="<?php esc_url( the_permalink() ); ?>" class="lte-header"><h3><?php the_title(); ?></h3></a>
		<?php

			$display_excerpt_q = get_query_var( 'lte_display_excerpt' );


			if ( isset($display_excerpt_q) AND $display_excerpt_q === true  ) {

				$display_excerpt = 'visible';
			}

			if ( !empty( $display_excerpt ) AND $display_excerpt == 'visible' ) {

    			echo '<div class="lte-excerpt">';

				set_query_var( 'limme_excerpt_activity', 'enable' );

				limme_the_excerpt( get_the_content() );

			    set_query_var( 'limme_excerpt_activity', 'disable' );

			    echo '</div>';
			}
		?>		
    </div>     	    	
</article>