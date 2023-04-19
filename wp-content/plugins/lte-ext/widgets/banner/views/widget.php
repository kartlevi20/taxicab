<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * @var string $before_widget
 * @var string $after_widget
 */

echo wp_kses_post( $before_widget );

if ( $params['target'] == 'self' ) {

	$target = '';
}
	else {

	$target = ' target="_blank" ';
}

echo '<a href="'.esc_url($params['href']).'" class="lte-widget-banner" '.$target.'>';

	if ( !empty($params['image']['url']) ) echo '<span class="lte-bg" style="background-image: url('.esc_url($params['image']['url']).')"></span>';
	if ( !empty($params['text']) ) echo '<span class="lte-content">'.wp_kses_post(lte_string_parse($params['text'])).'</span>';
	if ( !empty($params['icon']['icon-class']) ) echo '<span class="lte-icon"><span class="lte-ic '.esc_attr( $params['icon']['icon-class'] ).'"></span></span>';	

echo '</a>'

?>
<?php echo wp_kses_post( $after_widget ) ?>
