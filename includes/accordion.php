<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class FAQs_Display {
    private $displayed_faqs = array();

    public function __construct() {
        // Register shortcodes for displaying FAQs
        add_shortcode( 'faq_accordion_by_category', array( $this, 'display_faqs' ) );

        // Enqueue Font Awesome and custom scripts/styles
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_and_scripts' ) );
    }

    public function enqueue_styles_and_scripts() {
        // Enqueue Font Awesome
        wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css' );
        
    }
    public function display_faqs() {
        // Retrieve the stored options
        $options = get_option('faq_options');
    
        // Set defaults if options are not set
        $background_color = !empty($options['background_color']) ? $options['background_color'] : '#f9f9f9';
        $like_icon = !empty($options['like_icon']) ? $options['like_icon'] : 'default-like-icon-url.png'; // Provide a default URL
        $dislike_icon = !empty($options['dislike_icon']) ? $options['dislike_icon'] : 'default-dislike-icon-url.png'; // Provide a default URL
    
        $categories = get_terms(array(
            'taxonomy' => 'faq_category',
            'hide_empty' => true,
        ));
    
        $tags = get_terms(array(
            'taxonomy' => 'faq_tag', 
            'hide_empty' => true,
        ));
    
        if (empty($categories) && empty($tags)) {
            return '<p>No FAQ categories or tags found.</p>';
        }
    
        ob_start();
        echo '<div class="faq-main-content" style="background-color:' . esc_attr($background_color) . ';">'; // Apply background color
        echo '<div class="faq-content">';
    
        // Add search bar, search button, and background image
        echo '<div class="faq-image-container">';
        echo '<div class="faq-search-bar">';
        echo '<input type="text" id="faq-search-input" placeholder="Search FAQs...">';
        echo '<button id="faq-search-button">Search</button>';
        echo '</div>';
        echo '</div>';
    
        // Add clickable category tabs
        echo '<div class="faq-tabs">';
        echo '<ul class="faq-categories-tabs">';
        echo '<li class="faq-tab active" data-term="all">All Categories</li>'; // Default "All" tab
        foreach ($categories as $category) {
            echo '<li class="faq-tab" data-term="'. esc_attr($category->slug) .'">' . esc_html($category->name) . '</li>';
        }
        echo '</ul>';
        echo '</div>';
    
        // Add clickable tag tabs
        echo '<div class="faq-tags-tabs">';
        echo '<ul class="faq-tags-list">';
        echo '<li class="faq-tag-tab" data-tag="all">All Tags</li>'; // Default "All Tags" tab
        foreach ($tags as $tag) {
            echo '<li class="faq-tag-tab" data-tag="'. esc_attr($tag->slug) .'">' . esc_html($tag->name) . '</li>';
        }
        echo '</ul>';
        echo '</div>';
    
        echo '<div id="faq-accordion">'; // Container for FAQ items
    
        // Initial display of all FAQs
        foreach ($categories as $category) {
            $faq_query = new WP_Query(array(
                'post_type' => 'faq',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'faq_category',
                        'field'    => 'slug',
                        'terms'    => $category->slug,
                    ),
                ),
                'posts_per_page' => -1,
            ));
    
            if ($faq_query->have_posts()) {
                echo '<div class="faq-category-block" data-category="' . esc_attr($category->slug) . '">'; // Start category block
    
                while ($faq_query->have_posts()) {
                    $faq_query->the_post();
                    $question_id = get_the_ID();
                    if (in_array($question_id, $this->displayed_faqs)) {
                        continue; // Skip if already displayed
                    }
                    $this->displayed_faqs[] = $question_id; // Mark as displayed
                    $question = get_the_title();
                    $answer   = get_the_content();
    
                    // FAQ Item
                    echo '<div class="faq-item" data-question="'. esc_html($question) .'" data-answer="'. wp_strip_all_tags($answer) .'" data-tags="'. esc_html( implode( ',', wp_get_post_terms( $question_id, 'faq_tag', array( 'fields' => 'slugs' ) ) ) ) .'">';
                    echo '<div class="faq-question" data-faq-id="' . esc_attr($question_id) . '">';
                    echo '<span class="faq-toggle">+</span> <strong>' . esc_html($question) . '</strong>';
                    echo '</div>';
                    echo '<div class="faq-answer" style="display: none;">'; // Initially hidden
                    echo '<p><strong>ANS:</strong> ' . wp_strip_all_tags($answer) . '</p>';
    
                    // Display like/dislike buttons and counts
                    $likes = get_post_meta($question_id, 'likes', true);
                    $dislikes = get_post_meta($question_id, 'dislikes', true);
                    echo '<div class="faq-likes-dislikes">';
                    echo '<button class="like-button" data-faq-id="' . esc_attr($question_id) . '">';
                    echo '<img src="' . esc_url($like_icon) . '" alt="Like" /> Like (' . esc_html($likes) . ')</button>';
                    echo '<button class="dislike-button" data-faq-id="' . esc_attr($question_id) . '">';
                    echo '<img src="' . esc_url($dislike_icon) . '" alt="Dislike" /> Dislike (' . esc_html($dislikes) . ')</button>';
                    echo '</div>';
    
                    echo '</div>'; // Close .faq-answer
                    echo '</div>'; // Close .faq-item
                }
    
                echo '</div>'; // Close .faq-category-block
            }
    
            wp_reset_postdata();
        }
    
        echo '</div>'; // Close faq-accordion
    
        // Display the sidebar in the faq-sidebar div
        echo '<div class="faq-sidebar">';
        if (is_active_sidebar('faq-widget-area')) {
            dynamic_sidebar('faq-widget-area');
        } else {
            echo '<p>No widgets added yet.</p>';
        }
        echo '</div>'; // Close .faq-sidebar
    
        echo '</div>'; // Close faq-main-content 
    
        return ob_get_clean();
    }
    
}

// Instantiate the class to ensure shortcodes are registered
new FAQs_Display();
