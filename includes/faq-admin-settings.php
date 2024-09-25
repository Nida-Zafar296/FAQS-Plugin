<?php
// Hook to add the settings page to the admin menu
add_action('admin_menu', 'faq_plugin_add_settings_page');

function faq_plugin_add_settings_page() {
    add_options_page(
        'FAQ Settings',
        'FAQ Settings',
        'manage_options',
        'faq-settings',
        'faq_plugin_render_settings_page'
    );
}

// Render the settings page
function faq_plugin_render_settings_page() {
    ?>
    <div class="wrap">
        <h1>FAQ Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('faq_options_group');
            do_settings_sections('faq-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Hook to initialize settings
add_action('admin_init', 'faq_plugin_settings_init');

function faq_plugin_settings_init() {
    register_setting('faq_options_group', 'faq_options');

    // Add setting for background color
    add_settings_section(
        'faq_customization_section',
        'Customization Settings',
        null,
        'faq-settings'
    );

    add_settings_field(
        'faq_background_color',
        'FAQ Background Color',
        'faq_background_color_render',
        'faq-settings',
        'faq_customization_section'
    );

    // Add setting for like/dislike icons
    add_settings_field(
        'faq_like_icon',
        'Like Icon URL',
        'faq_like_icon_render',
        'faq-settings',
        'faq_customization_section'
    );

    add_settings_field(
        'faq_dislike_icon',
        'Dislike Icon URL',
        'faq_dislike_icon_render',
        'faq-settings',
        'faq_customization_section'
    );
}

// Render the background color input
function faq_background_color_render() {
    $options = get_option('faq_options');
    ?>
    <input type="text" name="faq_options[background_color]" value="<?php echo esc_attr($options['background_color'] ?? ''); ?>" class="color-picker" />
    <?php
}

// Render the like icon input
function faq_like_icon_render() {
    $options = get_option('faq_options');
    ?>
    <input type="text" name="faq_options[like_icon]" value="<?php echo esc_attr($options['like_icon'] ?? ''); ?>" />
    <?php
}

// Render the dislike icon input
function faq_dislike_icon_render() {
    $options = get_option('faq_options');
    ?>
    <input type="text" name="faq_options[dislike_icon]" value="<?php echo esc_attr($options['dislike_icon'] ?? ''); ?>" />
    <?php
}
