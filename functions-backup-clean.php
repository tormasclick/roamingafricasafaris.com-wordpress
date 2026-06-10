<?php
/**
 * Roaming Africa Theme Functions - Modular Version
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
    register_nav_menus(array('primary' => __('Primary Menu', 'roaming-africa'), 'footer' => __('Footer Menu', 'roaming-africa')));
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

// Include modular files
require_once ROAMING_THEME_DIR . '/inc/customizer/theme-customizer.php';
require_once ROAMING_THEME_DIR . '/inc/dynamic-nav.php';
require_once ROAMING_THEME_DIR . '/inc/hero-manager.php';
require_once ROAMING_THEME_DIR . '/inc/why-travel-admin.php';
require_once ROAMING_THEME_DIR . '/inc/destinations-admin.php';
require_once ROAMING_THEME_DIR . '/inc/booking-steps-admin.php';
require_once ROAMING_THEME_DIR . '/inc/partners-admin.php';
require_once ROAMING_THEME_DIR . '/inc/final-cta-admin.php';
require_once ROAMING_THEME_DIR . '/inc/footer-admin.php';
require_once ROAMING_THEME_DIR . '/inc/featured-safaris-admin.php';
require_once ROAMING_THEME_DIR . '/inc/meta-boxes/safari-meta-boxes.php';

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

// Helper functions
function roaming_get_destinations() { return get_option('roaming_destinations', array()); }
function roaming_get_cta() {
    return array(
        'enabled' => get_option('roaming_cta_enabled', true),
        'title' => get_option('roaming_cta_title', 'Ready for Your Safari Adventure?'),
        'subtitle' => get_option('roaming_cta_subtitle', 'Contact us today to start planning your dream African safari'),
        'button_text' => get_option('roaming_cta_button_text', 'Get in Touch →'),
        'button_url' => get_option('roaming_cta_button_url', '/contact')
    );
}
function roaming_get_planner_destinations() { return get_option('roaming_planner_destinations_list', array('Kenya Safari', 'Tanzania Safari', 'Zanzibar Beach', 'Combo Safari')); }
function roaming_get_planner_title() { return get_option('roaming_planner_title', 'Plan Your Safari'); }

// Register Custom Post Types
function register_safari_cpt() {
    register_post_type('safari', array('labels' => array('name' => 'Safaris', 'singular_name' => 'Safari'), 'public' => true, 'has_archive' => true, 'supports' => array('title', 'editor', 'thumbnail', 'excerpt'), 'menu_icon' => 'dashicons-palmtree', 'show_in_rest' => true));
}
add_action('init', 'register_safari_cpt');

function register_destination_cpt() {
    register_post_type('destination', array('labels' => array('name' => 'Destinations', 'singular_name' => 'Destination', 'menu_name' => 'Destinations'), 'public' => true, 'rewrite' => array('slug' => 'destination'), 'has_archive' => true, 'menu_icon' => 'dashicons-location-alt', 'supports' => array('title', 'editor', 'thumbnail', 'excerpt'), 'show_in_rest' => true));
}
add_action('init', 'register_destination_cpt');

function register_hotel_cpt() {
    register_post_type('hotel', array('labels' => array('name' => 'Hotels & Lodges', 'singular_name' => 'Hotel', 'menu_name' => 'Hotels'), 'public' => true, 'rewrite' => array('slug' => 'hotel'), 'has_archive' => true, 'menu_icon' => 'dashicons-building', 'supports' => array('title', 'editor', 'thumbnail', 'excerpt'), 'show_in_rest' => true));
}
add_action('init', 'register_hotel_cpt');

function register_vehicle_cpt() {
    register_post_type('vehicle', array('labels' => array('name' => 'Safari Vehicles', 'singular_name' => 'Vehicle', 'menu_name' => 'Vehicles'), 'public' => true, 'rewrite' => array('slug' => 'vehicle'), 'has_archive' => true, 'menu_icon' => 'dashicons-car', 'supports' => array('title', 'editor', 'thumbnail', 'excerpt'), 'show_in_rest' => true));
}
add_action('init', 'register_vehicle_cpt');

// Destination meta boxes
function destination_add_meta_boxes() {
    add_meta_box('destination_details', 'Destination Details', 'destination_details_callback', 'destination', 'normal', 'high');
}
add_action('add_meta_boxes', 'destination_add_meta_boxes');

function destination_details_callback($post) {
    wp_nonce_field('destination_details', 'destination_details_nonce');
    ?>
    <p><label>Country:</label><br><input type="text" name="destination_country" value="<?php echo esc_attr(get_post_meta($post->ID, '_destination_country', true)); ?>" style="width:100%"></p>
    <p><label>Best Time to Visit:</label><br><input type="text" name="destination_best_time" value="<?php echo esc_attr(get_post_meta($post->ID, '_destination_best_time', true)); ?>" style="width:100%"></p>
    <p><label>Wildlife / Highlights:</label><br><textarea name="destination_wildlife" rows="3" style="width:100%"><?php echo esc_textarea(get_post_meta($post->ID, '_destination_wildlife', true)); ?></textarea></p>
    <?php
}

function destination_save_meta_boxes($post_id) {
    if(!isset($_POST['destination_details_nonce']) || !wp_verify_nonce($_POST['destination_details_nonce'], 'destination_details')) return;
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    foreach(['destination_country', 'destination_best_time', 'destination_wildlife'] as $field) {
        if(isset($_POST[$field])) update_post_meta($post_id, "_$field", sanitize_text_field($_POST[$field]));
    }
}
add_action('save_post_destination', 'destination_save_meta_boxes');

// Hotel meta boxes
function hotel_add_meta_boxes() {
    add_meta_box('hotel_details', 'Hotel Details', 'hotel_details_callback', 'hotel', 'normal', 'high');
}
add_action('add_meta_boxes', 'hotel_add_meta_boxes');

function hotel_details_callback($post) {
    wp_nonce_field('hotel_details', 'hotel_details_nonce');
    ?>
    <p><label>Location:</label><br><input type="text" name="hotel_location" value="<?php echo esc_attr(get_post_meta($post->ID, '_hotel_location', true)); ?>" style="width:100%"></p>
    <p><label>Price From (per night):</label><br><input type="text" name="hotel_price_from" value="<?php echo esc_attr(get_post_meta($post->ID, '_hotel_price_from', true)); ?>" style="width:100%"></p>
    <p><label>Tier:</label><br><select name="hotel_tier" style="width:100%"><option value="luxury" <?php selected(get_post_meta($post->ID, '_hotel_tier', true), 'luxury'); ?>>Luxury</option><option value="mid-range" <?php selected(get_post_meta($post->ID, '_hotel_tier', true), 'mid-range'); ?>>Mid-Range</option><option value="budget" <?php selected(get_post_meta($post->ID, '_hotel_tier', true), 'budget'); ?>>Budget</option></select></p>
    <?php
}

function hotel_save_meta_boxes($post_id) {
    if(!isset($_POST['hotel_details_nonce']) || !wp_verify_nonce($_POST['hotel_details_nonce'], 'hotel_details')) return;
    foreach(['hotel_location', 'hotel_price_from', 'hotel_tier'] as $field) {
        if(isset($_POST[$field])) update_post_meta($post_id, "_$field", sanitize_text_field($_POST[$field]));
    }
}
add_action('save_post_hotel', 'hotel_save_meta_boxes');

// Vehicle meta boxes (simplified)
function vehicle_add_meta_boxes() {
    add_meta_box('vehicle_details', 'Vehicle Details', 'vehicle_details_callback', 'vehicle', 'normal', 'high');
}
add_action('add_meta_boxes', 'vehicle_add_meta_boxes');

function vehicle_details_callback($post) {
    wp_nonce_field('vehicle_details', 'vehicle_details_nonce');
    ?>
    <p><label>Capacity:</label><br><input type="text" name="vehicle_capacity" value="<?php echo esc_attr(get_post_meta($post->ID, '_vehicle_capacity', true)); ?>" style="width:100%"></p>
    <p><label>Type:</label><br><select name="vehicle_type" style="width:100%"><option value="safari" <?php selected(get_post_meta($post->ID, '_vehicle_type', true), 'safari'); ?>>Safari</option><option value="self-drive" <?php selected(get_post_meta($post->ID, '_vehicle_type', true), 'self-drive'); ?>>Self Drive</option><option value="bus" <?php selected(get_post_meta($post->ID, '_vehicle_type', true), 'bus'); ?>>Bus</option></select></p>
    <p><label>Price From (per day):</label><br><input type="text" name="vehicle_price_from" value="<?php echo esc_attr(get_post_meta($post->ID, '_vehicle_price_from', true)); ?>" style="width:100%"></p>
    <?php
}

function vehicle_save_meta_boxes($post_id) {
    if(!isset($_POST['vehicle_details_nonce']) || !wp_verify_nonce($_POST['vehicle_details_nonce'], 'vehicle_details')) return;
    foreach(['vehicle_capacity', 'vehicle_type', 'vehicle_price_from'] as $field) {
        if(isset($_POST[$field])) update_post_meta($post_id, "_$field", sanitize_text_field($_POST[$field]));
    }
}
add_action('save_post_vehicle', 'vehicle_save_meta_boxes');

// Get featured functions
function roaming_get_featured_destinations() {
    return get_posts(array('post_type' => 'destination', 'posts_per_page' => 8, 'meta_key' => '_thumbnail_id', 'orderby' => 'date', 'order' => 'DESC'));
}
function roaming_get_featured_hotels() {
    return get_posts(array('post_type' => 'hotel', 'posts_per_page' => 4, 'meta_key' => '_thumbnail_id', 'orderby' => 'date', 'order' => 'DESC'));
}
function roaming_get_featured_vehicles() {
    return get_posts(array('post_type' => 'vehicle', 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC'));
}

// Add custom CSS for Contact Form 7 hover effects
function safari_cf7_styles() {
    if(is_singular('safari')) {
        echo '<style>
            .cf7-submit:hover {
                background: #e09510 !important;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(245,166,35,0.3);
            }
            .safari-booking-form input:focus,
            .safari-booking-form select:focus,
            .safari-booking-form textarea:focus {
                border-color: #298742 !important;
                outline: none;
                box-shadow: 0 0 0 3px rgba(41,135,66,0.1);
            }
            .safari-booking-form input:hover,
            .safari-booking-form select:hover,
            .safari-booking-form textarea:hover {
                border-color: #298742 !important;
            }
            .wpcf7-spinner {
                position: absolute;
                right: 20px;
                top: 50%;
                transform: translateY(-50%);
            }
            .wpcf7-response-output {
                margin: 16px 0 0 !important;
                padding: 12px !important;
                border-radius: 12px !important;
                text-align: center;
            }
            .wpcf7-not-valid-tip {
                font-size: 11px;
                color: #dc3232;
                margin-top: 4px;
            }
        </style>';
    }
}
add_action('wp_head', 'safari_cf7_styles');

// Add Contact Form 7 custom styling

// Add Contact Form 7 custom styling for safari pages
function safari_cf7_custom_styles() {
    if(is_singular('safari')) {
        echo '<style>
        .safari-booking-form .form-group { margin-bottom: 16px; }
        .safari-booking-form .form-group label { display: block; font-size: 12px; font-weight: 700; color: #374151; margin-bottom: 6px; }
        .safari-booking-form .form-control { width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 14px; background: white; box-sizing: border-box; }
        .safari-booking-form .form-control:focus { border-color: #298742; outline: none; }
        .safari-booking-form select.form-control { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'%23666\'%3E%3Cpath stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M19 9l-7 7-7-7\'%3E%3C/path%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; }
        .safari-booking-form .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
        .safari-booking-form .cf7-submit { width: 100%; background: #F5A623; color: #1a3c2c; padding: 14px; border-radius: 40px; font-weight: 700; font-size: 16px; border: none; cursor: pointer; margin-top: 8px; }
        .safari-booking-form .cf7-submit:hover { background: #e09510; }
        @media (max-width: 640px) { .safari-booking-form .form-row-2 { grid-template-columns: 1fr; gap: 0; } }
        </style>';
    }
}
add_action('wp_head', 'safari_cf7_custom_styles');

// Add Contact Form 7 custom styling with reduced spacing
function safari_cf7_custom_styles() {
    if(is_singular('safari')) {
        echo '<style>
        .safari-booking-form .form-group {
            margin-bottom: 8px;
        }
        .safari-booking-form .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 14px;
            background: white;
            box-sizing: border-box;
            transition: all 0.3s;
            font-family: inherit;
        }
        .safari-booking-form .form-control:focus {
            border-color: #298742;
            outline: none;
            box-shadow: 0 0 0 3px rgba(41,135,66,0.1);
        }
        .safari-booking-form select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'%23666\'%3E%3Cpath stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M19 9l-7 7-7-7\'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 16px;
            cursor: pointer;
        }
        .safari-booking-form .form-row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 8px;
        }
        .safari-booking-form .cf7-submit {
            width: 100%;
            background: #F5A623;
            color: #1a3c2c;
            padding: 12px;
            border-radius: 40px;
            font-weight: 700;
            font-size: 15px;
            border: none;
            cursor: pointer;
            margin-top: 8px;
            transition: all 0.3s;
        }
        .safari-booking-form .cf7-submit:hover {
            background: #e09510;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(245,166,35,0.3);
        }
        .safari-booking-form .wpcf7-spinner {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }
        .safari-booking-form .wpcf7-not-valid-tip {
            font-size: 11px;
            color: #dc3232;
            margin-top: 4px;
        }
        .safari-booking-form .wpcf7-response-output {
            margin: 16px 0 0 !important;
            padding: 12px !important;
            border-radius: 12px !important;
            text-align: center;
        }
        @media (max-width: 640px) {
            .safari-booking-form .form-row-2 {
                grid-template-columns: 1fr;
                gap: 8px;
            }
        }
        </style>';
    }
}
add_action('wp_head', 'safari_cf7_custom_styles');
