<?php
function footer_admin_menu() {
    add_menu_page('Footer Settings', 'Footer', 'manage_options', 'footer-settings', 'footer_admin_page', 'dashicons-footer', 28);
}
add_action('admin_menu', 'footer_admin_menu');

function footer_admin_page() {
    wp_enqueue_media();
    
    // Save Company Info (separate handler)
    if(isset($_POST['save_company_info'])) {
        update_option('footer_company_name', sanitize_text_field($_POST['company_name']));
        update_option('footer_address', sanitize_textarea_field($_POST['address']));
        update_option('footer_po_box', sanitize_text_field($_POST['po_box']));
        update_option('footer_phone_1', sanitize_text_field($_POST['phone_1']));
        update_option('footer_phone_2', sanitize_text_field($_POST['phone_2']));
        update_option('footer_phone_3', sanitize_text_field($_POST['phone_3']));
        update_option('footer_email_1', sanitize_email($_POST['email_1']));
        update_option('footer_email_2', sanitize_email($_POST['email_2']));
        update_option('footer_payments_text', sanitize_text_field($_POST['payments_text']));
        update_option('footer_copyright', sanitize_text_field($_POST['copyright']));
        update_option('footer_facebook', esc_url_raw($_POST['facebook']));
        update_option('footer_twitter', esc_url_raw($_POST['twitter']));
        update_option('footer_instagram', esc_url_raw($_POST['instagram']));
        update_option('footer_youtube', esc_url_raw($_POST['youtube']));
        echo '<div class="notice notice-success"><p>Company info saved!</p></div>';
    }
    
    // Save Payment Logos (separate handler)
    if(isset($_POST['save_payment_logos'])) {
        $payment_logos = array();
        for($i = 0; $i < count($_POST['payment_name']); $i++) {
            if(!empty($_POST['payment_name'][$i]) && !empty($_POST['payment_logo'][$i])) {
                $payment_logos[] = array(
                    'name' => sanitize_text_field($_POST['payment_name'][$i]),
                    'logo' => esc_url_raw($_POST['payment_logo'][$i])
                );
            }
        }
        update_option('footer_payment_logos', $payment_logos);
        echo '<div class="notice notice-success"><p>Payment logos saved!</p></div>';
    }
    
    // Save Menus
    $menus = ['kenya', 'tanzania', 'quick', 'resources'];
    foreach($menus as $menu) {
        if(isset($_POST["save_{$menu}"])) {
            $items = array();
            for($i = 0; $i < count($_POST["{$menu}_name"]); $i++) {
                if(!empty($_POST["{$menu}_name"][$i])) {
                    $items[] = array('label' => sanitize_text_field($_POST["{$menu}_name"][$i]), 'href' => esc_url_raw($_POST["{$menu}_href"][$i]));
                }
            }
            update_option("footer_{$menu}_menu", $items);
            echo '<div class="notice notice-success"><p>Menu saved!</p></div>';
        }
    }
    
    // Get current values
    $company_name = get_option('footer_company_name', 'Roaming Africa Tours and Safaris');
    $address = get_option('footer_address', '2nd Floor, Country Arcade, Ngong Road, Nairobi, Kenya – East Africa');
    $po_box = get_option('footer_po_box', 'P.O. Box 40-50105, Nairobi, Kenya');
    $phone_1 = get_option('footer_phone_1', '+254 722 433 910');
    $phone_2 = get_option('footer_phone_2', '+254 706 563 764');
    $phone_3 = get_option('footer_phone_3', '+254 723 480 704');
    $email_1 = get_option('footer_email_1', 'info@roamingafricasafaris.com');
    $email_2 = get_option('footer_email_2', 'reservations@roamingafricasafaris.com');
    $payments_text = get_option('footer_payments_text', 'We Accept');
    $payment_logos = get_option('footer_payment_logos', array());
    $copyright = get_option('footer_copyright', date('Y') . ' Roaming Africa Tours and Safaris | All Rights Reserved');
    $facebook = get_option('footer_facebook', '#');
    $twitter = get_option('footer_twitter', '#');
    $instagram = get_option('footer_instagram', '#');
    $youtube = get_option('footer_youtube', '#');
    
    $kenya_menu = get_option('footer_kenya_menu', array());
    $tanzania_menu = get_option('footer_tanzania_menu', array());
    $quick_links = get_option('footer_quick_links', array());
    $resources = get_option('footer_resources', array());
    
    if(empty($payment_logos)) {
        $payment_logos = array(
            array('name' => 'Visa', 'logo' => 'https://img.icons8.com/color/48/visa.png'),
            array('name' => 'Mastercard', 'logo' => 'https://img.icons8.com/color/48/mastercard.png'),
            array('name' => 'M-Pesa', 'logo' => '')
        );
    }
    ?>
    <div class="wrap">
        <h1>Footer Settings</h1>
        <div class="nav-tab-wrapper">
            <a href="#company" class="nav-tab nav-tab-active">Company Info</a>
            <a href="#payments" class="nav-tab">Payment Logos</a>
            <a href="#kenya" class="nav-tab">Explore Kenya</a>
            <a href="#tanzania" class="nav-tab">Explore Tanzania</a>
            <a href="#quick" class="nav-tab">Quick Links</a>
            <a href="#resources" class="nav-tab">Resources</a>
        </div>
        
        <!-- Company Info Tab -->
        <div id="company" class="tab-content active">
            <form method="post">
                <table class="form-table">
                    <tr><th>Company Name</th><td><input type="text" name="company_name" value="<?php echo esc_attr($company_name); ?>" style="width:100%"></td></tr>
                    <tr><th>Address</th><td><textarea name="address" rows="3" style="width:100%"><?php echo esc_textarea($address); ?></textarea></td></tr>
                    <tr><th>P.O. Box</th><td><input type="text" name="po_box" value="<?php echo esc_attr($po_box); ?>" style="width:100%"></td></tr>
                    <tr><th>Phone 1</th><td><input type="text" name="phone_1" value="<?php echo esc_attr($phone_1); ?>" style="width:100%"></td></tr>
                    <tr><th>Phone 2</th><td><input type="text" name="phone_2" value="<?php echo esc_attr($phone_2); ?>" style="width:100%"></td></tr>
                    <tr><th>Phone 3</th><td><input type="text" name="phone_3" value="<?php echo esc_attr($phone_3); ?>" style="width:100%"></td></tr>
                    <tr><th>Email 1</th><td><input type="email" name="email_1" value="<?php echo esc_attr($email_1); ?>" style="width:100%"></td></tr>
                    <tr><th>Email 2</th><td><input type="email" name="email_2" value="<?php echo esc_attr($email_2); ?>" style="width:100%"></td></tr>
                    <tr><th>Payment Section Text</th><td><input type="text" name="payments_text" value="<?php echo esc_attr($payments_text); ?>" style="width:100%"></td></tr>
                    <tr><th>Facebook URL</th><td><input type="url" name="facebook" value="<?php echo esc_url($facebook); ?>" style="width:100%"></td></tr>
                    <tr><th>Twitter URL</th><td><input type="url" name="twitter" value="<?php echo esc_url($twitter); ?>" style="width:100%"></td></tr>
                    <tr><th>Instagram URL</th><td><input type="url" name="instagram" value="<?php echo esc_url($instagram); ?>" style="width:100%"></td></tr>
                    <tr><th>YouTube URL</th><td><input type="url" name="youtube" value="<?php echo esc_url($youtube); ?>" style="width:100%"></td></tr>
                    <tr><th>Copyright</th><td><input type="text" name="copyright" value="<?php echo esc_attr($copyright); ?>" style="width:100%"><p class="description">Use {year} for automatic year</p></td></tr>
                </table>
                <p><input type="submit" name="save_company_info" class="button button-primary" value="Save Company Info"></p>
            </form>
        </div>
        
        <!-- Payment Logos Tab -->
        <div id="payments" class="tab-content">
            <form method="post">
                <div id="payment-logos-container">
                    <?php foreach($payment_logos as $index => $logo): ?>
                        <div class="payment-logo-item" style="background:#f9f9f9; border:1px solid #ddd; padding:15px; margin:15px 0; border-radius:8px;">
                            <h3><?php echo esc_html($logo['name']); ?></h3>
                            <p><label>Name:</label><br><input type="text" name="payment_name[]" value="<?php echo esc_attr($logo['name']); ?>" style="width:100%"></p>
                            <p><label>Logo URL:</label><br><input type="text" name="payment_logo[]" class="payment-logo-url" value="<?php echo esc_url($logo['logo']); ?>" style="width:70%"> <button type="button" class="button upload-payment-logo">Upload Logo</button></p>
                            <?php if($logo['logo']): ?>
                                <div><img src="<?php echo esc_url($logo['logo']); ?>" style="max-height:40px; margin-top:10px;"></div>
                            <?php endif; ?>
                            <button type="button" class="button remove-payment">Remove Payment Method</button>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="button" id="add-payment">Add Payment Method</button>
                <p><input type="submit" name="save_payment_logos" class="button button-primary" value="Save Payment Logos"></p>
            </form>
        </div>
        
        <?php foreach(['kenya', 'tanzania', 'quick', 'resources'] as $menu): 
            $items = get_option("footer_{$menu}_menu", array());
            $title = ucfirst($menu);
        ?>
        <div id="<?php echo $menu; ?>" class="tab-content">
            <form method="post"><h2><?php echo $title; ?> Menu</h2><div id="<?php echo $menu; ?>-items"><?php foreach($items as $item): ?><div><input type="text" name="<?php echo $menu; ?>_name[]" value="<?php echo esc_attr($item['label']); ?>" placeholder="Label" style="width:30%"> <input type="text" name="<?php echo $menu; ?>_href[]" value="<?php echo esc_attr($item['href']); ?>" placeholder="URL" style="width:50%"> <button type="button" class="button remove-item">Remove</button></div><?php endforeach; ?></div><button type="button" class="button add-<?php echo $menu; ?>">Add Item</button><p><input type="submit" name="save_<?php echo $menu; ?>" class="button button-primary" value="Save <?php echo $title; ?> Menu"></p></form>
        </div>
        <?php endforeach; ?>
    </div>
    <style>.tab-content{display:none;padding:20px 0}.tab-content.active{display:block}.nav-tab-wrapper{margin-bottom:20px}</style>
    <script>
    jQuery(document).ready(function($){
        $('.nav-tab').click(function(e){e.preventDefault();$('.nav-tab').removeClass('nav-tab-active');$(this).addClass('nav-tab-active');$('.tab-content').removeClass('active');$($(this).attr('href')).addClass('active');});
        
        // Payment logo upload
        $(document).on('click','.upload-payment-logo',function(){var button=$(this);var frame=wp.media({title:'Select Payment Logo',multiple:false,button:{text:'Use Logo'}});frame.on('select',function(){var attachment=frame.state().get('selection').first().toJSON();button.siblings('.payment-logo-url').val(attachment.url);button.siblings('.payment-logo-url').after('<div><img src="'+attachment.url+'" style="max-height:40px; margin-top:10px;"></div>');button.siblings('div').remove();});frame.open();});
        
        // Add payment method
        $('#add-payment').click(function(){var html='<div class="payment-logo-item" style="background:#f9f9f9; border:1px solid #ddd; padding:15px; margin:15px 0; border-radius:8px;"><h3>New Payment</h3><p><label>Name:</label><br><input type="text" name="payment_name[]" style="width:100%"></p><p><label>Logo URL:</label><br><input type="text" name="payment_logo[]" class="payment-logo-url" style="width:70%"> <button type="button" class="button upload-payment-logo">Upload Logo</button></p><button type="button" class="button remove-payment">Remove Payment Method</button></div>';$('#payment-logos-container').append(html);});
        
        // Remove payment method
        $(document).on('click','.remove-payment',function(){$(this).closest('.payment-logo-item').remove();});
        
        function addItem(container,name,href){$(container).append('<div><input type="text" name="'+name+'_name[]" placeholder="Label" style="width:30%"> <input type="text" name="'+name+'_href[]" placeholder="URL" style="width:50%"> <button type="button" class="button remove-item">Remove</button></div>');}
        $('.add-kenya').click(function(){addItem('#kenya-items','kenya');});
        $('.add-tanzania').click(function(){addItem('#tanzania-items','tanzania');});
        $('.add-quick').click(function(){addItem('#quick-items','quick');});
        $('.add-resources').click(function(){addItem('#resources-items','resources');});
        $(document).on('click','.remove-item',function(){$(this).closest('div').remove();});
    });
    </script>
    <?php
}
