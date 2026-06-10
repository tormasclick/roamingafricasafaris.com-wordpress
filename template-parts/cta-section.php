<?php
/**
 * CTA Section - Updated to match Next.js Final CTA design
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

<section style="padding: 64px 0; background: #5a2d0c;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 20px; text-align: center;">
        <h2 style="color: white; font-size: 32px; font-weight: 700; margin-bottom: 16px;"><?php echo esc_html($title); ?></h2>
        <p style="color: rgba(255,255,255,0.8); font-size: 18px; margin-bottom: 32px; max-width: 700px; margin-left: auto; margin-right: auto;"><?php echo esc_html($subtitle); ?></p>
        <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
            <a href="<?php echo esc_url($button_url); ?>" style="display: inline-flex; align-items: center; gap: 8px; background: #F5A623; color: #1a3c2c; padding: 12px 32px; border-radius: 9999px; text-decoration: none; font-weight: 700; font-size: 16px; transition: all 0.3s;">
                <?php echo esc_html($button_text); ?> <i class="fas fa-arrow-right"></i>
            </a>
            <a href="https://wa.me/<?php echo esc_attr($whatsapp_clean); ?>?text=<?php echo urlencode($whatsapp_text); ?>" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 8px; background: #25D366; color: white; padding: 12px 32px; border-radius: 9999px; text-decoration: none; font-weight: 700; font-size: 16px; transition: all 0.3s;">
                <i class="fab fa-whatsapp"></i> Inquire on WhatsApp
            </a>
        </div>
    </div>
</section>

<style>
[style*="background: #F5A623"]:hover {
    background: #e09510 !important;
    transform: translateY(-2px);
}
[style*="background: #25D366"]:hover {
    background: #1da15a !important;
    transform: translateY(-2px);
}
@media (max-width: 640px) {
    [style*="font-size: 32px"] {
        font-size: 24px !important;
    }
    [style*="font-size: 18px"] {
        font-size: 14px !important;
    }
    [style*="padding: 12px 32px"] {
        padding: 10px 20px !important;
        font-size: 14px !important;
    }
}
</style>
