<?php
/**
 * Plugin Name: Markhub Woo Addon
 * Plugin URI: https://yourwebsite.com
 * Description: Custom WooCommerce cart page design.
 * Version: 1.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 */
function markhub_woo_addon_scripts() {
    wp_enqueue_style('markhub-woo-addon-style', plugins_url('style.css', __FILE__));
    wp_enqueue_script('markhub-woo-addon-script', plugins_url('script.js', __FILE__), array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'markhub_woo_addon_scripts');
function markhub_override_cart_template($template, $template_name, $template_path) {
    if ('cart/cart.php' == $template_name) {
        $template = plugin_dir_path(__FILE__) . 'templates/custom-cart.php';
    }
    return $template;
}
add_filter('woocommerce_locate_template', 'markhub_override_cart_template', 10, 3);
