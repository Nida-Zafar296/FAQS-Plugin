<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class FAQs_Display {
    private $displayed_faqs = array();

    public function __construct() {
        // Register shortcodes for displaying FAQs
        add_shortcode( 'faq_accordion_by_category', array( $this, 'display_faqs_by_category' ) );
    }
    
    public function display_faqs_by_category() {
        $categories = get_terms(array(
            'taxonomy' => 'faq_category',
            'hide_empty' => true,
        ));

        if (empty($categories)) {
            return '<p>No FAQ categories found.</p>';
        }

        ob_start();

    
        // Add search bar,search button and bg image
        echo '<div class="faq-image-container">';
        echo '<div class="faq-search-bar">';
        echo '<input type="text" id="faq-search-input" placeholder="Search FAQs...">';
        echo '<button id="faq-search-button">Search</button>';
        echo '</div>';
        echo '</div>';

        // Loop through each category
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
                echo '<div class="faq-category-block">'; // Start category block

                // Display FAQs, with category information first
                echo '<div class="faq-items">';

                while ($faq_query->have_posts()) {
                    $faq_query->the_post();
                    $question_id = get_the_ID();
                    if (in_array($question_id, $this->displayed_faqs)) {
                        continue; // Skip if already displayed
                    }
                    $this->displayed_faqs[] = $question_id; // Mark as displayed
                    $question = get_the_title();
                    $answer   = get_the_content();

                    // Get categories for the current FAQ item
                    $faq_categories = get_the_terms($question_id, 'faq_category');
                    $categories_list = '';

                    if ($faq_categories && !is_wp_error($faq_categories)) {
                        $categories_list = '<div class="faq-categories"><strong>Category:</strong> ';
                        $categories_list .= implode(', ', wp_list_pluck($faq_categories, 'name'));
                        $categories_list .= '</div>';
                    }

                    // Get tags for the current FAQ item
                    $tags = get_the_terms($question_id, 'faq_tag');
                    $tags_list = '';

                    if ($tags && !is_wp_error($tags)) {
                        $tags_list = '<div class="faq-tags"><strong>Tags:</strong> ';
                        $tags_list .= implode(', ', wp_list_pluck($tags, 'name'));
                        $tags_list .= '</div>';
                    }

                    echo '<div class="faq-item" data-question="'. esc_html($question) .'" data-answer="'. wp_strip_all_tags($answer) .'">';
                    echo '<div class="faq-question" data-faq-id="' . esc_attr($question_id) . '">';
                    echo '<span class="faq-toggle">+</span> <strong>' . esc_html($question) . '</strong>';
                    echo '</div>';
                    echo '<div class="faq-answer" style="display: none;">'; // Initially hidden
                    echo '<p><strong>ANS:</strong> ' . wp_strip_all_tags($answer) . '</p>';
                    echo $categories_list; // Display categories inside the block
                    echo $tags_list; // Display tags inside the block

                    // Display like/dislike buttons and counts
                    $likes = get_post_meta($question_id, 'likes', true);
                    $dislikes = get_post_meta($question_id, 'dislikes', true);
                    echo '<div class="faq-likes-dislikes">';
                    echo '<button class="like-button" data-faq-id="' . esc_attr($question_id) . '">Like (' . esc_html($likes) . ')</button>';
                    echo '<button class="dislike-button" data-faq-id="' . esc_attr($question_id) . '">Dislike (' . esc_html($dislikes) . ')</button>';
                    echo '</div>';

                    echo '</div>'; // Close .faq-answer
                    echo '</div>'; // Close .faq-item
                }

                echo '</div>'; // Close .faq-items
                echo '</div>'; // Close .faq-category-block
            } else {
                echo '<div class="faq-category-block">';
                echo '<p>No FAQs found in this category.</p>';
                echo '</div>';
            }

            wp_reset_postdata();
        }

        return ob_get_clean();
    }
}

// Instantiate the class to ensure shortcodes are registered
new FAQs_Display();