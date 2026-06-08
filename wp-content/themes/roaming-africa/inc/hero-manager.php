<?php
/**
 * Hero Section Manager - Fixed with working image upload
 */

// Add admin menu
function roaming_hero_admin_menu() {
    add_menu_page(
        'Hero Section',
        'Hero Section',
        'manage_options',
        'roaming-hero',
        'roaming_hero_admin_page',
        'dashicons-slides',
        15
    );
    
    add_submenu_page(
        'roaming-hero',
        'Safari Planner',
        'Safari Planner',
        'manage_options',
        'roaming-planner',
        'roaming_planner_admin_page'
    );
}
add_action('admin_menu', 'roaming_hero_admin_menu');

// Enqueue media uploader
function roaming_hero_admin_scripts($hook) {
    if($hook == 'toplevel_page_roaming-hero') {
        wp_enqueue_media();
        wp_enqueue_script('roaming-hero-admin', get_template_directory_uri() . '/assets/js/hero-admin.js', array('jquery'), '1.0', true);
    }
}
add_action('admin_enqueue_scripts', 'roaming_hero_admin_scripts');

// Hero Section Admin Page
function roaming_hero_admin_page() {
    // Save slides
    if(isset($_POST['save_slides'])) {
        $slides = array();
        if(isset($_POST['slide_title']) && is_array($_POST['slide_title'])) {
            foreach($_POST['slide_title'] as $i => $title) {
                if(!empty($title)) {
                    $slides[] = array(
                        'title' => sanitize_text_field($title),
                        'subtitle' => sanitize_textarea_field($_POST['slide_subtitle'][$i]),
                        'image' => esc_url_raw($_POST['slide_image'][$i]),
                        'button_text' => sanitize_text_field($_POST['slide_button_text'][$i]),
                        'button_url' => esc_url_raw($_POST['slide_button_url'][$i]),
                    );
                }
            }
        }
        update_option('roaming_hero_slides', $slides);
        echo '<div class="notice notice-success"><p>Hero slides saved!</p></div>';
    }
    
    // Get existing slides
    $slides = get_option('roaming_hero_slides', array(
        array(
            'title' => 'Welcome to Roaming Africa Tours & Safaris',
            'subtitle' => 'Leading DMC (Destination Management Company) and Tour Operator for Kenya, Tanzania and Zanzibar',
            'image' => '',
            'button_text' => 'Plan My Safari',
            'button_url' => '/kenya-safaris',
        ),
        array(
            'title' => 'Elephants Under Kilimanjaro',
            'subtitle' => 'Amboseli National Park · Luxury Lodges',
            'image' => '',
            'button_text' => 'Explore Now',
            'button_url' => '/destination/amboseli',
        ),
        array(
            'title' => 'Tanzania Wildlife, Curated by Locals',
            'subtitle' => 'Serengeti · Ngorongoro Crater',
            'image' => '',
            'button_text' => 'View Safaris',
            'button_url' => '/tanzania-safaris',
        ),
        array(
            'title' => 'Zanzibar Beaches, Effortlessly Planned',
            'subtitle' => 'Beach Resorts · Stone Town · Spice Tours',
            'image' => '',
            'button_text' => 'Book Now',
            'button_url' => '/tanzania-safaris/zanzibar',
        ),
    ));
    ?>
    <div class="wrap">
        <h1>Hero Slider Manager</h1>
        <form method="post">
            <div id="slides-container">
                <?php foreach($slides as $i => $slide): ?>
                    <div class="slide-card" style="background: #fff; border: 1px solid #ddd; margin: 20px 0; padding: 20px; border-radius: 8px;">
                        <h3>Slide <?php echo $i + 1; ?></h3>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Title:</label>
                            <input type="text" name="slide_title[]" value="<?php echo esc_attr($slide['title']); ?>" style="width: 100%; padding: 8px;">
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Subtitle:</label>
                            <textarea name="slide_subtitle[]" rows="3" style="width: 100%; padding: 8px;"><?php echo esc_textarea($slide['subtitle']); ?></textarea>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Image:</label>
                            <div style="display: flex; gap: 10px; align-items: center;">
                                <input type="text" name="slide_image[]" id="slide_image_<?php echo $i; ?>" value="<?php echo esc_attr($slide['image']); ?>" style="flex: 1; padding: 8px;">
                                <button type="button" class="button upload-image-btn" data-target="slide_image_<?php echo $i; ?>">Upload Image</button>
                            </div>
                            <?php if($slide['image']): ?>
                                <div style="margin-top: 10px;">
                                    <img src="<?php echo esc_url($slide['image']); ?>" style="max-width: 200px; max-height: 100px; border: 1px solid #ddd; padding: 5px;">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                            <div>
                                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Button Text:</label>
                                <input type="text" name="slide_button_text[]" value="<?php echo esc_attr($slide['button_text']); ?>" style="width: 100%; padding: 8px;">
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Button URL:</label>
                                <input type="text" name="slide_button_url[]" value="<?php echo esc_url($slide['button_url']); ?>" style="width: 100%; padding: 8px;">
                            </div>
                        </div>
                        <button type="button" class="button remove-slide" style="background: #dc3232; color: white; border: none;">Remove Slide</button>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="button" id="add-slide" style="margin-right: 10px;">Add New Slide</button>
            <button type="submit" name="save_slides" class="button button-primary">Save All Slides</button>
        </form>
    </div>
    
    <style>
        .slide-card { position: relative; }
        .remove-slide:hover { background: #c02222 !important; }
    </style>
    <?php
}

// Safari Planner Admin Page
function roaming_planner_admin_page() {
    if(isset($_POST['save_planner'])) {
        update_option('roaming_planner_title', sanitize_text_field($_POST['planner_title']));
        update_option('roaming_planner_enabled', isset($_POST['planner_enabled']) ? true : false);
        update_option('roaming_planner_destinations', array_map('sanitize_text_field', $_POST['destinations']));
        echo '<div class="notice notice-success"><p>Safari Planner settings saved!</p></div>';
    }
    
    $planner_title = get_option('roaming_planner_title', 'Plan Your Safari');
    $planner_enabled = get_option('roaming_planner_enabled', true);
    $destinations = get_option('roaming_planner_destinations', array('Kenya Safari', 'Tanzania Safari', 'Zanzibar Beach', 'Combo Safari'));
    ?>
    <div class="wrap">
        <h1>Safari Planner Settings</h1>
        <form method="post">
            <table class="form-table">
                <tr>
                    <th>Enable Safari Planner</th>
                    <td><input type="checkbox" name="planner_enabled" <?php checked($planner_enabled, true); ?>></td>
                </tr>
                <tr>
                    <th>Planner Title</th>
                    <td><input type="text" name="planner_title" value="<?php echo esc_attr($planner_title); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th>Destinations</th>
                    <td>
                        <div id="destinations-list">
                            <?php foreach($destinations as $dest): ?>
                                <div style="margin-bottom: 5px;">
                                    <input type="text" name="destinations[]" value="<?php echo esc_attr($dest); ?>" style="width: 200px;">
                                    <button type="button" class="button remove-dest" style="margin-left: 5px;">Remove</button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="button" class="button" id="add-destination">Add Destination</button>
                    </td>
                </tr>
            </table>
            <button type="submit" name="save_planner" class="button button-primary">Save Settings</button>
        </form>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        $('#add-destination').click(function() {
            $('#destinations-list').append('<div style="margin-bottom:5px;"><input type="text" name="destinations[]" style="width:200px;"><button type="button" class="button remove-dest" style="margin-left:5px;">Remove</button></div>');
        });
        $(document).on('click', '.remove-dest', function() {
            $(this).closest('div').remove();
        });
    });
    </script>
    <?php
}

// Get hero slides with fallback images
function roaming_get_hero_slides() {
    $slides = get_option('roaming_hero_slides', array());
    
    // Default images if no custom images
    $default_images = array(
        'https://images.unsplash.com/photo-1516426122078-c23e76319801?w=1600',
        'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?w=1600',
        'https://images.unsplash.com/photo-1536421462769-7c71d2e8ea9f?w=1600',
        'https://images.unsplash.com/photo-1570077188670-6e65c2d60404?w=1600',
    );
    
    // Ensure we have at least 4 slides
    if(empty($slides)) {
        $slides = array(
            array('title' => 'Welcome to Roaming Africa Tours & Safaris', 'subtitle' => 'Leading DMC for Kenya, Tanzania and Zanzibar', 'image' => $default_images[0], 'button_text' => 'Plan My Safari', 'button_url' => '/kenya-safaris'),
            array('title' => 'Elephants Under Kilimanjaro', 'subtitle' => 'Amboseli National Park · Luxury Lodges', 'image' => $default_images[1], 'button_text' => 'Explore Now', 'button_url' => '/destination/amboseli'),
            array('title' => 'Tanzania Wildlife, Curated by Locals', 'subtitle' => 'Serengeti · Ngorongoro Crater', 'image' => $default_images[2], 'button_text' => 'View Safaris', 'button_url' => '/tanzania-safaris'),
            array('title' => 'Zanzibar Beaches, Effortlessly Planned', 'subtitle' => 'Beach Resorts · Stone Town · Spice Tours', 'image' => $default_images[3], 'button_text' => 'Book Now', 'button_url' => '/tanzania-safaris/zanzibar'),
        );
    } else {
        // Ensure each slide has an image
        foreach($slides as $i => &$slide) {
            if(empty($slide['image'])) {
                $slide['image'] = $default_images[$i] ?? $default_images[0];
            }
        }
    }
    
    return $slides;
}
