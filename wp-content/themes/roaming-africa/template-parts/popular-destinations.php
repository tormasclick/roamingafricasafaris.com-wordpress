<?php
$destinations = roaming_get_destinations();
if(empty($destinations)) return;
?>
<div style="padding: 80px 0; background: #298742;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 20px; text-align: center;">
        <h2 style="font-size: 36px; font-weight: 700; color: white; margin-bottom: 20px;">Popular Safari Destinations</h2>
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-top: 50px;">
            <?php foreach($destinations as $dest): ?>
                <a href="<?php echo esc_url($dest['url']); ?>" style="background: #1a3c2c; border-radius: 12px; padding: 40px; text-align: center; text-decoration: none; display: block;">
                    <h3 style="color: white;"><?php echo esc_html($dest['name']); ?></h3>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
