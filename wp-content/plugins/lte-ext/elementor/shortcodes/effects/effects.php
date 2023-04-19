<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Effects_Widget extends Widget_Base {

	public function get_name() {
		return 'lte-effects';
	}

	public function get_title() {
		return esc_html__( 'Effects', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-image-rollover';
	}

	public function get_categories() {
		return [ 'lte-category' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Layout', 'lte-ext' ),
			]
		);


			$this->add_control(
				'type',
				[
					'label' => esc_html__( 'Type', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						'smoke' 		=> esc_html__('Smoke', 'lte-ext'),
						'dots' 			=> esc_html__('Dots Animated', 'lte-ext'),
						'square' 		=> esc_html__('Square Animated', 'lte-ext'),
						'square-large' 	=> esc_html__('Large Square Animated', 'lte-ext'),
					],
				]
			);		


			$this->add_control(
				'square-animation',
				[
					'label' => __( 'Continuous Animation', 'lte-ext' ),
					'type' => Controls_Manager::SWITCHER,
					'default'	=>	'yes',
					'condition' => [
						'type' => ['square', 'square-large'],
					],					
				]
			);

			$this->add_control(
				'image',
				[
					'label' => __( 'Image', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'label_block' => true,
					'condition' => [
						'type' => 'smoke',
					],					
				]
			);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		lte_sc_output('effects', $settings);
	}
}




