<?php
/**
 * Popular Destinations Section
 */

$destinations = get_option('roaming_destinations', array(
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

<div style="padding: 80px 0; background: #298742;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 20px; text-align: center;">
        <h2 style="font-size: 36px; font-weight: 700; color: white; margin-bottom: 20px;">Popular Safari Destinations</h2>
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-top: 40px;">
            <?php foreach($destinations as $dest): ?>
                <a href="<?php echo esc_url($dest['url']); ?>" style="text-decoration: none;">
                    <div style="background: #1a3c2c; border-radius: 12px; padding: 30px; text-align: center; transition: transform 0.3s;">
                        <h3 style="color: white; font-size: 18px; margin: 0;"><?php echo esc_html($dest['name']); ?></h3>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<style>
@media (max-width: 1024px) {
    [style*="grid-template-columns: repeat(4, 1fr)"] {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}
@media (max-width: 640px) {
    [style*="grid-template-columns: repeat(4, 1fr)"] {
        grid-template-columns: 1fr !important;
    }
}
[style*="background: #1a3c2c"]:hover {
    transform: translateY(-5px);
    background: #234f3a !important;
}
</style>
