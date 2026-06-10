<?php
/**
 * Roaming Africa Theme Functions
 * Version: 2.0 (Clean)
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
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'roaming-africa'),
        'footer' => __('Footer Menu', 'roaming-africa'),
    ));
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
require_once get_template_directory() . '/inc/why-travel-admin.php';

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

// Helper function for destinations (if needed for frontend)
function roaming_get_destinations() {
    return get_option('roaming_destinations', array());
}
require_once get_template_directory() . '/inc/destinations-admin.php';

// Direct function definition for navigation

// CTA Section functions
function roaming_get_cta() {
    return array(
        'enabled' => get_option('roaming_cta_enabled', true),
        'title' => get_option('roaming_cta_title', 'Ready for Your Safari Adventure?'),
        'subtitle' => get_option('roaming_cta_subtitle', 'Contact us today to start planning your dream African safari'),
        'button_text' => get_option('roaming_cta_button_text', 'Get in Touch →'),
        'button_url' => get_option('roaming_cta_button_url', '/contact')
    );
}

// Safari Planner functions
function roaming_get_planner_destinations() {
    return get_option('roaming_planner_destinations_list', array('Kenya Safari', 'Tanzania Safari', 'Zanzibar Beach', 'Combo Safari'));
}

// Also add planner title function if missing
function roaming_get_planner_title() {
    return get_option('roaming_planner_title', 'Plan Your Safari');
}

// Register Destinations Custom Post Type
function register_destination_cpt() {
    $labels = array(
        'name' => 'Destinations',
        'singular_name' => 'Destination',
        'menu_name' => 'Destinations',
        'add_new' => 'Add New Destination',
        'add_new_item' => 'Add New Destination',
        'edit_item' => 'Edit Destination',
        'new_item' => 'New Destination',
        'view_item' => 'View Destination',
        'search_items' => 'Search Destinations',
        'not_found' => 'No destinations found',
        'not_found_in_trash' => 'No destinations found in trash',
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'destination'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-location-alt',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest' => true, // Gutenberg support
    );
    
    register_post_type('destination', $args);
}
add_action('init', 'register_destination_cpt');

// Add custom meta boxes for destination details
function destination_add_meta_boxes() {
    add_meta_box(
        'destination_details',
        'Destination Details',
        'destination_details_callback',
        'destination',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'destination_add_meta_boxes');

function destination_details_callback($post) {
    wp_nonce_field('destination_details', 'destination_details_nonce');
    $country = get_post_meta($post->ID, '_destination_country', true);
    $best_time = get_post_meta($post->ID, '_destination_best_time', true);
    $wildlife = get_post_meta($post->ID, '_destination_wildlife', true);
    ?>
    <p>
        <label>Country:</label>
        <input type="text" name="destination_country" value="<?php echo esc_attr($country); ?>" style="width:100%">
    </p>
    <p>
        <label>Best Time to Visit:</label>
        <input type="text" name="destination_best_time" value="<?php echo esc_attr($best_time); ?>" style="width:100%">
    </p>
    <p>
        <label>Wildlife / Highlights:</label>
        <textarea name="destination_wildlife" rows="3" style="width:100%"><?php echo esc_textarea($wildlife); ?></textarea>
    </p>
    <?php
}

function destination_save_meta_boxes($post_id) {
    if(!isset($_POST['destination_details_nonce'])) return;
    if(!wp_verify_nonce($_POST['destination_details_nonce'], 'destination_details')) return;
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    
    if(isset($_POST['destination_country'])) {
        update_post_meta($post_id, '_destination_country', sanitize_text_field($_POST['destination_country']));
    }
    if(isset($_POST['destination_best_time'])) {
        update_post_meta($post_id, '_destination_best_time', sanitize_text_field($_POST['destination_best_time']));
    }
    if(isset($_POST['destination_wildlife'])) {
        update_post_meta($post_id, '_destination_wildlife', sanitize_textarea_field($_POST['destination_wildlife']));
    }
}
add_action('save_post_destination', 'destination_save_meta_boxes');

// Get featured destinations for homepage
function roaming_get_featured_destinations() {
    return get_posts(array(
        'post_type' => 'destination',
        'posts_per_page' => 8,
        'meta_key' => '_thumbnail_id',
        'orderby' => 'date',
        'order' => 'DESC'
    ));
}

// Register Hotels Custom Post Type
function register_hotel_cpt() {
    $labels = array(
        'name' => 'Hotels & Lodges',
        'singular_name' => 'Hotel',
        'menu_name' => 'Hotels',
        'add_new' => 'Add New Hotel',
        'add_new_item' => 'Add New Hotel',
        'edit_item' => 'Edit Hotel',
        'new_item' => 'New Hotel',
        'view_item' => 'View Hotel',
        'search_items' => 'Search Hotels',
        'not_found' => 'No hotels found',
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'hotel'),
        'capability_type' => 'post',
        'has_archive' => true,
        'menu_position' => 21,
        'menu_icon' => 'dashicons-building',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
    );
    
    register_post_type('hotel', $args);
}
add_action('init', 'register_hotel_cpt');

// Add custom meta boxes for hotel details
function hotel_add_meta_boxes() {
    add_meta_box(
        'hotel_details',
        'Hotel Details',
        'hotel_details_callback',
        'hotel',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'hotel_add_meta_boxes');

function hotel_details_callback($post) {
    wp_nonce_field('hotel_details', 'hotel_details_nonce');
    $location = get_post_meta($post->ID, '_hotel_location', true);
    $price_from = get_post_meta($post->ID, '_hotel_price_from', true);
    $tier = get_post_meta($post->ID, '_hotel_tier', true);
    ?>
    <p>
        <label>Location:</label>
        <input type="text" name="hotel_location" value="<?php echo esc_attr($location); ?>" style="width:100%">
    </p>
    <p>
        <label>Price From (per night):</label>
        <input type="text" name="hotel_price_from" value="<?php echo esc_attr($price_from); ?>" placeholder="$220" style="width:100%">
    </p>
    <p>
        <label>Tier:</label>
        <select name="hotel_tier" style="width:100%">
            <option value="luxury" <?php selected($tier, 'luxury'); ?>>Luxury</option>
            <option value="mid-range" <?php selected($tier, 'mid-range'); ?>>Mid-Range</option>
            <option value="budget" <?php selected($tier, 'budget'); ?>>Budget</option>
        </select>
    </p>
    <?php
}

function hotel_save_meta_boxes($post_id) {
    if(!isset($_POST['hotel_details_nonce'])) return;
    if(!wp_verify_nonce($_POST['hotel_details_nonce'], 'hotel_details')) return;
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    
    if(isset($_POST['hotel_location'])) {
        update_post_meta($post_id, '_hotel_location', sanitize_text_field($_POST['hotel_location']));
    }
    if(isset($_POST['hotel_price_from'])) {
        update_post_meta($post_id, '_hotel_price_from', sanitize_text_field($_POST['hotel_price_from']));
    }
    if(isset($_POST['hotel_tier'])) {
        update_post_meta($post_id, '_hotel_tier', sanitize_text_field($_POST['hotel_tier']));
    }
}
add_action('save_post_hotel', 'hotel_save_meta_boxes');

// Get featured hotels for homepage
function roaming_get_featured_hotels() {
    return get_posts(array(
        'post_type' => 'hotel',
        'posts_per_page' => 4,
        'meta_key' => '_thumbnail_id',
        'orderby' => 'date',
        'order' => 'DESC'
    ));
}

// Register Vehicles Custom Post Type
function register_vehicle_cpt() {
    $labels = array(
        'name' => 'Safari Vehicles',
        'singular_name' => 'Vehicle',
        'menu_name' => 'Vehicles',
        'add_new' => 'Add New Vehicle',
        'add_new_item' => 'Add New Vehicle',
        'edit_item' => 'Edit Vehicle',
        'new_item' => 'New Vehicle',
        'view_item' => 'View Vehicle',
        'search_items' => 'Search Vehicles',
        'not_found' => 'No vehicles found',
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'vehicle'),
        'capability_type' => 'post',
        'has_archive' => true,
        'menu_position' => 22,
        'menu_icon' => 'dashicons-car',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
    );
    
    register_post_type('vehicle', $args);
}
add_action('init', 'register_vehicle_cpt');

// Add meta boxes for vehicle details
function vehicle_add_meta_boxes() {
    add_meta_box(
        'vehicle_details',
        'Vehicle Details',
        'vehicle_details_callback',
        'vehicle',
        'normal',
        'high'
    );
    add_meta_box(
        'vehicle_gallery',
        'Vehicle Gallery',
        'vehicle_gallery_callback',
        'vehicle',
        'normal',
        'high'
    );
    add_meta_box(
        'vehicle_faqs',
        'Vehicle FAQs',
        'vehicle_faqs_callback',
        'vehicle',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vehicle_add_meta_boxes');

function vehicle_details_callback($post) {
    wp_nonce_field('vehicle_details', 'vehicle_details_nonce');
    $capacity = get_post_meta($post->ID, '_vehicle_capacity', true);
    $vehicle_type = get_post_meta($post->ID, '_vehicle_type', true);
    $price_from = get_post_meta($post->ID, '_vehicle_price_from', true);
    $features = get_post_meta($post->ID, '_vehicle_features', true);
    ?>
    <p>
        <label>Vehicle Type:</label>
        <select name="vehicle_type" style="width:100%">
            <option value="safari" <?php selected($vehicle_type, 'safari'); ?>>Safari Vehicle (4x4)</option>
            <option value="self-drive" <?php selected($vehicle_type, 'self-drive'); ?>>Self Drive</option>
            <option value="bus" <?php selected($vehicle_type, 'bus'); ?>>Bus / Coach</option>
            <option value="helicopter" <?php selected($vehicle_type, 'helicopter'); ?>>Helicopter</option>
        </select>
    </p>
    <p>
        <label>Capacity (passengers):</label>
        <input type="text" name="vehicle_capacity" value="<?php echo esc_attr($capacity); ?>" style="width:100%">
    </p>
    <p>
        <label>Price From (per day):</label>
        <input type="text" name="vehicle_price_from" value="<?php echo esc_attr($price_from); ?>" style="width:100%">
    </p>
    <p>
        <label>Key Features (comma separated):</label>
        <input type="text" name="vehicle_features" value="<?php echo esc_attr($features); ?>" style="width:100%">
    </p>
    <?php
}

function vehicle_gallery_callback($post) {
    wp_nonce_field('vehicle_gallery', 'vehicle_gallery_nonce');
    $gallery_images = get_post_meta($post->ID, '_vehicle_gallery', true);
    $gallery_images = $gallery_images ? explode(',', $gallery_images) : array();
    ?>
    <div id="vehicle-gallery-container">
        <div id="gallery-images">
            <?php foreach($gallery_images as $image_id): 
                $image_url = wp_get_attachment_url($image_id);
                if($image_url):
            ?>
                <div style="display: inline-block; margin: 10px; position: relative;">
                    <img src="<?php echo esc_url($image_url); ?>" style="width: 150px; height: 100px; object-fit: cover; border-radius: 8px;">
                    <button type="button" class="button remove-gallery-image" data-id="<?php echo $image_id; ?>" style="position: absolute; top: 5px; right: 5px; background: red; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; cursor: pointer;">×</button>
                </div>
            <?php endif; endforeach; ?>
        </div>
        <button type="button" class="button" id="add-gallery-images">Add Gallery Images</button>
        <input type="hidden" name="vehicle_gallery" id="vehicle_gallery" value="<?php echo esc_attr(implode(',', $gallery_images)); ?>">
    </div>
    <script>
    jQuery(document).ready(function($) {
        $('#add-gallery-images').click(function(e) {
            e.preventDefault();
            var frame = wp.media({
                title: 'Select Gallery Images',
                multiple: true,
                library: { type: 'image' },
                button: { text: 'Add to Gallery' }
            });
            frame.on('select', function() {
                var selection = frame.state().get('selection');
                var ids = $('#vehicle_gallery').val() ? $('#vehicle_gallery').val().split(',') : [];
                selection.map(function(attachment) {
                    attachment = attachment.toJSON();
                    ids.push(attachment.id);
                    $('#gallery-images').append('<div style="display: inline-block; margin: 10px; position: relative;"><img src="' + attachment.url + '" style="width: 150px; height: 100px; object-fit: cover; border-radius: 8px;"><button type="button" class="button remove-gallery-image" data-id="' + attachment.id + '" style="position: absolute; top: 5px; right: 5px; background: red; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; cursor: pointer;">×</button></div>');
                });
                $('#vehicle_gallery').val(ids.join(','));
            });
            frame.open();
        });
        $(document).on('click', '.remove-gallery-image', function() {
            var id = $(this).data('id');
            var ids = $('#vehicle_gallery').val().split(',');
            var newIds = ids.filter(function(i) { return i != id; });
            $('#vehicle_gallery').val(newIds.join(','));
            $(this).closest('div').remove();
        });
    });
    </script>
    <?php
}

function vehicle_faqs_callback($post) {
    wp_nonce_field('vehicle_faqs', 'vehicle_faqs_nonce');
    $faqs = get_post_meta($post->ID, '_vehicle_faqs', true);
    $faqs = $faqs ? json_decode($faqs, true) : array();
    ?>
    <div id="faqs-container">
        <?php foreach($faqs as $index => $faq): ?>
            <div style="background: #f9f9f9; padding: 15px; margin: 10px 0; border-radius: 8px;">
                <input type="text" name="faq_question[]" value="<?php echo esc_attr($faq['question']); ?>" placeholder="Question" style="width: 100%; margin-bottom: 10px;">
                <textarea name="faq_answer[]" rows="3" placeholder="Answer" style="width: 100%;"><?php echo esc_textarea($faq['answer']); ?></textarea>
                <button type="button" class="button remove-faq">Remove FAQ</button>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="button" id="add-faq">Add FAQ</button>
    <script>
    jQuery(document).ready(function($) {
        $('#add-faq').click(function() {
            $('#faqs-container').append('<div style="background: #f9f9f9; padding: 15px; margin: 10px 0; border-radius: 8px;"><input type="text" name="faq_question[]" placeholder="Question" style="width: 100%; margin-bottom: 10px;"><textarea name="faq_answer[]" rows="3" placeholder="Answer" style="width: 100%;"></textarea><button type="button" class="button remove-faq">Remove FAQ</button></div>');
        });
        $(document).on('click', '.remove-faq', function() {
            $(this).closest('div').remove();
        });
    });
    </script>
    <?php
}

function vehicle_save_meta_boxes($post_id) {
    if(isset($_POST['vehicle_details_nonce']) && wp_verify_nonce($_POST['vehicle_details_nonce'], 'vehicle_details')) {
        if(isset($_POST['vehicle_capacity'])) update_post_meta($post_id, '_vehicle_capacity', sanitize_text_field($_POST['vehicle_capacity']));
        if(isset($_POST['vehicle_type'])) update_post_meta($post_id, '_vehicle_type', sanitize_text_field($_POST['vehicle_type']));
        if(isset($_POST['vehicle_price_from'])) update_post_meta($post_id, '_vehicle_price_from', sanitize_text_field($_POST['vehicle_price_from']));
        if(isset($_POST['vehicle_features'])) update_post_meta($post_id, '_vehicle_features', sanitize_text_field($_POST['vehicle_features']));
    }
    if(isset($_POST['vehicle_gallery_nonce']) && wp_verify_nonce($_POST['vehicle_gallery_nonce'], 'vehicle_gallery')) {
        if(isset($_POST['vehicle_gallery'])) update_post_meta($post_id, '_vehicle_gallery', sanitize_text_field($_POST['vehicle_gallery']));
    }
    if(isset($_POST['vehicle_faqs_nonce']) && wp_verify_nonce($_POST['vehicle_faqs_nonce'], 'vehicle_faqs')) {
        $faqs = array();
        if(isset($_POST['faq_question']) && is_array($_POST['faq_question'])) {
            for($i = 0; $i < count($_POST['faq_question']); $i++) {
                if(!empty($_POST['faq_question'][$i])) {
                    $faqs[] = array(
                        'question' => sanitize_text_field($_POST['faq_question'][$i]),
                        'answer' => sanitize_textarea_field($_POST['faq_answer'][$i])
                    );
                }
            }
        }
        update_post_meta($post_id, '_vehicle_faqs', json_encode($faqs));
    }
}
add_action('save_post_vehicle', 'vehicle_save_meta_boxes');

function roaming_get_featured_vehicles() {
    return get_posts(array(
        'post_type' => 'vehicle',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC'
    ));
}
require_once get_template_directory() . '/inc/booking-steps-admin.php';
require_once get_template_directory() . '/inc/partners-admin.php';
require_once get_template_directory() . '/inc/final-cta-admin.php';
require_once get_template_directory() . '/inc/footer-admin.php';
