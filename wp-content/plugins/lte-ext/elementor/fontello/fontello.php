<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

add_filter( 'elementor/icons_manager/additional_tabs', 'lte_elementor_add_icons_tab' );


/**
 * Add custom icons to Elementor Icons tabs (new in v2.6+)
 *
 * @param array $tabs Additional tabs for new icon interface.
 * @return array $tabs
 */
function lte_elementor_add_icons_tab( $tabs = array() ) {

	$icons = limme_get_fontello_icons(limme_get_fontello_css()); 
	if ( empty($icons) ) return $tabs;

	$new_icons = array();
	foreach ( $icons as $icon ) {

		$i = explode('-', $icon);
		$prefix = $i[0];
		array_shift($i);

		$new_icons[] = implode('-', $i);
	}

	$file = get_template_directory_uri() . '/assets/fontello/lte-limme.css?600';
	
	$tabs['lte-limme'] = [
		'name'          => 'lte-limme',
		'label'         => esc_html__( 'lte-limme', 'text-domain' ),
		'labelIcon'     => 'fas fa-user',
		'prefix'        => $prefix.'-',
		'displayPrefix' => $prefix,
		'url'           => $file,
		'icons'         => $new_icons,
		'ver'           => '1.0.0',
	];

	return $tabs;
}


