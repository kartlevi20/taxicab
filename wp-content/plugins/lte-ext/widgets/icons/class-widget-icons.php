<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

class lte_Widget_Icons extends WP_Widget {
 
    /**
     * Widget constructor.
     */
    private $options;
    private $prefix;
    function __construct() {
 
        $this->prefix = "icons";
        $widget_ops = array( 'description' => esc_html__( 'Display font-awesome icons', 'lte-ext' ) );
        parent::__construct( false, esc_html__( 'LTE Icons', 'lte-ext' ), $widget_ops );
        
        // Create our options by using Unyson option types
        $this->options = array(
            'title' => array(
                'type' => 'text',
                'label' => esc_html__('Widget Title', 'lte-ext'),
            ),
			'list-type' => array(
				'label' => esc_html__( 'List type', 'lte-ext' ),
				'type' => 'radio',
				'choices' => array(
					'icons-list' => esc_html__( 'List with icons and text on right side', 'lte-ext' ),
                    'icons-top' => esc_html__( 'List with icons on the top', 'lte-ext' ),
//					'icons-inline-large' => esc_html__( 'Large icons inline list', 'lte-ext' ),
					'icons-inline-small' => esc_html__( 'Small icons inline list', 'lte-ext' ),
				), 'value' => esc_html__( 'icons-inline-small', 'lte-ext' ),
			),          
            'target' => array(
                'label' => esc_html__( 'Link Target', 'lte-ext' ),
                'type' => 'radio',
                'choices' => array(
                    'self' => esc_html__( 'Current window', 'lte-ext' ),
                    'blank' => esc_html__( 'New window', 'lte-ext' ),
                ), 'value' => 'self',
            ),            
			'items' => array(
				'label' => esc_html__( 'Items', 'lte-ext' ),
				'type' => 'addable-box',
				'value' => array(),
				'desc' => esc_html__( 'Items list with text on left side and button on right', 'lte-ext' ),
				'box-options' => array(
					'icon' => array(
						'label' => esc_html__( 'Icon', 'lte-ext' ),
						'type'  => 'icon-v2',
					),
                    'header' => array(
                        'label' => esc_html__( 'Header', 'lte-ext' ),
                        'desc' => esc_html__( '(only for icon top)', 'lte-ext' ),
                        'type' => 'textarea',
                    ),                    
					'text' => array(
						'label' => esc_html__( 'Text', 'lte-ext' ),
                        'desc' => esc_html__( 'User {{ brackets }} to highlight string', 'lte-ext' ),
						'type' => 'textarea',
					),
					'href' => array(
						'label' => esc_html__( 'Link', 'lte-ext' ),
						'type' => 'text',
						'value' => '#',
					),
				),
				'template' => '{{- header }}{{- text }}',
			),
        );

        add_action("admin_enqueue_scripts", array($this, "print_widget_javascript"));
    }
 
    function widget( $args, $instance ) {

        if ( !function_exists( 'fw' ) ) return false;

        extract( $args );
        $params = array();
 
        foreach ( $instance as $key => $value ) {
            $params[ $key ] = $value;
        }

        $instance = $params;
        if ( file_exists( LTE_PLUGIN_DIR . 'widgets/' . $this->prefix . '/views/widget.php' ) ) {

            include LTE_PLUGIN_DIR . 'widgets/' . $this->prefix . '/views/widget.php';
        }
    }
 
    function update( $new_instance, $old_instance ) {

        if ( !function_exists( 'fw' ) ) return false;

        return fw_get_options_values_from_input(
            $this->options,
            FW_Request::POST(fw_html_attr_name_to_array_multi_key($this->get_field_name($this->prefix)), array())
        );
    }
 
    function form( $values ) {
 
        $prefix = $this->get_field_id($this->prefix); // Get unique prefix, preventing dupplicated key
        $id = 'fw-widget-options-'. $prefix;
 
        // Print our options
        echo '<div class="fw-force-xs fw-theme-admin-widget-wrap" id="'. esc_attr($id) .'">';
        
        if ( function_exists( 'fw' ) ) {

            echo fw()->backend->render_options($this->options, $values, array(
                'id_prefix' => $prefix .'-',
                'name_prefix' => $this->get_field_name($this->prefix),
            ));
        }
            else {

            echo "<p>" . esc_html__( 'Widget requires Unyson Framework installed', 'lte-ext' ) . "</p>";
        }

        echo '</div>';

        return $values;
    }
    
    /*
     * Initialize options after saving.
     */
    function print_widget_javascript() {

    	wp_add_inline_script( 'jquery-core', '
            jQuery(function($) {

                function lteIconsWidgetsReinit(selector) {                  

                    var timeoutId;
                    $("#" + selector).on("remove", function(){ // ReInit options on html replace (on widget Save)

                        clearTimeout(timeoutId);
                        timeoutId = setTimeout(function(){ // wait a few milliseconds for html replace to finish
                            fwEvents.trigger("fw:options:init", { $elements: $("#" + selector) });
                            lteIconsWidgetsReinit(selector);
                        }, 100);
                    });           
                }

                $("#widgets-right .fw-theme-admin-widget-wrap").each(function(i, el) { 
                    lteIconsWidgetsReinit($(this).attr("id"));
                });
            });
        ' );
    }
}

