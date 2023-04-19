<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Navmenu_Widget extends Widget_Base {

	public function get_name() {
		return 'lte-navmenu';
	}

	public function get_title() {
		return esc_html__( 'Navmenu', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-nav-menu';
	}

	public function get_categories() {
		return [ 'lte-category' ];
	}

	protected function register_controls() {

        $menus_ = wp_get_nav_menus();
        $menus = array();
        if ( !empty($menus_) ) {

            foreach ($menus_ as $item) {

                $menus[$item->term_id] = $item->name;
            }
        }

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Layout', 'lte-ext' ),
			]
		);

			$this->add_control(
				'menu',
				[
					'label' => esc_html__( 'Menu', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'label_block' => true,
					'options' => $menus,
				]
			);		

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		lte_sc_output('navmenu', $settings);
	}
}




