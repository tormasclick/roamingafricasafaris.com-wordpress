<?php
/**
 * Popular Destinations Section - Using Custom Post Type
 */

// Get destinations from custom post type
$destinations = get_posts(array(
    'post_type' => 'destination',
    'posts_per_page' => 8,
    'meta_key' => '_thumbnail_id',
    'orderby' => 'date',
    'order' => 'DESC'
));

// If no destinations exist yet, show placeholder
if(empty($destinations)) {
    echo '<div style="padding: 80px 0; background: #298742; text-align: center;">
            <h2 style="color: white;">Popular Safari Destinations</h2>
            <p style="color: rgba(255,255,255,0.8);">Please add destinations in the WordPress admin under "Destinations" menu.</p>
          </div>';
    return;
}
?>

<div style="padding: 80px 0; background: #298742;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 20px;">
        <h2 style="text-align: center; margin-bottom: 16px; font-size: 36px; font-weight: 700; color: white;">Popular Safari Destinations</h2>
        <p style="text-align: center; color: rgba(255,255,255,0.8); margin-bottom: 48px;">From the iconic Masai Mara to the exotic beaches of Zanzibar, discover East Africa's most spectacular destinations.</p>
        
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;">
            <?php foreach($destinations as $destination): 
                $country = get_post_meta($destination->ID, '_destination_country', true);
                $featured_image = get_the_post_thumbnail_url($destination->ID, 'medium');
                if(!$featured_image) {
                    $featured_image = 'https://images.unsplash.com/photo-1516426122078-c23e76319801?w=600';
                }
            ?>
                <a href="<?php echo get_permalink($destination->ID); ?>" class="dest-card" style="position: relative; border-radius: 16px; overflow: hidden; height: 280px; display: block; text-decoration: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: all 0.3s;">
                    <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr($destination->post_title); ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;">
                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.2) 50%, rgba(0,0,0,0.1) 100%);"></div>
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 20px;">
                        <h3 style="color: white; font-size: 18px; font-weight: 700; margin-bottom: 4px;"><?php echo esc_html($destination->post_title); ?></h3>
                        <p style="color: rgba(255,255,255,0.8); font-size: 14px;"><?php echo esc_html($country ?: 'Kenya'); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<style>
.dest-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.25) !important;
}
.dest-card:hover img {
    transform: scale(1.1);
}
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
</style>
