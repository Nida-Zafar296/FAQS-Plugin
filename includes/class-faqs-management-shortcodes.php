<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Class to handle FAQ search functionality.
 */
class FAQs_DIsplay {

    public function __construct() {
        // Register the shortcode for displaying FAQs with search
        add_shortcode( 'faq_accordion_search', array( $this, 'display_faq_search' ) );
    }

    public function display_faq_search() {
        ob_start();

        // Search form
        echo '<form method="GET" class="faq-search-form">
                <input type="text" name="faq_search" placeholder="Search FAQs..." />
                <input type="submit" value="Search" />
              </form>';

        // Handle search term
        $search_term = isset($_GET['faq_search']) ? sanitize_text_field($_GET['faq_search']) : '';
        $faq_query = new WP_Query(array(
            'post_type' => 'faq',
            'posts_per_page' => -1,
            's' => $search_term,
        ));

        if ($faq_query->have_posts()) {
            echo '<div class="faq-items">';
            while ($faq_query->have_posts()) {
                $faq_query->the_post();
                $question_id = get_the_ID();
                $question = get_the_title();
                $answer   = get_the_content();

                echo '<div class="faq-item">';
                echo '<div class="faq-question" data-faq-id="' . esc_attr($question_id) . '">';
                echo '<span class="faq-toggle">+</span> <strong>' . esc_html($question) . '</strong>';
                echo '</div>';
                echo '<div class="faq-answer" style="display: none;">';
                echo '<p><strong>ANS:</strong> ' . wp_strip_all_tags($answer) . '</p>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p>No FAQs found matching your search.</p>';
        }

        wp_reset_postdata();

        return ob_get_clean();
    }
}

// Instantiate the class
new FAQs_DIsplay();
