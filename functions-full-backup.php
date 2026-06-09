<?php
/**
 * Roaming Africa Theme Functions
 * Version: 2.0 (Modular)
 */

// Define theme constants
define('ROAMING_THEME_VERSION', '2.0');
define('ROAMING_THEME_DIR', get_template_directory());
define('ROAMING_THEME_URI', get_template_directory_uri());

// Theme setup
function roaming_africa_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'roaming_africa_setup');

// Enqueue scripts
function roaming_africa_scripts() {
    wp_enqueue_style('tailwindcss', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap');
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'roaming_africa_scripts');

// Register Safari CPT
function register_safari_cpt() {
    register_post_type('safari', array(
        'labels' => array('name' => 'Safaris', 'singular_name' => 'Safari'),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-palmtree',
        'show_in_rest' => true,
    ));
}
add_action('init', 'register_safari_cpt');

// Include required files
require_once get_template_directory() . '/inc/customizer/theme-customizer.php';
require_once get_template_directory() . '/inc/dynamic-nav.php';
require_once get_template_directory() . '/inc/hero-manager.php';
require_once get_template_directory() . '/inc/customizer/why-travel.php';
require_once get_template_directory() . '/inc/dynamic-sections.php';

// Hero slides function
if(!function_exists('roaming_get_hero_slides')) {
    function roaming_get_hero_slides() {
        $slides = get_option('roaming_hero_slides', array());
        $default_images = array(
            'https://images.unsplash.com/photo-1516426122078-c23e76319801?w=1600',
            'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?w=1600',
            'https://images.unsplash.com/photo-1536421462769-7c71d2e8ea9f?w=1600',
            'https://images.unsplash.com/photo-1570077188670-6e65c2d60404?w=1600',
        );
        
        if(empty($slides)) {
            $slides = array(
                array('title' => 'Welcome to Roaming Africa Tours & Safaris', 'subtitle' => 'Leading DMC for Kenya, Tanzania and Zanzibar', 'image' => $default_images[0], 'button_text' => 'Plan My Safari', 'button_url' => '/kenya-safaris'),
                array('title' => 'Elephants Under Kilimanjaro', 'subtitle' => 'Amboseli National Park · Luxury Lodges', 'image' => $default_images[1], 'button_text' => 'Explore Now', 'button_url' => '/destination/amboseli'),
                array('title' => 'Tanzania Wildlife, Curated by Locals', 'subtitle' => 'Serengeti · Ngorongoro Crater', 'image' => $default_images[2], 'button_text' => 'View Safaris', 'button_url' => '/tanzania-safaris'),
                array('title' => 'Zanzibar Beaches, Effortlessly Planned', 'subtitle' => 'Beach Resorts · Stone Town · Spice Tours', 'image' => $default_images[3], 'button_text' => 'Book Now', 'button_url' => '/tanzania-safaris/zanzibar'),
            );
        }
        return $slides;
    }
}
require_once get_template_directory() . '/inc/why-travel-admin.php';
