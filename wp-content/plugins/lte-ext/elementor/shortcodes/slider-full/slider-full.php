<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Slider_Full_Widget extends Widget_Base {

   public function __construct($data = [], $args = null) {

		parent::__construct($data, $args);
   }

	public function get_script_depends() {
		return [ 'lte-slider-full' ];
	}

	public function get_style_depends() {
		return [ 'lte-slider-full' ];
	}

	public function get_name() {
		return 'lte-slider-full';
	}

	public function get_title() {
		return esc_html__( 'Products Slider', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-slides';
	}

	public function get_categories() {
		return [ 'lte-category' ];
	}

	protected function register_controls() {

		$categories = get_categories( [ 'taxonomy' => 'sliders-full-category' ]);
		$cats = array();
		$cars[0] = '---';
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
					'raw' => esc_html__( "The content of can be edited in Product Sliders menu of Dashboard. The correct output of slider will be visible only in frontend. This Shortcode used for full-height pages and may conflict with any other elements on the page.", 'lte-ext'),
				]
			);				

			$this->add_control(
				'black-pattern',
				[
					'label' => esc_html__( 'Black Pattern', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'label_block' => true,
				]
			);

			$this->add_control(
				'white-pattern',
				[
					'label' => esc_html__( 'White Pattern', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'label_block' => true,
				]
			);
/*
			$this->add_control(
				'cat',
				[
					'label' => esc_html__( 'Category', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'label_block' => true,
					'default' => '',
					'options' => $cats,
					'description' => esc_html__( 'Used for left menu. Can be empty.', 'lte-ext' ),
				]
			);		
*/
	

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		lte_sc_output('slider-full', $settings);
	}
}




