<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Blog_Widget extends Widget_Base {

	public function get_name() {
		return 'lte-blog';
	}

	public function get_title() {
		return esc_html__( 'Blog', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'lte-category' ];
	}

	protected function register_controls() {

		$categories = get_categories();
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
				'layout',
				[
					'label' => esc_html__( 'Layout', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'posts',
					'options' => [
						'featured-rows' => esc_html__( 'Featured Section', 'lte-ext' ),
						'posts' => esc_html__( 'Default', 'lte-ext' ),
					],
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
				'columns',
				[
					'label' => esc_html__( 'Columns', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => '3',
					'options' => [
						1 => 1,
						2 => 2,
						3 => 3,
						4 => 4,
					],
				]
			);

			$this->add_control(
				'excerpt_display',
				[
					'label' => esc_html__( 'Excerpt Display', 'lte-ext' ),
					'type' => Controls_Manager::SWITCHER,
				]
			);

			$this->add_control(
				'excerpt',
				[
					'label' => esc_html__( 'Excerpt Size', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'default' => '',
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
/*
			$this->add_control(
				'ids',
				[
					'label' => esc_html__( 'Filter IDs', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'description' => esc_html__("Enter IDs to show, separated by comma", 'lte-ext'),
					'default' => '',
				]
			);
*/
			$this->add_control(
				'orderby',
				[
					'label' => esc_html__( 'Order By', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'date',
					'options' => [
						'date'	=>	esc_html__( 'Date', 'lte-ext' ),
						'ID'	=>	esc_html__( 'ID', 'lte-ext' ),
						'menu_order'	=>	esc_html__( 'Menu Order', 'lte-ext' ),
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

		lte_sc_output('blog', $settings);
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	/*
	protected function _content_template() {
		?>
		<div class="title">
			{{{ settings.title }}}
		</div>
		<?php
	}
	*/
}




