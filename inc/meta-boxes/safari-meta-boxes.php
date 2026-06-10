<?php
// Safari Meta Boxes - Complete with Media Uploader for Itinerary Images
function safari_add_meta_boxes() {
    add_meta_box('safari_details_meta', 'Safari Details', 'safari_details_meta_callback', 'safari', 'normal', 'high');
    add_meta_box('safari_itinerary_meta', 'Day-by-Day Itinerary (with Images)', 'safari_itinerary_meta_callback', 'safari', 'normal', 'high');
    add_meta_box('safari_pricing_meta', 'Tour Pricing Tables', 'safari_pricing_meta_callback', 'safari', 'normal', 'high');
    add_meta_box('safari_inclusions_meta', 'Inclusions & Exclusions', 'safari_inclusions_meta_callback', 'safari', 'normal', 'high');
    add_meta_box('safari_faqs_meta', 'Frequently Asked Questions', 'safari_faqs_meta_callback', 'safari', 'normal', 'high');
    add_meta_box('safari_gallery_meta', 'Safari Gallery', 'safari_gallery_meta_callback', 'safari', 'normal', 'high');
}
add_action('add_meta_boxes', 'safari_add_meta_boxes');

function safari_details_meta_callback($post) {
    wp_nonce_field('safari_details_meta', 'safari_details_meta_nonce');
    ?>
    <p><label>Duration (e.g., 4 Days / 3 Nights):</label><br><input type="text" name="safari_duration" value="<?php echo esc_attr(get_post_meta($post->ID, '_safari_duration', true)); ?>" style="width:100%"></p>
    <p><label>Price From (e.g., $1,200):</label><br><input type="text" name="safari_price" value="<?php echo esc_attr(get_post_meta($post->ID, '_safari_price', true)); ?>" style="width:100%"></p>
    <p><label>Country:</label><br><input type="text" name="safari_country" value="<?php echo esc_attr(get_post_meta($post->ID, '_safari_country', true)); ?>" style="width:100%"></p>
    <p><label>Max People:</label><br><input type="text" name="safari_max_people" value="<?php echo esc_attr(get_post_meta($post->ID, '_safari_max_people', true)); ?>" style="width:100%"></p>
    <p><label>Departure Info:</label><br><input type="text" name="safari_departure" value="<?php echo esc_attr(get_post_meta($post->ID, '_safari_departure', true)); ?>" style="width:100%"></p>
    <?php
}

function safari_itinerary_meta_callback($post) {
    wp_nonce_field('safari_itinerary_meta', 'safari_itinerary_meta_nonce');
    wp_enqueue_media();
    $days = get_post_meta($post->ID, '_safari_itinerary_days', true);
    $days = $days ? json_decode($days, true) : array();
    ?>
    <div id="itinerary-days-container">
        <?php foreach($days as $index => $day): ?>
            <div class="itinerary-day" style="background:#f9f9f9; border:1px solid #ddd; padding:20px; margin:20px 0; border-radius:8px;">
                <h3>Day <?php echo $day['day']; ?></h3>
                <p><label>Image:</label><br>
                    <div class="itinerary-image-wrapper">
                        <input type="hidden" name="itinerary_day_image_id[]" class="itinerary-image-id" value="<?php echo esc_attr($day['image_id'] ?? ''); ?>">
                        <div class="itinerary-image-preview">
                            <?php if(!empty($day['image_id'])): 
                                $image_url = wp_get_attachment_url($day['image_id']);
                                if($image_url): ?>
                                    <img src="<?php echo esc_url($image_url); ?>" style="max-width:200px; max-height:120px; border-radius:8px; margin-bottom:10px;">
                                <?php endif; 
                            endif; ?>
                        </div>
                        <button type="button" class="button upload-itinerary-image">Upload Image</button>
                        <button type="button" class="button remove-itinerary-image" style="background:#dc3232; color:white;">Remove Image</button>
                    </div>
                </p>
                <p><label>Title:</label><br><input type="text" name="itinerary_day_title[]" value="<?php echo esc_attr($day['title']); ?>" style="width:100%"></p>
                <p><label>Description:</label><br><textarea name="itinerary_day_desc[]" rows="4" style="width:100%"><?php echo esc_textarea($day['desc']); ?></textarea></p>
                <p><label>Overnight Accommodation:</label><br><input type="text" name="itinerary_day_overnight[]" value="<?php echo esc_attr($day['overnight']); ?>" style="width:100%"></p>
                <button type="button" class="button remove-day" style="background:#dc3232; color:white;">Remove Day</button>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="button button-primary" id="add-itinerary-day">+ Add New Day</button>
    <input type="hidden" name="safari_itinerary_days" id="safari_itinerary_days" value="">
    
    <script>
    jQuery(document).ready(function($) {
        function updateDaysJson() {
            var days = [];
            $('.itinerary-day').each(function(i) {
                days.push({
                    day: i+1,
                    image_id: $(this).find('.itinerary-image-id').val(),
                    title: $(this).find('input[name="itinerary_day_title[]"]').val(),
                    desc: $(this).find('textarea[name="itinerary_day_desc[]"]').val(),
                    overnight: $(this).find('input[name="itinerary_day_overnight[]"]').val()
                });
                $(this).find('h3').text('Day ' + (i+1));
            });
            $('#safari_itinerary_days').val(JSON.stringify(days));
        }
        
        // Add new day
        $('#add-itinerary-day').click(function() {
            var count = $('.itinerary-day').length + 1;
            var html = '<div class="itinerary-day" style="background:#f9f9f9; border:1px solid #ddd; padding:20px; margin:20px 0; border-radius:8px;">' +
                '<h3>Day ' + count + '</h3>' +
                '<p><label>Image:</label><br>' +
                '<div class="itinerary-image-wrapper">' +
                '<input type="hidden" name="itinerary_day_image_id[]" class="itinerary-image-id" value="">' +
                '<div class="itinerary-image-preview"></div>' +
                '<button type="button" class="button upload-itinerary-image">Upload Image</button> ' +
                '<button type="button" class="button remove-itinerary-image" style="background:#dc3232; color:white;">Remove Image</button>' +
                '</div></p>' +
                '<p><label>Title:</label><br><input type="text" name="itinerary_day_title[]" style="width:100%"></p>' +
                '<p><label>Description:</label><br><textarea name="itinerary_day_desc[]" rows="4" style="width:100%"></textarea></p>' +
                '<p><label>Overnight Accommodation:</label><br><input type="text" name="itinerary_day_overnight[]" style="width:100%"></p>' +
                '<button type="button" class="button remove-day" style="background:#dc3232; color:white;">Remove Day</button>' +
                '</div>';
            $('#itinerary-days-container').append(html);
            updateDaysJson();
        });
        
        // Upload image for itinerary day
        $(document).on('click', '.upload-itinerary-image', function(e) {
            e.preventDefault();
            var button = $(this);
            var frame = wp.media({
                title: 'Select Itinerary Image',
                multiple: false,
                library: { type: 'image' },
                button: { text: 'Use this image' }
            });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                button.siblings('.itinerary-image-id').val(attachment.id);
                button.siblings('.itinerary-image-preview').html('<img src="' + attachment.url + '" style="max-width:200px; max-height:120px; border-radius:8px; margin-bottom:10px;">');
                updateDaysJson();
            });
            frame.open();
        });
        
        // Remove image
        $(document).on('click', '.remove-itinerary-image', function(e) {
            e.preventDefault();
            $(this).siblings('.itinerary-image-id').val('');
            $(this).siblings('.itinerary-image-preview').html('');
            updateDaysJson();
        });
        
        // Remove entire day
        $(document).on('click', '.remove-day', function() {
            if(confirm('Remove this day from the itinerary?')) {
                $(this).closest('.itinerary-day').remove();
                updateDaysJson();
            }
        });
        
        // Update JSON on any change
        $(document).on('change keyup', '.itinerary-day input, .itinerary-day textarea', updateDaysJson);
        
        // Initial update
        updateDaysJson();
    });
    </script>
    <style>
        .itinerary-day { position: relative; }
        .itinerary-day .remove-day { margin-top: 10px; }
        .upload-itinerary-image, .remove-itinerary-image { margin-top: 5px; }
    </style>
    <?php
}

function safari_pricing_meta_callback($post) {
    wp_nonce_field('safari_pricing_meta', 'safari_pricing_meta_nonce');
    $low_season = get_post_meta($post->ID, '_safari_low_season', true);
    $high_season = get_post_meta($post->ID, '_safari_high_season', true);
    $low = $low_season ? json_decode($low_season, true) : array();
    $high = $high_season ? json_decode($high_season, true) : array();
    ?>
    <h3>Low Season Pricing (April, May, November)</h3>
    <table class="form-table">
        <tr><th>Adventure (1 Person)</th><td><input type="text" name="low_season_adventure_1" value="<?php echo esc_attr($low['adventure_1'] ?? ''); ?>" style="width:100%"></td></tr>
        <tr><th>Adventure (2 People)</th><td><input type="text" name="low_season_adventure_2" value="<?php echo esc_attr($low['adventure_2'] ?? ''); ?>" style="width:100%"></td></tr>
        <tr><th>Adventure (4 People)</th><td><input type="text" name="low_season_adventure_4" value="<?php echo esc_attr($low['adventure_4'] ?? ''); ?>" style="width:100%"></td></tr>
        <tr><th>Adventure (6+ People)</th><td><input type="text" name="low_season_adventure_6" value="<?php echo esc_attr($low['adventure_6'] ?? ''); ?>" style="width:100%"></td></tr>
        <tr><th>Comfort (1 Person)</th><td><input type="text" name="low_season_comfort_1" value="<?php echo esc_attr($low['comfort_1'] ?? ''); ?>" style="width:100%"></td></tr>
        <tr><th>Comfort (2 People)</th><td><input type="text" name="low_season_comfort_2" value="<?php echo esc_attr($low['comfort_2'] ?? ''); ?>" style="width:100%"></td></tr>
        <tr><th>Comfort (4 People)</th><td><input type="text" name="low_season_comfort_4" value="<?php echo esc_attr($low['comfort_4'] ?? ''); ?>" style="width:100%"></td></tr>
        <tr><th>Comfort (6+ People)</th><td><input type="text" name="low_season_comfort_6" value="<?php echo esc_attr($low['comfort_6'] ?? ''); ?>" style="width:100%"></td></tr>
    </table>
    <h3>High Season Pricing</h3>
    <table class="form-table">
        <tr><th>Adventure (1 Person)</th><td><input type="text" name="high_season_adventure_1" value="<?php echo esc_attr($high['adventure_1'] ?? ''); ?>" style="width:100%"></td></tr>
        <tr><th>Adventure (2 People)</th><td><input type="text" name="high_season_adventure_2" value="<?php echo esc_attr($high['adventure_2'] ?? ''); ?>" style="width:100%"></td></tr>
        <tr><th>Adventure (4 People)</th><td><input type="text" name="high_season_adventure_4" value="<?php echo esc_attr($high['adventure_4'] ?? ''); ?>" style="width:100%"></td></tr>
        <tr><th>Adventure (6+ People)</th><td><input type="text" name="high_season_adventure_6" value="<?php echo esc_attr($high['adventure_6'] ?? ''); ?>" style="width:100%"></td></tr>
        <tr><th>Comfort (1 Person)</th><td><input type="text" name="high_season_comfort_1" value="<?php echo esc_attr($high['comfort_1'] ?? ''); ?>" style="width:100%"></td></tr>
        <tr><th>Comfort (2 People)</th><td><input type="text" name="high_season_comfort_2" value="<?php echo esc_attr($high['comfort_2'] ?? ''); ?>" style="width:100%"></td></tr>
        <tr><th>Comfort (4 People)</th><td><input type="text" name="high_season_comfort_4" value="<?php echo esc_attr($high['comfort_4'] ?? ''); ?>" style="width:100%"></td></tr>
        <tr><th>Comfort (6+ People)</th><td><input type="text" name="high_season_comfort_6" value="<?php echo esc_attr($high['comfort_6'] ?? ''); ?>" style="width:100%"></td></tr>
    </table>
    <?php
}

function safari_inclusions_meta_callback($post) {
    wp_nonce_field('safari_inclusions_meta', 'safari_inclusions_meta_nonce');
    ?>
    <p><strong>Inclusions (What's included - use bullet points with &lt;ul&gt;&lt;li&gt;):</strong></p>
    <textarea name="safari_inclusions" rows="10" style="width:100%"><?php echo esc_textarea(get_post_meta($post->ID, '_safari_inclusions', true)); ?></textarea>
    <p><strong>Exclusions (What's not included):</strong></p>
    <textarea name="safari_exclusions" rows="10" style="width:100%"><?php echo esc_textarea(get_post_meta($post->ID, '_safari_exclusions', true)); ?></textarea>
    <?php
}

function safari_faqs_meta_callback($post) {
    wp_nonce_field('safari_faqs_meta', 'safari_faqs_meta_nonce');
    $faqs = get_post_meta($post->ID, '_safari_faqs', true);
    $faqs = $faqs ? json_decode($faqs, true) : array();
    ?>
    <div id="faqs-container">
        <?php foreach($faqs as $index => $faq): ?>
            <div style="background:#f9f9f9; border:1px solid #ddd; padding:15px; margin:15px 0; border-radius:8px;">
                <p><label>Question:</label><br><input type="text" name="faq_question[]" value="<?php echo esc_attr($faq['question']); ?>" style="width:100%"></p>
                <p><label>Answer:</label><br><textarea name="faq_answer[]" rows="3" style="width:100%"><?php echo esc_textarea($faq['answer']); ?></textarea></p>
                <button type="button" class="button remove-faq">Remove FAQ</button>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="button button-primary" id="add-faq">+ Add FAQ</button>
    <script>
    jQuery(document).ready(function($) {
        $('#add-faq').click(function() {
            $('#faqs-container').append('<div style="background:#f9f9f9; border:1px solid #ddd; padding:15px; margin:15px 0; border-radius:8px;"><p><label>Question:</label><br><input type="text" name="faq_question[]" style="width:100%"></p><p><label>Answer:</label><br><textarea name="faq_answer[]" rows="3" style="width:100%"></textarea></p><button type="button" class="button remove-faq">Remove FAQ</button></div>');
        });
        $(document).on('click', '.remove-faq', function() {
            $(this).closest('div').remove();
        });
    });
    </script>
    <?php
}

function safari_gallery_meta_callback($post) {
    wp_nonce_field('safari_gallery_meta', 'safari_gallery_meta_nonce');
    $gallery = get_post_meta($post->ID, '_safari_gallery', true);
    $gallery = $gallery ? explode(',', $gallery) : array();
    wp_enqueue_media();
    ?>
    <div id="safari_gallery_wrapper">
        <div id="safari_gallery_images"><?php foreach($gallery as $img_id): $img_url = wp_get_attachment_url($img_id); if($img_url): ?><div style="display:inline-block; margin:5px; position:relative;"><img src="<?php echo esc_url($img_url); ?>" style="width:120px; height:80px; object-fit:cover; border-radius:4px;"><button type="button" class="button remove-gallery-img" data-id="<?php echo $img_id; ?>" style="position:absolute; top:-5px; right:-5px; background:red; color:white; border:none; border-radius:50%; width:20px; height:20px; cursor:pointer;">×</button></div><?php endif; endforeach; ?></div>
        <button type="button" class="button button-primary" id="add_safari_gallery">+ Add Gallery Images</button>
        <input type="hidden" name="safari_gallery" id="safari_gallery" value="<?php echo esc_attr(implode(',', $gallery)); ?>">
    </div>
    <script>
    jQuery(document).ready(function($) {
        $('#add_safari_gallery').click(function(e) {
            e.preventDefault();
            var frame = wp.media({ title: 'Select Images', multiple: true, button: { text: 'Add to Gallery' } });
            frame.on('select', function() {
                var selection = frame.state().get('selection');
                var ids = $('#safari_gallery').val() ? $('#safari_gallery').val().split(',') : [];
                selection.map(function(attachment) {
                    attachment = attachment.toJSON();
                    ids.push(attachment.id);
                    $('#safari_gallery_images').append('<div style="display:inline-block; margin:5px; position:relative;"><img src="' + attachment.url + '" style="width:120px; height:80px; object-fit:cover; border-radius:4px;"><button type="button" class="button remove-gallery-img" data-id="' + attachment.id + '" style="position:absolute; top:-5px; right:-5px; background:red; color:white; border:none; border-radius:50%; width:20px; height:20px; cursor:pointer;">×</button></div>');
                });
                $('#safari_gallery').val(ids.join(','));
            });
            frame.open();
        });
        $(document).on('click', '.remove-gallery-img', function() {
            var id = $(this).data('id');
            var ids = $('#safari_gallery').val().split(',');
            var newIds = ids.filter(function(i) { return i != id; });
            $('#safari_gallery').val(newIds.join(','));
            $(this).parent().remove();
        });
    });
    </script>
    <?php
}

function safari_save_meta_data($post_id) {
    if(isset($_POST['safari_details_meta_nonce']) && wp_verify_nonce($_POST['safari_details_meta_nonce'], 'safari_details_meta')) {
        $fields = ['safari_duration', 'safari_price', 'safari_country', 'safari_max_people', 'safari_departure'];
        foreach($fields as $field) {
            if(isset($_POST[$field])) update_post_meta($post_id, "_$field", sanitize_text_field($_POST[$field]));
        }
    }
    if(isset($_POST['safari_itinerary_meta_nonce']) && wp_verify_nonce($_POST['safari_itinerary_meta_nonce'], 'safari_itinerary_meta')) {
        if(isset($_POST['safari_itinerary_days'])) update_post_meta($post_id, '_safari_itinerary_days', wp_kses_post($_POST['safari_itinerary_days']));
    }
    if(isset($_POST['safari_pricing_meta_nonce']) && wp_verify_nonce($_POST['safari_pricing_meta_nonce'], 'safari_pricing_meta')) {
        $low = array();
        $high = array();
        for($i = 1; $i <= 6; $i+=1) {
            $key = $i == 6 ? '6' : $i;
            if(isset($_POST["low_season_adventure_$key"])) $low["adventure_$key"] = sanitize_text_field($_POST["low_season_adventure_$key"]);
            if(isset($_POST["low_season_comfort_$key"])) $low["comfort_$key"] = sanitize_text_field($_POST["low_season_comfort_$key"]);
            if(isset($_POST["high_season_adventure_$key"])) $high["adventure_$key"] = sanitize_text_field($_POST["high_season_adventure_$key"]);
            if(isset($_POST["high_season_comfort_$key"])) $high["comfort_$key"] = sanitize_text_field($_POST["high_season_comfort_$key"]);
        }
        update_post_meta($post_id, '_safari_low_season', json_encode($low));
        update_post_meta($post_id, '_safari_high_season', json_encode($high));
    }
    if(isset($_POST['safari_inclusions_meta_nonce']) && wp_verify_nonce($_POST['safari_inclusions_meta_nonce'], 'safari_inclusions_meta')) {
        if(isset($_POST['safari_inclusions'])) update_post_meta($post_id, '_safari_inclusions', wp_kses_post($_POST['safari_inclusions']));
        if(isset($_POST['safari_exclusions'])) update_post_meta($post_id, '_safari_exclusions', wp_kses_post($_POST['safari_exclusions']));
    }
    if(isset($_POST['safari_faqs_meta_nonce']) && wp_verify_nonce($_POST['safari_faqs_meta_nonce'], 'safari_faqs_meta')) {
        $faqs = array();
        if(isset($_POST['faq_question']) && is_array($_POST['faq_question'])) {
            for($i = 0; $i < count($_POST['faq_question']); $i++) {
                if(!empty($_POST['faq_question'][$i])) {
                    $faqs[] = array('question' => sanitize_text_field($_POST['faq_question'][$i]), 'answer' => sanitize_textarea_field($_POST['faq_answer'][$i]));
                }
            }
        }
        update_post_meta($post_id, '_safari_faqs', json_encode($faqs));
    }
    if(isset($_POST['safari_gallery_meta_nonce']) && wp_verify_nonce($_POST['safari_gallery_meta_nonce'], 'safari_gallery_meta')) {
        if(isset($_POST['safari_gallery'])) update_post_meta($post_id, '_safari_gallery', sanitize_text_field($_POST['safari_gallery']));
    }
}
add_action('save_post_safari', 'safari_save_meta_data');

// Add form shortcode meta box
function safari_form_shortcode_meta_box() {
    add_meta_box('safari_form_shortcode_meta', 'Booking Form Shortcode', 'safari_form_shortcode_callback', 'safari', 'side', 'high');
}
add_action('add_meta_boxes', 'safari_form_shortcode_meta_box');

function safari_form_shortcode_callback($post) {
    $shortcode = get_post_meta($post->ID, '_safari_form_shortcode', true);
    ?>
    <p>Enter your Contact Form 7 shortcode:</p>
    <input type="text" name="safari_form_shortcode" value="<?php echo esc_attr($shortcode); ?>" style="width:100%">
    <p class="description">Example: [contact-form-7 id="123" title="Safari Booking"]</p>
    <?php
}

// Save form shortcode
function safari_save_form_shortcode($post_id) {
    if(isset($_POST['safari_form_shortcode'])) {
        update_post_meta($post_id, '_safari_form_shortcode', sanitize_text_field($_POST['safari_form_shortcode']));
    }
}
add_action('save_post_safari', 'safari_save_form_shortcode');

// Fix FAQ save function - ensure proper saving
function safari_faqs_save_fixed($post_id) {
    if(isset($_POST['safari_faqs_meta_nonce']) && wp_verify_nonce($_POST['safari_faqs_meta_nonce'], 'safari_faqs_meta')) {
        $faqs = array();
        if(isset($_POST['faq_question']) && is_array($_POST['faq_question'])) {
            for($i = 0; $i < count($_POST['faq_question']); $i++) {
                if(!empty($_POST['faq_question'][$i])) {
                    $faqs[] = array(
                        'question' => sanitize_text_field($_POST['faq_question'][$i]),
                        'answer' => sanitize_textarea_field($_POST['faq_answer'][$i])
                    );
                }
            }
        }
        update_post_meta($post_id, '_safari_faqs', json_encode($faqs));
    }
}
add_action('save_post_safari', 'safari_faqs_save_fixed', 20);

// Fix FAQ save - unlimited entries
function safari_faqs_save_unlimited($post_id) {
    if(isset($_POST['safari_faqs_meta_nonce']) && wp_verify_nonce($_POST['safari_faqs_meta_nonce'], 'safari_faqs_meta')) {
        $faqs = array();
        if(isset($_POST['faq_question']) && is_array($_POST['faq_question'])) {
            for($i = 0; $i < count($_POST['faq_question']); $i++) {
                if(!empty($_POST['faq_question'][$i])) {
                    $faqs[] = array(
                        'question' => sanitize_text_field($_POST['faq_question'][$i]),
                        'answer' => sanitize_textarea_field($_POST['faq_answer'][$i])
                    );
                }
            }
        }
        update_post_meta($post_id, '_safari_faqs', json_encode($faqs));
    }
}
add_action('save_post_safari', 'safari_faqs_save_unlimited', 20);
