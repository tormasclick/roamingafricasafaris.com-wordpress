<?php get_header(); ?>

<!-- Hero Slider -->
<?php get_template_part('template-parts/hero-slider'); ?>

<!-- Safari Planner -->
<section id="safari-planner" style="position: relative; margin-top: -40px; z-index: 20; padding: 0 16px;">
    <div style="max-width: 1024px; margin: 0 auto; background: white; border-radius: 16px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); padding: 30px;">
        <h2 style="text-align: center; margin-bottom: 24px; font-size: 24px; font-weight: bold;">Plan Your Safari</h2>
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px;">
            <div><label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px;">Destination</label><select style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;"><option>Kenya Safari</option><option>Tanzania Safari</option></select></div>
            <div><label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px;">Travel Date</label><input type="date" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;"></div>
            <div><label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px;">Adults</label><input type="number" value="2" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;"></div>
            <div><label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px;">Children</label><input type="number" value="0" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;"></div>
        </div>
        <div style="text-align: center; margin-top: 24px;"><button style="background: #F5A623; color: black; padding: 12px 32px; border-radius: 40px; font-weight: bold; border: none; cursor: pointer;">Make a Booking</button></div>
    </div>
</section>

<!-- Safari Highlights Section - Why Travel With Us -->
<section style="padding: 80px 0; background: #f5f0e8;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 20px;">
        <div style="text-align: center; margin-bottom: 60px;">
            <span style="display: inline-block; font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; color: #F5A623;">Why travel with us</span>
            <h2 style="font-size: 32px; font-weight: 700; color: #1a3c2c; margin-bottom: 16px;">Why Travel With Roaming Africa Tours &amp; Safaris</h2>
            <p style="color: #666; max-width: 700px; margin: 0 auto;">Established in 2006, Roaming Africa Tours and Safaris combines destination management expertise with local knowledge to create seamless journeys across Kenya, Tanzania and Zanzibar.</p>
        </div>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            <?php
            $highlights = array(
                array('icon' => 'fa-award', 'title' => 'Operating Since 2006', 'desc' => 'Nearly two decades creating memorable East African safaris. Roaming Africa Tours and Safaris has guided travellers from over 60 countries across Kenya, Tanzania and Zanzibar.', 'gradient' => 'linear-gradient(135deg, rgba(41, 135, 66, 0.15) 0%, rgba(41, 135, 66, 0.05) 100%)'),
                array('icon' => 'fa-map', 'title' => 'Destination Management Expertise', 'desc' => 'A full-service East African DMC handling permits, transfers, lodges, vehicles and ground logistics in-house — one trusted operator from arrival to departure.', 'gradient' => 'linear-gradient(135deg, rgba(47, 158, 74, 0.15) 0%, rgba(47, 158, 74, 0.05) 100%)'),
                array('icon' => 'fa-binoculars', 'title' => 'Deep Local Knowledge', 'desc' => 'Our team lives and works in Nairobi, Mombasa, Arusha and Zanzibar. We know the parks, the seasons, the camps and the people behind every itinerary we build.', 'gradient' => 'linear-gradient(135deg, rgba(245, 166, 35, 0.15) 0%, rgba(245, 166, 35, 0.05) 100%)'),
                array('icon' => 'fa-users', 'title' => 'Professional Safari Guides', 'desc' => 'KPSGA-certified, bronze and silver level driver-guides with years of experience reading wildlife behaviour and translating Kenya, Tanzania and Zanzibar for our guests.', 'gradient' => 'linear-gradient(135deg, rgba(41, 135, 66, 0.15) 0%, rgba(47, 158, 74, 0.05) 100%)'),
                array('icon' => 'fa-compass', 'title' => 'Tailor-Made Itineraries', 'desc' => 'Every journey is customised to your dates, budget and pace — private safaris, family travel, honeymoons, photography expeditions and corporate incentive groups.', 'gradient' => 'linear-gradient(135deg, rgba(47, 158, 74, 0.15) 0%, rgba(245, 166, 35, 0.05) 100%)'),
                array('icon' => 'fa-wheelchair', 'title' => 'Accessible Travel Specialists', 'desc' => 'One of East Africa\'s most established accessible safari programmes — wheelchair-accessible vehicles, step-free lodges and trained guides for barrier-free travel.', 'gradient' => 'linear-gradient(135deg, rgba(245, 166, 35, 0.15) 0%, rgba(41, 135, 66, 0.05) 100%)')
            );
            foreach($highlights as $item): ?>
                <div class="group" style="position: relative; overflow: hidden; border-radius: 16px; border: 1px solid #e5e5e5; padding: 28px; transition: all 0.3s; background: <?php echo $item['gradient']; ?>;">
                    <div style="width: 56px; height: 56px; background: #298742; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; transition: transform 0.3s;">
                        <i class="fas <?php echo $item['icon']; ?>" style="font-size: 28px; color: white;"></i>
                    </div>
                    <h3 style="font-size: 18px; font-weight: 700; color: #1a3c2c; margin-bottom: 12px;"><?php echo $item['title']; ?></h3>
                    <p style="font-size: 14px; color: #666; line-height: 1.5;"><?php echo $item['desc']; ?></p>
                    <div style="position: absolute; right: -40px; bottom: -40px; width: 128px; height: 128px; border-radius: 50%; background: rgba(41, 135, 66, 0.05);"></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Featured Safaris Section -->
<section style="padding: 64px 0; background: white;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 20px;">
        <div style="text-align: center; margin-bottom: 48px;">
            <h2 style="font-size: 32px; font-weight: 700; color: #111; margin-bottom: 16px;">Best Featured Safari Deals</h2>
            <p style="color: #666; max-width: 600px; margin: 0 auto;">Explore our most popular safari packages across East Africa. Each tour is carefully designed to showcase the best wildlife and landscapes.</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;">
            <?php 
            $safaris = new WP_Query(array('post_type' => 'safari', 'posts_per_page' => 4)); 
            if($safaris->have_posts()) : while($safaris->have_posts()) : $safaris->the_post(); 
                $duration = get_post_meta(get_the_ID(), '_safari_duration', true);
                $price = get_post_meta(get_the_ID(), '_safari_price', true);
                $country = get_post_meta(get_the_ID(), '_safari_country', true);
            ?>
                <div style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: 1px solid #eee;">
                    <div style="position: relative; height: 200px; overflow: hidden;">
                        <?php if(has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('medium', array('style' => 'width:100%; height:100%; object-fit:cover; transition: transform 0.3s;')); ?>
                        <?php endif; ?>
                        <div style="position: absolute; top: 12px; left: 12px; background: #298742; color: white; font-size: 12px; font-weight: bold; padding: 4px 12px; border-radius: 9999px;"><?php echo esc_html(ucfirst($country ?: 'Kenya')); ?></div>
                        <?php if($price): ?>
                            <div style="position: absolute; top: 12px; right: 12px; background: #F5A623; color: black; font-size: 12px; font-weight: bold; padding: 4px 12px; border-radius: 9999px;">From <?php echo esc_html($price); ?></div>
                        <?php endif; ?>
                    </div>
                    <div style="padding: 16px;">
                        <?php if($duration): ?>
                            <div style="display: flex; align-items: center; gap: 8px; color: #666; font-size: 14px; margin-bottom: 8px;"><i class="far fa-clock"></i> <span><?php echo esc_html($duration); ?></span></div>
                        <?php endif; ?>
                        <h3 style="font-size: 18px; font-weight: 700; color: #111; margin-bottom: 8px;"><?php the_title(); ?></h3>
                        <p style="color: #666; font-size: 14px; margin-bottom: 16px; line-height: 1.4;"><?php echo wp_trim_words(get_the_excerpt(), 12, '...'); ?></p>
                        <a href="<?php the_permalink(); ?>" style="display: inline-flex; align-items: center; gap: 8px; color: #298742; font-weight: bold; font-size: 14px; text-decoration: none;">View Full Itinerary <i class="fas fa-arrow-right" style="font-size: 12px;"></i></a>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
        
        <div style="text-align: center; margin-top: 48px;">
            <a href="/safari" style="display: inline-block; background: #298742; color: white; padding: 12px 32px; border-radius: 9999px; font-weight: bold; text-decoration: none;">View All Safaris <i class="fas fa-arrow-right" style="margin-left: 8px;"></i></a>
        </div>
    </div>
</section>

<!-- Popular Destinations -->
<div style="padding: 80px 0; background: #298742;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 20px; text-align: center;">
        <h2 style="font-size: 36px; font-weight: 700; color: white; margin-bottom: 20px;">Popular Safari Destinations</h2>
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-top: 40px;">
            <?php $dests = array('Masai Mara','Amboseli','Serengeti','Zanzibar','Ngorongoro','Tsavo','Lake Nakuru','Diani Beach'); ?>
            <?php foreach($dests as $dest): ?>
                <div style="background: #1a3c2c; border-radius: 12px; padding: 30px; text-align: center;"><h3 style="color: white; font-size: 18px;"><?php echo $dest; ?></h3></div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div style="padding: 80px 0; background: #F5A623;">
    <div style="max-width: 800px; margin: 0 auto; padding: 0 20px; text-align: center;">
        <h2 style="font-size: 36px; font-weight: 700; color: #2D2D2D;">Ready for Your Safari Adventure?</h2>
        <p style="font-size: 18px; margin: 20px 0 30px; color: #2D2D2D;">Contact us today to start planning your dream African safari</p>
        <a href="/contact" style="display: inline-block; background: #298742; color: white; padding: 14px 36px; border-radius: 40px; font-weight: bold; text-decoration: none;">Get in Touch →</a>
    </div>
</div>

<?php get_footer(); ?>
