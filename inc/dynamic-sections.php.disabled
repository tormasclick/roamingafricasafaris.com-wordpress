<?php
/**
 * Dynamic Sections Manager - Everything editable from backend
 */

// Add admin menu for all sections
function roaming_sections_admin_menu() {
    add_menu_page(
        'Site Sections',
        'Site Sections',
        'manage_options',
        'roaming-sections',
        'roaming_sections_admin_page',
        'dashicons-layout',
        25
    );
    
    add_submenu_page(
        'roaming-sections',
        'Safari Highlights',
        'Safari Highlights',
        'manage_options',
        'roaming-highlights',
        'roaming_highlights_admin_page'
    );
    
    add_submenu_page(
        'roaming-sections',
        'Popular Destinations',
        'Popular Destinations',
        'manage_options',
        'roaming-destinations',
        'roaming_destinations_admin_page'
    );
    
    add_submenu_page(
        'roaming-sections',
        'CTA Section',
        'CTA Section',
        'manage_options',
        'roaming-cta',
        'roaming_cta_admin_page'
    );
    
    add_submenu_page(
        'roaming-sections',
        'Safari Planner',
        'Safari Planner',
        'manage_options',
        'roaming-planner-settings',
        'roaming_planner_settings_page'
    );
}
add_action('admin_menu', 'roaming_sections_admin_menu');

// ========== SAFARI HIGHLIGHTS ==========
function roaming_highlights_admin_page() {
    if(isset($_POST['save_highlights'])) {
        $highlights = array();
        for($i = 0; $i < count($_POST['highlight_title']); $i++) {
            if(!empty($_POST['highlight_title'][$i])) {
                $highlights[] = array(
                    'icon' => sanitize_text_field($_POST['highlight_icon'][$i]),
                    'title' => sanitize_text_field($_POST['highlight_title'][$i]),
                    'description' => sanitize_textarea_field($_POST['highlight_desc'][$i])
                );
            }
        }
        update_option('roaming_highlights', $highlights);
        echo '<div class="notice notice-success"><p>Highlights saved!</p></div>';
    }
    
    $highlights = get_option('roaming_highlights', array(
        array('icon' => 'fa-award', 'title' => 'Operating Since 2006', 'description' => 'Nearly two decades creating memorable East African safaris.'),
        array('icon' => 'fa-map', 'title' => 'Destination Management Expertise', 'description' => 'Full-service East African DMC handling all ground logistics in-house.'),
        array('icon' => 'fa-binoculars', 'title' => 'Deep Local Knowledge', 'description' => 'Our team lives and works across East Africa.'),
        array('icon' => 'fa-users', 'title' => 'Professional Safari Guides', 'description' => 'KPSGA-certified driver-guides with years of experience.'),
        array('icon' => 'fa-compass', 'title' => 'Tailor-Made Itineraries', 'description' => 'Every journey customized to your dates, budget and pace.'),
        array('icon' => 'fa-wheelchair', 'title' => 'Accessible Travel Specialists', 'description' => 'Wheelchair-accessible vehicles and step-free lodges.')
    ));
    ?>
    <div class="wrap">
        <h1>Safari Highlights</h1>
        <form method="post">
            <div id="highlights-container">
                <?php foreach($highlights as $i => $item): ?>
                    <div class="highlight-card" style="background:#fff;border:1px solid #ddd;margin:20px 0;padding:20px;border-radius:8px;">
                        <h3>Highlight <?php echo $i + 1; ?></h3>
                        <div><label>Icon (FontAwesome class):</label><input type="text" name="highlight_icon[]" value="<?php echo esc_attr($item['icon']); ?>" style="width:100%;margin-bottom:10px;"></div>
                        <div><label>Title:</label><input type="text" name="highlight_title[]" value="<?php echo esc_attr($item['title']); ?>" style="width:100%;margin-bottom:10px;"></div>
                        <div><label>Description:</label><textarea name="highlight_desc[]" rows="3" style="width:100%;margin-bottom:10px;"><?php echo esc_textarea($item['description']); ?></textarea></div>
                        <button type="button" class="button remove-highlight">Remove</button>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="button" id="add-highlight">Add Highlight</button>
            <button type="submit" name="save_highlights" class="button button-primary">Save All</button>
        </form>
    </div>
    <script>
    jQuery(document).ready(function($) {
        $('#add-highlight').click(function() {
            var html = '<div class="highlight-card" style="background:#fff;border:1px solid #ddd;margin:20px 0;padding:20px;border-radius:8px;">' +
                '<h3>New Highlight</h3>' +
                '<div><label>Icon (FontAwesome class):</label><input type="text" name="highlight_icon[]" style="width:100%;margin-bottom:10px;" placeholder="fa-award"></div>' +
                '<div><label>Title:</label><input type="text" name="highlight_title[]" style="width:100%;margin-bottom:10px;"></div>' +
                '<div><label>Description:</label><textarea name="highlight_desc[]" rows="3" style="width:100%;margin-bottom:10px;"></textarea></div>' +
                '<button type="button" class="button remove-highlight">Remove</button>' +
                '</div>';
            $('#highlights-container').append(html);
        });
        $(document).on('click', '.remove-highlight', function() {
            $(this).closest('.highlight-card').remove();
        });
    });
    </script>
    <?php
}

// ========== POPULAR DESTINATIONS ==========
function roaming_destinations_admin_page() {
    if(isset($_POST['save_destinations'])) {
        $dests = array();
        for($i = 0; $i < count($_POST['dest_name']); $i++) {
            if(!empty($_POST['dest_name'][$i])) {
                $dests[] = array(
                    'name' => sanitize_text_field($_POST['dest_name'][$i]),
                    'url' => esc_url_raw($_POST['dest_url'][$i])
                );
            }
        }
        update_option('roaming_destinations', $dests);
        echo '<div class="notice notice-success"><p>Destinations saved!</p></div>';
    }
    
    $dests = get_option('roaming_destinations', array(
        array('name' => 'Masai Mara', 'url' => '/destination/masai-mara'),
        array('name' => 'Amboseli', 'url' => '/destination/amboseli'),
        array('name' => 'Serengeti', 'url' => '/destination/serengeti'),
        array('name' => 'Zanzibar', 'url' => '/destination/zanzibar'),
        array('name' => 'Ngorongoro', 'url' => '/destination/ngorongoro'),
        array('name' => 'Tsavo', 'url' => '/destination/tsavo'),
        array('name' => 'Lake Nakuru', 'url' => '/destination/lake-nakuru'),
        array('name' => 'Diani Beach', 'url' => '/destination/diani')
    ));
    ?>
    <div class="wrap">
        <h1>Popular Destinations</h1>
        <form method="post">
            <div id="destinations-container">
                <?php foreach($dests as $i => $dest): ?>
                    <div style="background:#fff;border:1px solid #ddd;margin:10px 0;padding:15px;border-radius:8px;display:flex;gap:10px;">
                        <input type="text" name="dest_name[]" value="<?php echo esc_attr($dest['name']); ?>" placeholder="Destination Name" style="flex:2;">
                        <input type="text" name="dest_url[]" value="<?php echo esc_attr($dest['url']); ?>" placeholder="URL" style="flex:3;">
                        <button type="button" class="button remove-dest">Remove</button>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="button" id="add-destination">Add Destination</button>
            <button type="submit" name="save_destinations" class="button button-primary">Save Destinations</button>
        </form>
    </div>
    <script>
    jQuery(document).ready(function($) {
        $('#add-destination').click(function() {
            var html = '<div style="background:#fff;border:1px solid #ddd;margin:10px 0;padding:15px;border-radius:8px;display:flex;gap:10px;">' +
                '<input type="text" name="dest_name[]" placeholder="Destination Name" style="flex:2;">' +
                '<input type="text" name="dest_url[]" placeholder="URL" style="flex:3;">' +
                '<button type="button" class="button remove-dest">Remove</button>' +
                '</div>';
            $('#destinations-container').append(html);
        });
        $(document).on('click', '.remove-dest', function() {
            $(this).closest('div').remove();
        });
    });
    </script>
    <?php
}

// ========== CTA SECTION ==========
function roaming_cta_admin_page() {
    if(isset($_POST['save_cta'])) {
        update_option('roaming_cta_title', sanitize_text_field($_POST['cta_title']));
        update_option('roaming_cta_subtitle', sanitize_textarea_field($_POST['cta_subtitle']));
        update_option('roaming_cta_button_text', sanitize_text_field($_POST['cta_button_text']));
        update_option('roaming_cta_button_url', esc_url_raw($_POST['cta_button_url']));
        update_option('roaming_cta_enabled', isset($_POST['cta_enabled']) ? true : false);
        echo '<div class="notice notice-success"><p>CTA saved!</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>CTA Section Settings</h1>
        <form method="post">
            <table class="form-table">
                <tr><th>Enable CTA</th><td><input type="checkbox" name="cta_enabled" <?php checked(get_option('roaming_cta_enabled', true)); ?>></td></tr>
                <tr><th>Title</th><td><input type="text" name="cta_title" value="<?php echo esc_attr(get_option('roaming_cta_title', 'Ready for Your Safari Adventure?')); ?>" class="regular-text"></td></tr>
                <tr><th>Subtitle</th><td><textarea name="cta_subtitle" rows="3" class="large-text"><?php echo esc_textarea(get_option('roaming_cta_subtitle', 'Contact us today to start planning your dream African safari')); ?></textarea></td></tr>
                <tr><th>Button Text</th><td><input type="text" name="cta_button_text" value="<?php echo esc_attr(get_option('roaming_cta_button_text', 'Get in Touch →')); ?>" class="regular-text"></td></tr>
                <tr><th>Button URL</th><td><input type="text" name="cta_button_url" value="<?php echo esc_attr(get_option('roaming_cta_button_url', '/contact')); ?>" class="regular-text"></td></tr>
            </table>
            <button type="submit" name="save_cta" class="button button-primary">Save CTA</button>
        </form>
    </div>
    <?php
}

// ========== SAFARI PLANNER SETTINGS ==========
function roaming_planner_settings_page() {
    if(isset($_POST['save_planner'])) {
        update_option('roaming_planner_destinations_list', array_map('sanitize_text_field', $_POST['planner_destinations']));
        update_option('roaming_planner_booking_url', esc_url_raw($_POST['booking_url']));
        echo '<div class="notice notice-success"><p>Planner settings saved!</p></div>';
    }
    $destinations = get_option('roaming_planner_destinations_list', array('Kenya Safari', 'Tanzania Safari', 'Zanzibar Beach', 'Combo Safari'));
    ?>
    <div class="wrap">
        <h1>Safari Planner Settings</h1>
        <form method="post">
            <div>
                <label>Destinations for dropdown:</label>
                <div id="planner-dests">
                    <?php foreach($destinations as $dest): ?>
                        <div style="margin:5px 0;"><input type="text" name="planner_destinations[]" value="<?php echo esc_attr($dest); ?>" style="width:300px;"> <button type="button" class="button remove-planner-dest">Remove</button></div>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="button" id="add-planner-dest">Add Destination</button>
            </div>
            <div style="margin-top:20px;">
                <label>Booking Form URL:</label>
                <input type="text" name="booking_url" value="<?php echo esc_attr(get_option('roaming_planner_booking_url', '/booking')); ?>" style="width:100%;">
            </div>
            <button type="submit" name="save_planner" class="button button-primary" style="margin-top:20px;">Save Settings</button>
        </form>
    </div>
    <script>
    jQuery(document).ready(function($) {
        $('#add-planner-dest').click(function() {
            $('#planner-dests').append('<div style="margin:5px 0;"><input type="text" name="planner_destinations[]" style="width:300px;"> <button type="button" class="button remove-planner-dest">Remove</button></div>');
        });
        $(document).on('click', '.remove-planner-dest', function() {
            $(this).closest('div').remove();
        });
    });
    </script>
    <?php
}

// Get functions for frontend
function roaming_get_highlights() {
    return get_option('roaming_highlights', array());
}

function roaming_get_destinations() {
    return get_option('roaming_destinations', array());
}

function roaming_get_cta() {
    return array(
        'enabled' => get_option('roaming_cta_enabled', true),
        'title' => get_option('roaming_cta_title', 'Ready for Your Safari Adventure?'),
        'subtitle' => get_option('roaming_cta_subtitle', 'Contact us today to start planning your dream African safari'),
        'button_text' => get_option('roaming_cta_button_text', 'Get in Touch →'),
        'button_url' => get_option('roaming_cta_button_url', '/contact')
    );
}

function roaming_get_planner_destinations() {
    return get_option('roaming_planner_destinations_list', array('Kenya Safari', 'Tanzania Safari', 'Zanzibar Beach', 'Combo Safari'));
}
