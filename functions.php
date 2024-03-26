<?php
$template_directory =  get_template_directory();
require_once($template_directory . '/custom-post-types/cpt-course.php');
require_once($template_directory . '/custom-post-types/cpt-lesson.php');
require_once($template_directory . '/endpoints/get_course.php');
require_once($template_directory . '/custom-taxonomies/codigo-limpo-taxonomy.php');
require_once($template_directory . '/plugin-overwrite/wc_login.php');
require_once($template_directory . '/plugin-overwrite/wc_myaccount.php');
require_once($template_directory . '/plugin-overwrite/wc_edit-account.php');

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
    wp_enqueue_script('course-js', get_template_directory_uri() . '/course/index.js', [], '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'bookinvideo_enqueue_react_css');

function bookinvideo_enqueue_react_css() {
    wp_register_style('course-css', get_template_directory_uri() . '/course/index.css');
    wp_enqueue_style('course-css');
}
?>