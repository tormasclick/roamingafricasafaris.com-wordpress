<?php
// Fix FAQs - unlimited entries
function safari_faqs_meta_callback_unlimited($post) {
    wp_nonce_field('safari_faqs_meta', 'safari_faqs_meta_nonce');
    $faqs = get_post_meta($post->ID, '_safari_faqs', true);
    $faqs = $faqs ? json_decode($faqs, true) : array();
    if(empty($faqs)) {
        $faqs = array();
    }
    ?>
    <div id="faqs-container-unlimited">
        <?php foreach($faqs as $index => $faq): ?>
            <div class="faq-item-unlimited" style="background:#f9f9f9; border:1px solid #ddd; padding:15px; margin:15px 0; border-radius:8px;">
                <p><label>Question:</label><br><input type="text" name="faq_question[]" value="<?php echo esc_attr($faq['question']); ?>" style="width:100%"></p>
                <p><label>Answer:</label><br><textarea name="faq_answer[]" rows="3" style="width:100%"><?php echo esc_textarea($faq['answer']); ?></textarea></p>
                <button type="button" class="button remove-faq-unlimited">Remove FAQ</button>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="button button-primary" id="add-faq-unlimited">+ Add FAQ</button>
    <script>
    jQuery(document).ready(function($) {
        $('#add-faq-unlimited').click(function() {
            $('#faqs-container-unlimited').append('<div class="faq-item-unlimited" style="background:#f9f9f9; border:1px solid #ddd; padding:15px; margin:15px 0; border-radius:8px;"><p><label>Question:</label><br><input type="text" name="faq_question[]" style="width:100%"></p><p><label>Answer:</label><br><textarea name="faq_answer[]" rows="3" style="width:100%"></textarea></p><button type="button" class="button remove-faq-unlimited">Remove FAQ</button></div>');
        });
        $(document).on('click', '.remove-faq-unlimited', function() {
            $(this).closest('.faq-item-unlimited').remove();
        });
    });
    </script>
    <?php
}
?>
