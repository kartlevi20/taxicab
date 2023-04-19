<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Slide_Background_Widget extends Widget_Base {

	public function get_name() {
		return 'lte-slide-background';
	}

	public function get_title() {
		return esc_html__( 'Slide Images', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-skill-bar';
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

		$repeater = new \Elementor\Repeater();

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
				'label' => esc_html__( 'Images', 'lte-ext' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ image }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		wp_enqueue_script( 'anime', lteGetPluginUrl('/elementor/shortcodes/slide-background/anime.min.js'), array(), null, true );
		wp_enqueue_script( 'slide-background', lteGetPluginUrl('/elementor/shortcodes/slide-background/jquery.slide_background.js'), array('jquery', 'anime') , null, true );

		$settings = $this->get_settings_for_display();
		lte_sc_output('slide-background', $settings);
	}
}




