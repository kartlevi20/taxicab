<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Video_Widget extends Widget_Base {

	public function get_name() {
		return 'lte-video';
	}

	public function get_title() {
		return esc_html__( 'Video Popup', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-youtube';
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
				'href',
				[
					'label' => __( 'Href', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::URL,
					'label_block' => true,
				]
			);


			$this->add_control(
				'style',
				[
					'label' => esc_html__( 'Style', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'plain',
					'options' => [
						'plain' 	=> esc_html__('Plain', 'lte-ext'),
						'solid'		=> esc_html__('Solid', 'lte-ext'),
//						'icon'		=> esc_html__('Icon with Text', 'lte-ext'),
					],
				]
			);			

			$this->add_control(
				'header',
				[
					'label' => esc_html__( 'Header', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'label_block'	=>	true,
					'condition' => ['style' => ['icon'] ],
				]
			);


		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		lte_sc_output('video', $settings);
	}
}




