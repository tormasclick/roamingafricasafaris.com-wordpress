<?php
/**
 * Logo Customizer Controls
 */
function roaming_logo_customizer($wp_customize) {
    $wp_customize->add_section('roaming_logo_section', array(
        'title' => __('Logo Settings', 'roaming-africa'),
        'priority' => 20,
    ));
    
    $wp_customize->add_setting('roaming_logo_width', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('roaming_logo_width', array(
        'label' => __('Logo Width (px)', 'roaming-africa'),
        'section' => 'roaming_logo_section',
        'type' => 'number',
    ));
    
    $wp_customize->add_setting('roaming_logo_height', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('roaming_logo_height', array(
        'label' => __('Logo Height (px)', 'roaming-africa'),
        'section' => 'roaming_logo_section',
        'type' => 'number',
    ));
    
    $wp_customize->add_setting('roaming_logo_alignment', array(
        'default' => 'left',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('roaming_logo_alignment', array(
        'label' => __('Logo Alignment', 'roaming-africa'),
        'section' => 'roaming_logo_section',
        'type' => 'radio',
        'choices' => array('left' => 'Left', 'center' => 'Center'),
    ));
}
add_action('customize_register', 'roaming_logo_customizer');
