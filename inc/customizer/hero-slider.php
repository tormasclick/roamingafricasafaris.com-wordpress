<?php
/**
 * Hero Slider Customizer Controls
 */

function roaming_hero_slider_customizer($wp_customize) {
    // Hero Slider Section
    $wp_customize->add_section('roaming_hero_slider', array(
        'title' => __('Hero Slider', 'roaming-africa'),
        'priority' => 25,
    ));
    
    // Number of slides
    $wp_customize->add_setting('roaming_slider_count', array(
        'default' => 4,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('roaming_slider_count', array(
        'label' => __('Number of Slides', 'roaming-africa'),
        'section' => 'roaming_hero_slider',
        'type' => 'number',
        'input_attrs' => array('min' => 1, 'max' => 10),
    ));
    
    // Slide settings (dynamic)
    for($i = 1; $i <= 10; $i++) {
        $wp_customize->add_setting("roaming_slide_{$i}_image", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "roaming_slide_{$i}_image", array(
            'label' => sprintf(__('Slide %d - Image', 'roaming-africa'), $i),
            'section' => 'roaming_hero_slider',
            'settings' => "roaming_slide_{$i}_image",
        )));
        
        $wp_customize->add_setting("roaming_slide_{$i}_title", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("roaming_slide_{$i}_title", array(
            'label' => sprintf(__('Slide %d - Title', 'roaming-africa'), $i),
            'section' => 'roaming_hero_slider',
            'type' => 'text',
        ));
        
        $wp_customize->add_setting("roaming_slide_{$i}_subtitle", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("roaming_slide_{$i}_subtitle", array(
            'label' => sprintf(__('Slide %d - Subtitle', 'roaming-africa'), $i),
            'section' => 'roaming_hero_slider',
            'type' => 'text',
        ));
    }
}
add_action('customize_register', 'roaming_hero_slider_customizer');

// Get slides data
function roaming_get_slides() {
    $count = get_theme_mod('roaming_slider_count', 4);
    $slides = array();
    
    for($i = 1; $i <= $count; $i++) {
        $image = get_theme_mod("roaming_slide_{$i}_image");
        if(!empty($image)) {
            $slides[] = array(
                'image' => $image,
                'title' => get_theme_mod("roaming_slide_{$i}_title", "Welcome to Roaming Africa Tours & Safaris"),
                'subtitle' => get_theme_mod("roaming_slide_{$i}_subtitle", "Leading DMC for Kenya, Tanzania and Zanzibar"),
            );
        }
    }
    
    // Default slides if none configured
    if(empty($slides)) {
        $slides = array(
            array(
                'image' => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?w=1600',
                'title' => 'Welcome to Roaming Africa Tours & Safaris',
                'subtitle' => 'Leading DMC for Kenya, Tanzania and Zanzibar',
            ),
            array(
                'image' => 'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?w=1600',
                'title' => 'Elephants Under Kilimanjaro',
                'subtitle' => 'Amboseli National Park · Luxury Lodges',
            ),
            array(
                'image' => 'https://images.unsplash.com/photo-1536421462769-7c71d2e8ea9f?w=1600',
                'title' => 'Tanzania Wildlife, Curated by Locals',
                'subtitle' => 'Serengeti · Ngorongoro Crater',
            ),
            array(
                'image' => 'https://images.unsplash.com/photo-1570077188670-6e65c2d60404?w=1600',
                'title' => 'Zanzibar Beaches, Effortlessly Planned',
                'subtitle' => 'Beach Resorts · Stone Town · Spice Tours',
            ),
        );
    }
    
    return $slides;
}
