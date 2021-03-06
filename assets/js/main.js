jQuery(document).ready(function ($) {

    $(document).on("click", ".upload_image_button", function (e) {
        e.preventDefault();

        var $button = $(this);

        // Create the media frame.
        var file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select or upload image',
            library: { // remove these to show all
                type: 'pdf' // specific mime
            },
            button: {
                text: 'Select'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected, run a callback.
        file_frame.on('select', function () {
            // We set multiple to false so only get one image from the uploader

            var attachment = file_frame.state().get('selection').first().toJSON();

            // hidden input
            $button.siblings('input.fileURL').val(attachment.url);
            $button.siblings('div.fileURL').append("<em>URL: </em>" + attachment.url);

        });

        // Finally, open the modal
        file_frame.open();
    });

});

function deleteFile(id, url, widget_base_id, current_widget_id) {
    jQuery.ajax({
        url: url,
        type: 'POST',
        data: {
            'action': 'delete_record',
            'record_id': id,
            'widget_base': widget_base_id,
            'current_widget_id': current_widget_id
        },
        success: function (data) {
            removeFromTable(id, current_widget_id)
        },
        error: function (err) {
            // insert some text in ui 
            // TO-DO
        }
    });
}


function removeFromTable(recordID, currentWidgetID) {
    elementID = currentWidgetID + '-record-' + recordID;
    jQuery(`#${elementID}`).remove();
}