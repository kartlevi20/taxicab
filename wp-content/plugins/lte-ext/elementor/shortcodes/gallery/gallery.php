<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Gallery_Widget extends Widget_Base {

	public function get_name() {
		return 'lte-gallery';
	}

	public function get_title() {
		return esc_html__( 'Gallery', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'lte-category' ];
	}

	protected function register_controls() {

		$albums = lteGetGalleryPosts();

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
					'raw' => esc_html__( "The content of galleries can be edited in Gallery menu of Dashboard.", 'lte-ext'),
				]
			);		

			$this->add_control(
				'layout',
				[
					'label' => esc_html__( 'Layout', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'static',
					'options' => [

						'slider'	=>	esc_html__( "Slider", 'lte-ext'),
						'static'	=>	esc_html__( "Static", 'lte-ext'),
					],
				]
			);	

			$this->add_control(
				'album',
				[
					'label' => esc_html__( 'Album', 'lte-ext' ),
					'type' => Controls_Manager::SELECT2,
					'label_block' => true,
					'default' => '',
					'options' => $albums,
				]
			);	

			$this->add_control(
				'limit',
				[
					'label' => esc_html__( 'Limit', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'default' => '6',
				]
			);

			$this->add_control(
				'links',
				[
					'label' => esc_html__( 'Lightbox Links', 'lte-ext' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		lte_sc_output('gallery', $settings);
	}
}




