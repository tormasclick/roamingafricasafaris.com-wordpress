<?php get_header(); ?>

<?php while(have_posts()): the_post(); 
    $location = get_post_meta(get_the_ID(), '_hotel_location', true);
    $price_from = get_post_meta(get_the_ID(), '_hotel_price_from', true);
    $tier = get_post_meta(get_the_ID(), '_hotel_tier', true);
    $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>

<article style="max-width: 1280px; margin: 0 auto; padding: 40px 20px;">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
        <div>
            <?php if($featured_image): ?>
                <img src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title(); ?>" style="width: 100%; border-radius: 16px;">
            <?php endif; ?>
        </div>
        <div>
            <span style="display: inline-block; background: <?php echo $tier == 'luxury' ? '#F5A623' : ($tier == 'mid-range' ? '#3b82f6' : '#10b981'); ?>; color: <?php echo $tier == 'luxury' ? 'black' : 'white'; ?>; padding: 4px 12px; border-radius: 20px; font-size: 12px; margin-bottom: 16px;">
                <?php echo esc_html(ucfirst($tier ?: 'Luxury')); ?>
            </span>
            <h1 style="font-size: 36px; color: #1a3c2c; margin-bottom: 16px;"><?php the_title(); ?></h1>
            <p style="color: #666; margin-bottom: 16px;"><i class="fas fa-map-marker-alt"></i> <?php echo esc_html($location ?: 'Nairobi'); ?></p>
            <?php if($price_from): ?>
                <p style="font-size: 24px; color: #298742; font-weight: bold; margin-bottom: 24px;">From <?php echo esc_html($price_from); ?>/night</p>
            <?php endif; ?>
            <div style="line-height: 1.8; color: #444;"><?php the_content(); ?></div>
            <a href="/booking" style="display: inline-block; background: #F5A623; color: #1a3c2c; padding: 12px 32px; border-radius: 40px; text-decoration: none; font-weight: bold; margin-top: 24px;">Book This Hotel →</a>
        </div>
    </div>
</article>

<?php endwhile; ?>

<?php get_footer(); ?>
