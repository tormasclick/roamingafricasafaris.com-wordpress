<?php
/**
 * CTA Section
 */

$cta = roaming_get_cta();
if(!$cta['enabled']) return;
?>

<div style="padding: 80px 0; background: #F5A623;">
    <div style="max-width: 800px; margin: 0 auto; padding: 0 20px; text-align: center;">
        <h2 style="font-size: 36px; font-weight: 700; color: #2D2D2D;"><?php echo esc_html($cta['title']); ?></h2>
        <p style="font-size: 18px; margin: 20px 0 30px; color: #2D2D2D;"><?php echo esc_html($cta['subtitle']); ?></p>
        <a href="<?php echo esc_url($cta['button_url']); ?>" style="display: inline-block; background: #298742; color: white; padding: 14px 36px; border-radius: 40px; font-weight: bold; text-decoration: none; transition: background 0.3s;">
            <?php echo esc_html($cta['button_text']); ?>
        </a>
    </div>
</div>

<style>
[style*="background: #298742"]:hover {
    background: #1e6b35 !important;
}
</style>
