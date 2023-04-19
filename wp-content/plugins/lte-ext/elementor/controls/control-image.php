<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Adds additonal controls to default Elementor's sections/shortcodes
 */

add_action( 'elementor/element/image/section_image/after_section_end', function( $element ) {

		$element->start_controls_section(
			'lte_paroller_section',
			[
				'label' => esc_html__( 'Parallax', 'lte-ext' ),
			]
		);

			$element->add_control(
				'important_note',
				[
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'raw' => esc_html__( "Effect visible only on frontend.", 'lte-ext'),
				]
			);	

			$element->add_control(
				'lte_paroller',
				[
					'label' => esc_html__( 'Image Parallax', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
				]				
			);

			$element->add_control(
				'lte_paroller_factor',
				[
					'label' => esc_html__( 'Factor', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'description' => esc_html__( "From -1.0 to 1.0", 'lte-ext'),
					'default' => '0.5',
				]				
			);

			$element->add_control(
				'lte_paroller_factor_lg',
				[
					'label' => esc_html__( 'Factor Lg', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => '',
				]				
			);

			$element->add_control(
				'lte_paroller_factor_md',
				[
					'label' => esc_html__( 'Factor Md', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => '',
				]				
			);		
					
			$element->add_control(
				'lte_paroller_factor_sm',
				[
					'label' => esc_html__( 'Factor Sm', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => '',
				]				
			);

			$element->add_control(
				'lte_paroller_factor_xs',
				[
					'label' => esc_html__( 'Factor Xs', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'description' => esc_html__( "If empty previous value used", 'lte-ext'),
					'default' => '',
				]				
			);

			$element->add_control(
				'lte_paroller_type',
				[
					'label' => esc_html__( 'Type', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'foreground',
					'options' => [
						'foreground'	=>	esc_html__( 'Foreground', 'lte-ext' ),
						'background'	=>	esc_html__( 'Background', 'lte-ext' ),
					],					
				]				
			);		

			$element->add_control(
				'lte_paroller_direction',
				[
					'label' => esc_html__( 'Direction', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'vertical',
					'options' => [
						'vertical'		=>	esc_html__( 'Vertical', 'lte-ext' ),
						'horizontal'	=>	esc_html__( 'Horizontal', 'lte-ext' ),
					],					
				]				
			);											

		$element->end_controls_section();

}, 10, 3 );


add_action( 'elementor/frontend/widget/before_render', function ( \Elementor\Element_Base $element ) {

	if ( $element->get_name() == 'image' AND !empty($element->get_settings( 'lte_paroller' )) )  {

		$settings = [
			'data-paroller-factor' => $element->get_settings( 'lte_paroller_factor' ),
			'data-paroller-type' => $element->get_settings( 'lte_paroller_type' ),
			'data-paroller-direction' => $element->get_settings( 'lte_paroller_direction' ),
		];

		if ( !empty($element->get_settings( 'lte_paroller_factor_lg' )) ) $settings['data-paroller-factor-lg'] = $element->get_settings( 'lte_paroller_factor_lg' );

		if ( !empty($element->get_settings( 'lte_paroller_factor_md' )) ) $settings['data-paroller-factor-md'] = $element->get_settings( 'lte_paroller_factor_md' );

		if ( !empty($element->get_settings( 'lte_paroller_factor_sm' )) ) $settings['data-paroller-factor-sm'] = $element->get_settings( 'lte_paroller_factor_sm' );

		if ( !empty($element->get_settings( 'lte_paroller_factor_xs' )) ) $settings['data-paroller-factor-xs'] = $element->get_settings( 'lte_paroller_factor_xs' );				

		$element->add_render_attribute( '_wrapper', $settings );
	}
} );




