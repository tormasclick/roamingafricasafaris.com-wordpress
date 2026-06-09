<?php
/**
 * Why Travel With Us - Admin Manager
 * Allows editing of features from WordPress admin
 */

// Add admin menu
function roaming_why_travel_admin_menu() {
    add_submenu_page(
        'themes.php',
        'Why Travel With Us',
        'Why Travel With Us',
        'manage_options',
        'roaming-why-travel',
        'roaming_why_travel_admin_page'
    );
}
add_action('admin_menu', 'roaming_why_travel_admin_menu');

// Admin page
function roaming_why_travel_admin_page() {
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
        echo '<div class="notice notice-success"><p>Features saved successfully!</p></div>';
    }
    
    // Get existing features
    $features_json = get_option('roaming_why_travel_features', '');
    $features = array();
    if(!empty($features_json)) {
        $features = json_decode($features_json, true);
    }
    
    // Default gradients
    $default_gradients = array(
        'linear-gradient(135deg, rgba(41, 135, 66, 0.15) 0%, rgba(41, 135, 66, 0.05) 100%)',
        'linear-gradient(135deg, rgba(47, 158, 74, 0.15) 0%, rgba(47, 158, 74, 0.05) 100%)',
        'linear-gradient(135deg, rgba(245, 166, 35, 0.15) 0%, rgba(245, 166, 35, 0.05) 100%)',
        'linear-gradient(135deg, rgba(41, 135, 66, 0.15) 0%, rgba(47, 158, 74, 0.05) 100%)',
        'linear-gradient(135deg, rgba(47, 158, 74, 0.15) 0%, rgba(245, 166, 35, 0.05) 100%)',
        'linear-gradient(135deg, rgba(245, 166, 35, 0.15) 0%, rgba(41, 135, 66, 0.05) 100%)'
    );
    
    ?>
    <div class="wrap">
        <h1>Why Travel With Us - Manage Features</h1>
        <p>Edit the 6 features displayed on the homepage.</p>
        
        <form method="post">
            <div id="features-container">
                <?php if(empty($features)): ?>
                    <!-- Default features -->
                    <div class="feature-card" style="background:#fff;border:1px solid #ddd;margin:20px 0;padding:20px;border-radius:8px;">
                        <h3>Feature 1</h3>
                        <p><label>Icon (FontAwesome class):</label> <input type="text" name="feature_icon[]" value="fa-award" style="width:100%"></p>
                        <p><label>Title:</label> <input type="text" name="feature_title[]" value="Operating Since 2006" style="width:100%"></p>
                        <p><label>Description:</label> <textarea name="feature_desc[]" rows="3" style="width:100%">Nearly two decades creating memorable East African safaris. Roaming Africa Tours and Safaris has guided travellers from over 60 countries across Kenya, Tanzania and Zanzibar.</textarea></p>
                        <p><label>Gradient (CSS):</label> <input type="text" name="feature_gradient[]" value="<?php echo esc_attr($default_gradients[0]); ?>" style="width:100%"></p>
                    </div>
                    <div class="feature-card" style="background:#fff;border:1px solid #ddd;margin:20px 0;padding:20px;border-radius:8px;">
                        <h3>Feature 2</h3>
                        <p><label>Icon (FontAwesome class):</label> <input type="text" name="feature_icon[]" value="fa-map" style="width:100%"></p>
                        <p><label>Title:</label> <input type="text" name="feature_title[]" value="Destination Management Expertise" style="width:100%"></p>
                        <p><label>Description:</label> <textarea name="feature_desc[]" rows="3" style="width:100%">A full-service East African DMC handling permits, transfers, lodges, vehicles and ground logistics in-house — one trusted operator from arrival to departure.</textarea></p>
                        <p><label>Gradient (CSS):</label> <input type="text" name="feature_gradient[]" value="<?php echo esc_attr($default_gradients[1]); ?>" style="width:100%"></p>
                    </div>
                    <div class="feature-card" style="background:#fff;border:1px solid #ddd;margin:20px 0;padding:20px;border-radius:8px;">
                        <h3>Feature 3</h3>
                        <p><label>Icon (FontAwesome class):</label> <input type="text" name="feature_icon[]" value="fa-binoculars" style="width:100%"></p>
                        <p><label>Title:</label> <input type="text" name="feature_title[]" value="Deep Local Knowledge" style="width:100%"></p>
                        <p><label>Description:</label> <textarea name="feature_desc[]" rows="3" style="width:100%">Our team lives and works in Nairobi, Mombasa, Arusha and Zanzibar. We know the parks, the seasons, the camps and the people behind every itinerary we build.</textarea></p>
                        <p><label>Gradient (CSS):</label> <input type="text" name="feature_gradient[]" value="<?php echo esc_attr($default_gradients[2]); ?>" style="width:100%"></p>
                    </div>
                    <div class="feature-card" style="background:#fff;border:1px solid #ddd;margin:20px 0;padding:20px;border-radius:8px;">
                        <h3>Feature 4</h3>
                        <p><label>Icon (FontAwesome class):</label> <input type="text" name="feature_icon[]" value="fa-users" style="width:100%"></p>
                        <p><label>Title:</label> <input type="text" name="feature_title[]" value="Professional Safari Guides" style="width:100%"></p>
                        <p><label>Description:</label> <textarea name="feature_desc[]" rows="3" style="width:100%">KPSGA-certified, bronze and silver level driver-guides with years of experience reading wildlife behaviour and translating Kenya, Tanzania and Zanzibar for our guests.</textarea></p>
                        <p><label>Gradient (CSS):</label> <input type="text" name="feature_gradient[]" value="<?php echo esc_attr($default_gradients[3]); ?>" style="width:100%"></p>
                    </div>
                    <div class="feature-card" style="background:#fff;border:1px solid #ddd;margin:20px 0;padding:20px;border-radius:8px;">
                        <h3>Feature 5</h3>
                        <p><label>Icon (FontAwesome class):</label> <input type="text" name="feature_icon[]" value="fa-compass" style="width:100%"></p>
                        <p><label>Title:</label> <input type="text" name="feature_title[]" value="Tailor-Made Itineraries" style="width:100%"></p>
                        <p><label>Description:</label> <textarea name="feature_desc[]" rows="3" style="width:100%">Every journey is customised to your dates, budget and pace — private safaris, family travel, honeymoons, photography expeditions and corporate incentive groups.</textarea></p>
                        <p><label>Gradient (CSS):</label> <input type="text" name="feature_gradient[]" value="<?php echo esc_attr($default_gradients[4]); ?>" style="width:100%"></p>
                    </div>
                    <div class="feature-card" style="background:#fff;border:1px solid #ddd;margin:20px 0;padding:20px;border-radius:8px;">
                        <h3>Feature 6</h3>
                        <p><label>Icon (FontAwesome class):</label> <input type="text" name="feature_icon[]" value="fa-wheelchair" style="width:100%"></p>
                        <p><label>Title:</label> <input type="text" name="feature_title[]" value="Accessible Travel Specialists" style="width:100%"></p>
                        <p><label>Description:</label> <textarea name="feature_desc[]" rows="3" style="width:100%">One of East Africa's most established accessible safari programmes — wheelchair-accessible vehicles, step-free lodges and trained guides for barrier-free travel.</textarea></p>
                        <p><label>Gradient (CSS):</label> <input type="text" name="feature_gradient[]" value="<?php echo esc_attr($default_gradients[5]); ?>" style="width:100%"></p>
                    </div>
                <?php else: ?>
                    <?php foreach($features as $index => $feature): ?>
                        <div class="feature-card" style="background:#fff;border:1px solid #ddd;margin:20px 0;padding:20px;border-radius:8px;">
                            <h3>Feature <?php echo $index + 1; ?></h3>
                            <button type="button" class="remove-feature button" style="float:right;background:#dc3232;color:white;">Remove</button>
                            <p><label>Icon (FontAwesome class):</label> <input type="text" name="feature_icon[]" value="<?php echo esc_attr($feature['icon']); ?>" style="width:100%"></p>
                            <p><label>Title:</label> <input type="text" name="feature_title[]" value="<?php echo esc_attr($feature['title']); ?>" style="width:100%"></p>
                            <p><label>Description:</label> <textarea name="feature_desc[]" rows="3" style="width:100%"><?php echo esc_textarea($feature['desc']); ?></textarea></p>
                            <p><label>Gradient (CSS):</label> <input type="text" name="feature_gradient[]" value="<?php echo esc_attr($feature['gradient']); ?>" style="width:100%"></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <button type="button" class="button" id="add-feature">Add New Feature</button>
            <button type="submit" name="save_features" class="button button-primary">Save All Features</button>
        </form>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        $('#add-feature').click(function() {
            var html = '<div class="feature-card" style="background:#fff;border:1px solid #ddd;margin:20px 0;padding:20px;border-radius:8px;">' +
                '<h3>New Feature</h3>' +
                '<button type="button" class="remove-feature button" style="float:right;background:#dc3232;color:white;">Remove</button>' +
                '<p><label>Icon (FontAwesome class):</label> <input type="text" name="feature_icon[]" placeholder="fa-award" style="width:100%"></p>' +
                '<p><label>Title:</label> <input type="text" name="feature_title[]" style="width:100%"></p>' +
                '<p><label>Description:</label> <textarea name="feature_desc[]" rows="3" style="width:100%"></textarea></p>' +
                '<p><label>Gradient (CSS):</label> <input type="text" name="feature_gradient[]" value="linear-gradient(135deg, rgba(41, 135, 66, 0.15) 0%, rgba(41, 135, 66, 0.05) 100%)" style="width:100%"></p>' +
                '</div>';
            $('#features-container').append(html);
        });
        
        $(document).on('click', '.remove-feature', function() {
            $(this).closest('.feature-card').remove();
        });
    });
    </script>
    <?php
}
