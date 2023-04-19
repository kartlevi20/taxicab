<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Zoomslider_Widget extends Widget_Base {

   public function __construct($data = [], $args = null) {

		parent::__construct($data, $args);

		wp_register_script( 'lte-zoomslider', lteGetPluginUrl('elementor/shortcodes/zoomslider/jquery.zoomslider.js'), array('jquery'), null, true );
		wp_register_style( 'lte-zoomslider', lteGetPluginUrl('elementor/shortcodes/zoomslider/zoom-slider.css') );
   }

	public function get_script_depends() {
		return [ 'lte-zoomslider' ];
	}

	public function get_style_depends() {
		return [ 'lte-zoomslider' ];
	}

	public function get_name() {
		return 'lte-zoomslider';
	}

	public function get_title() {
		return esc_html__( 'Like Slider', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-slides';
	}

	public function get_categories() {
		return [ 'lte-category' ];
	}

	protected function register_controls() {

		$categories = get_categories( [ 'taxonomy' => 'sliders-category' ]);
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
					'raw' => esc_html__( "The content of Zoom Slider can be edited in Sliders menu of Dashboard.", 'lte-ext'),
				]
			);				

			$this->add_control(
				'type',
				[
					'label' => esc_html__( 'Type', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'label_block' => true,
					'default' => 'zs',
					'options' => [
						'zs'		=>	esc_html__( 'Zoom Slider', 'lte-ext' ),
						'swiper'	=>	esc_html__( 'Swipe Slider', 'lte-ext' ),
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
/*
			$this->add_control(
				'tagline',
				[
					'label' => esc_html__( 'Tagline', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'false',
					'options' => [
						'default' 	=> esc_html__('Enabled', 'lte-ext'),
						'false' 	=> esc_html__('Disabled', 'lte-ext'),
					],
				]
			);
*/
			$this->add_control(
				'overlay',
				[
					'label' => esc_html__( 'Overlay', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'false',
					'options' => [
						'black' 		=> esc_html__('Black Overlay', 'lte-ext'),
						'black-gradient' 		=> esc_html__('Black with Gradient Overlay', 'lte-ext'),						
						'false' 		=> esc_html__('Disabled', 'lte-ext'),
					],
					'condition' => [
						'type' => 'zs',
					],						
				]
			);
/*
			$this->add_control(
				'overlay-add',
				[
					'label' => esc_html__( 'Overlay Additional', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'vertical-lines',
					'options' => [
						'vertical-lines' 	=> esc_html__('Vertical Lines', 'lte-ext'),
						'false' 			=> esc_html__('Disabled', 'lte-ext'),
					],
				]
			);
*/
			$this->add_control(
				'bullets',
				[
					'label' => esc_html__( 'Bullets', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'false',
					'options' => [
						'default' 	=> esc_html__('Enabled', 'lte-ext'),
						'false' 	=> esc_html__('Disabled', 'lte-ext'),
					],
				]
			);

			$this->add_control(
				'arrows',
				[
					'label' => esc_html__( 'Arrows', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default' 	=> esc_html__('Enabled', 'lte-ext'),
						'false' 	=> esc_html__('Disabled', 'lte-ext'),
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_animation',
			[
				'label' => esc_html__( 'Animation', 'lte-ext' ),
			]
		);

			$this->add_control(
				'zoom',
				[
					'label' => esc_html__( 'Zoom', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default' 	=> esc_html__('Zoom In', 'lte-ext'),
						'out'		=> esc_html__('Zoom Out', 'lte-ext'),
						'fade'		=> esc_html__('Fade Only', 'lte-ext')
					],
					'condition' => [
						'type' => 'zs',
					],					
				]
			);

			$this->add_control(
				'zs-origin',
				[
					'label' => esc_html__( 'Zoom Origin', 'lte-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::SELECT,
					'default' => 'center-center',
					'options' => [
						"top-left"		=> esc_html__( "Top Left", 'lte-ext' ),
						"top-center"	=> esc_html__( "Top Center", 'lte-ext' ),
						"top-right"		=> esc_html__( "Top-Right", 'lte-ext' ),						

						"center-left"	=> esc_html__( "Center Left", 'lte-ext' ),
						"center-center"	=> esc_html__( "Center", 'lte-ext' ),
						"center-right"	=> esc_html__( "Center Right", 'lte-ext' ),

						"bottom-left"	=> esc_html__( "Bottom Left", 'lte-ext' ),
						"bottom-center"	=> esc_html__( "Bottom Center", 'lte-ext' ),
						"bottom-right"	=> esc_html__( "Bottom Right", 'lte-ext' ),
					],
					'condition' => [
						'type' => 'zs',
					],						
				]
			);

			$this->add_control(
				'zs-speed',
				[
					'label' => esc_html__( 'Zoom Effect Speed, ms', 'lte-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::TEXT,
					'default' => 20000,
					'condition' => [
						'type' => 'zs',
					],						
				]

			);

			$this->add_control(
				'zs-interval',
				[
					'label' => esc_html__( 'Interval between slides, ms', 'lte-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::TEXT,
					'default' => 4500,
					'condition' => [
						'type' => 'zs',
					],						
				]
			);	

			$this->add_control(
				'zs-switch',
				[
					'label' => esc_html__( 'Switch Speed, ms', 'lte-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::TEXT,
					'default' => 7000,
					'condition' => [
						'type' => 'zs',
					],						
				]
			);		

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		lte_sc_output('zoomslider', $settings);
	}
}




