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

// Create the FAQ Widget Class
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
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        // Query to fetch recent FAQs
        $faq_args = array(
            'post_type' => 'faq',
            'posts_per_page' => 5, // Adjust the number as needed
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

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Recent FAQs', 'faq-widget-plugin');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'faq-widget-plugin'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        return $instance;
    }
}

// Register the FAQ Widget
function register_faq_widget() {
    register_widget('FAQ_Widget');
}
add_action('widgets_init', 'register_faq_widget');
