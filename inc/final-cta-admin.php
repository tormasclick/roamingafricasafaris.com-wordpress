<?php
function final_cta_admin_menu() {
    add_menu_page('Final CTA Section', 'Final CTA', 'manage_options', 'final-cta', 'final_cta_admin_page', 'dashicons-megaphone', 27);
}
add_action('admin_menu', 'final_cta_admin_menu');

function final_cta_admin_page() {
    if(isset($_POST['save_cta'])) {
        update_option('final_cta_enabled', isset($_POST['cta_enabled']));
        update_option('final_cta_title', sanitize_text_field($_POST['cta_title']));
        update_option('final_cta_subtitle', sanitize_textarea_field($_POST['cta_subtitle']));
        update_option('final_cta_button_text', sanitize_text_field($_POST['button_text']));
        update_option('final_cta_button_url', esc_url_raw($_POST['button_url']));
        update_option('final_cta_whatsapp_text', sanitize_text_field($_POST['whatsapp_text']));
        update_option('final_cta_whatsapp_number', sanitize_text_field($_POST['whatsapp_number']));
        echo '<div class="notice notice-success"><p>Final CTA saved!</p></div>';
    }
    
    $enabled = get_option('final_cta_enabled', true);
    $title = get_option('final_cta_title', 'Ready to Start Your African Safari Adventure?');
    $subtitle = get_option('final_cta_subtitle', 'Let our experienced safari experts help you plan the trip of a lifetime.');
    $button_text = get_option('final_cta_button_text', 'Plan Your Safari');
    $button_url = get_option('final_cta_button_url', '/booking');
    $whatsapp_text = get_option('final_cta_whatsapp_text', 'Hi! I need help planning my East Africa safari.');
    $whatsapp_number = get_option('final_cta_whatsapp_number', '+254722433910');
    ?>
    <div class="wrap">
        <h1>Final CTA Section</h1>
        <form method="post">
            <p><label>Enable:</label> <input type="checkbox" name="cta_enabled" <?php checked($enabled); ?>></p>
            <p><label>Title:</label><br><input type="text" name="cta_title" value="<?php echo esc_attr($title); ?>" style="width:100%"></p>
            <p><label>Subtitle:</label><br><textarea name="cta_subtitle" rows="3" style="width:100%"><?php echo esc_textarea($subtitle); ?></textarea></p>
            <p><label>Button Text:</label><br><input type="text" name="button_text" value="<?php echo esc_attr($button_text); ?>" style="width:100%"></p>
            <p><label>Button URL:</label><br><input type="text" name="button_url" value="<?php echo esc_url($button_url); ?>" style="width:100%"></p>
            <p><label>WhatsApp Message:</label><br><input type="text" name="whatsapp_text" value="<?php echo esc_attr($whatsapp_text); ?>" style="width:100%"></p>
            <p><label>WhatsApp Number:</label><br><input type="text" name="whatsapp_number" value="<?php echo esc_attr($whatsapp_number); ?>" style="width:100%"></p>
            <p><input type="submit" name="save_cta" class="button button-primary" value="Save CTA"></p>
        </form>
    </div>
    <?php
}
