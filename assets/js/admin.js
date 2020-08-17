jQuery(document).ready(function ($) {
    $(document).on('click', '.del-btn', function (e) {
        var this2 = this;
        recordID = $(this).siblings('input.record_id')[0].value;
        widgetBaseID = $(this).siblings('input.widget_base')[0].value;
        currentWidgetID = $(this).siblings('input.current_widget_id')[0].value;
        $.post(my_ajax_obj.ajax_url, {
            _ajax_nonce: my_ajax_obj.nonce,
            action: 'remove_record',
            record_id: recordID,
            widget_base: widgetBaseID,
            current_widget_id: currentWidgetID
        }, function (data) {
            /**
             * Removing deleted record element from DOM
             */
            // console.log(data);
            elementID = currentWidgetID + '-record-' + recordID;
            jQuery(`#${elementID}`).remove();
        })
    })
})


var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function (e) {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        e.preventDefault();
        this.classList.toggle("active");

        /* Toggle between hiding and showing the active panel */
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
