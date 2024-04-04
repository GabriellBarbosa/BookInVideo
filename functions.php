<?php
$template_directory =  get_template_directory();
require_once($template_directory . '/domain/SubscribedUser.php');
require_once($template_directory . '/custom-post-types/cpt-course.php');
require_once($template_directory . '/custom-post-types/cpt-lesson.php');
require_once($template_directory . '/api/get_course.php');
require_once($template_directory . '/api/get_user.php');
require_once($template_directory . '/custom-taxonomies/codigo-limpo-taxonomy.php');
require_once($template_directory . '/plugin-overwrite/wc_login.php');
require_once($template_directory . '/plugin-overwrite/wc_myaccount.php');
require_once($template_directory . '/plugin-overwrite/wc_edit-account.php');
require_once($template_directory . '/plugin-overwrite/wc_cart_validation.php');
require_once($template_directory . '/plugin-overwrite/wc_skip_cart.php');

add_filter('wc_add_to_cart_message', '__return_false', 10, 2);

add_action('after_setup_theme', 'bookinvideo_add_woocommerce_support');

function bookinvideo_add_woocommerce_support() {
    add_theme_support('woocommerce');
}

add_action('init', 'bookinvideo_fix_react_routing');

function bookinvideo_fix_react_routing() {
    add_rewrite_rule('^(curso|slide)/(.+)?', 'index.php?pagename=curso', 'top');
}

add_action('wp_enqueue_scripts', 'bookinvideo_register_css');

function bookinvideo_register_css() {
    wp_register_style('bookinvideo-style', get_template_directory_uri() . '/style.css', [], '1.0.0');
    wp_enqueue_style('bookinvideo-style');
}

add_action('wp_enqueue_scripts', 'bookinvideo_enqueue_react_js');

function bookinvideo_enqueue_react_js() {
    wp_enqueue_script('course-js', get_template_directory_uri() . '/course-page-in-react/index.js', [], '1.0.2', true);
    $productPost = get_page_by_path('codigo-limpo', OBJECT, 'product');
    $wcProduct = new WC_Product($productPost->ID);
    wp_localize_script('course-js', 'wp_data',  array(
        'course' => $wcProduct->get_id(),
        'nonce' => wp_create_nonce('wp_rest')
    ));
}

add_action('wp_enqueue_scripts', 'bookinvideo_enqueue_react_css');

function bookinvideo_enqueue_react_css() {
    wp_register_style('course-css', get_template_directory_uri() . '/course-page-in-react/index.css');
    wp_enqueue_style('course-css');
}

function getCourseProductInfo() {
    $product = getCourseProduct();
    return array(
        'id' => $product->get_id(),
        'name' => $product->get_name(),
        'price' => $product->get_price(),
        'description' => $product->get_description(),
        'link' => $product->get_permalink(),
    );
}

function getCourseProduct() {
    $productPost = get_page_by_path('codigo-limpo', OBJECT, 'product');
    return new WC_Product($productPost->ID);
}
?>