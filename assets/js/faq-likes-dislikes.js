jQuery(document).ready(function($) {
    $('.like-button, .dislike-button').on('click', function() {
        var button = $(this);
        var faqID = button.data('faq-id');
        var action = button.hasClass('like-button') ? 'like' : 'dislike';

        $.ajax({
            url: faqLikesDislikes.ajaxurl, // Use the localized ajaxurl
            type: 'POST',
            data: {
                action: 'faq_like_dislike',
                faq_id: faqID,
                like_dislike: action
            },
            success: function(response) {
                if (response.success) {
                    // Update like/dislike counts on success
                    button.text(action.charAt(0).toUpperCase() + action.slice(1) + ' (' + response.new_count + ')');

                    // Toggle the active class for styling
                    if (action === 'like') {
                        button.addClass('active');
                        button.siblings('.dislike-button').removeClass('active');
                    } else {
                        button.addClass('active');
                        button.siblings('.like-button').removeClass('active');
                    }
                }
            }
        });
    });
});
