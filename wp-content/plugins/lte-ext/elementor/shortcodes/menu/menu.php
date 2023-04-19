<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Menu_Widget extends Widget_Base {

	public function get_name() {
		return 'lte-menu';
	}

	public function get_title() {
		return esc_html__( 'Menu', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'lte-category' ];
	}

	protected function register_controls() {

		$categories = get_categories( [ 'taxonomy' => 'lte-menu-category' ]);
		$cats = array();
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
					'raw' => esc_html__( "The content of menu can be edited in Menu menu of Dashboard.", 'lte-ext'),
				]
			);		

			$this->add_control(
				'cat',
				[
					'label' => esc_html__( 'Category', 'lte-ext' ),
					'type' => Controls_Manager::SELECT2,
					'multiple'	=>	true,
					'label_block' => true,
					'default' => '',
					'options' => $cats,
				]
			);			

			$this->add_control(
				'layout',
				[
					'label' => esc_html__( 'Layout', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'two-cols',
					'options' => [

						'two-cols'	=>	esc_html__( "Two Columns", 'lte-ext'),
						'one-col'	=>	esc_html__( "One Column", 'lte-ext'),
					],
				]
			);	

			$this->add_control(
				'scroll',
				[
					'label' => esc_html__( 'Scroll Bar', 'lte-ext' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'no',
				]
			);

			$this->add_control(
				'limit',
				[
					'label' => esc_html__( 'Limit', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'default' => '8',
				]
			);

			$this->add_control(
				'orderby',
				[
					'label' => esc_html__( 'Order By', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'date',
					'options' => [
						'date'	=>	esc_html__( 'Date', 'lte-ext' ),
						'ID'	=>	esc_html__( 'ID', 'lte-ext' ),
						'title'	=>	esc_html__( 'Title', 'lte-ext' ),
						'rand'	=>	esc_html__( 'Random', 'lte-ext' ),

					],
				]
			);

			$this->add_control(
				'orderway',
				[
					'label' => esc_html__( 'Sort Order', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'DESC',
					'options' => [
						'DESC' => esc_html__( 'Descending', 'lte-ext' ),
						'ASC' => esc_html__( 'Ascending', 'lte-ext' )
					],
				]
			);


		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		lte_sc_output('menu', $settings);
	}
}




