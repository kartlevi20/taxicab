<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Partners_Widget extends Widget_Base {

	public function get_name() {
		return 'lte-partners';
	}

	public function get_title() {
		return esc_html__( 'Partners', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-banner';
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
			'target',
			[
				'label' => esc_html__( 'Link Target', 'lte-ext' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'self',
				'label_block' => true,
				'options' => [
					'self'	=>	esc_html__( 'Current window', 'lte-ext' ),
					'blank'	=>	esc_html__( 'New window', 'lte-ext' ),
				],
			]
		);		

		$this->add_control(
			'hover',
			[
				'label' => esc_html__( 'Hover Effect', 'lte-ext' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'opacity',
				'label_block' => true,
				'options' => [
					'opacity'	=>	esc_html__( 'Opacity', 'lte-ext' ),
					'scale'		=>	esc_html__( 'Scale', 'lte-ext' ),
					'none'		=>	esc_html__( 'None', 'lte-ext' ),
				],
			]
		);	

		$this->add_control(
			'x2', [
				'label' => esc_html__( 'Logos x2', 'lte-ext' ),
				'description' => esc_html__( 'Size will be decreased to predefined max-height', 'lte-ext' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'prefix_class' => 'lte-2x-',
			]
		);		

		$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'header', [
					'label' => esc_html__( 'Header', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'href',
				[
					'label' => esc_html__( 'Href', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::URL,
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'image',
				[
					'label' => esc_html__( 'Image', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'label_block' => true,
				]
			);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Items', 'lte-ext' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ header }}}',
			]
		);


		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		lte_sc_output('partners', $settings);
	}
}




