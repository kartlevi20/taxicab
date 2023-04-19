<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class LTE_Instagram_Widget extends Widget_Base {

	public function get_name() {
		return 'lte-instagram';
	}

	public function get_title() {
		return esc_html__( 'Instagram', 'lte-ext' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
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
				'username',
				[
					'label' => esc_html__( 'Instagram Username', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
				]
			);		

			$this->add_control(
				'cache',
				[
					'label' => esc_html__( 'Cache, sec', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'description' => esc_html__( 'Recommended - 3600. Set empty to disable cache', 'lte-ext' ),
					'default' => 3600,
				]
			);		

			$this->add_control(
				'size',
				[
					'label' => esc_html__( 'Thumbnail Size', 'lte-ext' ),
					'type' => Controls_Manager::SELECT2,
					'label_block' => true,
					'default' => 2,
					'options' => [
						0	=>	'150px',
						1	=>	'240px',
						2	=>	'320px',
						3	=>	'480px',
						4	=>	'640px',
					],
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
				'header',
				[
					'label' => esc_html__( 'Header', 'lte-ext' ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'description' => esc_html__( 'Use {{ brackets }} to highlight string or leave empty.', 'lte-ext' ),
					'default' => esc_html__( 'Header {{ Subheader }}', 'lte-ext' ),
				]
			);			

			$this->add_control(
				'header-link',
				[
					'label' => esc_html__( 'Header Link', 'lte-ext' ),
					'type' => Controls_Manager::URL,
					'label_block' => true,
				]
			);		

		$this->end_controls_section();
	}

    protected function get_instagram_from_json( $username ) {

    	$username = str_replace( '@', '', trim( $username ) );
        $url = 'https://www.instagram.com/' .esc_attr($username) .'/?__a=1';
        $remote_get  = wp_remote_get( $url, array('timeout'	=>	5) );

        if ( !is_wp_error($remote_get ) ) {

	        $result = json_decode( wp_remote_retrieve_body( $remote_get  ), TRUE );

	        return $result;
        }
        	else {

        	return false;
        }
    }

    protected function get_instagram_items( $username, $cache ) {

    	$result = $this->get_instagram_from_json( $username );

    	$items = array();
    	if ( !empty($result['graphql']['user']['edge_owner_to_timeline_media']['edges']) ) {

    		foreach ( $result['graphql']['user']['edge_owner_to_timeline_media']['edges'] as $item ) {

    			$items[] = $item['node']['thumbnail_resources'];
    		}
    	}

    	if ( !empty( $items) AND !empty($cache) ) {

	        set_transient('lte-instagram-feed-'.esc_attr($username), json_encode($items), $settings['cache']);
    	}

    	return $items;
    }    

	protected function render() {

		$settings = $this->get_settings_for_display();

        if ( !empty( $settings['cache']) AND get_transient('lte-instagram-feed-'.esc_attr($settings['username'])) !== false ) {

            $items = json_decode(get_transient('lte-instagram-feed-'.esc_attr($settings['username'])), TRUE);
        }
        	else {

			$items = $this->get_instagram_items($settings['username'], $settings['cache']);
       	}

		if ( !empty($items) ) {

			$settings['items'] = $items;

			lte_sc_output('instagram', $settings);
		}
	}
}




