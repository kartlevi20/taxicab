<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Rental_Search_Widget extends Widget_Base {
	
   public function __construct($data = [], $args = null) {

		parent::__construct($data, $args);

		wp_enqueue_script('lte-frontend');
   }

	public function get_name() {
		return 'lte-rental-search';
	}

	public function get_title() {
		return esc_html__( 'Rental Search', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-post-list';
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
				'style',
				[
					'label' => esc_html__( 'Layout', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'pattern',
					'options' => [

						'pattern'	=>	esc_html__( "Limousine", 'lte-ext'),
						'gray'	=>	esc_html__( "Car", 'lte-ext'),
					],
				]
			);				

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		lte_sc_output('rental-search', $settings);
	}
}




