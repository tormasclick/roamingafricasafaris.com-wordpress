<?php
/**
 * Safari Highlights Section - Why Travel With Us
 */

$highlights = roaming_get_highlights();
?>

<section style="padding: 80px 0; background: #f5f0e8;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 20px;">
        <div style="text-align: center; margin-bottom: 60px;">
            <span style="display: inline-block; font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; color: #F5A623;">Why travel with us</span>
            <h2 style="font-size: 32px; font-weight: 700; color: #1a3c2c; margin-bottom: 16px;">Why Travel With Roaming Africa Tours &amp; Safaris</h2>
            <p style="color: #666; max-width: 700px; margin: 0 auto;">Established in 2006, Roaming Africa Tours and Safaris combines destination management expertise with local knowledge to create seamless journeys across Kenya, Tanzania and Zanzibar.</p>
        </div>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            <?php foreach($highlights as $item): ?>
                <div class="why-travel-card" style="position: relative; overflow: hidden; border-radius: 16px; border: 1px solid #e5e5e5; padding: 28px; transition: all 0.3s; background: <?php echo isset($item['gradient']) ? $item['gradient'] : 'linear-gradient(135deg, rgba(41, 135, 66, 0.15) 0%, rgba(41, 135, 66, 0.05) 100%)'; ?>;">
                    <div style="width: 56px; height: 56px; background: #298742; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; transition: transform 0.3s;">
                        <i class="fas <?php echo esc_attr($item['icon']); ?>" style="font-size: 28px; color: white;"></i>
                    </div>
                    <h3 style="font-size: 18px; font-weight: 700; color: #1a3c2c; margin-bottom: 12px;"><?php echo esc_html($item['title']); ?></h3>
                    <p style="font-size: 14px; color: #666; line-height: 1.5;"><?php echo esc_html($item['desc']); ?></p>
                    <div style="position: absolute; right: -40px; bottom: -40px; width: 128px; height: 128px; border-radius: 50%; background: rgba(41, 135, 66, 0.05);"></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
.why-travel-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}
.why-travel-card:hover div[style*="background: #298742"] {
    transform: scale(1.05);
}
@media (max-width: 992px) {
    [style*="grid-template-columns: repeat(3, 1fr)"] {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}
@media (max-width: 768px) {
    [style*="grid-template-columns: repeat(3, 1fr)"] {
        grid-template-columns: 1fr !important;
    }
}
</style>
