<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

$limme_cfg = limme_theme_config();

$options = array(
    
    'limme_customizer' => array(
        'title' => esc_html__('Limme Colors', 'limme'),
        'position' => 1,
        'options' => array(

            'main_color' => array(
                'type' => 'color-picker',
                'value' => $limme_cfg['color_main'],
                'label' => esc_html__('Main Color', 'limme'),
            ),            
            'second_color' => array(
                'type' => 'color-picker',
                'value' => $limme_cfg['color_second'],
                'label' => esc_html__('Second Color', 'limme'),
            ),                
            'gray_color' => array(
                'type' => 'color-picker',
                'value' => $limme_cfg['color_gray'],
                'label' => esc_html__('Gray Color', 'limme'),
            ),
            'black_color' => array(
                'type' => 'color-picker',
                'value' => $limme_cfg['color_black'],
                'label' => esc_html__('Black Color', 'limme'),
            ),    
                          'white_color' => array(
                'type' => 'color-picker',
                'value' => $limme_cfg['color_white'],
                'label' => esc_html__('White Color', 'limme'),
            ),  
            'red_color' => array(
                'type' => 'color-picker',
                'value' => $limme_cfg['color_red'],
                'label' => esc_html__('Red Color', 'limme'),
            ),
            'green_color' => array(
                'type' => 'color-picker',
                'value' => $limme_cfg['color_green'],
                'label' => esc_html__('Green Color', 'limme'),
            ),            
            'yellow_color' => array(
                'type' => 'color-picker',
                'value' => $limme_cfg['color_yellow'],
                'label' => esc_html__('Green Color', 'limme'),
            ),               
                        
            'navbar_dark_color' => array(
                'type' => 'rgba-color-picker',
                'value' => $limme_cfg['navbar_dark'],
                'label' => esc_html__('Navbar Dark Color', 'limme'),
            ),      
        ),
    ),
);

