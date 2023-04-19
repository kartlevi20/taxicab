<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Adds additonal controls to default Elementor's sections/shortcodes
 */

add_action( 'elementor/element/after_section_start', function( $element, $section_id, $args ) {

	$lte_cfg = lte_elementor_config();
	if ( !empty($lte_cfg['background']) ) {

		$lte_cfg['background'] = array_merge(array(''	=>	esc_html__( 'Default', 'lte-ext' )), $lte_cfg['background']);

		if ( ( 'section' === $element->get_name() && 'section_background' === $section_id) OR 
			   'column' === $element->get_name() && 'section_style' === $section_id	 ) {

			$element->add_control(
				'lte_background',
				[
					'label' => esc_html__( 'Theme Background', 'lte-ext' ),
					'label_block'	=>	true,
					'description' => esc_html__("Can be replaced be Elementor settings.", 'lte-ext'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => $lte_cfg['background'],
					'prefix_class' => 'lte-background-',
				]
			);		
	
			$element->add_control(
				'lte_parallax',
				[
					'label' => esc_html__( 'Background Parallax', 'lte-ext' ),
					'description' => esc_html__("May require page reload in order to take an action.", 'lte-ext'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'prefix_class' => 'lte-parallax-',
				]				
			);		

		}	
	}

	if ( !empty($lte_cfg['overlay']) ) {

		$lte_cfg['overlay'] = array_merge(array(''	=>	esc_html__( 'None', 'lte-ext' )), $lte_cfg['overlay']);

		if ( 'section' === $element->get_name() && 'section_background_overlay' === $section_id OR 
			 'column' === $element->get_name() && 'section_background_overlay' === $section_id ) {

			$element->add_control(
				'lte_overlay',
				[
					'label' => esc_html__( 'Theme Overlay', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => $lte_cfg['overlay'],
					'prefix_class' => 'lte-overlay-wrapper-',
				]
			);					

			$element->add_control(
				'lte_overlay_mobile',
				[
					'label' => esc_html__( 'Theme Overlay Mobile Only', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'prefix_class' => 'lte-overlay-mobile-only-',
				]
			);		

			$element->add_control(
				'lte_particles',
				[
					'label' => esc_html__( 'Theme Particles', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						false 		=>	esc_html__( 'None', 'lte-ext' ),
						'ripples'	=>	'Water Ripples',
					],
					'prefix_class' => 'lte-particles-',
				]
			);					
		}
	}

}, 10, 3 );


add_action( 'elementor/frontend/section/before_render', function ( \Elementor\Element_Base $element ) {

	if ( !empty($element->get_settings( 'lte_background' )) ) {

		$element->add_render_attribute( '_wrapper', [
			'class' => 'lte-background-' . esc_attr($element->get_settings( 'lte_background' )),
		] );
	}

	if ( !empty($element->get_settings( 'lte_particles' )) ) {

		wp_enqueue_script('jquery-ripples', lteGetPluginUrl('assets/js/jquery.ripples.js'), array('jquery'), '0.5.3' );
	}	
} );






