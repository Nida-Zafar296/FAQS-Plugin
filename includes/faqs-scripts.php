<?php
function faqs_management_enqueue_scripts() {
    wp_enqueue_script('jquery');

    // Enqueue CSS files
    wp_enqueue_style('faq-accordion-css', plugins_url('../assets/css/accordion.css', __FILE__));
    wp_enqueue_style('faq-search-css', plugins_url('../assets/css/search.css', __FILE__));
    wp_enqueue_style('faq-likes-dislikes-css', plugins_url('../assets/css/likes-dislikes.css', __FILE__));
    wp_enqueue_style('faq-widget-css', plugins_url('../assets/css/widget.css', __FILE__));

    // Enqueue JS files
    wp_enqueue_script('faq-accordion', plugins_url('../assets/js/faq-accordion.js', __FILE__), array('jquery'), null, true);
    wp_enqueue_script('faq-search', plugins_url('../assets/js/faq-search.js', __FILE__), array('jquery'), null, true); 
    wp_enqueue_script('faq-likes-dislikes', plugins_url('../assets/js/faq-likes-dislikes.js', __FILE__), array('jquery'), null, true);

    // Localize the ajaxurl for the faq-likes-dislikes.js
    wp_localize_script('faq-likes-dislikes', 'faqLikesDislikes', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}
?>
