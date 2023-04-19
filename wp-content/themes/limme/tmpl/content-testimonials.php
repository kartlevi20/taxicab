<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
	Testimonials Single Item
 */

$rate_display = false;
$subheader_display = false;

$class = '';
if ( function_exists( 'FW' ) ) {

	$subheader = fw_get_db_post_option(get_The_ID(), 'subheader');
	$rate = fw_get_db_post_option(get_The_ID(), 'rate');	
	$short = fw_get_db_post_option(get_The_ID(), 'short');	

	$sc = get_query_var( 'lte-testimonials-sc' );
	$sc_cut = get_query_var( 'lte-testimonials-sc-cut' );

	if ( !empty($short) AND empty($sc) ) {

		$class = ' lte-short';
	}
}


?>
<div class="lte-inner <?php echo esc_attr($class); ?>">
	<?php

		if ( !empty($rate_display) ) {

			echo '<div class="rate">';
			for ($x = 1; $x<= (int)($rate); $x++) {

				echo '<span class="fa fa-star"></span>';
			}
			echo '</div>';
		}

		echo '<div class="lte-descr">';

			if ( !empty($sc_cut) ) {

				echo '<p>'. limme_cut_words(get_the_content(), $sc_cut, '.') .'</p>';
			}
				else {

				echo '<p>'. get_the_content() .'</p>';
			}
		echo '<span class="lte-triangle"></span></div>';

		if ( empty($short) OR !empty($sc)) {

			echo '<div class="lte-image">';
				the_post_thumbnail('limme-tiny-square');
			echo '</div>';
		}

		echo '<div class="lte-header">'. get_the_title() .'</div>';

		if ( !empty($subheader_display) AND !empty($subheader) ) {

			echo '<div class="lte-subheader">'. wp_kses($subheader, 'header') .'</div>';
		}

	?>
</div>
