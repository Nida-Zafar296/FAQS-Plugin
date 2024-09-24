<?php
function handle_faq_like_dislike() {
    // Check the request and nonce validation here if necessary

    $faq_id = intval($_POST['faq_id']);
    $like_dislike = sanitize_text_field($_POST['like_dislike']);

    if ($faq_id && in_array($like_dislike, ['like', 'dislike'])) {
        $meta_key = ($like_dislike === 'like') ? 'likes' : 'dislikes';
        $count = get_post_meta($faq_id, $meta_key, true);
        $new_count = ($count) ? $count + 1 : 1;

        // Update the post meta with the new like/dislike count
        update_post_meta($faq_id, $meta_key, $new_count);

        // Send the new count back in the response
        wp_send_json_success(array('new_count' => $new_count));
    } else {
        wp_send_json_error();
    }
}
add_action('wp_ajax_faq_like_dislike', 'handle_faq_like_dislike');
add_action('wp_ajax_nopriv_faq_like_dislike', 'handle_faq_like_dislike');
