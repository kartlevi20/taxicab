<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Team_Widget extends Widget_Base {

	public function get_name() {
		return 'lte-team';
	}

	public function get_title() {
		return esc_html__( 'Team', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-lock-user';
	}

	public function get_categories() {
		return [ 'lte-category' ];
	}

	protected function register_controls() {

		$categories = get_categories( [ 'taxonomy' => 'team-category'] );

		$cats = [];


		foreach ($categories as $item) {

			$cats[$item->term_id] = $item->name;
		}		

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Layout', 'lte-ext' ),
			]
		);

			$this->add_control(
				'important_note',
				[
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'raw' => esc_html__( "The content of team can be edited in Team menu of Dashboard.", 'lte-ext'),
				]
			);		

			$this->add_control(
				'layout',
				[
					'label' => esc_html__( 'Layout', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'static',
					'label_block' => true,
					'options' => [
//						'swiper'	=>	esc_html__( 'Slider', 'lte-ext' ),
						'static'	=>	esc_html__( 'Static', 'lte-ext' ),
					],
				]
			);		

			$this->add_control(
				'cat',
				[
					'label' => esc_html__( 'Category', 'lte-ext' ),
					'type' => Controls_Manager::SELECT2,
					'label_block' => true,
					'default' => '',
					'options' => $cats,
				]
			);	

			$this->add_control(
				'limit',
				[
					'label' => esc_html__( 'Limit', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'default' => '4',
				]
			);
/*
			$this->add_control(
				'columns',
				[
					'label' => esc_html__( 'Columns', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => '4',
					'options' => [
						1 => 1,
						2 => 2,
						3 => 3,
						4 => 4,
					],
				]
			);
*/
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		lte_sc_output('team', $settings);
	}
}




