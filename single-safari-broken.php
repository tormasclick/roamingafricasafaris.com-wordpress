<?php get_header(); ?>
<?php if(current_user_can('administrator')): ?>
<div style="background: #ff6b6b; color: white; padding: 15px; text-align: center; position: fixed; top: 0; left: 0; right: 0; z-index: 9999;">
    <strong>DEBUG MODE ACTIVE</strong> | Post ID: <?php echo get_the_ID(); ?> | FAQs in DB: <?php $test = get_post_meta(get_the_ID(), '_safari_faqs', true); $test_arr = json_decode($test, true); echo count($test_arr); ?> | FAQs in variable: <?php echo count($faqs); ?>
</div>
<?php endif; ?>


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
.single-safari-container { max-width: 1200px; margin: 0 auto; padding: 40px 20px; }
.single-safari-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 40px; }
.single-safari-section { margin-bottom: 48px; }
.single-safari-section h2 { font-size: 28px; color: #1a3c2c; margin-bottom: 20px; font-weight: 700; }
.hero-section { position: relative; height: 250px; overflow: hidden; background: #1a3c2c; }
.hero-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); }
.hero-content { position: relative; z-index: 10; height: 250px; display: flex; align-items: center; justify-content: center; text-align: center; color: white; padding: 0 20px; }
.hero-title { font-size: 36px; margin-bottom: 20px; font-weight: 700; }
.inclusion-box { background: #f5f0e8; padding: 24px; border-radius: 16px; }
.faq-item { margin-bottom: 16px; border-bottom: 1px solid #e5e7eb; }
.faq-question { padding: 16px 0; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; color: #1a3c2c; }
.faq-answer { display: none; padding-bottom: 16px; color: #666; line-height: 1.6; }
.faq-item.open .faq-answer { display: block; }
.faq-item.open .faq-question i { transform: rotate(180deg); }
.sidebar-card { background: white; border: 1px solid #e5e7eb; border-radius: 16px; padding: 24px; margin-bottom: 20px; }
.whatsapp-btn { display: flex; align-items: center; justify-content: center; gap: 8px; background: #25D366; color: white; padding: 14px; border-radius: 40px; text-decoration: none; font-weight: bold; }
@media (max-width: 768px) { .single-safari-grid { grid-template-columns: 1fr; } .hero-title { font-size: 24px; } }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <?php if($featured_image): ?>
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('<?php echo esc_url($featured_image); ?>'); background-size: cover; background-position: center;"></div>
    <?php endif; ?>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div>
            <?php if($duration): ?>
                <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(0,0,0,0.6); padding: 8px 20px; border-radius: 40px; margin-bottom: 20px;">
                    <i class="far fa-clock"></i> <?php echo esc_html($duration); ?>
                </div>
            <?php endif; ?>
            <h1 class="hero-title"><?php the_title(); ?></h1>
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
                <div style="line-height: 1.8; color: #444;"><?php the_content(); ?></div>
            </div>
            
            <!-- Inclusions & Exclusions -->
            <?php if($inclusions || $exclusions): ?>
            <div class="single-safari-section">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                    <?php if($inclusions): ?>
                        <div class="inclusion-box">
                            <h3 style="color: #298742; margin-bottom: 20px; font-size: 20px;"><i class="fas fa-check-circle"></i> Inclusions</h3>
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <?php 
                                $inclusion_items = explode("\n", $inclusions);
                                foreach($inclusion_items as $item): 
                                    $item = trim($item);
                                    if(!empty($item)):
                                ?>
                                    <li style="margin-bottom: 12px; display: flex; align-items: flex-start; gap: 10px;">
                                        <i class="fas fa-check-circle" style="color: #298742; margin-top: 2px;"></i>
                                        <span style="color: #444;"><?php echo esc_html($item); ?></span>
                                    </li>
                                <?php endif; endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <?php if($exclusions): ?>
                        <div class="inclusion-box">
                            <h3 style="color: #dc3232; margin-bottom: 20px; font-size: 20px;"><i class="fas fa-times-circle"></i> Exclusions</h3>
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <?php 
                                $exclusion_items = explode("\n", $exclusions);
                                foreach($exclusion_items as $item): 
                                    $item = trim($item);
                                    if(!empty($item)):
                                ?>
                                    <li style="margin-bottom: 12px; display: flex; align-items: flex-start; gap: 10px;">
                                        <i class="fas fa-times-circle" style="color: #dc3232; margin-top: 2px;"></i>
                                        <span style="color: #444;"><?php echo esc_html($item); ?></span>
                                    </li>
                                <?php endif; endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- FAQs -->
            <?php if(!empty($faqs)): ?>
            <div class="single-safari-section">
            <?php if(current_user_can('administrator')): ?><div style="background: #f0f0f0; padding: 10px; margin: 10px 0;"><strong>Debug:</strong> FAQs count = <?php echo count($faqs); ?>, Form shortcode = <?php echo $form_shortcode ?: 'Not set'; ?></div><?php endif; ?>

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
        </div>
        
        <!-- RIGHT COLUMN - SIDEBAR -->
        <div>
            <div style="position: sticky; top: 100px;">
                <div class="sidebar-card">
                    <h3 style="text-align: center; font-size: 20px; margin-bottom: 8px;">Plan Your Safari</h3>
                    <p style="text-align: center; font-size: 12px; color: #666;">We reply within 1 hour · Free consultation</p>
                    
                    <?php if($duration || $price): ?>
                        <p style="text-align: center; font-size: 12px; color: #298742; margin-bottom: 20px;">
                            <?php echo esc_html($duration ?: ''); ?> <?php echo $price ? '• From ' . esc_html($price) : ''; ?>
                        </p>
                    <?php endif; ?>
                    
                    <?php if($form_shortcode): ?>
                        <?php echo do_shortcode($form_shortcode); ?>
                    <?php else: ?>
                        <p>Add form shortcode in meta box</p>
                    <?php endif; ?>
                </div>
                
                <a href="https://wa.me/<?php echo esc_attr($whatsapp_number); ?>?text=<?php echo esc_attr($whatsapp_text); ?>" target="_blank" class="whatsapp-btn">
                    <i class="fab fa-whatsapp" style="font-size: 18px;"></i> Inquire on WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

<?php endwhile; ?>
<?php get_footer(); ?>
