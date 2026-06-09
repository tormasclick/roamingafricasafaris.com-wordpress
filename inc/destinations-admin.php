<?php
/**
 * Popular Destinations - Standalone Admin Menu
 */

// Add admin menu
function roaming_destinations_admin_menu() {
    add_menu_page(
        'Popular Destinations',
        'Destinations',
        'manage_options',
        'roaming-destinations',
        'roaming_destinations_admin_page',
        'dashicons-location-alt',
        31
    );
}
add_action('admin_menu', 'roaming_destinations_admin_menu');

// Admin page
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
            <?php foreach($dests as $i => $dest): ?>
                <div style="background:#f9f9f9;border:1px solid #ddd;margin:10px 0;padding:15px;display:flex;gap:10px;align-items:center;">
                    <input type="text" name="dest_name[]" value="<?php echo esc_attr($dest['name']); ?>" placeholder="Name" style="flex:2;">
                    <input type="text" name="dest_url[]" value="<?php echo esc_attr($dest['url']); ?>" placeholder="URL" style="flex:3;">
                    <button type="button" class="button remove-dest">Remove</button>
                </div>
            <?php endforeach; ?>
            <button type="button" class="button" id="add-destination">+ Add Destination</button>
            <p class="submit"><input type="submit" name="save_destinations" class="button button-primary" value="Save Destinations"></p>
        </form>
    </div>
    <script>
    jQuery(document).ready(function($) {
        $('#add-destination').click(function() {
            $('#destinations-container').append('<div style="background:#f9f9f9;border:1px solid #ddd;margin:10px 0;padding:15px;display:flex;gap:10px;align-items:center;"><input type="text" name="dest_name[]" placeholder="Name" style="flex:2;"><input type="text" name="dest_url[]" placeholder="URL" style="flex:3;"><button type="button" class="button remove-dest">Remove</button></div>');
        });
        $(document).on('click', '.remove-dest', function() {
            $(this).closest('div').remove();
        });
    });
    </script>
    <?php
}
