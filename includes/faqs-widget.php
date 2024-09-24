<?php
// Register the FAQ Widget Area
function faq_widget_init() {
    register_sidebar(array(
        'name'          => __('FAQ Widget Area', 'faq-widget-plugin'),
        'id'            => 'faq-widget-area',
        'before_widget' => '<div class="faq-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'faq_widget_init');

class FAQ_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'faq_widget',
            __('FAQ Widget', 'faq-widget-plugin'),
            array('description' => __('Displays recent FAQs', 'faq-widget-plugin'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo $args['before_title'] . __('Recent FAQs', 'faq-widget-plugin') . $args['after_title'];

        // Query to fetch recent FAQs
        $faq_args = array(
            'post_type' => 'faq',
            'posts_per_page' => 2, // Show top 2 FAQs
            'orderby' => 'date',
            'order' => 'DESC'
        );

        $faqs = new WP_Query($faq_args);

        if ($faqs->have_posts()) {
            echo '<ul class="faq-list">';
            while ($faqs->have_posts()) {
                $faqs->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
        } else {
            echo '<p>' . __('No FAQs found.', 'faq-widget-plugin') . '</p>';
        }

        wp_reset_postdata();
        echo $args['after_widget'];
    }
}

function register_faq_widget() {
    register_widget('FAQ_Widget');
}
add_action('widgets_init', 'register_faq_widget');

?>
