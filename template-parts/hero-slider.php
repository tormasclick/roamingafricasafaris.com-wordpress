<?php
$slides = roaming_get_hero_slides();
if(empty($slides)) {
    echo '<!-- No hero slides found -->';
    return;
}

$whatsapp_number = get_option('roaming_whatsapp_number', '+254722433910');
?>

<div style="position: relative; height: 500px; overflow: hidden;">
    <?php foreach($slides as $index => $slide): ?>
        <div class="hero-bg" data-slide="<?php echo $index; ?>" style="
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('<?php echo esc_url($slide['image']); ?>');
            background-size: cover;
            background-position: center;
            opacity: <?php echo $index === 0 ? '1' : '0'; ?>;
            transition: opacity 1s ease;
        ">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);"></div>
        </div>
    <?php endforeach; ?>
    
    <div style="position: relative; z-index: 10; height: 500px; display: flex; align-items: center; justify-content: center; text-align: center; color: white; padding: 0 20px;">
        <div>
            <?php foreach($slides as $index => $slide): ?>
                <div class="hero-content" data-content="<?php echo $index; ?>" style="display: <?php echo $index === 0 ? 'block' : 'none'; ?>;">
                    <h1 style="font-size: 48px; margin-bottom: 20px;"><?php echo esc_html($slide['title']); ?></h1>
                    <p style="font-size: 18px; margin-bottom: 30px;"><?php echo esc_html($slide['subtitle']); ?></p>
                    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                        <a href="<?php echo esc_url($slide['button_url']); ?>" style="background: #F5A623; color: #1a3c2c; padding: 12px 30px; border-radius: 30px; text-decoration: none; font-weight: bold; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s;">
                            <i class="fas fa-paper-plane"></i> <?php echo esc_html($slide['button_text']); ?> →
                        </a>
                        <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $whatsapp_number); ?>?text=Hi! I'd like to plan a safari with Roaming Africa Tours." target="_blank" rel="noopener noreferrer" style="background: #25D366; color: white; padding: 12px 30px; border-radius: 30px; text-decoration: none; font-weight: bold; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s;">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div style="margin-top: 40px; display: flex; justify-content: center; gap: 10px;">
                <?php foreach($slides as $index => $slide): ?>
                    <button class="hero-dot" data-index="<?php echo $index; ?>" style="
                        width: <?php echo $index === 0 ? '40px' : '12px'; ?>;
                        height: 4px;
                        border-radius: 2px;
                        background: <?php echo $index === 0 ? '#F5A623' : 'rgba(255,255,255,0.5)'; ?>;
                        border: none;
                        cursor: pointer;
                        transition: all 0.3s;
                    "></button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <button id="hero-scroll" style="
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: none;
        border: none;
        color: white;
        font-size: 30px;
        cursor: pointer;
        z-index: 20;
    ">
        ↓
    </button>
</div>

<script>
(function() {
    var totalSlides = <?php echo count($slides); ?>;
    var currentIndex = 0;
    var slides = document.querySelectorAll('.hero-bg');
    var contents = document.querySelectorAll('.hero-content');
    var dots = document.querySelectorAll('.hero-dot');
    var interval;
    
    function showSlide(index) {
        slides.forEach(function(slide, i) {
            slide.style.opacity = i === index ? '1' : '0';
        });
        contents.forEach(function(content, i) {
            content.style.display = i === index ? 'block' : 'none';
        });
        dots.forEach(function(dot, i) {
            if(i === index) {
                dot.style.width = '40px';
                dot.style.background = '#F5A623';
            } else {
                dot.style.width = '12px';
                dot.style.background = 'rgba(255,255,255,0.5)';
            }
        });
        currentIndex = index;
    }
    
    function nextSlide() {
        showSlide((currentIndex + 1) % totalSlides);
    }
    
    function startAutoPlay() {
        if(interval) clearInterval(interval);
        interval = setInterval(nextSlide, 5000);
    }
    
    function stopAutoPlay() {
        if(interval) clearInterval(interval);
    }
    
    startAutoPlay();
    
    dots.forEach(function(dot) {
        dot.addEventListener('click', function() {
            stopAutoPlay();
            showSlide(parseInt(this.getAttribute('data-index')));
            startAutoPlay();
        });
    });
    
    var heroContainer = document.querySelector('.hero-bg').parentElement;
    heroContainer.addEventListener('mouseenter', stopAutoPlay);
    heroContainer.addEventListener('mouseleave', startAutoPlay);
    
    var scrollBtn = document.getElementById('hero-scroll');
    if(scrollBtn) {
        scrollBtn.addEventListener('click', function() {
            var planner = document.getElementById('safari-planner');
            if(planner) planner.scrollIntoView({ behavior: 'smooth' });
        });
    }
})();
</script>
