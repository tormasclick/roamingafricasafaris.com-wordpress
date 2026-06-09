<?php
$vehicles = roaming_get_featured_vehicles();
if(empty($vehicles)) return;
?>
<section style="padding: 80px 0; background: #f5f0e8;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 20px;">
        <h2 style="text-align: center; font-size: 32px; font-weight: 700; color: #1a3c2c; margin-bottom: 16px;">Safari Vehicles & Tour Buses</h2>
        <p style="text-align: center; color: #666; max-width: 700px; margin: 0 auto 48px;">Hire reliable safari vehicles in Nairobi and Arusha. All vehicles come with experienced professional driver guides.</p>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            <?php foreach($vehicles as $vehicle):
                $capacity = get_post_meta($vehicle->ID, '_vehicle_capacity', true);
                $image = get_the_post_thumbnail_url($vehicle->ID, 'medium');
                if(!$image) $image = 'https://images.unsplash.com/photo-1583201197280-159f2d4b1a61?w=400';
            ?>
                <a href="<?php echo get_permalink($vehicle->ID); ?>" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-decoration: none; display: block; transition: all 0.3s;">
                    <div style="height: 200px; overflow: hidden;">
                        <img src="<?php echo esc_url($image); ?>" style="width:100%; height:100%; object-fit:cover; transition:transform 0.5s;">
                    </div>
                    <div style="padding: 20px;">
                        <h3 style="font-size: 16px; font-weight: 700; color: #1a3c2c; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-car" style="color:#298742;"></i> <?php echo esc_html($vehicle->post_title); ?>
                        </h3>
                        <p style="font-size: 12px; color: #666; margin-top: 8px;"><?php echo esc_html($capacity ?: 'Contact for capacity'); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <div style="text-align: center; margin-top: 48px;">
            <a href="/vehicles" style="display: inline-flex; align-items: center; gap: 8px; background: #298742; color: white; padding: 12px 32px; border-radius: 40px; text-decoration: none; font-weight: bold;">
                View All Vehicles <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
<?php
