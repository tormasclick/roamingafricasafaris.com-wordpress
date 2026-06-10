<?php
$steps = get_option('booking_steps', array(
    array('step' => 1, 'title' => 'Choose Your Safari', 'desc' => 'Browse our curated safari packages or use the planner above to find your ideal adventure.'),
    array('step' => 2, 'title' => 'Select Dates & Details', 'desc' => 'Pick your travel dates, number of travelers, and accommodation preferences.'),
    array('step' => 3, 'title' => 'Review & Pay', 'desc' => 'Review your booking summary and choose your preferred payment method.'),
    array('step' => 4, 'title' => 'Get Confirmation', 'desc' => 'Receive your confirmed itinerary and prepare for an unforgettable safari!')
));
$button_text = get_option('booking_button_text', 'Book Your Safari Now');
$button_url = get_option('booking_button_url', '/booking');
?>

<section style="padding: 80px 0; background: white;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 20px;">
        <h2 style="text-align: center; margin-bottom: 16px; font-size: 32px; font-weight: 700; color: #1a3c2c;">How Booking Works</h2>
        <p style="text-align: center; color: #666; max-width: 700px; margin: 0 auto 48px;">Book your dream safari in 4 simple steps.</p>
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;">
            <?php foreach($steps as $step): ?>
                <div style="text-align: center; padding: 24px; background: white; border-radius: 16px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; transition: all 0.3s;">
                    <div style="width: 56px; height: 56px; margin: 0 auto 16px; background: #F5A623; color: #1a3c2c; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold;"><?php echo $step['step']; ?></div>
                    <h3 style="font-size: 18px; font-weight: 700; color: #1a3c2c; margin-bottom: 12px;"><?php echo esc_html($step['title']); ?></h3>
                    <p style="font-size: 14px; color: #666; line-height: 1.6;"><?php echo esc_html($step['desc']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div style="text-align: center; margin-top: 48px;">
            <a href="<?php echo esc_url($button_url); ?>" style="display: inline-flex; align-items: center; gap: 8px; background: #F5A623; color: #1a3c2c; padding: 12px 32px; border-radius: 40px; text-decoration: none; font-weight: bold; transition: all 0.3s;">
                <?php echo esc_html($button_text); ?> <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
