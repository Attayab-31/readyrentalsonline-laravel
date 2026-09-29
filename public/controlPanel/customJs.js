$(document).ready(function() {
    $('#formSubmitBTN').on('click', function() {
        var $button = $(this);
        // Change the text to indicate processing
        $button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');
        // Disable the button and allow form to submit normally
        setTimeout(function() {
            $button.prop('disabled', true);
        }, 10);
    });
});
 
