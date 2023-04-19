<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Products_Widget extends Widget_Base {

   public function __construct($data = [], $args = null) {

		parent::__construct($data, $args);

		wp_enqueue_script('swiper');
		wp_enqueue_script('lte-frontend');
   }

	public function get_script_depends() {
		return [ 'lte-frontend' ];
	}

	public function get_name() {
		return 'lte-products';
	}

	public function get_title() {
		return esc_html__( 'Products', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-products';
	}

	public function get_categories() {
		return [ 'lte-category' ];
	}

	protected function register_controls() {

		$categories = get_categories( [ 'taxonomy' => 'product_cat'] );
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
					'raw' => esc_html__( "The Frontend display of products layout may by different due to the limits of Elementor.", 'lte-ext'),
				]
			);		

			$this->add_control(
				'layout',
				[
					'label' => esc_html__( 'Layout', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'simple',
					'options' => [
						'simple'		=>	esc_html__( 'Simple', 'lte-ext'),
						'slider'		=>	esc_html__( 'Slider', 'lte-ext'),
						'slider-filter'	=>	esc_html__( 'Categories filter with Slider', 'lte-ext'),
						'simple-filter'	=>	esc_html__( 'Categories filter without Slider', 'lte-ext'),
					],
				]
			);

			$this->add_control(
				'style',
				[
					'label' => esc_html__( 'Style', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default'	=>	esc_html__( 'Default', 'lte-ext'),				
					],
				]
			);

			$this->add_control(
				'categories-align',
				[
					'label' => esc_html__( 'Categories Align', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'center',
					'options' => [
						'left'		=>	esc_html__( 'Left', 'lte-ext'),
						'center'	=>	esc_html__( 'Center', 'lte-ext'),
						'right'		=>	esc_html__( 'Right', 'lte-ext'),
					],
					'condition' => ['layout' => ['slider-filter', 'simple-filter'] ],
				]
			);

			$this->add_control(
				'categories-active-color',
				[
					'label' => esc_html__( 'Category Active Color', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'main',
					'options' => [
						'main'		=>	esc_html__( 'Main', 'lte-ext'),
						'second'	=>	esc_html__( 'Second', 'lte-ext'),
					],
					'condition' => ['layout' => ['slider-filter', 'simple-filter'] ],
				]
			);

			$this->add_control(
				'limit',
				[
					'label' => esc_html__( 'Limit', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'default' => '4',
				]
			);
/*
			$this->add_control(
				'columns',
				[
					'label' => esc_html__( 'Columns', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'description' => esc_html__( 'Can be overrided by responsive columns tab', 'lte-ext' ),
					'default' => '4',
					'options' => [ 1 => 1, 2, 3, 4, 5, 6 ],
					'condition' => ['layout' => ['simple', 'simple-filter'] ],
				]
			);
*/
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

			$this->add_control(
				'ids',
				[
					'label' => esc_html__( 'Filter Ids', 'lte-ext' ),
					'description' => esc_html__( 'Coma separated', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
				]
			);			

			$this->add_control(
				'featured',
				[
					'label' => esc_html__( 'Featured Only', 'lte-ext' ),
					'type' => Controls_Manager::SWITCHER,
				]
			);

			$this->add_control(
				'orderby',
				[
					'label' => esc_html__( 'Order By', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'menu_order',
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

			$this->add_control(
				'excerpt',
				[
					'label' => esc_html__( 'Excerpt', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'description' => esc_html__( 'Default settings can be set in Theme Settings', 'lte-ext' ),
					'default' => 'default',
					'options' => [
						'default' => esc_html__( 'Default', 'lte-ext' ),
						'enabled' => esc_html__( 'Force Display', 'lte-ext' ),
						'disabled' => esc_html__( 'Force Hide', 'lte-ext' )
					],
				]
			);

			$this->add_control(
				'excerpt_size',
				[
					'label' => esc_html__( 'Excerpt Cut, words', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'description' => esc_html__( 'Leave empty to set default from Theme Settings', 'lte-ext' ),
					'condition' => ['excerpt' => ['enabled'] ],
				]
			);

			$this->add_control(
				'padding',
				[
					'label' => esc_html__( 'Inner Padding', 'lte-ext' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider',
			[
				'label' => esc_html__( 'Slider', 'lte-ext' ),
				'condition' => ['layout' => ['slider', 'slider-filter'] ],
			]
		);

			$this->add_control(
				'swiper_arrows',
				[
					'label' => esc_html__( 'Arrows', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'disabled',
					'options' => [
						'false' => esc_html__( 'Disabled', 'lte-ext' ),
						'sides-outside' => esc_html__( 'Sides', 'lte-ext' ),
						'bottom' => esc_html__( 'Bottom', 'lte-ext' ),
					],
				]
			);

			$this->add_control(
				'swiper_pagination',
				[
					'label' => esc_html__( 'Bullets', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'disabled',
					'options' => [
						'false' => esc_html__( 'Disabled', 'lte-ext' ),
						'bullets' => esc_html__( 'Bullets', 'lte-ext' ),
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cols',
			[
				'label' => esc_html__( 'Responsive Columns', 'lte-ext' ),
			]
		);

			$swiper_items = [
				'xl'	=>	[ esc_html__( 'Extra Large Desktop, 1600px', 'limme' ), 4],
				'lg'	=>	[ esc_html__( 'Large Desktop, 1200px,', 'limme' ), 4],
				'md'	=>	[ esc_html__( 'Notebook, 1000px', 'limme' ), 4],
				'sm'	=>	[ esc_html__( 'Tablet, 768px', 'limme' ), 3],
				'ms'	=>	[ esc_html__( 'Horizontal Mobile, 480px', 'limme' ), 3],
				'xs'	=>	[ esc_html__( 'Mobile', 'limme' ), 1],
			];

			foreach ( $swiper_items as $bp => $item ) {

				$this->add_control(
					'columns_' . $bp,
					[
						'label' => $item[0],
						'type' => Controls_Manager::SELECT,
						'label_block' => true,
						'default' => $item[1],
						'options' => [ 1 => 1, 2, 3, 4, 5, 6 ],
					]
				);				
			}


		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		lte_sc_output('products', $settings);
	}
}




