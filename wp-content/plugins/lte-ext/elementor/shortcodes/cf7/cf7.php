<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Cf7_Widget extends Widget_Base {
	
   public function __construct($data = [], $args = null) {

		parent::__construct($data, $args);

		wp_enqueue_script('lte-frontend');
   }

	public function get_name() {
		return 'lte-cf7';
	}

	public function get_title() {
		return esc_html__( 'Contact Form 7', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return [ 'lte-category' ];
	}

	protected function register_controls() {

		$contact_forms = array();
		$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

		if ( $cf7 ) {

			foreach ( $cf7 as $cform ) {

				$contact_forms[$cform->ID] = $cform->post_title;
			}
		}
			else {

			$contact_forms[0] = esc_html__( 'No contact forms found', 'lte-ext' );
		}

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Layout', 'lte-ext' ),
			]
		);

			$this->add_control(
				'form-id',
				[
					'label' => esc_html__( 'Contact Form', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'label_block' => true,
					'options' => $contact_forms,
					'description' => esc_html__( 'Select form created in Contacts menu of the dashboard', 'lte-ext' ),
				]
			);

			$this->add_control(
				'header',
				[
					'label' => esc_html__( 'Header', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'label_block'	=>	true,
				]
			);

			$this->add_control(
				'subheader',
				[
					'label' => esc_html__( 'Subheader', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'label_block'	=>	true,
				]
			);

			$this->add_control(
				'text',
				[
					'label' => esc_html__( 'Text', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'label_block'	=>	true,
				]
			);

			$this->add_control(
				'background',
				[
					'label' => esc_html__( 'Background', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'transparent'	=>	esc_html__( 'Transparent', 'lte-ext' ),
						'white'			=>	esc_html__( 'White', 'lte-ext' ),
						'main'			=>	esc_html__( 'Main', 'lte-ext' ),
						'gray'			=>	esc_html__('Gray', 'lte-ext'),						
						'black'			=>	esc_html__( 'Black', 'lte-ext' ),
					],
					'prefix_class' => 'lte-background-',
				]
			);
/*
			$this->add_control(
				'button-color',
				[
					'label' => esc_html__( 'Button Color', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default'	=>	'black',
					'options' => [
						'main'			=> esc_html__('Main', 'lte-ext'),
						'second'		=> esc_html__('Second', 'lte-ext'),
						'black'			=> esc_html__('Black', 'lte-ext'),
					],
				]
			);
*/
			$this->add_control(
				'padding',
				[
					'label' => esc_html__( 'Inner Padding', 'lte-ext' ),
					'type' => Controls_Manager::SWITCHER,
					'default'	=>	'yes',
				]
			);					

			$this->add_control(
				'button-full',
				[
					'label' => esc_html__( 'Full-width Button', 'lte-ext' ),
					'type' => Controls_Manager::SWITCHER,
					'default'	=>	'no',
				]
			);				
			
		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		lte_sc_output('cf7', $settings);
	}
}




