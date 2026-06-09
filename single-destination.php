<?php get_header(); ?>

<?php while(have_posts()): the_post(); 
    $country = get_post_meta(get_the_ID(), '_destination_country', true);
    $best_time = get_post_meta(get_the_ID(), '_destination_best_time', true);
    $wildlife = get_post_meta(get_the_ID(), '_destination_wildlife', true);
    $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>

<!-- Hero Section -->
<div style="position: relative; height: 500px; overflow: hidden;">
    <?php if($featured_image): ?>
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('<?php echo esc_url($featured_image); ?>'); background-size: cover; background-position: center;">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);"></div>
        </div>
    <?php endif; ?>
    
    <div style="position: relative; z-index: 10; height: 500px; display: flex; align-items: center; justify-content: center; text-align: center; color: white; padding: 0 20px;">
        <div>
            <h1 style="font-size: 48px; margin-bottom: 20px;"><?php the_title(); ?></h1>
            <p style="font-size: 18px;"><?php echo esc_html($country); ?></p>
        </div>
    </div>
</div>

<!-- Content Section -->
<div style="max-width: 1280px; margin: 0 auto; padding: 60px 20px;">
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px;">
        <div>
            <h2 style="font-size: 28px; color: #1a3c2c; margin-bottom: 20px;">About <?php the_title(); ?></h2>
            <div style="line-height: 1.8; color: #444;">
                <?php the_content(); ?>
            </div>
            
            <?php if($wildlife): ?>
                <h3 style="font-size: 24px; color: #1a3c2c; margin: 40px 0 20px;">Wildlife & Highlights</h3>
                <p style="line-height: 1.8; color: #444;"><?php echo esc_html($wildlife); ?></p>
            <?php endif; ?>
        </div>
        
        <div>
            <div style="background: #f5f0e8; padding: 30px; border-radius: 16px;">
                <h3 style="font-size: 20px; color: #1a3c2c; margin-bottom: 20px;">Destination Information</h3>
                
                <?php if($country): ?>
                    <div style="margin-bottom: 20px;">
                        <strong>📍 Country:</strong>
                        <p style="margin-top: 5px; color: #666;"><?php echo esc_html($country); ?></p>
                    </div>
                <?php endif; ?>
                
                <?php if($best_time): ?>
                    <div style="margin-bottom: 20px;">
                        <strong>📅 Best Time to Visit:</strong>
                        <p style="margin-top: 5px; color: #666;"><?php echo esc_html($best_time); ?></p>
                    </div>
                <?php endif; ?>
                
                <div style="margin-top: 30px;">
                    <a href="/contact" style="display: inline-block; background: #F5A623; color: #1a3c2c; padding: 12px 30px; border-radius: 40px; text-decoration: none; font-weight: bold;">
                        Plan Your Safari →
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
