jQuery(document).ready(function($) {
    // Image upload functionality
    $('.upload-image-btn').on('click', function(e) {
        e.preventDefault();
        var button = $(this);
        var customUploader = wp.media({
            title: 'Select Partner Logo',
            button: { text: 'Use this logo' },
            multiple: false,
            library: { type: 'image' }
        }).on('select', function() {
            var attachment = customUploader.state().get('selection').first().toJSON();
            button.siblings('.partner-image-url').val(attachment.url);
            button.siblings('.image-preview').remove();
            button.siblings('.partner-image-url').after('<div><img src="' + attachment.url + '" class="image-preview" style="max-width:150px; max-height:60px; margin-top:10px; border:1px solid #ddd; padding:5px; border-radius:4px;" /></div>');
        });
        customUploader.open();
    });
});
