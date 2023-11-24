jQuery(document).ready(function ($) {
    $('#event-submission-form').on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append('action', 'submit_event'); // Include the action in the formData

        jQuery.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status === 'success') {
                    $('#response-message').html('<p class="success">' + response.message + '</p>');
                    $('#event-submission-form')[0].reset();
                } else {
                    $('#response-message').html('<p class="error">' + response.message + '</p>');
                }
            },
            error: function () {
                $('#response-message').html('<p>Server error. Please try again later.</p>');
            },
        });
    });
});

