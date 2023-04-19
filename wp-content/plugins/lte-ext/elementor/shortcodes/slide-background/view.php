<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode
 */

$key = 'lte-sb-'.mt_rand();

echo '<div class="lte-slide-background" data-key="'.esc_attr($key).'" data-images="'.esc_attr(sizeof($args['list'])).'">';

		echo "
		<div class='ltx-svg'>
			<svg viewBox='0 0 100 100'>
			    <defs>";

				$x = 0;
				foreach ( $args['list'] as $k => $item ) {
			    
			    	$x++;

					echo "   
			        <mask id='".$key.'-'.esc_attr($x)."' x='0' y='0' width='100' height='100'>
			            <rect class='part' x='100' y='0'  width='100' height='20.2' fill='#fff' />
			            <rect class='part' x='100' y='20' width='100' height='20.2' fill='#fff' />
			            <rect class='part' x='100' y='40' width='100' height='20.2' fill='#fff' />
			            <rect class='part' x='100' y='60' width='100' height='20.2' fill='#fff' />
			            <rect class='part' x='100' y='80' width='100' height='20.2' fill='#fff' />
			            <rect class='full' x='0' y='0' width='100' height='100' fill='#fff' opacity='0' />
			        </mask>";  
				}
			echo "</defs>";

			$x = 0;
			foreach ( $args['list'] as $k => $item ) {

				$mask = '';
				if ( $x > 0) {

					$mask = " mask='url(#".$key.'-'.esc_attr($x).")'";
				}
				echo "<image width='100' height='100' xlink:href='".esc_url($item['image']['url'])."' ".$mask." />";
				$x++;

				$image = $item['image']['url'];

			}

			echo "<image width='100' height='100' xlink:href='".esc_url($args['list'][0]['image']['url'])."' mask='url(#".$key.'-'.esc_attr($x).")' />";

			echo "</svg>
		</div>";

echo '</div>';

?>