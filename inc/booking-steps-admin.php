<?php
/**
 * How Booking Works - Admin Management
 */

function booking_steps_admin_menu() {
    add_menu_page(
        'Booking Steps',
        'Booking Steps',
        'manage_options',
        'booking-steps',
        'booking_steps_admin_page',
        'dashicons-welcome-learn-more',
        25
    );
}
add_action('admin_menu', 'booking_steps_admin_menu');

function booking_steps_admin_page() {
    if(isset($_POST['save_steps'])) {
        $steps = array();
        for($i = 0; $i < 4; $i++) {
            $steps[] = array(
                'step' => $i + 1,
                'title' => sanitize_text_field($_POST["step_title_{$i}"]),
                'desc' => sanitize_textarea_field($_POST["step_desc_{$i}"])
            );
        }
        update_option('booking_steps', $steps);
        update_option('booking_button_text', sanitize_text_field($_POST['button_text']));
        update_option('booking_button_url', esc_url_raw($_POST['button_url']));
        echo '<div class="notice notice-success"><p>Booking steps saved!</p></div>';
    }
    
    $steps = get_option('booking_steps', array(
        array('step' => 1, 'title' => 'Choose Your Safari', 'desc' => 'Browse our curated safari packages or use the planner above to find your ideal adventure.'),
        array('step' => 2, 'title' => 'Select Dates & Details', 'desc' => 'Pick your travel dates, number of travelers, and accommodation preferences.'),
        array('step' => 3, 'title' => 'Review & Pay', 'desc' => 'Review your booking summary and choose your preferred payment method.'),
        array('step' => 4, 'title' => 'Get Confirmation', 'desc' => 'Receive your confirmed itinerary and prepare for an unforgettable safari!')
    ));
    
    $button_text = get_option('booking_button_text', 'Book Your Safari Now');
    $button_url = get_option('booking_button_url', '/booking');
    ?>
    <div class="wrap">
        <h1>How Booking Works</h1>
        <form method="post">
            <?php foreach($steps as $index => $step): ?>
                <div style="background:#f9f9f9; border:1px solid #ddd; padding:20px; margin:20px 0; border-radius:8px;">
                    <h3>Step <?php echo $step['step']; ?></h3>
                    <p><label>Title:</label><br><input type="text" name="step_title_<?php echo $index; ?>" value="<?php echo esc_attr($step['title']); ?>" style="width:100%"></p>
                    <p><label>Description:</label><br><textarea name="step_desc_<?php echo $index; ?>" rows="3" style="width:100%"><?php echo esc_textarea($step['desc']); ?></textarea></p>
                </div>
            <?php endforeach; ?>
            <p><label>Button Text:</label><br><input type="text" name="button_text" value="<?php echo esc_attr($button_text); ?>" style="width:100%"></p>
            <p><label>Button URL:</label><br><input type="text" name="button_url" value="<?php echo esc_attr($button_url); ?>" style="width:100%"></p>
            <p><input type="submit" name="save_steps" class="button button-primary" value="Save Changes"></p>
        </form>
    </div>
    <?php
}
