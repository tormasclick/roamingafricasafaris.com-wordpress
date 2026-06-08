<?php
/**
 * Theme Setup Functions
 */

// Theme supports
function roaming_theme_support() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height' => 80,
        'width' => 200,
        'flex-height' => true,
        'flex-width' => true,
    ));
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'roaming_theme_support');

// Register menus
function roaming_register_menus() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'roaming-africa'),
        'footer-kenya' => __('Footer - Kenya', 'roaming-africa'),
        'footer-tanzania' => __('Footer - Tanzania', 'roaming-africa'),
        'footer-quick' => __('Footer - Quick Links', 'roaming-africa'),
    ));
}
add_action('init', 'roaming_register_menus');

// Add custom image sizes
add_image_size('safari-card', 400, 300, true);
add_image_size('safari-hero', 1200, 600, true);
