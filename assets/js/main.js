jQuery(document).ready(function ($) {

    $(document).on("click", ".upload_image_button", function (e) {
        e.preventDefault();
        var $button = $(this);


        // Create the media frame.
        var file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select or upload image',
            library: { // remove these to show all
                type: 'image' // specific mime
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

            console.log(attachment);

            // hidden input
            $button.siblings('input.fileURL').val(attachment.url);

        });

        // Finally, open the modal
        file_frame.open();
    });
});

// jQuery(document).ready(function ($) {
//     console.log($(".post-generator-data input"));
//     $(".post-generator-data input").keyup(function (e) {
//         console.log(e.target.value);
//     })

//     console.log();
//     $("#widget-postgenerator_widget-3-savewidget").attr('value', 'xx');
// })

