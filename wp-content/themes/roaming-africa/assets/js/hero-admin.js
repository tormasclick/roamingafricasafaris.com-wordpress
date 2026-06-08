jQuery(document).ready(function($) {
    // Image upload functionality
    $(document).on('click', '.upload-image-btn', function(e) {
        e.preventDefault();
        var targetInput = $(this).data('target');
        var customUploader = wp.media({
            title: 'Select Image',
            button: {
                text: 'Use this image'
            },
            multiple: false
        });
        
        customUploader.on('select', function() {
            var attachment = customUploader.state().get('selection').first().toJSON();
            $('#' + targetInput).val(attachment.url);
            
            // Show preview
            var previewHtml = '<div style="margin-top: 10px;"><img src="' + attachment.url + '" style="max-width: 200px; max-height: 100px; border: 1px solid #ddd; padding: 5px;"></div>';
            $(this).closest('div').find('.image-preview').remove();
            $(this).closest('div').append('<div class="image-preview">' + previewHtml + '</div>');
        });
        
        customUploader.open();
    });
    
    // Add new slide
    $('#add-slide').click(function() {
        var index = $('#slides-container .slide-card').length;
        var html = '<div class="slide-card" style="background:#fff;border:1px solid #ddd;margin:20px 0;padding:20px;border-radius:8px;">' +
            '<h3>Slide ' + (index + 1) + '</h3>' +
            '<div style="margin-bottom:15px;"><label style="display:block;margin-bottom:5px;font-weight:bold;">Title:</label><input type="text" name="slide_title[]" style="width:100%;padding:8px;"></div>' +
            '<div style="margin-bottom:15px;"><label style="display:block;margin-bottom:5px;font-weight:bold;">Subtitle:</label><textarea name="slide_subtitle[]" rows="3" style="width:100%;padding:8px;"></textarea></div>' +
            '<div style="margin-bottom:15px;"><label style="display:block;margin-bottom:5px;font-weight:bold;">Image:</label>' +
            '<div style="display:flex;gap:10px;align-items:center;"><input type="text" name="slide_image[]" id="slide_image_' + index + '" style="flex:1;padding:8px;">' +
            '<button type="button" class="button upload-image-btn" data-target="slide_image_' + index + '">Upload Image</button></div></div>' +
            '<div style="display:grid;grid-template-columns:1fr 1fr;gap:15px;margin-bottom:15px;">' +
            '<div><label style="display:block;margin-bottom:5px;font-weight:bold;">Button Text:</label><input type="text" name="slide_button_text[]" style="width:100%;padding:8px;"></div>' +
            '<div><label style="display:block;margin-bottom:5px;font-weight:bold;">Button URL:</label><input type="text" name="slide_button_url[]" style="width:100%;padding:8px;"></div>' +
            '</div>' +
            '<button type="button" class="button remove-slide" style="background:#dc3232;color:white;border:none;">Remove Slide</button>' +
            '</div>';
        $('#slides-container').append(html);
    });
    
    // Remove slide
    $(document).on('click', '.remove-slide', function() {
        if(confirm('Remove this slide?')) {
            $(this).closest('.slide-card').remove();
        }
    });
});
