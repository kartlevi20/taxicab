<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Product_Categories_Widget extends Widget_Base {

   public function __construct($data = [], $args = null) {

		parent::__construct($data, $args);

		wp_enqueue_script('swiper');
		wp_enqueue_script('lte-frontend');
   }

	public function get_name() {
		return 'lte-product-categories';
	}

	public function get_title() {
		return esc_html__( 'Product Categories', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-product-categories';
	}

	public function get_categories() {
		return [ 'lte-category' ];
	}

	protected function register_controls() {

		$categories = get_categories( [ 'taxonomy' => 'product_cat', 'hide_empty'   => 0 ] );
		foreach ($categories as $item) {

			$cats[$item->term_id] = $item->name;
		}		

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Layout', 'lte-ext' ),
			]
		);

/*
			$this->add_control(
				'layout',
				[
					'label' => esc_html__( 'Layout', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'solid',
					'options' => [
						'circles'		=>	esc_html__( 'Circles', 'lte-ext'),
						'grid'		=>	esc_html__( 'Grid with Description', 'lte-ext'),
					],
				]
			);
*/
			$this->add_control(
				'limit',
				[
					'label' => esc_html__( 'Limit', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'default' => '4',
				]
			);

			$this->add_control(
				'columns',
				[
					'label' => esc_html__( 'Columns', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => '4',
					'options' => [
						1 => 1,
						2 => 2,
						3 => 3,
						4 => 4,
						5 => 5,
						6 => 6,
					],
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

			$this->add_control(
				'slider',
				[
					'label' => esc_html__( 'Slider', 'lte-ext' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => '',
				]
			);				

			$this->add_control(
				'slider-effect',
				[
					'label' => esc_html__( 'Slider Effect', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'coverflow',
					'options' => [
						'swipe'		=>	esc_html__( 'Swipe', 'lte-ext'),
						'coverflow'		=>	esc_html__( 'Coverflow', 'lte-ext'),
					],
					'condition' => ['slider' => [ 'yes' ] ],
				]
			);

/*
			$this->add_control(
				'orderby',
				[
					'label' => esc_html__( 'Order By', 'lte-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'menu_order',
					'options' => [
						'menu_order'	=>	esc_html__( 'Menu Order', 'lte-ext' ),
						'date'	=>	esc_html__( 'Date', 'lte-ext' ),
						'ID'	=>	esc_html__( 'ID', 'lte-ext' ),
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
*/
		$this->end_controls_section();

		$this->start_controls_section(
			'section_cols',
			[
				'label' => esc_html__( 'Responsive Columns', 'lte-ext' ),
				'condition' => ['slider' => [ 'yes' ] ],
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

		lte_sc_output('product-categories', $settings);
	}
}




