<?php
/**
 * Complete Data Import from React to WordPress
 */

require_once('wp-load.php');

// Copy all images from React to WordPress uploads
function copy_images() {
    $react_images_dir = '/Users/admin/Documents/Nzisa/Personal/Gain/roamingafricasafaris/src/assets';
    $wp_upload_dir = wp_upload_dir();
    
    if(is_dir($react_images_dir)) {
        exec("cp -r $react_images_dir/* {$wp_upload_dir['basedir']}/ 2>/dev/null");
        echo "✅ Images copied to WordPress uploads\n";
    }
}

// Import Safaris
function import_safaris() {
    $safaris_data = array(
        array(
            'title' => '2 Days Amboseli Safari from Nairobi',
            'duration' => '2 Days / 1 Night',
            'price' => '$640',
            'country' => 'kenya',
            'destinations' => 'Amboseli',
            'content' => 'Witness giant elephant herds against the backdrop of Mount Kilimanjaro on this 2-day Amboseli safari from Nairobi. Explore Amboseli National Park, one of Kenya\'s most iconic wildlife destinations.',
            'inclusions' => "Transport in 4×4 safari Land Cruiser\nProfessional English-speaking driver guide\n1 night full board accommodation\nPark entrance fees\nBottled drinking water",
            'exclusions' => "International flights\nVisa fees\nTravel insurance\nPersonal expenses\nTips and gratuities"
        ),
        array(
            'title' => '3 Days Lake Naivasha to Lake Nakuru Safari',
            'duration' => '3 Days / 2 Nights',
            'price' => '$800',
            'country' => 'kenya',
            'destinations' => 'Lake Naivasha, Lake Nakuru',
            'content' => 'Explore Kenya\'s Great Rift Valley on this 3-day safari combining the lush shores of Lake Naivasha with the flamingo paradise of Lake Nakuru.',
            'inclusions' => "Transport in 4×4 safari Land Cruiser\nProfessional driver guide\n2 nights full board accommodation\nPark entrance fees\nBoat ride on Lake Naivasha",
            'exclusions' => "International flights\nVisa fees\nTravel insurance\nPersonal expenses\nTips"
        ),
        array(
            'title' => '5 Days Kenya Safari - Masai Mara & Lake Nakuru',
            'duration' => '5 Days / 4 Nights',
            'price' => '$1,200',
            'country' => 'kenya',
            'destinations' => 'Masai Mara, Lake Nakuru',
            'content' => 'Experience Kenya\'s premier safari destinations including the world-famous Masai Mara National Reserve and the flamingo paradise of Lake Nakuru.',
            'inclusions' => "4×4 Safari Land Cruiser\nProfessional guide\n4 nights accommodation\nAll meals\nPark fees\nBottled water",
            'exclusions' => "International flights\nVisa\nInsurance\nTips\nPersonal items"
        ),
        array(
            'title' => '7 Days Kenya & Tanzania Combo Safari',
            'duration' => '7 Days / 6 Nights',
            'price' => '$2,200',
            'country' => 'combo',
            'destinations' => 'Masai Mara, Serengeti, Ngorongoro',
            'content' => 'The ultimate East African safari experience combining Kenya\'s Masai Mara with Tanzania\'s Serengeti and Ngorongoro Crater.',
            'inclusions' => "4×4 Vehicles\nExpert guides\n6 nights accommodation\nAll meals\nPark fees\nBorder transfers",
            'exclusions' => "International flights\nVisa fees\nTravel insurance\nTips\nDrinks"
        ),
    );
    
    foreach($safaris_data as $safari) {
        $post_id = wp_insert_post(array(
            'post_title' => $safari['title'],
            'post_content' => $safari['content'],
            'post_status' => 'publish',
            'post_type' => 'safari',
            'meta_input' => array(
                '_safari_duration' => $safari['duration'],
                '_safari_price' => $safari['price'],
                '_safari_country' => $safari['country'],
                '_safari_destinations' => $safari['destinations'],
                '_safari_inclusions' => $safari['inclusions'],
                '_safari_exclusions' => $safari['exclusions']
            )
        ));
        
        if($post_id) {
            echo "✅ Imported: {$safari['title']}\n";
        }
    }
}

// Create WordPress pages
function create_pages() {
    $pages = array(
        'Home' => '[home_page_content]',
        'About' => 'Roaming Africa Tours and Safaris is a leading Destination Management Company (DMC) based in Nairobi, Kenya, specializing in unforgettable wildlife adventures across East Africa.',
        'Contact' => '[contact-form-7 id="YOUR_FORM_ID" title="Contact form"]',
        'Safaris' => 'Browse our amazing safari packages below.',
        'Destinations' => 'Explore our top safari destinations across Kenya and Tanzania.',
        'Hotels' => 'Discover our handpicked hotels and lodges.',
        'Vehicles' => 'Explore our fleet of safari vehicles.'
    );
    
    foreach($pages as $title => $content) {
        $existing_page = get_page_by_title($title);
        if(!$existing_page) {
            wp_insert_post(array(
                'post_title' => $title,
                'post_content' => $content,
                'post_status' => 'publish',
                'post_type' => 'page'
            ));
            echo "✅ Created page: $title\n";
        }
    }
}

// Run all imports
echo "Starting import...\n\n";
copy_images();
echo "\n";
import_safaris();
echo "\n";
create_pages();
echo "\n✅ Import completed successfully!\n";
echo "\nNext steps:\n";
echo "1. Go to WordPress admin\n";
echo "2. Settings > Reading > Set Homepage as front page\n";
echo "3. Appearance > Menus > Create navigation menu\n";
echo "4. Add your Contact Form 7 shortcode to Contact page\n";
