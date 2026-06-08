<?php
/**
 * Why Travel With Us Section - Complete replica of your design
 */

// Data from your React site
$features = array(
    array(
        'icon' => 'fa-calendar-alt',
        'title' => 'Operating Since 2006',
        'description' => 'Nearly two decades creating memorable East African safaris. Roaming Africa Tours and Safaris has guided travellers from over 60 countries across Kenya, Tanzania and Zanzibar.'
    ),
    array(
        'icon' => 'fa-building',
        'title' => 'Destination Management Expertise',
        'description' => 'A full-service East African DMC handling permits, transfers, lodges, vehicles and ground logistics in-house — one trusted operator from arrival to departure.'
    ),
    array(
        'icon' => 'fa-map-marker-alt',
        'title' => 'Deep Local Knowledge',
        'description' => 'Our team lives and works in Nairobi, Mombasa, Arusha and Zanzibar. We know the parks, the seasons, the camps and the people behind every itinerary we build.'
    ),
    array(
        'icon' => 'fa-star',
        'title' => 'Professional Safari Guides',
        'description' => 'KPSGA-certified, bronze and silver level driver-guides with years of experience reading wildlife behaviour and translating Kenya, Tanzania and Zanzibar for our guests.'
    ),
    array(
        'icon' => 'fa-pencil-ruler',
        'title' => 'Tailor-Made Itineraries',
        'description' => 'Every journey is customised to your dates, budget and pace — private safaris, family travel, honeymoons, photography expeditions and corporate incentive groups.'
    ),
    array(
        'icon' => 'fa-wheelchair',
        'title' => 'Accessible Travel Specialists',
        'description' => 'One of East Africa\'s most established accessible safari programmes — wheelchair-accessible vehicles, step-free lodges and trained guides for barrier-free travel.'
    )
);
?>

<section class="why-travel-section" style="padding: 80px 0; background: #f5f0e8;">
    <div class="why-travel-container" style="max-width: 1280px; margin: 0 auto; padding: 0 20px;">
        
        <!-- Section Header -->
        <div style="text-align: center; margin-bottom: 60px;">
            <h2 style="font-size: 36px; font-weight: 700; color: #1a3c2c; margin-bottom: 16px; font-family: 'Ubuntu', sans-serif;">
                Why Travel With Us
            </h2>
            <p style="font-size: 18px; color: #555; max-width: 700px; margin: 0 auto; font-family: 'Ubuntu', sans-serif;">
                Established in 2006, Roaming Africa Tours and Safaris combines destination management expertise with local knowledge to create seamless journeys across Kenya, Tanzania and Zanzibar.
            </p>
        </div>
        
        <!-- Features Grid -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            <?php foreach($features as $feature): ?>
                <div class="why-travel-card" style="background: white; border-radius: 12px; padding: 32px 24px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="icon-wrapper" style="width: 70px; height: 70px; background: #e8f5e9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="fas <?php echo $feature['icon']; ?>" style="font-size: 32px; color: #298742;"></i>
                    </div>
                    <h3 style="font-size: 20px; font-weight: 700; color: #1a3c2c; margin-bottom: 16px; font-family: 'Ubuntu', sans-serif;">
                        <?php echo $feature['title']; ?>
                    </h3>
                    <p style="font-size: 14px; line-height: 1.6; color: #666; font-family: 'Ubuntu', sans-serif;">
                        <?php echo $feature['description']; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Trust Badges / Partners Section -->
        <div style="margin-top: 60px; text-align: center;">
            <div style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 40px; opacity: 0.7;">
                <div style="text-align: center;">
                    <i class="fas fa-trophy" style="font-size: 40px; color: #298742;"></i>
                    <p style="font-size: 12px; margin-top: 8px; color: #666;">Licensed & Insured</p>
                </div>
                <div style="text-align: center;">
                    <i class="fas fa-shield-alt" style="font-size: 40px; color: #298742;"></i>
                    <p style="font-size: 12px; margin-top: 8px; color: #666;">Bonded Operator</p>
                </div>
                <div style="text-align: center;">
                    <i class="fas fa-handshake" style="font-size: 40px; color: #298742;"></i>
                    <p style="font-size: 12px; margin-top: 8px; color: #666;">Trusted Partner</p>
                </div>
                <div style="text-align: center;">
                    <i class="fas fa-globe-africa" style="font-size: 40px; color: #298742;"></i>
                    <p style="font-size: 12px; margin-top: 8px; color: #666;">East African Specialists</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .why-travel-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    
    @media (max-width: 992px) {
        .why-travel-section [style*="grid-template-columns"] {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }
    
    @media (max-width: 768px) {
        .why-travel-section [style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }
        
        .why-travel-section h2 {
            font-size: 28px !important;
        }
    }
</style>

<script>
// Add hover effect logging (optional)
document.querySelectorAll('.why-travel-card').forEach(card => {
    card.addEventListener('mouseenter', () => {
        console.log('Card hovered');
    });
});
</script>
