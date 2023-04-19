<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Rental_Widget extends Widget_Base {

	public function get_name() {
		return 'lte-rental';
	}

	public function get_title() {
		return esc_html__( 'Rental', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'lte-category' ];
	}

	protected function register_controls() {

		$categories = get_categories( [ 'taxonomy' => 'rental-category' ]);
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
					'raw' => esc_html__( "The content of rental can be edited in Rental menu of Dashboard.", 'lte-ext'),
				]
			);		

			$this->add_control(
				'layout',
				[
					'label' => esc_html__( 'Layout', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'photos',
					'options' => [

						'buy'	=>	esc_html__( "Cars Buy", 'lte-ext'),
						'car'	=>	esc_html__( "Cars Rent", 'lte-ext'),
						'single'	=>	esc_html__( "Single Car", 'lte-ext'),
					],
				]
			);			

			$this->add_control(
				'cat',
				[
					'label' => esc_html__( 'Category', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'label_block' => true,
					'default' => '',
					'options' => $cats,
				]
			);			

			$this->add_control(
				'ids',
				[
					'label' => esc_html__( 'Filter Ids', 'lte-ext' ),
					'description' => esc_html__( 'Coma separated', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
				]
			);	

			$this->add_control(
				'limit',
				[
					'label' => esc_html__( 'Limit', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'default' => '3',
				]
			);

			$this->add_control(
				'label',
				[
					'label' => esc_html__( 'Label', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'label_block'	=>	true,
					'condition' => [
						'layout' => ['single'],
					],						
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

			$this->add_control(
				'btn_text',
				[
					'label' => esc_html__( 'Order Button', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Order Car', 'lte-ext' ),
					'label_block' => true,			
				]
			);


		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		lte_sc_output('rental', $settings);
	}
}




