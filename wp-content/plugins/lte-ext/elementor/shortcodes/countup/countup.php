<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Countup_Widget extends Widget_Base {

	public function get_name() {
		return 'lte-countup';
	}

	public function get_title() {
		return esc_html__( 'Countup', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-counter';
	}
/*
	public function get_script_depends() {
		return [ 'jquery-numerator' ];
	}
*/
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
			'style',
			[
				'label' => esc_html__( 'Style', 'lte-ext' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'	=>	esc_html__( 'Animated', 'lte-ext' ),
					'static'	=>	esc_html__( 'Static', 'lte-ext' ),
				],
			]
		);	
/*
		$this->add_control(
			'duration',
			[
				'label' => esc_html__( 'Animation Duration', 'lte-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 2000,
				'min' => 100,
				'step' => 100,
			]
		);
*/
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'header', [
				'label' => esc_html__( 'Header', 'lte-ext' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
/*
		$repeater->add_control(
			'starting_number',
			[
				'label' => esc_html__( 'Starting Number', 'lte-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
			]
		);
*/
		$repeater->add_control(
			'ending_number',
			[
				'label' => esc_html__( 'Ending Number', 'lte-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 100,
			]
		);


		$repeater->add_control(
			'prefix',
			[
				'label' => esc_html__( 'Number Prefix', 'lte-ext' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => 1,
			]
		);

		$repeater->add_control(
			'suffix',
			[
				'label' => esc_html__( 'Number Suffix', 'lte-ext' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);
		
		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'lte-ext' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'label_block' => true,
			]
		);

		$this->add_control(
			'list',
			[
				'label' => __( 'Items', 'lte-ext' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ header }}}',
			]
		);		

		$this->end_controls_section();
	}

	protected function render() {

		wp_enqueue_script( 'counterup', lteGetPluginUrl('/elementor/shortcodes/countup/jquery.counterup.min.js'), array('jquery'), null, true );

		$settings = $this->get_settings_for_display();

		lte_sc_output('countup', $settings);
	}
}




