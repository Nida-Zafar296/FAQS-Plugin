jQuery(document).ready(function($) {
    $('.faq-tab').click(function() {
        var selectedCategory = $(this).data('term');
        
        if (selectedCategory === 'all') {
            $('.faq-category-block').show();
        } else {
            $('.faq-category-block').hide();
            $('.faq-category-block[data-category="' + selectedCategory + '"]').show();
        }

        $('.faq-tab').removeClass('active');
        $(this).addClass('active');
    });

    // Handle tag tab clicks
    $('.faq-tag-tab').click(function() {
        var selectedTag = $(this).data('tag');

        // Show or hide FAQs based on the selected tag
        if (selectedTag === 'all') {
            $('.faq-item').show();
        } else {
            $('.faq-item').hide();
            $('.faq-item[data-tags*="' + selectedTag + '"]').show();
        }

        // Mark the selected tag as active
        $('.faq-tag-tab').removeClass('active');
        $(this).addClass('active');
    });
});
