<?php
/**
 * Why Travel With Us - Full Customizer Controls
 */

function roaming_why_travel_customizer($wp_customize) {
    // Why Travel Section
    $wp_customize->add_section('roaming_why_travel', array(
        'title' => __('Why Travel With Us', 'roaming-africa'),
        'priority' => 35,
    ));
    
    // Small Label (Yellow text above title)
    $wp_customize->add_setting('roaming_why_travel_label', array(
        'default' => 'Why travel with us',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('roaming_why_travel_label', array(
        'label' => __('Small Label (Yellow Text)', 'roaming-africa'),
        'description' => __('The small uppercase text above the main title', 'roaming-africa'),
        'section' => 'roaming_why_travel',
        'type' => 'text',
    ));
    
    // Main Title
    $wp_customize->add_setting('roaming_why_travel_title', array(
        'default' => 'Why Travel With Roaming Africa Tours &amp; Safaris',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('roaming_why_travel_title', array(
        'label' => __('Main Title', 'roaming-africa'),
        'section' => 'roaming_why_travel',
        'type' => 'text',
    ));
    
    // Subtitle / Description
    $wp_customize->add_setting('roaming_why_travel_subtitle', array(
        'default' => 'Established in 2006, Roaming Africa Tours and Safaris combines destination management expertise with local knowledge to create seamless journeys across Kenya, Tanzania and Zanzibar.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('roaming_why_travel_subtitle', array(
        'label' => __('Subtitle / Description', 'roaming-africa'),
        'section' => 'roaming_why_travel',
        'type' => 'textarea',
    ));
    
    // Enable/Disable Section
    $wp_customize->add_setting('roaming_why_travel_enabled', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('roaming_why_travel_enabled', array(
        'label' => __('Enable Section', 'roaming-africa'),
        'section' => 'roaming_why_travel',
        'type' => 'checkbox',
    ));
}
add_action('customize_register', 'roaming_why_travel_customizer');
