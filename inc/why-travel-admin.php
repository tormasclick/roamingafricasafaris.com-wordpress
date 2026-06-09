<?php
/**
 * Why Travel With Us - Complete Admin Management
 */

// Add admin menu
function roaming_why_travel_admin_menu() {
    add_menu_page(
        'Why Travel With Us',
        'Why Travel',
        'manage_options',
        'roaming-why-travel',
        'roaming_why_travel_admin_page',
        'dashicons-star-filled',
        30
    );
}
add_action('admin_menu', 'roaming_why_travel_admin_menu');

// Admin page
function roaming_why_travel_admin_page() {
    // Save header settings
    if(isset($_POST['save_header'])) {
        update_option('roaming_why_travel_label', sanitize_text_field($_POST['section_label']));
        update_option('roaming_why_travel_title', sanitize_text_field($_POST['section_title']));
        update_option('roaming_why_travel_subtitle', sanitize_textarea_field($_POST['section_subtitle']));
        echo '<div class="notice notice-success is-dismissible"><p>Header settings saved!</p></div>';
    }
    
    // Save features
    if(isset($_POST['save_features'])) {
        $features = array();
        if(isset($_POST['feature_icon']) && is_array($_POST['feature_icon'])) {
            for($i = 0; $i < count($_POST['feature_icon']); $i++) {
                if(!empty($_POST['feature_title'][$i])) {
                    $features[] = array(
                        'icon' => sanitize_text_field($_POST['feature_icon'][$i]),
                        'title' => sanitize_text_field($_POST['feature_title'][$i]),
                        'desc' => sanitize_textarea_field($_POST['feature_desc'][$i]),
                        'gradient' => sanitize_text_field($_POST['feature_gradient'][$i])
                    );
                }
            }
        }
        update_option('roaming_why_travel_features', json_encode($features));
        echo '<div class="notice notice-success is-dismissible"><p>Features saved successfully!</p></div>';
    }
    
    // Get current values
    $section_label = get_option('roaming_why_travel_label', 'Why travel with us');
    $section_title = get_option('roaming_why_travel_title', 'Why Travel With Roaming Africa Tours &amp; Safaris');
    $section_subtitle = get_option('roaming_why_travel_subtitle', 'Established in 2006, Roaming Africa Tours and Safaris combines destination management expertise with local knowledge to create seamless journeys across Kenya, Tanzania and Zanzibar.');
    
    $features_json = get_option('roaming_why_travel_features', '');
    $features = array();
    if(!empty($features_json)) {
        $features = json_decode($features_json, true);
    }
    
    // Default features if empty
    if(empty($features)) {
        $features = array(
            array('icon' => 'fa-award', 'title' => 'Operating Since 2006', 'desc' => 'Nearly two decades creating memorable East African safaris. Roaming Africa Tours and Safaris has guided travellers from over 60 countries across Kenya, Tanzania and Zanzibar.', 'gradient' => 'linear-gradient(135deg, rgba(41, 135, 66, 0.15) 0%, rgba(41, 135, 66, 0.05) 100%)'),
            array('icon' => 'fa-map', 'title' => 'Destination Management Expertise', 'desc' => 'A full-service East African DMC handling permits, transfers, lodges, vehicles and ground logistics in-house — one trusted operator from arrival to departure.', 'gradient' => 'linear-gradient(135deg, rgba(47, 158, 74, 0.15) 0%, rgba(47, 158, 74, 0.05) 100%)'),
            array('icon' => 'fa-binoculars', 'title' => 'Deep Local Knowledge', 'desc' => 'Our team lives and works in Nairobi, Mombasa, Arusha and Zanzibar. We know the parks, the seasons, the camps and the people behind every itinerary we build.', 'gradient' => 'linear-gradient(135deg, rgba(245, 166, 35, 0.15) 0%, rgba(245, 166, 35, 0.05) 100%)'),
            array('icon' => 'fa-users', 'title' => 'Professional Safari Guides', 'desc' => 'KPSGA-certified, bronze and silver level driver-guides with years of experience reading wildlife behaviour and translating Kenya, Tanzania and Zanzibar for our guests.', 'gradient' => 'linear-gradient(135deg, rgba(41, 135, 66, 0.15) 0%, rgba(47, 158, 74, 0.05) 100%)'),
            array('icon' => 'fa-compass', 'title' => 'Tailor-Made Itineraries', 'desc' => 'Every journey is customised to your dates, budget and pace — private safaris, family travel, honeymoons, photography expeditions and corporate incentive groups.', 'gradient' => 'linear-gradient(135deg, rgba(47, 158, 74, 0.15) 0%, rgba(245, 166, 35, 0.05) 100%)'),
            array('icon' => 'fa-wheelchair', 'title' => 'Accessible Travel Specialists', 'desc' => 'One of East Africa\'s most established accessible safari programmes — wheelchair-accessible vehicles, step-free lodges and trained guides for barrier-free travel.', 'gradient' => 'linear-gradient(135deg, rgba(245, 166, 35, 0.15) 0%, rgba(41, 135, 66, 0.05) 100%)')
        );
    }
    
    ?>
    <div class="wrap">
        <h1>Why Travel With Us - Section Manager</h1>
        
        <style>
            .nav-tab-wrapper { margin-bottom: 20px; }
            .tab-content { display: none; background: #fff; padding: 20px; border: 1px solid #ccc; border-top: none; }
            .tab-content.active { display: block; }
            .feature-card { background: #f9f9f9; border: 1px solid #ddd; margin: 20px 0; padding: 20px; border-radius: 8px; position: relative; }
            .feature-card h3 { margin-top: 0; }
            .remove-feature { position: absolute; top: 20px; right: 20px; background: #dc3232; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; }
            .remove-feature:hover { background: #c02222; }
            .add-feature-btn { margin: 20px 0; }
            .form-table th { width: 200px; }
        </style>
        
        <h2 class="nav-tab-wrapper">
            <a href="#" class="nav-tab nav-tab-active" data-tab="header">Header Settings</a>
            <a href="#" class="nav-tab" data-tab="features">Features (6 Cards)</a>
        </h2>
        
        <!-- Header Settings Tab -->
        <div id="tab-header" class="tab-content active">
            <form method="post">
                <table class="form-table">
                    <tr>
                        <th><label for="section_label">Section Label (Yellow Text)</label></th>
                        <td>
                            <input type="text" name="section_label" id="section_label" value="<?php echo esc_attr($section_label); ?>" class="regular-text" />
                            <p class="description">The small uppercase text above the main title (e.g., "Why travel with us")</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section_title">Main Title</label></th>
                        <td>
                            <input type="text" name="section_title" id="section_title" value="<?php echo esc_attr($section_title); ?>" class="large-text" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section_subtitle">Description / Subtitle</label></th>
                        <td>
                            <textarea name="section_subtitle" id="section_subtitle" rows="4" class="large-text"><?php echo esc_textarea($section_subtitle); ?></textarea>
                        </td>
                    </tr>
                </table>
                <p class="submit">
                    <button type="submit" name="save_header" class="button button-primary">Save Header Settings</button>
                </p>
            </form>
        </div>
        
        <!-- Features Tab -->
        <div id="tab-features" class="tab-content">
            <form method="post">
                <div id="features-container">
                    <?php foreach($features as $index => $feature): ?>
                        <div class="feature-card">
                            <button type="button" class="remove-feature">Remove</button>
                            <h3>Feature <?php echo $index + 1; ?></h3>
                            <table class="form-table">
                                <tr>
                                    <th><label>FontAwesome Icon</label></th>
                                    <td>
                                        <input type="text" name="feature_icon[]" value="<?php echo esc_attr($feature['icon']); ?>" class="regular-text" />
                                        <p class="description">e.g., fa-award, fa-map, fa-binoculars, fa-users, fa-compass, fa-wheelchair</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label>Title</label></th>
                                    <td><input type="text" name="feature_title[]" value="<?php echo esc_attr($feature['title']); ?>" class="large-text" /></td>
                                </tr>
                                <tr>
                                    <th><label>Description</label></th>
                                    <td><textarea name="feature_desc[]" rows="3" class="large-text"><?php echo esc_textarea($feature['desc']); ?></textarea></td>
                                </tr>
                                <tr>
                                    <th><label>Gradient Background</label></th>
                                    <td>
                                        <input type="text" name="feature_gradient[]" value="<?php echo esc_attr($feature['gradient']); ?>" class="large-text" />
                                        <p class="description">CSS linear-gradient value for the card background</p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <button type="button" class="button add-feature-btn" id="add-feature">+ Add New Feature</button>
                <p class="submit">
                    <button type="submit" name="save_features" class="button button-primary">Save All Features</button>
                </p>
            </form>
        </div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        // Tab switching
        $('.nav-tab').click(function(e) {
            e.preventDefault();
            var tab = $(this).data('tab');
            $('.nav-tab').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');
            $('.tab-content').removeClass('active');
            $('#tab-' + tab).addClass('active');
        });
        
        // Add new feature
        $('#add-feature').click(function() {
            var featureCount = $('.feature-card').length + 1;
            var html = '<div class="feature-card">' +
                '<button type="button" class="remove-feature">Remove</button>' +
                '<h3>Feature ' + featureCount + '</h3>' +
                '<table class="form-table">' +
                '<tr><th><label>FontAwesome Icon</label></th>' +
                '<td><input type="text" name="feature_icon[]" class="regular-text" placeholder="fa-award" />' +
                '<p class="description">e.g., fa-award, fa-map, fa-binoculars, fa-users, fa-compass, fa-wheelchair</p></td></tr>' +
                '<tr><th><label>Title</label></th>' +
                '<td><input type="text" name="feature_title[]" class="large-text" /></td></tr>' +
                '<tr><th><label>Description</label></th>' +
                '<td><textarea name="feature_desc[]" rows="3" class="large-text"></textarea></td></tr>' +
                '<tr><th><label>Gradient Background</label></th>' +
                '<td><input type="text" name="feature_gradient[]" class="large-text" value="linear-gradient(135deg, rgba(41, 135, 66, 0.15) 0%, rgba(41, 135, 66, 0.05) 100%)" />' +
                '<p class="description">CSS linear-gradient value for the card background</p></td></tr>' +
                '</table></div>';
            $('#features-container').append(html);
        });
        
        // Remove feature
        $(document).on('click', '.remove-feature', function() {
            if(confirm('Remove this feature?')) {
                $(this).closest('.feature-card').remove();
                // Renumber remaining features
                $('.feature-card').each(function(i) {
                    $(this).find('h3').text('Feature ' + (i + 1));
                });
            }
        });
    });
    </script>
    <?php
}
