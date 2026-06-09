<?php get_header(); while(have_posts()): the_post();
$capacity = get_post_meta(get_the_ID(), '_vehicle_capacity', true);
$type = get_post_meta(get_the_ID(), '_vehicle_type', true);
$price = get_post_meta(get_the_ID(), '_vehicle_price_from', true);
$features = get_post_meta(get_the_ID(), '_vehicle_features', true);
$gallery = get_post_meta(get_the_ID(), '_vehicle_gallery', true);
$gallery = $gallery ? explode(',', $gallery) : array();
$faqs = get_post_meta(get_the_ID(), '_vehicle_faqs', true);
$faqs = $faqs ? json_decode($faqs, true) : array();
$main_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
if(!$main_image) $main_image = 'https://images.unsplash.com/photo-1583201197280-159f2d4b1a61?w=1200';
?>
<div style="max-width: 1280px; margin: 0 auto; padding: 40px 20px;">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-bottom: 60px;">
        <div><img src="<?php echo esc_url($main_image); ?>" style="width:100%; border-radius:16px;"></div>
        <div>
            <h1 style="font-size: 36px; color:#1a3c2c;"><?php the_title(); ?></h1>
            <p style="color:#666; margin:16px 0;"><i class="fas fa-users"></i> <?php echo esc_html($capacity ?: 'Contact for capacity'); ?></p>
            <?php if($price): ?><p style="color:#298742; font-size:24px; font-weight:bold;">From <?php echo esc_html($price); ?>/day</p><?php endif; ?>
            <div style="margin:20px 0; line-height:1.8;"><?php the_content(); ?></div>
            <?php echo do_shortcode('[contact-form-7 id="123" title="Vehicle Booking"]'); ?>
        </div>
    </div>
    <?php if(!empty($gallery)): ?>
    <div style="margin-bottom:60px;"><h2 style="font-size:28px; color:#1a3c2c;">Vehicle Gallery</h2><div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-top:20px;"><?php foreach($gallery as $img): $url = wp_get_attachment_url($img); if($url): ?><img src="<?php echo esc_url($url); ?>" style="width:100%; height:150px; object-fit:cover; border-radius:12px;"><?php endif; endforeach; ?></div></div>
    <?php endif; ?>
    <?php if(!empty($faqs)): ?>
    <div><h2 style="font-size:28px; color:#1a3c2c;">Frequently Asked Questions</h2><?php foreach($faqs as $faq): ?><div style="margin:20px 0;"><strong><?php echo esc_html($faq['question']); ?></strong><p style="margin-top:8px; color:#666;"><?php echo esc_html($faq['answer']); ?></p></div><?php endforeach; ?></div>
    <?php endif; ?>
</div>
<?php endwhile; get_footer(); ?>
