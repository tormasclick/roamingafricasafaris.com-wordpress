<?php
/**
 * Safari Highlights - FULLY DYNAMIC
 * All content editable from WordPress Customizer + Admin
 */

// Get dynamic highlights from database
$highlights = roaming_get_highlights();

// If no highlights exist, show default
if(empty($highlights)) {
    $highlights = array(
        array('icon' => 'fa-award', 'title' => 'Operating Since 2006', 'description' => 'Nearly two decades creating memorable East African safaris.'),
        array('icon' => 'fa-map', 'title' => 'Destination Management Expertise', 'description' => 'Full-service East African DMC handling all ground logistics in-house.'),
        array('icon' => 'fa-binoculars', 'title' => 'Deep Local Knowledge', 'description' => 'Our team lives and works across East Africa.'),
        array('icon' => 'fa-users', 'title' => 'Professional Safari Guides', 'description' => 'KPSGA-certified driver-guides with years of experience.'),
        array('icon' => 'fa-compass', 'title' => 'Tailor-Made Itineraries', 'description' => 'Every journey customized to your dates, budget and pace.'),
        array('icon' => 'fa-wheelchair', 'title' => 'Accessible Travel Specialists', 'description' => 'Wheelchair-accessible vehicles and step-free lodges.')
    );
}

// Get customizer values
$section_label = get_theme_mod('roaming_why_travel_label', 'Why travel with us');
$section_title = get_theme_mod('roaming_why_travel_title', 'Why Travel With Roaming Africa Tours &amp; Safaris');
$section_subtitle = get_theme_mod('roaming_why_travel_subtitle', 'Established in 2006, Roaming Africa Tours and Safaris combines destination management expertise with local knowledge to create seamless journeys across Kenya, Tanzania and Zanzibar.');
$section_enabled = get_theme_mod('roaming_why_travel_enabled', true);

if(!$section_enabled) return;
?>

<section class="py-20" style="background: hsl(40, 30%, 96%);">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="max-w-2xl mx-auto text-center mb-14">
            <span class="inline-block text-xs font-heading font-bold uppercase tracking-widest mb-3" style="color: hsl(44, 100%, 46%);">
                <?php echo esc_html($section_label); ?>
            </span>
            <h2 class="mb-4" style="font-size: 32px; font-weight: 700; color: hsl(30, 10%, 15%); font-family: 'Ubuntu', sans-serif;">
                <?php echo esc_html($section_title); ?>
            </h2>
            <p class="text-sm" style="color: hsl(30, 10%, 40%); font-family: 'Ubuntu', sans-serif; line-height: 1.5;">
                <?php echo esc_html($section_subtitle); ?>
            </p>
        </div>

        <!-- Highlights Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach($highlights as $i => $item): ?>
                <?php
                $gradients = array(
                    'linear-gradient(135deg, rgba(41, 135, 66, 0.15) 0%, rgba(41, 135, 66, 0.05) 100%)',
                    'linear-gradient(135deg, rgba(47, 158, 74, 0.15) 0%, rgba(47, 158, 74, 0.05) 100%)',
                    'linear-gradient(135deg, rgba(245, 166, 35, 0.15) 0%, rgba(245, 166, 35, 0.05) 100%)',
                    'linear-gradient(135deg, rgba(41, 135, 66, 0.15) 0%, rgba(47, 158, 74, 0.05) 100%)',
                    'linear-gradient(135deg, rgba(47, 158, 74, 0.15) 0%, rgba(245, 166, 35, 0.05) 100%)',
                    'linear-gradient(135deg, rgba(245, 166, 35, 0.15) 0%, rgba(41, 135, 66, 0.05) 100%)'
                );
                $gradient = $gradients[$i % count($gradients)];
                ?>
                <article class="group relative overflow-hidden rounded-2xl border p-7 hover:-translate-y-1.5 hover:shadow-xl transition-all duration-300 animate-fade-in-up" 
                         style="border-color: hsl(40, 15%, 85%); background: <?php echo $gradient; ?>; animation-delay: <?php echo $i * 80; ?>ms;">
                    
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5 group-hover:rotate-6 transition-transform" 
                         style="background: hsl(135, 53%, 35%); color: white;">
                        <i class="fas <?php echo esc_attr($item['icon']); ?>" style="font-size: 28px;"></i>
                    </div>
                    
                    <h3 class="text-lg mb-2 font-heading font-bold" style="color: hsl(30, 10%, 15%); font-family: 'Ubuntu', sans-serif;">
                        <?php echo esc_html($item['title']); ?>
                    </h3>
                    
                    <p class="text-sm leading-relaxed" style="color: hsl(30, 10%, 40%); font-family: 'Ubuntu', sans-serif; line-height: 1.5;">
                        <?php echo esc_html($item['description']); ?>
                    </p>
                    
                    <div class="absolute -right-10 -bottom-10 w-32 h-32 rounded-full transition-colors group-hover:bg-primary/10" 
                         style="background: rgba(41, 135, 66, 0.05);"></div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out forwards;
    opacity: 0;
}
@media (max-width: 1024px) {
    .grid { gap: 1.5rem !important; }
}
</style>
