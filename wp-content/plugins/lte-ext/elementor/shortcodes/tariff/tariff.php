<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Tariff_Widget extends Widget_Base {

	public function get_name() {
		return 'lte-tariff';
	}

	public function get_title() {
		return esc_html__( 'Tariff', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-price-list';
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
				'header',
				[
					'label' => esc_html__( 'Header', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'default' => 'Header',
					'label_block' => true,					
				]
			);

			$this->add_control(
				'price',
				[
					'label' => esc_html__( 'Price', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'description'	=>	esc_html__("Use brackets to set units as postfix (for ex: {{ /unit }} )", 'lte-ext'),
					'default' => '$9.99{{ / month }}',
					'label_block' => true,					
				]
			);

			$this->add_control(
				'text',
				[
					'label' => esc_html__( 'List', 'lte-ext' ),
					'type' => Controls_Manager::TEXTAREA,
					'description'	=>	esc_html__("To set yes prefix use {+}, to set no prefix use {-}", 'lte-ext'),
				]
			);

			$this->add_control(
				'btn-header',
				[
					'label' => esc_html__( 'Button Header', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'default' => 'Read More',
				]
			);

			$this->add_control(
				'btn-href',
				[
					'label' => esc_html__( 'Button Link', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'default' => '#',
				]
			);

			$this->add_control(
				'vip',
				[
					'label' => esc_html__( 'VIP', 'lte-ext' ),
					'type' => Controls_Manager::SWITCHER,
				]
			);		

			$this->add_control(
				'bg-image',
				[
					'label' => esc_html__( 'Background Image', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'label_block' => true,
				]
			);


		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		lte_sc_output('tariff', $settings);
	}
}




