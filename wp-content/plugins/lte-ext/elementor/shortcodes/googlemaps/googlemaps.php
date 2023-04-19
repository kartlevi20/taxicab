<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Modules\DynamicTags\Module as TagsModule;

class LTE_Googlemaps_Widget extends Widget_Base {

   public function __construct($data = [], $args = null) {

		parent::__construct($data, $args);

		wp_register_script( 'lte-googlemaps', lteGetPluginUrl('elementor/shortcodes/googlemaps/google-maps.js'), array('jquery'), null, true );

		if ( function_exists( 'FW' ) ) {

			$google_api = fw_get_db_settings_option( 'google_api' );

			wp_register_script(
				'google-maps-api-v3',
				'https://maps.googleapis.com/maps/api/js?v=3&key=' . esc_attr( $google_api ),
				array( 'jquery' ),
				'',
				true
			);	
		}

   }

	public function get_script_depends() {
		return [ 'lte-googlemaps', 'google-maps-api-v3' ];
	}

	public function get_name() {
		return 'lte-googlemaps';
	}

	public function get_title() {
		return esc_html__( 'Google Maps', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-google-maps';
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
				'important_note',
				[
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'raw' => __( "This shortcode requires correct Google Maps API connected and entered in Theme Settings. Check this <a href=\"//developers.google.com/maps/documentation/javascript/get-api-key\">article</a> about more information.<br><br>This shortcode is visible only on frontend sections of the site.<br><br>You can also use alternative Google Maps shortcode from basic section.", 'lte-ext'),
				]
			);		
/*
			$this->add_control(
				'location',
				[
					'label' => __( 'Location Type', 'lte-ext' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Address', 'lte-ext' ),
					'label_off' => __( 'Lat/Lng', 'lte-ext' ),
					'return_value' => 'address',
					'default' => 'address',
				]
			);			

			$default_address = __( 'London Eye, London, United Kingdom', 'lte-ext' );
			$this->add_control(
				'address',
				[
					'label' => __( 'Address', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
						'categories' => [
							TagsModule::POST_META_CATEGORY,
						],
					],
					'placeholder' => $default_address,
					'default' => $default_address,
					'label_block' => true,
				]
			);

*/
			$this->add_control(
				'lat',
				[
					'label' => esc_html__( 'Latitude', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'default'	=>	'40.7058253',
				]
			);

			$this->add_control(
				'lng',
				[
					'label' => esc_html__( 'Longitude', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'default'	=>	'-74.1180862',
				]
			);

			$this->add_control(
				'zoom',
				[
					'label' => __( 'Zoom', 'lte-ext' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 10,
					],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 20,
						],
					],
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'height',
				[
					'label' => __( 'Height', 'lte-ext' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 40,
							'max' => 1440,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 400,
					],					
				]
			);
	

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		lte_sc_output('googlemaps', $settings);
	}
}




