<?php
/**
 * Safari Card - Exact replica from React SafariCard component
 */

$safari_id = get_the_ID();
$duration = get_post_meta($safari_id, '_safari_duration', true);
$price = get_post_meta($safari_id, '_safari_price', true);
$country = get_post_meta($safari_id, '_safari_country', true);
$destinations = get_post_meta($safari_id, '_safari_destinations', true);
?>

<div class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-200 h-full flex flex-col">
    <!-- Image Container -->
    <div class="relative overflow-hidden h-52">
        <?php if(has_post_thumbnail()): ?>
            <?php the_post_thumbnail('medium', array(
                'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500',
                'loading' => 'lazy',
                'width' => 400,
                'height' => 208
            )); ?>
        <?php else: ?>
            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                <i class="fas fa-image text-4xl text-gray-400"></i>
            </div>
        <?php endif; ?>
        
        <!-- Country Badge -->
        <div class="absolute top-3 left-3 bg-[#298742] text-white text-xs font-bold px-3 py-1 rounded-full">
            <?php echo esc_html(ucfirst($country ?: 'Kenya')); ?>
        </div>
        
        <!-- Price Badge -->
        <?php if($price): ?>
            <div class="absolute top-3 right-3 bg-[#F5A623] text-[#2D2D2D] text-xs font-bold px-3 py-1 rounded-full">
                From <?php echo esc_html($price); ?>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Content -->
    <div class="p-5 flex-grow">
        <!-- Duration & Location -->
        <div class="flex items-center gap-3 text-gray-500 text-sm mb-2">
            <?php if($duration): ?>
                <span class="flex items-center gap-1">
                    <i class="far fa-clock w-3.5 h-3.5"></i> <?php echo esc_html($duration); ?>
                </span>
            <?php endif; ?>
            <?php if($destinations): ?>
                <span class="flex items-center gap-1">
                    <i class="fas fa-map-marker-alt w-3.5 h-3.5"></i> <?php echo esc_html(explode(',', $destinations)[0]); ?>
                </span>
            <?php endif; ?>
        </div>
        
        <!-- Title -->
        <h3 class="text-lg leading-snug font-bold mb-2 group-hover:text-[#298742] transition-colors">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        
        <!-- Short Description -->
        <?php if(has_excerpt()): ?>
            <p class="text-sm text-gray-500 mb-4 line-clamp-2">
                <?php echo get_the_excerpt(); ?>
            </p>
        <?php endif; ?>
        
        <!-- View Link -->
        <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-1 text-sm font-bold text-[#298742] hover:text-[#1f6332] transition-colors group/link">
            View Full Itinerary 
            <i class="fas fa-arrow-right w-4 h-4 transition-transform group-hover/link:translate-x-1"></i>
        </a>
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

@media (max-width: 768px) {
    .safari-card .h-52 {
        height: 200px;
    }
}

.group:hover .group-hover\:scale-110 {
    transform: scale(1.1);
}
.group:hover .group-hover\:text-\[\.\.\.\] {
    color: #298742;
}
</style>
