<?php
/**
 * Featured Safari Deals Section - Dynamic from backend
 */

$safari_count = get_option('featured_safaris_count', 4);
$section_title = get_option('featured_safaris_title', 'Best Featured Safari Deals');
$section_subtitle = get_option('featured_safaris_subtitle', 'Explore our most popular safari packages across East Africa. Each tour is carefully designed to showcase the best wildlife and landscapes.');

$safaris = new WP_Query(array(
    'post_type' => 'safari', 
    'posts_per_page' => $safari_count,
    'meta_key' => '_thumbnail_id',
    'orderby' => 'date',
    'order' => 'DESC'
));
?>

<section style="padding: 64px 0; background: white;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 20px;">
        <div style="text-align: center; margin-bottom: 48px;">
            <h2 style="font-size: 32px; font-weight: 700; color: #1a3c2c; margin-bottom: 16px;"><?php echo esc_html($section_title); ?></h2>
            <p style="color: #666; max-width: 700px; margin: 0 auto;"><?php echo esc_html($section_subtitle); ?></p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;">
            <?php if($safaris->have_posts()) : while($safaris->have_posts()) : $safaris->the_post(); 
                $duration = get_post_meta(get_the_ID(), '_safari_duration', true);
                $price = get_post_meta(get_the_ID(), '_safari_price', true);
                $country = get_post_meta(get_the_ID(), '_safari_country', true);
            ?>
                <div class="safari-card" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: 1px solid #eee; transition: transform 0.3s;">
                    <div style="position: relative; height: 200px; overflow: hidden;">
                        <?php if(has_post_thumbnail()): ?>
                            <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>" style="width:100%; height:100%; object-fit:cover; transition: transform 0.3s;">
                        <?php else: ?>
                            <img src="https://images.unsplash.com/photo-1516426122078-c23e76319801?w=400" alt="Safari" style="width:100%; height:100%; object-fit:cover;">
                        <?php endif; ?>
                        <div style="position: absolute; top: 12px; left: 12px; background: #298742; color: white; font-size: 12px; font-weight: bold; padding: 4px 12px; border-radius: 20px;"><?php echo esc_html(ucfirst($country ?: 'Kenya')); ?></div>
                        <?php if($price): ?>
                            <div style="position: absolute; top: 12px; right: 12px; background: #F5A623; color: black; font-size: 12px; font-weight: bold; padding: 4px 12px; border-radius: 20px;">From <?php echo esc_html($price); ?></div>
                        <?php endif; ?>
                    </div>
                    <div style="padding: 16px;">
                        <?php if($duration): ?>
                            <div style="display: flex; align-items: center; gap: 8px; color: #666; font-size: 14px; margin-bottom: 8px;">
                                <i class="far fa-clock"></i> <span><?php echo esc_html($duration); ?></span>
                            </div>
                        <?php endif; ?>
                        <h3 style="font-size: 18px; font-weight: 700; color: #111; margin-bottom: 8px;"><?php the_title(); ?></h3>
                        <p style="color: #666; font-size: 14px; margin-bottom: 16px; line-height: 1.4;"><?php echo wp_trim_words(get_the_excerpt(), 12, '...'); ?></p>
                        <a href="<?php the_permalink(); ?>" style="display: inline-flex; align-items: center; gap: 8px; color: #298742; font-weight: bold; font-size: 14px; text-decoration: none;">View Full Itinerary <i class="fas fa-arrow-right" style="font-size: 12px;"></i></a>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
        
        <div style="text-align: center; margin-top: 48px;">
            <a href="/safari" style="display: inline-block; background: #298742; color: white; padding: 12px 32px; border-radius: 40px; font-weight: bold; text-decoration: none; transition: all 0.3s;">View All Safaris <i class="fas fa-arrow-right" style="margin-left: 8px;"></i></a>
        </div>
    </div>
</section>

<style>
.safari-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
.safari-card:hover img {
    transform: scale(1.05);
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
