<?php
// Enqueue scripts and styles for the block editor
function faqs_management_enqueue_block_editor_assets() {
    wp_enqueue_script(
        'my-plugin-faq-block', 
        plugin_dir_url(__FILE__) . '../assets/js/block.js', 
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components'), // Dependencies
        filemtime(plugin_dir_path(__FILE__) . '../assets/js/block.js') // whenever the file is updated, browsers will fetch the new version instead of using a cached one.
    );
}

// Hook to enqueue the block editor assets
add_action('enqueue_block_editor_assets', 'faqs_management_enqueue_block_editor_assets');
