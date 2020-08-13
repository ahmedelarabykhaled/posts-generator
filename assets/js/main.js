
var image_field;
jQuery(function ($) {
    // $(document).on('click', 'input.select-img', function (evt) {
    //     evt.preventDefault();
    //     console.log("ihn");
    //     // image_field = $(this).siblings('.img');
    //     // tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
    //     // return false;
    // });
    $('input.select-img').click(function (e) {
        e.preventDefault();
        console.log("ihn");
        // $('input.select-img').append("<p>Test</p>");
        $("<h3>islam</h3>").insertAfter(this)
        // image_field = $(this).siblings('.img');
        // tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        // return false;
    });

    window.send_to_editor = function (html) {
        imgurl = $('img', html).attr('src');
        image_field.val(imgurl);
        console.log(imgurl);
        tb_remove();
    }
});
