<?php
/**
 * Hotels & Safari Lodges Section - Exact replica of Next.js design
 */

$hotels = roaming_get_featured_hotels();

if(empty($hotels)) {
    echo '<div style="padding: 80px 0; background: white; text-align: center;">
            <div style="max-width: 1280px; margin: 0 auto;">
                <h2 style="font-size: 28px; font-weight: 700; color: #1a3c2c;">Hotels & Safari Lodges</h2>
                <p style="color: #666; margin: 20px 0;">Add hotels in the WordPress admin under "Hotels" menu.</p>
            </div>
          </div>';
    return;
}
?>

<section style="padding: 80px 0; background: white;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 20px;">
        <h2 style="text-align: center; font-size: 32px; font-weight: 700; color: #1a3c2c; margin-bottom: 16px;">Hotels & Safari Lodges</h2>
        <p style="text-align: center; color: #666; max-width: 700px; margin: 0 auto 48px;">Browse our curated selection of safari lodges, tented camps and hotels across East Africa.</p>
        
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;">
            <?php foreach($hotels as $hotel): 
                $location = get_post_meta($hotel->ID, '_hotel_location', true);
                $price_from = get_post_meta($hotel->ID, '_hotel_price_from', true);
                $tier = get_post_meta($hotel->ID, '_hotel_tier', true);
                $featured_image = get_the_post_thumbnail_url($hotel->ID, 'medium');
                if(!$featured_image) {
                    $featured_image = 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400';
                }
                
                // Tier color classes
                $tier_class = '';
                if($tier == 'luxury') $tier_class = 'bg-[#F5A623] text-black';
                elseif($tier == 'mid-range') $tier_class = 'bg-[#3b82f6] text-white';
                else $tier_class = 'bg-[#10b981] text-white';
            ?>
                <a href="<?php echo get_permalink($hotel->ID); ?>" class="hotel-card" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: 1px solid #e5e7eb; text-decoration: none; display: block; transition: all 0.3s;">
                    <div style="position: relative; height: 160px; overflow: hidden;">
                        <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr($hotel->post_title); ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;">
                        <span style="position: absolute; top: 12px; right: 12px; font-size: 11px; font-weight: bold; padding: 4px 10px; border-radius: 20px; text-transform: uppercase; <?php echo $tier == 'luxury' ? 'background: #F5A623; color: black;' : ($tier == 'mid-range' ? 'background: #3b82f6; color: white;' : 'background: #10b981; color: white;'); ?>">
                            <?php echo esc_html(ucfirst($tier ?: 'Luxury')); ?>
                        </span>
                    </div>
                    <div style="padding: 16px;">
                        <h3 style="font-size: 14px; font-weight: 700; color: #111; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
                            <i class="fas fa-bed" style="color: #298742; font-size: 14px;"></i>
                            <?php echo esc_html($hotel->post_title); ?>
                        </h3>
                        <p style="font-size: 12px; color: #666;">
                            <?php echo esc_html($location ?: 'Nairobi'); ?> • <?php echo esc_html($price_from ? "From {$price_from}/night" : 'Contact for pricing'); ?>
                        </p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        
        <div style="text-align: center; margin-top: 48px;">
            <a href="/hotels" style="display: inline-flex; align-items: center; gap: 8px; background: #298742; color: white; padding: 12px 32px; border-radius: 40px; text-decoration: none; font-weight: bold; transition: all 0.3s;">
                Browse All Hotels <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<style>
.hotel-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
.hotel-card:hover img {
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
