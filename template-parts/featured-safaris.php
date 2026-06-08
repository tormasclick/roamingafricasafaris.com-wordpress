<!-- Featured Safaris Section -->
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
                        <!-- Country Badge - Green background -->
                        <div class="absolute top-3 left-3 bg-[#298742] text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                            <?php echo esc_html(ucfirst($country ?: 'Kenya')); ?>
                        </div>
                        <!-- Price Badge - Gold/Yellow background -->
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
                        <!-- View Full Itinerary link - Green color matching NextJS -->
                        <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-1 text-sm font-bold text-[#298742] hover:text-[#1f6332] transition-all duration-300 group/link">
                            View Full Itinerary 
                            <i class="fas fa-arrow-right text-xs transition-transform group-hover/link:translate-x-1"></i>
                        </a>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
        
        <div class="text-center mt-12">
            <a href="/safari" class="inline-flex items-center gap-2 bg-[#298742] text-white px-8 py-3 rounded-full font-semibold hover:bg-[#1f6332] transition-all duration-300 shadow-md hover:shadow-lg">
                View All Safaris <i class="fas fa-arrow-right text-sm transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>
    </div>
</section>
