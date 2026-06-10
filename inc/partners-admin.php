<?php
/**
 * Partners & Endorsements - Admin Management with Media Uploader
 */

function partners_admin_menu() {
    add_menu_page(
        'Partners',
        'Partners',
        'manage_options',
        'partners',
        'partners_admin_page',
        'dashicons-awards',
        26
    );
}
add_action('admin_menu', 'partners_admin_menu');

// Enqueue media uploader
function partners_admin_scripts($hook) {
    if($hook == 'toplevel_page_partners') {
        wp_enqueue_media();
        wp_enqueue_script('partners-admin', get_template_directory_uri() . '/assets/js/partners-admin.js', array('jquery'), '1.0', true);
    }
}
add_action('admin_enqueue_scripts', 'partners_admin_scripts');

function partners_admin_page() {
    if(isset($_POST['save_partners'])) {
        $partners = array();
        for($i = 0; $i < count($_POST['partner_name']); $i++) {
            if(!empty($_POST['partner_name'][$i])) {
                $partners[] = array(
                    'name' => sanitize_text_field($_POST['partner_name'][$i]),
                    'img' => esc_url_raw($_POST['partner_img'][$i])
                );
            }
        }
        update_option('partners_list', $partners);
        update_option('partners_title', sanitize_text_field($_POST['partners_title']));
        update_option('partners_subtitle', sanitize_textarea_field($_POST['partners_subtitle']));
        echo '<div class="notice notice-success"><p>Partners saved!</p></div>';
    }
    
    $partners = get_option('partners_list', array(
        array('name' => 'TripAdvisor', 'img' => ''),
        array('name' => 'SafariBookings', 'img' => ''),
        array('name' => 'TouristLink', 'img' => ''),
        array('name' => 'Magical Kenya', 'img' => ''),
        array('name' => 'SafariDeal', 'img' => ''),
        array('name' => 'Tanzania Tourism Board', 'img' => ''),
        array('name' => 'Tourism Regulatory Authority', 'img' => ''),
        array('name' => 'East African Wild Life Society', 'img' => ''),
        array('name' => 'Your African Safari', 'img' => '')
    ));
    
    $title = get_option('partners_title', 'Recommended and Endorsed By');
    $subtitle = get_option('partners_subtitle', 'We are proud to be recognized by leading travel organizations and platforms.');
    ?>
    <div class="wrap">
        <h1>Partners & Endorsements</h1>
        <style>
            .partner-card { background: #f9f9f9; border: 1px solid #ddd; padding: 20px; margin: 20px 0; border-radius: 8px; }
            .partner-card h3 { margin-top: 0; }
            .image-preview { max-width: 150px; max-height: 60px; margin-top: 10px; border: 1px solid #ddd; padding: 5px; border-radius: 4px; }
        </style>
        
        <form method="post">
            <p><label>Section Title:</label><br><input type="text" name="partners_title" value="<?php echo esc_attr($title); ?>" style="width:100%"></p>
            <p><label>Section Subtitle:</label><br><textarea name="partners_subtitle" rows="2" style="width:100%"><?php echo esc_textarea($subtitle); ?></textarea></p>
            
            <div id="partners-container">
                <?php foreach($partners as $index => $partner): ?>
                    <div class="partner-card">
                        <h3>Partner <?php echo $index + 1; ?></h3>
                        <p><label>Name:</label><br><input type="text" name="partner_name[]" value="<?php echo esc_attr($partner['name']); ?>" style="width:100%"></p>
                        <p><label>Logo:</label><br>
                            <input type="text" name="partner_img[]" class="partner-image-url" value="<?php echo esc_url($partner['img']); ?>" style="width:80%">
                            <button type="button" class="button upload-image-btn">Upload Image</button>
                            <?php if($partner['img']): ?>
                                <div><img src="<?php echo esc_url($partner['img']); ?>" class="image-preview" /></div>
                            <?php endif; ?>
                        </p>
                        <button type="button" class="button remove-partner">Remove Partner</button>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <button type="button" class="button" id="add-partner">+ Add Partner</button>
            <p><input type="submit" name="save_partners" class="button button-primary" value="Save Partners"></p>
        </form>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        // Image upload functionality
        $(document).on('click', '.upload-image-btn', function(e) {
            e.preventDefault();
            var button = $(this);
            var customUploader = wp.media({
                title: 'Select Partner Logo',
                button: { text: 'Use this logo' },
                multiple: false,
                library: { type: 'image' }
            }).on('select', function() {
                var attachment = customUploader.state().get('selection').first().toJSON();
                button.siblings('.partner-image-url').val(attachment.url);
                button.siblings('.partner-image-url').after('<div><img src="' + attachment.url + '" class="image-preview" /></div>');
                button.siblings('.image-preview').remove();
            });
            customUploader.open();
        });
        
        // Add new partner
        $('#add-partner').click(function() {
            var count = $('.partner-card').length + 1;
            var html = '<div class="partner-card">' +
                '<h3>Partner ' + count + '</h3>' +
                '<p><label>Name:</label><br><input type="text" name="partner_name[]" style="width:100%"></p>' +
                '<p><label>Logo:</label><br>' +
                '<input type="text" name="partner_img[]" class="partner-image-url" style="width:80%">' +
                '<button type="button" class="button upload-image-btn">Upload Image</button>' +
                '</p>' +
                '<button type="button" class="button remove-partner">Remove Partner</button>' +
                '</div>';
            $('#partners-container').append(html);
        });
        
        // Remove partner
        $(document).on('click', '.remove-partner', function() {
            if(confirm('Remove this partner?')) {
                $(this).closest('.partner-card').remove();
            }
        });
    });
    </script>
    <?php
}
