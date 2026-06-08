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

<!-- Safari Highlights Section -->
<section class="py-20" style="background: hsl(40, 30%, 96%);">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center mb-14">
            <span class="inline-block text-xs font-heading font-bold uppercase tracking-widest mb-3" style="color: hsl(44, 100%, 46%);">Why travel with us</span>
            <h2 class="mb-4" style="font-size: 32px; font-weight: 700; color: hsl(30, 10%, 15%);">Why Travel With Roaming Africa Tours &amp; Safaris</h2>
            <p class="text-sm" style="color: hsl(30, 10%, 40%);">Established in 2006, Roaming Africa Tours and Safaris combines destination management expertise with local knowledge to create seamless journeys across Kenya, Tanzania and Zanzibar.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
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
                <div class="group relative overflow-hidden rounded-2xl border p-7 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl" style="border-color: hsl(40, 15%, 85%); background: <?php echo $item['gradient']; ?>;">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5 group-hover:rotate-6 transition-transform" style="background: hsl(135, 53%, 35%); color: white;">
                        <i class="fas <?php echo $item['icon']; ?>" style="font-size: 28px;"></i>
                    </div>
                    <h3 class="text-lg mb-2 font-heading font-bold" style="color: hsl(30, 10%, 15%);"><?php echo $item['title']; ?></h3>
                    <p class="text-sm leading-relaxed" style="color: hsl(30, 10%, 40%);"><?php echo $item['desc']; ?></p>
                    <div class="absolute -right-10 -bottom-10 w-32 h-32 rounded-full transition-colors group-hover:bg-primary/10" style="background: rgba(41, 135, 66, 0.05);"></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Featured Safaris Section - FIXED with proper badges and green link -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Best Featured Safari Deals</h2>
            <p class="text-gray-500 text-base max-w-2xl mx-auto">Explore our most popular safari packages across East Africa. Each tour is carefully designed to showcase the best wildlife and landscapes.</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php 
            $safaris = new WP_Query(array('post_type' => 'safari', 'posts_per_page' => 4, 'meta_key' => '_thumbnail_id')); 
            if($safaris->have_posts()) : while($safaris->have_posts()) : $safaris->the_post(); 
                $duration = get_post_meta(get_the_ID(), '_safari_duration', true);
                $price = get_post_meta(get_the_ID(), '_safari_price', true);
                $country = get_post_meta(get_the_ID(), '_safari_country', true);
            ?>
                <div class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100">
                    <div class="relative overflow-hidden h-52">
                        <?php if(has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500')); ?>
                        <?php endif; ?>
                        <!-- Country Badge - Green -->
                        <div class="absolute top-3 left-3 bg-[#298742] text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                            <?php echo esc_html(ucfirst($country ?: 'Kenya')); ?>
                        </div>
                        <!-- Price Badge - Gold -->
                        <?php if($price): ?>
                            <div class="absolute top-3 right-3 bg-[#F5A623] text-black text-xs font-bold px-3 py-1 rounded-full shadow-md">
                                From <?php echo esc_html($price); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-3 text-gray-500 text-sm mb-2">
                            <span class="flex items-center gap-1"><i class="far fa-clock"></i> <?php echo esc_html($duration ?: '3 Days'); ?></span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-[#298742] transition-colors">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2"><?php echo wp_trim_words(get_the_excerpt(), 12, '...'); ?></p>
                        <!-- Green link matching NextJS -->
                        <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-1 text-sm font-bold text-[#298742] hover:text-[#1f6332] transition-all duration-300">
                            View Full Itinerary 
                            <i class="fas fa-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                        </a>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
        
        <div class="text-center mt-12">
            <a href="/safari" class="inline-flex items-center gap-2 bg-[#298742] text-white px-8 py-3 rounded-full font-semibold hover:bg-[#1f6332] transition-all duration-300 shadow-md hover:shadow-lg">
                View All Safaris <i class="fas fa-arrow-right text-sm"></i>
            </a>
        </div>
    </div>
</section>

<!-- Popular Destinations -->
<div style="padding: 80px 0; background: #298742;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 style="font-size: 36px; font-weight: 700; color: white; margin-bottom: 20px;">Popular Safari Destinations</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 mt-10">
            <?php $dests = array('Masai Mara','Amboseli','Serengeti','Zanzibar','Ngorongoro','Tsavo','Lake Nakuru','Diani Beach'); ?>
            <?php foreach($dests as $dest): ?>
                <div class="bg-[#1a3c2c] rounded-xl py-8 px-4 text-center hover:bg-[#1a4a3a] transition-colors cursor-pointer">
                    <h3 class="text-white font-semibold"><?php echo $dest; ?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div style="padding: 80px 0; background: #F5A623;">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 style="font-size: 36px; font-weight: 700; color: #2D2D2D;">Ready for Your Safari Adventure?</h2>
        <p style="font-size: 18px; margin: 20px 0 30px;">Contact us today to start planning your dream African safari</p>
        <a href="/contact" class="inline-block bg-[#298742] text-white px-8 py-3 rounded-full font-semibold hover:bg-[#1f6332] transition-colors">Get in Touch →</a>
    </div>
</div>

<?php get_footer(); ?>
