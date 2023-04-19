<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

class lte_Widget_Banner extends WP_Widget {
 
    /**
     * Widget constructor.
     */
    private $options;
    private $prefix;
    function __construct() {
 
        $this->prefix = "banner";
        $widget_ops = array( 'description' => esc_html__( 'Display two-col banner', 'lte-ext' ) );
        parent::__construct( false, esc_html__( 'LTE Banner', 'lte-ext' ), $widget_ops );
        
        // Create our options by using Unyson option types
        $this->options = array(         
            'href' => array(
                'label' => esc_html__( 'Link', 'lte-ext' ),
                'type' => 'text',
                'value' => '#',
            ),            
            'target' => array(
                'label' => esc_html__( 'Target', 'lte-ext' ),
                'type' => 'radio',
                'choices' => array(
                    'self' => esc_html__( 'Current window', 'lte-ext' ),
                    'blank' => esc_html__( 'New window', 'lte-ext' ),
                ), 'value' => 'self',
            ),            
            'text' => array(
                'label' => esc_html__( 'Text', 'lte-ext' ),
                'desc' => esc_html__( 'Use {{ brackets }} to highlight string', 'lte-ext' ),
                'type' => 'textarea',
            ),  
            'icon' => array(
                'label' => esc_html__( 'Icon', 'lte-ext' ),
                'type'  => 'icon-v2',
            ),                      
            'image' => array(
                'label' => esc_html__( 'Background Image', 'lte-ext' ),
                'type'  => 'upload',
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

                function lteBannerWidgetsReinit(selector) {                  

                    var timeoutId;
                    $("#" + selector).on("remove", function(){ // ReInit options on html replace (on widget Save)

                        clearTimeout(timeoutId);
                        timeoutId = setTimeout(function(){ // wait a few milliseconds for html replace to finish
                            fwEvents.trigger("fw:options:init", { $elements: $("#" + selector) });
                            lteBannerWidgetsReinit(selector);
                        }, 100);
                    });           
                }

                $("#widgets-right .fw-theme-admin-widget-wrap").each(function(i, el) { 
                    lteBannerWidgetsReinit($(this).attr("id"));
                });
            });
        ' );
    }
}

