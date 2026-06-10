<?php
/**
 * Final Call-to-Action Section - Exact replica of Next.js design
 */

$enabled = get_option('final_cta_enabled', true);
if(!$enabled) return;

$title = get_option('final_cta_title', 'Ready to Start Your African Safari Adventure?');
$subtitle = get_option('final_cta_subtitle', 'Let our experienced safari experts help you plan the trip of a lifetime.');
$button_text = get_option('final_cta_button_text', 'Plan Your Safari');
$button_url = get_option('final_cta_button_url', '/booking');
$whatsapp_text = get_option('final_cta_whatsapp_text', 'Hi! I need help planning my East Africa safari.');
$whatsapp_number = get_option('final_cta_whatsapp_number', '+254722433910');

$whatsapp_clean = preg_replace('/[^0-9]/', '', $whatsapp_number);
?>

<section class="section-brown" style="padding: 64px 0; background-color: #5a2d0c; color: #fef3c7;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 20px; text-align: center;">
        <h2 style="margin-bottom: 16px; font-size: 28px; font-weight: 700; color: white;"><?php echo esc_html($title); ?></h2>
        <p style="opacity: 0.8; margin-bottom: 32px; max-width: 700px; margin-left: auto; margin-right: auto; color: rgba(255,255,255,0.8); font-size: 16px;"><?php echo esc_html($subtitle); ?></p>
        <div style="display: flex; flex-direction: column; gap: 16px; justify-content: center;">
            <a href="<?php echo esc_url($button_url); ?>" style="display: inline-flex; align-items: center; gap: 8px; background-color: #F5A623; color: #1a3c2c; padding: 12px 32px; border-radius: 9999px; text-decoration: none; font-weight: 700; font-size: 16px; transition: all 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.1); justify-content: center;">
                <?php echo esc_html($button_text); ?> <i class="fas fa-arrow-right" style="font-size: 14px;"></i>
            </a>
            <a href="https://wa.me/<?php echo esc_attr($whatsapp_clean); ?>?text=<?php echo urlencode($whatsapp_text); ?>" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 8px; background-color: #25D366; color: white; padding: 12px 32px; border-radius: 9999px; text-decoration: none; font-weight: 700; font-size: 16px; transition: all 0.3s; justify-content: center;">
                <i class="fab fa-whatsapp" style="font-size: 18px;"></i> Inquire on WhatsApp
            </a>
        </div>
    </div>
</section>

<style>
@media (min-width: 640px) {
    .section-brown div > div:last-child {
        flex-direction: row !important;
    }
}
@media (max-width: 640px) {
    .section-brown h2 {
        font-size: 24px !important;
    }
}
.section-brown a:first-child:hover {
    background-color: #e09510 !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15) !important;
}
.section-brown a:last-child:hover {
    background-color: #1da15a !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4) !important;
}
</style>
