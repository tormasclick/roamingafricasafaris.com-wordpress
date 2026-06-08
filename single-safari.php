<?php get_header(); ?>

<div class="container mx-auto px-4 py-12">
    <?php while(have_posts()) : the_post(); ?>
        
        <!-- Safari Header -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <?php if(has_post_thumbnail()): ?>
                <div class="h-96 overflow-hidden">
                    <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover')); ?>
                </div>
            <?php endif; ?>
            <div class="p-8">
                <h1 class="text-4xl font-bold mb-4"><?php the_title(); ?></h1>
                <div class="flex gap-4 mb-6">
                    <span class="bg-[#F5A623] text-black px-4 py-2 rounded-full text-sm font-bold">
                        <i class="far fa-clock mr-2"></i><?php echo get_post_meta(get_the_ID(), '_safari_duration', true); ?>
                    </span>
                    <span class="bg-[#298742] text-white px-4 py-2 rounded-full text-sm font-bold">
                        <i class="fas fa-tag mr-2"></i><?php echo get_post_meta(get_the_ID(), '_safari_price', true); ?>
                    </span>
                </div>
                <div class="prose max-w-none">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
        
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                
                <!-- Inclusions & Exclusions -->
                <div class="grid md:grid-cols-2 gap-6 mb-8">
                    <?php $inclusions = get_post_meta(get_the_ID(), '_safari_inclusions', true); ?>
                    <?php if($inclusions): ?>
                    <div class="bg-green-50 rounded-lg p-6">
                        <h3 class="text-xl font-bold mb-4 text-green-700">✓ Inclusions</h3>
                        <ul class="space-y-2">
                            <?php 
                            $items = explode("\n", $inclusions);
                            foreach($items as $item):
                                if(trim($item)):
                            ?>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check text-green-600 mt-1"></i>
                                    <span><?php echo esc_html($item); ?></span>
                                </li>
                            <?php 
                                endif;
                            endforeach; 
                            ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    
                    <?php $exclusions = get_post_meta(get_the_ID(), '_safari_exclusions', true); ?>
                    <?php if($exclusions): ?>
                    <div class="bg-red-50 rounded-lg p-6">
                        <h3 class="text-xl font-bold mb-4 text-red-700">✗ Exclusions</h3>
                        <ul class="space-y-2">
                            <?php 
                            $items = explode("\n", $exclusions);
                            foreach($items as $item):
                                if(trim($item)):
                            ?>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-times text-red-600 mt-1"></i>
                                    <span><?php echo esc_html($item); ?></span>
                                </li>
                            <?php 
                                endif;
                            endforeach; 
                            ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Sidebar - Booking -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-lg p-6 sticky top-24">
                    <h3 class="text-2xl font-bold mb-4">Book This Safari</h3>
                    <div class="space-y-4">
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <p class="text-3xl font-bold text-[#298742]"><?php echo get_post_meta(get_the_ID(), '_safari_price', true); ?></p>
                            <p class="text-gray-600">per person sharing</p>
                        </div>
                        <a href="https://wa.me/254722433910?text=Hi%2C%20I'm%20interested%20in%20<?php echo urlencode(get_the_title()); ?>" 
                           class="flex items-center justify-center gap-2 bg-[#25D366] text-white px-6 py-3 rounded-full font-bold hover:brightness-110 transition w-full" 
                           target="_blank">
                            <i class="fab fa-whatsapp text-xl"></i>
                            Book via WhatsApp
                        </a>
                        <a href="/contact" 
                           class="flex items-center justify-center gap-2 bg-[#F5A623] text-black px-6 py-3 rounded-full font-bold hover:brightness-110 transition w-full">
                            <i class="fas fa-envelope"></i>
                            Email Enquiry
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
