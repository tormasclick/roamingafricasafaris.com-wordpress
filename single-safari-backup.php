<?php get_header(); ?>

<?php while(have_posts()): the_post(); 
    $duration = get_post_meta(get_the_ID(), '_safari_duration', true);
    $price = get_post_meta(get_the_ID(), '_safari_price', true);
    $country = get_post_meta(get_the_ID(), '_safari_country', true);
    $max_people = get_post_meta(get_the_ID(), '_safari_max_people', true);
    $departure = get_post_meta(get_the_ID(), '_safari_departure', true);
    $itinerary_days = get_post_meta(get_the_ID(), '_safari_itinerary_days', true);
    $itinerary_days = $itinerary_days ? json_decode($itinerary_days, true) : array();
    $low_season = get_post_meta(get_the_ID(), '_safari_low_season', true);
    $low_season = $low_season ? json_decode($low_season, true) : array();
    $high_season = get_post_meta(get_the_ID(), '_safari_high_season', true);
    $high_season = $high_season ? json_decode($high_season, true) : array();
    $inclusions = get_post_meta(get_the_ID(), '_safari_inclusions', true);
    $exclusions = get_post_meta(get_the_ID(), '_safari_exclusions', true);
    $faqs = get_post_meta(get_the_ID(), '_safari_faqs', true);
    $faqs = $faqs ? json_decode($faqs, true) : array();
    $gallery = get_post_meta(get_the_ID(), '_safari_gallery', true);
    $gallery = $gallery ? explode(',', $gallery) : array();
    $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
    $form_shortcode = get_post_meta(get_the_ID(), '_safari_form_shortcode', true);
    $whatsapp_number = '+254722433910';
    $whatsapp_text = urlencode("Hi! I'm interested in " . get_the_title() . ". Please send more details.");
    
    $related_safaris = get_posts(array('post_type' => 'safari', 'posts_per_page' => 3, 'post__not_in' => array(get_the_ID()), 'orderby' => 'rand'));
?>

<style>
    .single-safari-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }
    .single-safari-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 40px;
    }
    .single-safari-section {
        margin-bottom: 48px;
    }
    .single-safari-section h2 {
        font-size: 28px;
        color: #1a3c2c;
        margin-bottom: 20px;
        font-weight: 700;
    }
    .itinerary-card {
        margin-bottom: 30px;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        overflow: hidden;
    }
    .itinerary-image {
        position: relative;
        height: 250px;
        overflow: hidden;
    }
    .itinerary-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .itinerary-day-badge {
        position: absolute;
        top: 16px;
        left: 16px;
        background: #F5A623;
        color: #1a3c2c;
        padding: 6px 16px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: bold;
    }
    .itinerary-content {
        padding: 24px;
    }
    .itinerary-title {
        font-size: 20px;
        color: #1a3c2c;
        margin-bottom: 12px;
        font-weight: 700;
    }
    .itinerary-desc {
        color: #666;
        line-height: 1.6;
        margin-bottom: 16px;
    }
    .itinerary-overnight {
        background: #f5f0e8;
        padding: 12px 16px;
        border-radius: 12px;
    }
    .inclusion-box {
        background: #f5f0e8;
        padding: 24px;
        border-radius: 16px;
    }
    .pricing-table {
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 24px;
        border: 1px solid #298742;
    }
    .pricing-header {
        background: #298742;
        color: white;
        padding: 16px 20px;
    }
    .pricing-table-inner {
        overflow-x: auto;
        background: #f5f1e8;
    }
    .pricing-table table {
        width: 100%;
        border-collapse: collapse;
    }
    .pricing-table th {
        padding: 12px;
        text-align: center;
        background: #3a4b2a;
        color: white;
    }
    .pricing-table td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }
    .sidebar-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .sidebar-title {
        text-align: center;
        font-size: 20px;
        color: #1a3c2c;
        margin-bottom: 8px;
        font-weight: 700;
    }
    .sidebar-subtitle {
        text-align: center;
        font-size: 12px;
        color: #666;
        margin-bottom: 20px;
    }
    .form-group {
        margin-bottom: 16px;
    }
    .form-group label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 6px;
    }
    .form-group input, .form-group select, .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 14px;
    }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
        border-color: #298742;
        outline: none;
    }
    .form-row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    .submit-btn {
        width: 100%;
        background: #F5A623;
        color: #1a3c2c;
        padding: 14px;
        border-radius: 40px;
        font-weight: 700;
        font-size: 16px;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 8px;
    }
    .submit-btn:hover {
        background: #e09510;
        transform: translateY(-2px);
    }
    .whatsapp-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #25D366;
        color: white;
        padding: 14px;
        border-radius: 40px;
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s;
    }
    .whatsapp-btn:hover {
        background: #1da15a;
        transform: translateY(-2px);
    }
    .faq-item {
        margin-bottom: 16px;
        border-bottom: 1px solid #e5e7eb;
    }
    .faq-question {
        padding: 16px 0;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 600;
        color: #1a3c2c;
    }
    .faq-answer {
        display: none;
        padding-bottom: 16px;
        color: #666;
        line-height: 1.6;
    }
    .faq-question i {
        transition: transform 0.3s;
    }
    .faq-item.open .faq-answer {
        display: block;
    }
    .faq-item.open .faq-question i {
        transform: rotate(180deg);
    }
    @media (max-width: 768px) {
        .single-safari-grid {
            grid-template-columns: 1fr;
        }
        .form-row-2 {
            grid-template-columns: 1fr;
        }
        .single-safari-section h2 {
            font-size: 24px;
        }
    }
</style>

<!-- Hero Section -->
<div style="position: relative; height: 500px; overflow: hidden; background: #1a3c2c;">
    <?php if($featured_image): ?>
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('<?php echo esc_url($featured_image); ?>'); background-size: cover; background-position: center;"></div>
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);"></div>
    <?php endif; ?>
    <div style="position: relative; z-index: 10; height: 500px; display: flex; align-items: center; justify-content: center; text-align: center; color: white; padding: 0 20px;">
        <div>
            <?php if($duration): ?>
                <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(0,0,0,0.6); padding: 8px 20px; border-radius: 40px; margin-bottom: 20px;">
                    <i class="far fa-clock"></i> <?php echo esc_html($duration); ?>
                </div>
            <?php endif; ?>
            <h1 style="font-size: 48px; margin-bottom: 20px; font-weight: 700;"><?php the_title(); ?></h1>
        </div>
    </div>
</div>

<!-- Breadcrumbs -->
<div style="max-width: 1200px; margin: 0 auto; padding: 16px 20px;">
    <nav style="display: flex; align-items: center; gap: 8px; font-size: 14px; flex-wrap: wrap;">
        <a href="<?php echo home_url(); ?>" style="color: #666; text-decoration: none;"><i class="fas fa-home"></i> Home</a>
        <i class="fas fa-chevron-right" style="font-size: 10px; color: #999;"></i>
        <a href="/safari" style="color: #666; text-decoration: none;">Safaris</a>
        <i class="fas fa-chevron-right" style="font-size: 10px; color: #999;"></i>
        <span style="color: #298742;"><?php the_title(); ?></span>
    </nav>
</div>

<!-- Main Content -->
<div class="single-safari-container">
    <div class="single-safari-grid">
        
        <!-- LEFT COLUMN -->
        <div>
            <!-- Overview -->
            <div class="single-safari-section">
                <h2>Overview</h2>
                <div style="line-height: 1.8; color: #444; font-size: 16px;"><?php the_content(); ?></div>
            </div>
            
            <!-- Itinerary -->
            <?php if(!empty($itinerary_days)): ?>
            <div class="single-safari-section">
                <h2>Day-by-Day Itinerary</h2>
                <p style="color: #666; margin-bottom: 24px;">Tap any day for full details.</p>
                <?php foreach($itinerary_days as $day): ?>
                    <div class="itinerary-card">
                        <div class="itinerary-image">
                            <?php if(!empty($day['image_id'])): 
                                $day_image = wp_get_attachment_url($day['image_id']);
                                if($day_image): ?>
                                    <img src="<?php echo esc_url($day_image); ?>" alt="Day <?php echo $day['day']; ?>">
                                <?php else: ?>
                                    <img src="https://images.unsplash.com/photo-1516426122078-c23e76319801?w=800" alt="Safari">
                                <?php endif;
                            else: ?>
                                <img src="https://images.unsplash.com/photo-1516426122078-c23e76319801?w=800" alt="Safari">
                            <?php endif; ?>
                            <span class="itinerary-day-badge">Day <?php echo $day['day']; ?></span>
                        </div>
                        <div class="itinerary-content">
                            <h3 class="itinerary-title"><?php echo esc_html($day['title']); ?></h3>
                            <p class="itinerary-desc"><?php echo nl2br(esc_html($day['desc'])); ?></p>
                            <?php if(!empty($day['overnight'])): ?>
                                <div class="itinerary-overnight">
                                    <i class="fas fa-bed" style="color: #298742; margin-right: 8px;"></i>
                                    <strong>Overnight:</strong> <?php echo esc_html($day['overnight']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            
            <!-- Inclusions & Exclusions -->
            <?php if($inclusions || $exclusions): ?>
            <div class="single-safari-section">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                    <?php if($inclusions): ?>
                        <div class="inclusion-box">
                            <h3 style="color: #298742; margin-bottom: 16px; font-size: 20px;"><i class="fas fa-check-circle"></i> Inclusions</h3>
                            <div style="line-height: 1.6; color: #444;"><?php echo wp_kses_post($inclusions); ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if($exclusions): ?>
                        <div class="inclusion-box">
                            <h3 style="color: #dc3232; margin-bottom: 16px; font-size: 20px;"><i class="fas fa-times-circle"></i> Exclusions</h3>
                            <div style="line-height: 1.6; color: #444;"><?php echo wp_kses_post($exclusions); ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Pricing Tables -->
            <?php if(!empty($low_season) || !empty($high_season)): ?>
            <div class="single-safari-section">
                <h2>Tour Pricing</h2>
                <p style="color: #666; margin-bottom: 24px;">Group discounts available. Prices include accommodation, meals, guide, and park fees.</p>
                
                <?php if(!empty($low_season)): ?>
                <div class="pricing-table">
                    <div class="pricing-header">
                        <h3 style="color: white; margin: 0; font-size: 18px;">Low Season</h3>
                        <p style="margin: 4px 0 0; font-size: 12px;">April · May · November</p>
                    </div>
                    <div class="pricing-table-inner">
                        <table>
                            <thead>
                                <tr>
                                    <th>Level</th>
                                    <th style="background: #f5f1e8; color: #b85a1a;">Adventure</th>
                                    <th style="background: #f5f1e8; color: #298742;">Comfort</th>
                                 </tr>
                            </thead>
                            <tbody>
                                <tr><td style="background: #3a4b2a; color: white;">1 Person</td><td><?php echo esc_html($low_season['adventure_1'] ?? '$1,650'); ?></td><td><?php echo esc_html($low_season['comfort_1'] ?? '$2,640'); ?></td></tr>
                                <tr><td style="background: #3a4b2a; color: white;">2 People</td><td><?php echo esc_html($low_season['adventure_2'] ?? '$1,400'); ?></td><td><?php echo esc_html($low_season['comfort_2'] ?? '$2,240'); ?></td></tr>
                                <tr><td style="background: #3a4b2a; color: white;">4 People</td><td><?php echo esc_html($low_season['adventure_4'] ?? '$1,240'); ?></td><td><?php echo esc_html($low_season['comfort_4'] ?? '$1,980'); ?></td></tr>
                                <tr><td style="background: #3a4b2a; color: white;">6+ People</td><td><?php echo esc_html($low_season['adventure_6'] ?? '$1,070'); ?></td><td><?php echo esc_html($low_season['comfort_6'] ?? '$1,720'); ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if(!empty($high_season)): ?>
                <div class="pricing-table">
                    <div class="pricing-header">
                        <h3 style="color: white; margin: 0; font-size: 18px;">High Season</h3>
                        <p style="margin: 4px 0 0; font-size: 11px;">January · February · March · June · July · August · September · October · December</p>
                    </div>
                    <div class="pricing-table-inner">
                        <table>
                            <thead>
                                <tr>
                                    <th>Level</th>
                                    <th style="background: #f5f1e8; color: #b85a1a;">Adventure</th>
                                    <th style="background: #f5f1e8; color: #298742;">Comfort</th>
                                 </tr>
                            </thead>
                            <tbody>
                                <tr><td style="background: #3a4b2a; color: white;">1 Person</td><td><?php echo esc_html($high_season['adventure_1'] ?? '$1,980'); ?></td><td><?php echo esc_html($high_season['comfort_1'] ?? '$3,170'); ?></td></tr>
                                <tr><td style="background: #3a4b2a; color: white;">2 People</td><td><?php echo esc_html($high_season['adventure_2'] ?? '$1,680'); ?></td><td><?php echo esc_html($high_season['comfort_2'] ?? '$2,690'); ?></td></tr>
                                <tr><td style="background: #3a4b2a; color: white;">4 People</td><td><?php echo esc_html($high_season['adventure_4'] ?? '$1,490'); ?></td><td><?php echo esc_html($high_season['comfort_4'] ?? '$2,380'); ?></td></tr>
                                <tr><td style="background: #3a4b2a; color: white;">6+ People</td><td><?php echo esc_html($high_season['adventure_6'] ?? '$1,290'); ?></td><td><?php echo esc_html($high_season['comfort_6'] ?? '$2,060'); ?></td></tr>
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
            <div class="single-safari-section">
                <h2>Frequently Asked Questions</h2>
                <?php foreach($faqs as $index => $faq): ?>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
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
            <div class="single-safari-section">
                <h2>Gallery</h2>
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px;">
                    <?php foreach($gallery as $img_id): 
                        $img_url = wp_get_attachment_url($img_id);
                        if($img_url): ?>
                            <img src="<?php echo esc_url($img_url); ?>" style="width:100%; height:150px; object-fit:cover; border-radius:12px; cursor:pointer;" onclick="window.open(this.src)">
                        <?php endif; 
                    endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Related Safaris -->
            <?php if(!empty($related_safaris)): ?>
            <div class="single-safari-section">
                <h2>Related Safari Packages</h2>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                    <?php foreach($related_safaris as $related): 
                        $rel_duration = get_post_meta($related->ID, '_safari_duration', true);
                        $rel_price = get_post_meta($related->ID, '_safari_price', true);
                        $rel_country = get_post_meta($related->ID, '_safari_country', true);
                        $rel_image = get_the_post_thumbnail_url($related->ID, 'medium');
                        if(!$rel_image) $rel_image = 'https://images.unsplash.com/photo-1516426122078-c23e76319801?w=400';
                    ?>
                        <a href="<?php echo get_permalink($related->ID); ?>" style="text-decoration: none; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: all 0.3s;">
                            <div style="position: relative; height: 160px; overflow: hidden;">
                                <img src="<?php echo esc_url($rel_image); ?>" style="width:100%; height:100%; object-fit:cover;">
                                <?php if($rel_country): ?>
                                    <span style="position: absolute; top: 10px; left: 10px; background: #298742; color: white; font-size: 10px; padding: 4px 10px; border-radius: 20px;"><?php echo esc_html($rel_country); ?></span>
                                <?php endif; ?>
                                <?php if($rel_price): ?>
                                    <span style="position: absolute; top: 10px; right: 10px; background: #F5A623; color: #1a3c2c; font-size: 10px; font-weight: bold; padding: 4px 10px; border-radius: 20px;">From <?php echo esc_html($rel_price); ?></span>
                                <?php endif; ?>
                            </div>
                            <div style="padding: 16px;">
                                <div style="display: flex; gap: 12px; color: #666; font-size: 12px; margin-bottom: 8px;">
                                    <?php if($rel_duration): ?>
                                        <span><i class="far fa-clock"></i> <?php echo esc_html($rel_duration); ?></span>
                                    <?php endif; ?>
                                </div>
                                <h3 style="font-size: 16px; color: #1a3c2c; margin-bottom: 8px;"><?php echo esc_html($related->post_title); ?></h3>
                                <p style="color: #298742; font-size: 14px; font-weight: bold;">View Details <i class="fas fa-arrow-right"></i></p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- RIGHT COLUMN - SIDEBAR -->
        <div>
            <div style="position: sticky; top: 100px;">
                <!-- Booking Form Card -->
                <div class="sidebar-card">
                    <h3 class="sidebar-title">Plan Your Safari</h3>
                    <p class="sidebar-subtitle">We reply within 1 hour · Free safari consultation</p>
                    
                    <?php if($duration || $price): ?>
                        <p style="text-align: center; font-size: 12px; color: #298742; margin-bottom: 20px;">
                            <?php echo esc_html($duration ?: ''); ?> <?php echo $price ? '• From ' . esc_html($price) : ''; ?>
                        </p>
                    <?php endif; ?>
                    
                    <?php if($form_shortcode): ?>
                        <?php echo do_shortcode($form_shortcode); ?>
                    <?php else: ?>
                        <form method="post" action="/booking">
                            <div class="form-group">
                                <label>Your Full Name *</label>
                                <input type="text" name="name" placeholder="Your Full Name">
                            </div>
                            <div class="form-group">
                                <label>Email Address *</label>
                                <input type="email" name="email" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="tel" name="phone" placeholder="Phone Number">
                            </div>
                            <div class="form-group">
                                <label>Travel Date</label>
                                <input type="date" name="travel_date">
                            </div>
                            <div class="form-row-2">
                                <div class="form-group">
                                    <label>Adults</label>
                                    <select name="adults"><option>1</option><option>2</option><option>3</option><option>4</option></select>
                                </div>
                                <div class="form-group">
                                    <label>Children</label>
                                    <select name="children"><option>0</option><option>1</option><option>2</option><option>3</option></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Your Message</label>
                                <textarea name="message" rows="3" placeholder="Your message"></textarea>
                            </div>
                            <button type="submit" class="submit-btn">Make a Booking →</button>
                        </form>
                    <?php endif; ?>
                </div>
                
                <!-- WhatsApp Button -->
                <a href="https://wa.me/<?php echo esc_attr($whatsapp_number); ?>?text=<?php echo esc_attr($whatsapp_text); ?>" target="_blank" class="whatsapp-btn">
                    <i class="fab fa-whatsapp" style="font-size: 18px;"></i> Inquire on WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function toggleFaq(element) {
    var parent = element.parentElement;
    parent.classList.toggle('open');
}
</script>

<?php endwhile; ?>

<?php get_footer(); ?>
