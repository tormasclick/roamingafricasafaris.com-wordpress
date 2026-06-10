<?php get_header(); ?>

<?php while(have_posts()): the_post(); 
<?php 
$faqs_raw = get_post_meta(get_the_ID(), '_safari_faqs', true); 
$faqs = json_decode($faqs_raw, true); 
if(!is_array($faqs)) $faqs = array(); 
?>
<div style="background: #ff00ff; color: white; padding: 10px; position: fixed; bottom: 0; left: 0; right: 0; z-index: 9999;">
FAQ Count: <?php echo count($faqs); ?> | Raw: <?php echo substr($faqs_raw, 0, 100); ?>
</div>

    $duration = get_post_meta(get_the_ID(), '_safari_duration', true);
    $price = get_post_meta(get_the_ID(), '_safari_price', true);
    $country = get_post_meta(get_the_ID(), '_safari_country', true);
    $max_people = get_post_meta(get_the_ID(), '_safari_max_people', true);
    $departure = get_post_meta(get_the_ID(), '_safari_departure', true);
    $inclusions = get_post_meta(get_the_ID(), '_safari_inclusions', true);
    $exclusions = get_post_meta(get_the_ID(), '_safari_exclusions', true);
    $faqs_raw = get_post_meta(get_the_ID(), '_safari_faqs', true);
    if(is_string($faqs_raw)) {
        $faqs = json_decode($faqs_raw, true);
    } else {
        $faqs = array();
    }
    $faqs = $faqs_raw ? json_decode($faqs_raw, true) : array();
    $itinerary_days = get_post_meta(get_the_ID(), '_safari_itinerary_days', true);
    $itinerary_days = $itinerary_days ? json_decode($itinerary_days, true) : array();
    $low_season = get_post_meta(get_the_ID(), '_safari_low_season', true);
    $low_season = $low_season ? json_decode($low_season, true) : array();
    $high_season = get_post_meta(get_the_ID(), '_safari_high_season', true);
    $high_season = $high_season ? json_decode($high_season, true) : array();
    $gallery = get_post_meta(get_the_ID(), '_safari_gallery', true);
    $gallery = $gallery ? explode(',', $gallery) : array();
    $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
    $form_shortcode = get_post_meta(get_the_ID(), '_safari_form_shortcode', true);
    $whatsapp_number = '+254722433910';
    $whatsapp_text = urlencode("Hi! I'm interested in " . get_the_title() . ". Please send more details.");
    
    $related_safaris = get_posts(array('post_type' => 'safari', 'posts_per_page' => 3, 'post__not_in' => array(get_the_ID()), 'orderby' => 'rand'));
?>

<style>
.safari-hero { position: relative; height: 400px; overflow: hidden; background: #1a3c2c; }
.safari-hero-img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-size: cover; background-position: center; }
.safari-hero-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); }
.safari-hero-content { position: relative; z-index: 10; height: 400px; display: flex; align-items: center; justify-content: center; text-align: center; color: white; }
.safari-hero-title { font-size: 48px; font-weight: 700; margin-bottom: 20px; }
.safari-hero-duration { display: inline-block; background: rgba(0,0,0,0.6); padding: 8px 24px; border-radius: 40px; margin-bottom: 20px; }
.safari-container { max-width: 1200px; margin: 0 auto; padding: 60px 20px; }
.safari-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 50px; }
.safari-section { margin-bottom: 50px; }
.safari-section h2 { font-size: 28px; color: #1a3c2c; margin-bottom: 20px; font-weight: 700; border-left: 4px solid #F5A623; padding-left: 15px; }
.inclusion-box { background: #f5f0e8; padding: 30px; border-radius: 16px; height: 100%; }
.inclusion-box h3 { font-size: 20px; margin-bottom: 20px; }
.inclusion-box ul { list-style: none; padding: 0; margin: 0; }
.inclusion-box li { margin-bottom: 12px; display: flex; align-items: flex-start; gap: 10px; color: #444; }
.inclusion-box li i { margin-top: 2px; }
.itinerary-card { border: 1px solid #e5e7eb; border-radius: 16px; overflow: hidden; margin-bottom: 30px; }
.itinerary-img { position: relative; height: 250px; overflow: hidden; }
.itinerary-img img { width: 100%; height: 100%; object-fit: cover; }
.itinerary-day { position: absolute; top: 16px; left: 16px; background: #F5A623; color: #1a3c2c; padding: 6px 16px; border-radius: 30px; font-size: 12px; font-weight: bold; }
.itinerary-content { padding: 24px; }
.itinerary-title { font-size: 20px; color: #1a3c2c; margin-bottom: 12px; font-weight: 700; }
.itinerary-desc { color: #666; line-height: 1.6; margin-bottom: 16px; }
.itinerary-overnight { background: #f5f0e8; padding: 12px 16px; border-radius: 12px; }
.pricing-table { border-radius: 16px; overflow: hidden; margin-bottom: 24px; border: 1px solid #298742; }
.pricing-header { background: #298742; color: white; padding: 16px 20px; }
.pricing-table-inner { overflow-x: auto; background: #f5f1e8; }
.pricing-table table { width: 100%; border-collapse: collapse; }
.pricing-table th { padding: 12px; text-align: center; background: #3a4b2a; color: white; }
.pricing-table td { padding: 12px; text-align: center; border-bottom: 1px solid #ddd; }
.faq-item { margin-bottom: 16px; border-bottom: 1px solid #e5e7eb; }
.faq-question { padding: 16px 0; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; color: #1a3c2c; }
.faq-answer { display: none; padding-bottom: 16px; color: #666; line-height: 1.6; }
.faq-item.open .faq-answer { display: block; }
.faq-item.open .faq-question i { transform: rotate(180deg); }
.gallery-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin-top: 20px; }
.gallery-img { width: 100%; height: 150px; object-fit: cover; border-radius: 12px; cursor: pointer; }
.related-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 20px; }
.related-card { text-decoration: none; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: all 0.3s; }
.related-card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
.related-img { position: relative; height: 160px; overflow: hidden; }
.related-img img { width: 100%; height: 100%; object-fit: cover; }
.related-badge { position: absolute; top: 10px; left: 10px; background: #298742; color: white; font-size: 10px; padding: 4px 10px; border-radius: 20px; }
.related-price { position: absolute; top: 10px; right: 10px; background: #F5A623; color: #1a3c2c; font-size: 10px; font-weight: bold; padding: 4px 10px; border-radius: 20px; }
.related-content { padding: 16px; }
.related-title { font-size: 16px; color: #1a3c2c; margin-bottom: 8px; font-weight: 700; }
.sidebar-card { background: white; border: 1px solid #e5e7eb; border-radius: 16px; padding: 24px; margin-bottom: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
.whatsapp-btn { display: flex; align-items: center; justify-content: center; gap: 8px; background: #25D366; color: white; padding: 14px; border-radius: 40px; text-decoration: none; font-weight: bold; }
.whatsapp-btn:hover { background: #1da15a; transform: translateY(-2px); }
@media (max-width: 768px) { .safari-grid { grid-template-columns: 1fr; } .gallery-grid { grid-template-columns: repeat(2, 1fr); } .related-grid { grid-template-columns: 1fr; } .safari-hero-title { font-size: 32px; } }
</style>

<!-- Hero Section -->
<div class="safari-hero">
    <?php if($featured_image): ?>
        <div class="safari-hero-img" style="background-image: url('<?php echo esc_url($featured_image); ?>');"></div>
    <?php endif; ?>
    <div class="safari-hero-overlay"></div>
    <div class="safari-hero-content">
        <div>
            <?php if($duration): ?>
                <div class="safari-hero-duration"><i class="far fa-clock"></i> <?php echo esc_html($duration); ?></div>
            <?php endif; ?>
            <h1 class="safari-hero-title"><?php the_title(); ?></h1>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="safari-container">
    <div class="safari-grid">
        <!-- Left Column -->
        <div>
            <!-- Overview -->
            <div class="safari-section">
                <h2>Overview</h2>
                <div style="line-height: 1.8; color: #444;"><?php the_content(); ?></div>
            </div>
            
            <!-- Day-by-Day Itinerary -->
            <?php if(!empty($itinerary_days)): ?>
            <div class="safari-section">
                <h2>Day-by-Day Itinerary</h2>
                <p style="color: #666; margin-bottom: 24px;">Tap any day for full details. Swipe horizontally on mobile.</p>
                <?php foreach($itinerary_days as $day): ?>
                <div class="itinerary-card">
                    <div class="itinerary-img">
                        <?php if(!empty($day['image_id'])): 
                            $day_img = wp_get_attachment_url($day['image_id']);
                            if($day_img): ?>
                                <img src="<?php echo esc_url($day_img); ?>" alt="Day <?php echo $day['day']; ?>">
                            <?php endif;
                        else: ?>
                            <img src="https://images.unsplash.com/photo-1516426122078-c23e76319801?w=800" alt="Safari">
                        <?php endif; ?>
                        <span class="itinerary-day">Day <?php echo $day['day']; ?></span>
                    </div>
                    <div class="itinerary-content">
                        <h3 class="itinerary-title"><?php echo esc_html($day['title']); ?></h3>
                        <p class="itinerary-desc"><?php echo nl2br(esc_html($day['desc'])); ?></p>
                        <?php if(!empty($day['overnight'])): ?>
                            <div class="itinerary-overnight">
                                <i class="fas fa-bed" style="color: #298742;"></i> <strong>Overnight:</strong> <?php echo esc_html($day['overnight']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            
            <!-- Inclusions & Exclusions -->
            <div class="safari-section">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                    <?php if(!empty($inclusions)): ?>
                        <div class="inclusion-box">
                            <h3 style="color: #298742;"><i class="fas fa-check-circle"></i> Inclusions</h3>
                            <ul>
                                <?php 
                                $inc_items = explode("\n", $inclusions);
                                foreach($inc_items as $item):
                                    $item = trim($item);
                                    if(!empty($item)):
                                ?>
                                    <li><i class="fas fa-check-circle" style="color: #298742;"></i> <?php echo esc_html($item); ?></li>
                                <?php endif; endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($exclusions)): ?>
                        <div class="inclusion-box">
                            <h3 style="color: #dc3232;"><i class="fas fa-times-circle"></i> Exclusions</h3>
                            <ul>
                                <?php 
                                $exc_items = explode("\n", $exclusions);
                                foreach($exc_items as $item):
                                    $item = trim($item);
                                    if(!empty($item)):
                                ?>
                                    <li><i class="fas fa-times-circle" style="color: #dc3232;"></i> <?php echo esc_html($item); ?></li>
                                <?php endif; endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Tour Pricing -->
            <?php if(!empty($low_season) || !empty($high_season)): ?>
            <div class="safari-section">
                <h2>Tour Pricing</h2>
                <p style="color: #666; margin-bottom: 24px;">Group discounts available. Prices include accommodation, meals, guide, and park fees.</p>
                
                <?php if(!empty($low_season)): ?>
                <div class="pricing-table">
                    <div class="pricing-header">
                        <h3 style="color: white; margin: 0;">Low Season</h3>
                        <p style="margin: 4px 0 0; font-size: 12px;">April · May · November</p>
                    </div>
                    <div class="pricing-table-inner">
                        <table>
                            <thead><tr><th>Level</th><th>Adventure</th><th>Comfort</th></tr></thead>
                            <tbody>
                                <tr><td>1 Person</td><td><?php echo esc_html($low_season['adventure_1'] ?? '$1,650'); ?></td><td><?php echo esc_html($low_season['comfort_1'] ?? '$2,640'); ?></td></tr>
                                <tr><td>2 People</td><td><?php echo esc_html($low_season['adventure_2'] ?? '$1,400'); ?></td><td><?php echo esc_html($low_season['comfort_2'] ?? '$2,240'); ?></td></tr>
                                <tr><td>4 People</td><td><?php echo esc_html($low_season['adventure_4'] ?? '$1,240'); ?></td><td><?php echo esc_html($low_season['comfort_4'] ?? '$1,980'); ?></td></tr>
                                <tr><td>6+ People</td><td><?php echo esc_html($low_season['adventure_6'] ?? '$1,070'); ?></td><td><?php echo esc_html($low_season['comfort_6'] ?? '$1,720'); ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if(!empty($high_season)): ?>
                <div class="pricing-table">
                    <div class="pricing-header">
                        <h3 style="color: white; margin: 0;">High Season</h3>
                        <p style="margin: 4px 0 0; font-size: 11px;">January · February · March · June · July · August · September · October · December</p>
                    </div>
                    <div class="pricing-table-inner">
                        <table>
                            <thead><tr><th>Level</th><th>Adventure</th><th>Comfort</th></tr></thead>
                            <tbody>
                                <tr><td>1 Person</td><td><?php echo esc_html($high_season['adventure_1'] ?? '$1,980'); ?></td><td><?php echo esc_html($high_season['comfort_1'] ?? '$3,170'); ?></td></tr>
                                <tr><td>2 People</td><td><?php echo esc_html($high_season['adventure_2'] ?? '$1,680'); ?></td><td><?php echo esc_html($high_season['comfort_2'] ?? '$2,690'); ?></td></tr>
                                <tr><td>4 People</td><td><?php echo esc_html($high_season['adventure_4'] ?? '$1,490'); ?></td><td><?php echo esc_html($high_season['comfort_4'] ?? '$2,380'); ?></td></tr>
                                <tr><td>6+ People</td><td><?php echo esc_html($high_season['adventure_6'] ?? '$1,290'); ?></td><td><?php echo esc_html($high_season['comfort_6'] ?? '$2,060'); ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>
                <p style="font-size: 12px; color: #666; margin-top: 16px;">* Cost per person sharing. Prices in USD.</p>
            </div>
            <?php endif; ?>
            
            <!-- FAQs -->
            <?php if(!empty($faqs)): ?>
            <div class="safari-section">
<?php if(current_user_can('administrator')): ?>
<div style="background: yellow; padding: 15px; margin: 15px 0; border: 2px solid red;">
<strong>DEBUG:</strong> FAQs count = <?php echo count($faqs); ?> | Raw data type: <?php echo gettype($faqs_raw); ?>
</div>
<?php endif; ?>

                <h2>Frequently Asked Questions</h2>
                <?php foreach($faqs as $faq): ?>
                <div class="faq-item">
                    <div class="faq-question" onclick="this.parentElement.classList.toggle('open')">
                        <?php echo esc_html($faq['question']); ?>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer"><?php echo esc_html($faq['answer']); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            
            <!-- Gallery -->
            <?php if(!empty($gallery)): ?>
            <div class="safari-section">
                <h2>Gallery</h2>
                <div class="gallery-grid">
                    <?php foreach($gallery as $img_id): 
                        $img_url = wp_get_attachment_url($img_id);
                        if($img_url): ?>
                            <img src="<?php echo esc_url($img_url); ?>" class="gallery-img" onclick="window.open(this.src)">
                        <?php endif; 
                    endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Related Safaris -->
            <?php if(!empty($related_safaris)): ?>
            <div class="safari-section">
                <h2>Related Safari Packages</h2>
                <div class="related-grid">
                    <?php foreach($related_safaris as $related): 
                        $rel_duration = get_post_meta($related->ID, '_safari_duration', true);
                        $rel_price = get_post_meta($related->ID, '_safari_price', true);
                        $rel_country = get_post_meta($related->ID, '_safari_country', true);
                        $rel_image = get_the_post_thumbnail_url($related->ID, 'medium');
                        if(!$rel_image) $rel_image = 'https://images.unsplash.com/photo-1516426122078-c23e76319801?w=400';
                    ?>
                        <a href="<?php echo get_permalink($related->ID); ?>" class="related-card">
                            <div class="related-img">
                                <img src="<?php echo esc_url($rel_image); ?>" alt="<?php echo esc_attr($related->post_title); ?>">
                                <?php if($rel_country): ?>
                                    <span class="related-badge"><?php echo esc_html($rel_country); ?></span>
                                <?php endif; ?>
                                <?php if($rel_price): ?>
                                    <span class="related-price">From <?php echo esc_html($rel_price); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="related-content">
                                <?php if($rel_duration): ?>
                                    <div style="font-size: 12px; color: #666; margin-bottom: 8px;"><i class="far fa-clock"></i> <?php echo esc_html($rel_duration); ?></div>
                                <?php endif; ?>
                                <h3 class="related-title"><?php echo esc_html($related->post_title); ?></h3>
                                <p style="color: #298742; font-size: 14px; font-weight: bold;">View Details <i class="fas fa-arrow-right"></i></p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Right Column - Sidebar -->
        <div>
            <div style="position: sticky; top: 100px;">
                <div class="sidebar-card">
                    <h3 style="text-align: center; font-size: 20px; margin-bottom: 8px;">Plan Your Safari</h3>
                    <p style="text-align: center; font-size: 12px; color: #666; margin-bottom: 20px;">We reply within 1 hour · Free consultation</p>
                    <?php if($duration): ?>
                        <p style="text-align: center; margin-bottom: 20px;"><?php echo esc_html($duration); ?></p>
                    <?php endif; ?>
                    <?php if($form_shortcode): ?>
                        <?php echo do_shortcode($form_shortcode); ?>
                    <?php else: ?>
                        <div style="background: #f5f0e8; padding: 20px; text-align: center; border-radius: 12px;">
                            <p>Booking form will appear here.</p>
                            <p>Add shortcode in the meta box.</p>
                        </div>
                    <?php endif; ?>
                </div>
                <a href="https://wa.me/<?php echo esc_attr($whatsapp_number); ?>?text=<?php echo esc_attr($whatsapp_text); ?>" target="_blank" class="whatsapp-btn">
                    <i class="fab fa-whatsapp"></i> Inquire on WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.faq-question').forEach(function(el) {
    el.addEventListener('click', function() {
        this.parentElement.classList.toggle('open');
    });
});
</script>

<?php endwhile; ?>
<?php get_footer(); ?>
