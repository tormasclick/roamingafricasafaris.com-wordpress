<?php
// Add admin menu for navigation
function roaming_nav_admin_menu() {
    add_menu_page(
        'Navigation Menu',
        'Site Navigation',
        'manage_options',
        'roaming-navigation',
        'roaming_nav_admin_page',
        'dashicons-menu',
        20
    );
}
add_action('admin_menu', 'roaming_nav_admin_menu');

function roaming_nav_admin_page() {
    if(isset($_POST['save_nav'])) {
        $nav_items = array();
        if(isset($_POST['nav_label']) && is_array($_POST['nav_label'])) {
            foreach($_POST['nav_label'] as $i => $label) {
                if(!empty($label)) {
                    $nav_items[] = array(
                        'label' => sanitize_text_field($label),
                        'url' => sanitize_url($_POST['nav_url'][$i]),
                        'type' => sanitize_text_field($_POST['nav_type'][$i]),
                    );
                }
            }
        }
        update_option('roaming_nav_items', $nav_items);
        echo '<div class="notice notice-success"><p>Navigation saved!</p></div>';
    }
    
    $nav_items = get_option('roaming_nav_items', array(
        array('label' => 'Home', 'url' => '/', 'type' => 'link'),
        array('label' => 'Kenya Safaris', 'url' => '/kenya-safaris', 'type' => 'link'),
        array('label' => 'Tanzania Safaris', 'url' => '/tanzania-safaris', 'type' => 'link'),
        array('label' => 'Destinations', 'url' => '/destinations', 'type' => 'link'),
        array('label' => 'Hotels', 'url' => '/hotels', 'type' => 'link'),
        array('label' => 'Contact', 'url' => '/contact', 'type' => 'highlight'),
    ));
    ?>
    <div class="wrap">
        <h1>Site Navigation</h1>
        <form method="post">
            <table class="widefat">
                <thead>
                    <tr><th>Label</th><th>URL</th><th>Type</th><th>Remove</th></tr>
                </thead>
                <tbody id="nav-sortable">
                    <?php foreach($nav_items as $i => $item): ?>
                    <tr>
                        <td><input type="text" name="nav_label[]" value="<?php echo esc_attr($item['label']); ?>" style="width:100%"></td>
                        <td><input type="text" name="nav_url[]" value="<?php echo esc_attr($item['url']); ?>" style="width:100%"></td>
                        <td>
                            <select name="nav_type[]">
                                <option value="link" <?php selected($item['type'], 'link'); ?>>Link</option>
                                <option value="highlight" <?php selected($item['type'], 'highlight'); ?>>Highlight Button</option>
                            </select>
                        </td>
                        <td><button type="button" class="button remove-row">Remove</button></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="button" class="button" id="add-row">Add Item</button>
            <button type="submit" name="save_nav" class="button button-primary">Save Navigation</button>
        </form>
    </div>
    <script>
    jQuery(document).ready(function($) {
        $('#add-row').click(function() {
            $('#nav-sortable').append('<tr><td><input type="text" name="nav_label[]" style="width:100%"></td><td><input type="text" name="nav_url[]" style="width:100%"></td><td><select name="nav_type[]"><option value="link">Link</option><option value="highlight">Highlight Button</option></select></td><td><button type="button" class="button remove-row">Remove</button></td></tr>');
        });
        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
        });
    });
    </script>
    <?php
}

function roaming_render_nav() {
    $items = get_option('roaming_nav_items', array(
        array('label' => 'Home', 'url' => '/', 'type' => 'link'),
        array('label' => 'Kenya Safaris', 'url' => '/kenya-safaris', 'type' => 'link'),
        array('label' => 'Contact', 'url' => '/contact', 'type' => 'highlight'),
    ));
    
    $html = '<nav class="desktop-nav hidden lg:flex items-center gap-1">';
    foreach($items as $item) {
        $class = $item['type'] == 'highlight' ? 'nav-link nav-link-highlight' : 'nav-link';
        $html .= '<a href="' . esc_url($item['url']) . '" class="' . $class . '">' . esc_html($item['label']) . '</a>';
    }
    $html .= '</nav>';
    return $html;
}
