<?php
$template_directory =  get_template_directory();

require_once($template_directory . '/src/User/User.php');
require_once($template_directory . '/src/User/UserImpl.php');
require_once($template_directory . '/src/User/UserRepository.php');
require_once($template_directory . '/src/User/UserRepositoryImpl.php');

require_once($template_directory . '/src/Course/CourseRepository.php');
require_once($template_directory . '/src/Course/CourseRespositoryImpl.php');

require_once($template_directory . '/src/Lesson/Lesson.php');
require_once($template_directory . '/src/Lesson/LessonFree.php');
require_once($template_directory . '/src/Lesson/LessonForSubscribed.php');
require_once($template_directory . '/src/Lesson/LessonForUnsubscribed.php');

require_once($template_directory . '/api/get_course_content.php');
require_once($template_directory . '/api/get_user.php');
require_once($template_directory . '/api/get_lesson.php');
require_once($template_directory . '/api/complete_lesson.php');

require_once($template_directory . '/custom-post-types/cpt-course.php');
require_once($template_directory . '/custom-post-types/cpt-lesson.php');
require_once($template_directory . '/custom-db-tables/completedLessons.php');
require_once($template_directory . '/custom-db-tables/conclusionCertificates.php');
require_once($template_directory . '/custom-taxonomies/codigo-limpo-taxonomy.php');

require_once($template_directory . '/plugin-overwrite/wc_login.php');
require_once($template_directory . '/plugin-overwrite/wc_myaccount.php');
require_once($template_directory . '/plugin-overwrite/wc_edit-account.php');
require_once($template_directory . '/plugin-overwrite/wc_cart.php');
require_once($template_directory . '/plugin-overwrite/wc_checkout-account-creation.php');
require_once($template_directory . '/plugin-overwrite/wc_checkout.php');
require_once($template_directory . '/plugin-overwrite/wc_address.php');
require_once($template_directory . '/plugin-overwrite/wc_order-status.php');
require_once($template_directory . '/plugin-overwrite/wc_order-details.php');

require_once($template_directory . '/utils/Certificate.php');
require_once($template_directory . '/utils/Course.php');

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
    wp_register_style('bookinvideo-style', get_template_directory_uri() . '/style.css', [], '7.6');
    wp_enqueue_style('bookinvideo-style');
}

add_action('wp_enqueue_scripts', 'bookinvideo_register_js');

function bookinvideo_register_js() {
    wp_enqueue_script('bookinvideo-theme-js', get_template_directory_uri() . '/assets/js/index.js', [], '1.8');
}

add_action('wp_enqueue_scripts', 'bookinvideo_enqueue_react_js');

function bookinvideo_enqueue_react_js() {
    wp_enqueue_script('course-js', get_template_directory_uri() . '/react-app/index.js', [], '4.0');
    $wcProduct = new WC_Product(getCourseProductPostID());
    wp_localize_script('course-js', 'wp_data',  array(
        'product' => get_permalink(getCourseProductPostID()),
        'course' => $wcProduct->get_id(),
        'nonce' => wp_create_nonce('wp_rest')
    ));
}

add_action('wp_enqueue_scripts', 'bookinvideo_enqueue_react_css');

function bookinvideo_enqueue_react_css() {
    wp_register_style('course-css', get_template_directory_uri() . '/react-app/index.css', [], '2.3');
    wp_enqueue_style('course-css');
}

add_action('init', 'custom_certificate_route');

function custom_certificate_route() {
    add_rewrite_rule(
        '^certificate/([A-Za-z0-9]+)/?$',
        'index.php?pagename=certificate&certificate_id=$matches[1]',
        'top'
    );
}

add_filter('query_vars', 'add_certificate_id_to_query_vars');

function add_certificate_id_to_query_vars($query_vars) {
    $query_vars[] = 'certificate_id';
    return $query_vars;
}

function getCourseLink() {
    return '/curso/codigo-limpo/0101-configuracao';
}

function displayPricingCard($displayAssignButton = true) { 
    $product = getCourseProductData(); ?>
    <div class="pricing_card"> 
        <div class="price_info_wrapper">
            <div class="price">
                <span>It's free</span>
                <p><?= $product['name']; ?></p>
            </div>
            <div class="pricing_card_info"><?= $product['description']; ?></div>
        </div>
        <?php if ($displayAssignButton) { ?>
        <div class="redirect">
            <?= displaySubscribeButton('Bora!', 'subscribe_btn'); ?>
        </div>
        <?php } ?>
    </div>
<?php }

function displaySubscribeButton(string $text, string $className) { 
    $courseProduct = getCourseProductData(); ?>
    <form action="<?= get_permalink(getCourseProductPostID()) ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="quantity" value="1" inputmode="numeric" autocomplete="off">
        <button class="<?= $className ?>" type="submit" name="add-to-cart" value="<?= $courseProduct['id'] ?>">
            <?= $text ?>
        </button>
    </form>
<?php }

function getCourseProductData() {
    $product = new WC_Product(getCourseProductPostID());
    return array(
        'id' => $product->get_id(),
        'name' => $product->get_name(),
        'price' => $product->get_price(),
        'description' => $product->get_description(),
        'link' => $product->get_permalink(),
    );
}

function getCourseProductPostID() {
    $course = get_page_by_path('codigo-limpo', OBJECT, 'product');
    return $course->ID;
}
?>