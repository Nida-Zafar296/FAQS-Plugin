<?php
/**
 * plugin name: FAQs Management
 * plugin url: http://example.com//FAQs-Management-plugin
 * Description: The plugin will allow users to create and manage a FAQs section for their website. Itshould provide features to categorize the questions, add tags, and facilitate easy navigation.
 * version: 1.0
 * Author: Nida 
 * Author URL: http://example.com
 * License: GPL2
 */
 
 if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

require_once plugin_dir_path( __FILE__ ) . 'includes/class-faqs-management.php'; 
require_once plugin_dir_path( __FILE__ ) . 'includes/class-faqs-management-shortcodes.php'; 


//plugin activation hook
function faqs_management_activat(){
    //Add functionality to run on plugin activation.
}
register_activation_hook(__FILE__,'faqs_management_activat');

//plugin deactivation hook
function faqs_management_deactivation(){
    //Add functionality to run on plugin deactivation.
}
register_deactivation_hook(__FILE__,'faqs_management_deactivation');

function faqs_management_enqueue_scripts() {

    // Custom CSS for the FAQ accordion
    wp_enqueue_script( 'jquery' ); // Ensure jQuery is loaded
    wp_enqueue_style( 'faq-accordion-css', plugins_url( 'assets/css/faq-styles.css', __FILE__ ) );
    wp_enqueue_script( 'faq-accordion', plugins_url( 'assets\js\faq-accordion.js', __FILE__ ), array( 'jquery' ), null, true );

}
add_action( 'wp_enqueue_scripts', 'faqs_management_enqueue_scripts' );
