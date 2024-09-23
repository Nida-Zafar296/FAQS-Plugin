<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly to prevent unauthorized access.
}

/**
 * Class to handle the registration of the custom post type and taxonomies for FAQs.
 */
class FAQs_Management {

    public function __construct() {
        add_action( 'init', array( $this, 'register_post_type' ) );
        add_action( 'init', array( $this, 'register_taxonomies' ) );
    }

    /**
     * Registers the custom post type 'faq'.
     * Defines the settings and arguments for the custom post type.
     */
    public function register_post_type() {
        $args = array(
            'public'    => true,
            'label'     => 'FAQs',
            'supports'  => array( 'title', 'editor' ),
            'menu_icon' => 'dashicons-format-chat',
            'has_archive' => true,
            'rewrite' => array( 'slug' => 'faqs' ),
        );
        // Register the custom post type with WordPress
        register_post_type( 'faq', $args );
    }

    /**
     * Registers custom taxonomies for FAQs.
     */
    public function register_taxonomies() {
        // Register FAQ Categories
        $category_args = array(
            'hierarchical' => true,
            'labels'       => array(
                'name'          => 'FAQ Categories',
                'singular_name' => 'FAQ Category',
            ),
            'public'       => true, // Make it visible on the front end
            'show_ui'      => true, // Show it in the admin UI
            'show_admin_column' => true, // Show in the admin columns
            'query_var'    => true, // Allow it to be queried
            'rewrite'      => array( 'slug' => 'faq-category' ), // Custom slug for permalinks
        );
        // Register the taxonomy 'faq_category' for the post type 'faq'
        register_taxonomy( 'faq_category', 'faq', $category_args );

        // Register FAQ Tags (non-hierarchical taxonomy)
        $tag_args = array(
            'hierarchical' => false,
            'labels'       => array(
                'name'          => 'FAQ Tags', // Plural name
                'singular_name' => 'FAQ Tag',
            ),
            'public'       => true,
            'show_ui'      => true,
            'show_admin_column' => true,
            'query_var'    => true,
            'rewrite'      => array( 'slug' => 'faq-tag' ),
        );
        // Register the taxonomy 'faq_tag' for the post type 'faq'
        register_taxonomy( 'faq_tag', 'faq', $tag_args );
    }
}

// Instantiate the class to ensure the post type and taxonomies are registered.
new FAQs_Management();