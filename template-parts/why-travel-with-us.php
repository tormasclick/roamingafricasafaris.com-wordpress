<?php
/**
 * Why Travel With Us Section - Fully Dynamic from Database
 */

// Get section header data from database options
$section_label = get_option('roaming_why_travel_label', 'Why travel with us');
$section_title = get_option('roaming_why_travel_title', 'Why Travel With Roaming Africa Tours &amp; Safaris');
$section_subtitle = get_option('roaming_why_travel_subtitle', 'Established in 2006, Roaming Africa Tours and Safaris combines destination management expertise with local knowledge to create seamless journeys across Kenya, Tanzania and Zanzibar.');

// Get features from database
$features_json = get_option('roaming_why_travel_features', '');
$features = array();

if(!empty($features_json)) {
    $features = json_decode($features_json, true);
}

// Fallback if empty
if(empty($features)) {
    $features = array(
        array('icon' => 'fa-award', 'title' => 'Operating Since 2006', 'desc' => 'Nearly two decades creating memorable East African safaris. Roaming Africa Tours and Safaris has guided travellers from over 60 countries across Kenya, Tanzania and Zanzibar.', 'gradient' => 'linear-gradient(135deg, rgba(41, 135, 66, 0.15) 0%, rgba(41, 135, 66, 0.05) 100%)'),
        array('icon' => 'fa-map', 'title' => 'Destination Management Expertise', 'desc' => 'A full-service East African DMC handling permits, transfers, lodges, vehicles and ground logistics in-house — one trusted operator from arrival to departure.', 'gradient' => 'linear-gradient(135deg, rgba(47, 158, 74, 0.15) 0%, rgba(47, 158, 74, 0.05) 100%)'),
        array('icon' => 'fa-binoculars', 'title' => 'Deep Local Knowledge', 'desc' => 'Our team lives and works in Nairobi, Mombasa, Arusha and Zanzibar. We know the parks, the seasons, the camps and the people behind every itinerary we build.', 'gradient' => 'linear-gradient(135deg, rgba(245, 166, 35, 0.15) 0%, rgba(245, 166, 35, 0.05) 100%)'),
        array('icon' => 'fa-users', 'title' => 'Professional Safari Guides', 'desc' => 'KPSGA-certified, bronze and silver level driver-guides with years of experience reading wildlife behaviour and translating Kenya, Tanzania and Zanzibar for our guests.', 'gradient' => 'linear-gradient(135deg, rgba(41, 135, 66, 0.15) 0%, rgba(47, 158, 74, 0.05) 100%)'),
        array('icon' => 'fa-compass', 'title' => 'Tailor-Made Itineraries', 'desc' => 'Every journey is customised to your dates, budget and pace — private safaris, family travel, honeymoons, photography expeditions and corporate incentive groups.', 'gradient' => 'linear-gradient(135deg, rgba(47, 158, 74, 0.15) 0%, rgba(245, 166, 35, 0.05) 100%)'),
        array('icon' => 'fa-wheelchair', 'title' => 'Accessible Travel Specialists', 'desc' => 'One of East Africa\'s most established accessible safari programmes — wheelchair-accessible vehicles, step-free lodges and trained guides for barrier-free travel.', 'gradient' => 'linear-gradient(135deg, rgba(245, 166, 35, 0.15) 0%, rgba(41, 135, 66, 0.05) 100%)')
    );
}
?>

<section style="padding: 80px 0; background: #f5f0e8;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 20px;">
        <div style="text-align: center; margin-bottom: 60px;">
            <span style="display: inline-block; font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; color: #F5A623;"><?php echo esc_html($section_label); ?></span>
            <h2 style="font-size: 32px; font-weight: 700; color: #1a3c2c; margin-bottom: 16px;"><?php echo wp_kses_post($section_title); ?></h2>
            <p style="color: #666; max-width: 700px; margin: 0 auto;"><?php echo esc_html($section_subtitle); ?></p>
        </div>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            <?php foreach($features as $item): ?>
                <div class="why-travel-card" style="position: relative; overflow: hidden; border-radius: 16px; border: 1px solid #e5e5e5; padding: 28px; transition: all 0.3s; background: <?php echo isset($item['gradient']) ? $item['gradient'] : 'linear-gradient(135deg, rgba(41, 135, 66, 0.15) 0%, rgba(41, 135, 66, 0.05) 100%)'; ?>;">
                    <div style="width: 56px; height: 56px; background: #298742; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; transition: transform 0.3s;">
                        <i class="fas <?php echo esc_attr($item['icon']); ?>" style="font-size: 28px; color: white;"></i>
                    </div>
                    <h3 style="font-size: 18px; font-weight: 700; color: #1a3c2c; margin-bottom: 12px;"><?php echo esc_html($item['title']); ?></h3>
                    <p style="font-size: 14px; color: #666; line-height: 1.5;"><?php echo esc_html($item['desc']); ?></p>
                    <div style="position: absolute; right: -40px; bottom: -40px; width: 128px; height: 128px; border-radius: 50%; background: rgba(41, 135, 66, 0.05);"></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
.why-travel-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}
.why-travel-card:hover div[style*="background: #298742"] {
    transform: scale(1.05);
}
@media (max-width: 992px) {
    [style*="grid-template-columns: repeat(3, 1fr)"] {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}
@media (max-width: 768px) {
    [style*="grid-template-columns: repeat(3, 1fr)"] {
        grid-template-columns: 1fr !important;
    }
}
</style>
