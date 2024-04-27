<?php
$template_directory =  get_template_directory();

require_once($template_directory . '/src/SubscribedUser.php');
require_once($template_directory . '/src/interfaces/CourseRepository.php');
require_once($template_directory . '/src/interfaces/UserRepository.php');

require_once($template_directory . '/src/repositories/CourseRespositoryImpl.php');
require_once($template_directory . '/src/repositories/UserRepositoryImpl.php');

require_once($template_directory . '/api/get_course.php');
require_once($template_directory . '/api/get_user.php');
require_once($template_directory . '/api/get_lesson.php');
require_once($template_directory . '/api/complete_lesson.php');

require_once($template_directory . '/custom-post-types/cpt-course.php');
require_once($template_directory . '/custom-post-types/cpt-lesson.php');
require_once($template_directory . '/custom-db-tables/completedLessons.php');

require_once($template_directory . '/custom-taxonomies/codigo-limpo-taxonomy.php');
require_once($template_directory . '/plugin-overwrite/wc_login.php');
require_once($template_directory . '/plugin-overwrite/wc_myaccount.php');
require_once($template_directory . '/plugin-overwrite/wc_edit-account.php');
require_once($template_directory . '/plugin-overwrite/wc_cart_validation.php');
require_once($template_directory . '/plugin-overwrite/wc_skip_cart.php');
require_once($template_directory . '/plugin-overwrite/wc_checkout.php');
require_once($template_directory . '/plugin-overwrite/wc_address.php');
require_once($template_directory . '/plugin-overwrite/wc_order-status.php');

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
    wp_register_style('bookinvideo-style', get_template_directory_uri() . '/style.css', [], '2.4');
    wp_enqueue_style('bookinvideo-style');
}

add_action('wp_enqueue_scripts', 'bookinvideo_enqueue_react_js');

function bookinvideo_enqueue_react_js() {
    wp_enqueue_script('course-js', get_template_directory_uri() . '/react-app/index.js', [], '1.2.0', true);
    $wcProduct = new WC_Product(getCourseProductPostID());
    wp_localize_script('course-js', 'wp_data',  array(
        'product' => get_permalink(getCourseProductPostID()),
        'course' => $wcProduct->get_id(),
        'nonce' => wp_create_nonce('wp_rest')
    ));
}

add_action('wp_enqueue_scripts', 'bookinvideo_enqueue_react_css');

function bookinvideo_enqueue_react_css() {
    wp_register_style('course-css', get_template_directory_uri() . '/react-app/index.css', [], '1.0.1');
    wp_enqueue_style('course-css');
}

function displayPricingCard($displayAssignButton = true) { 
    $product = getCourseProductData(); ?>
    <div class="pricing_card"> 
        <div class="price_info_wrapper">
            <div class="price">
                <p><?= $product['name']; ?></p>
                <span>R$ <?= $product['price']; ?></span>
            </div>
            <div class="pricing_card_info"><?= $product['description']; ?></div>
        </div>
        <?php if ($displayAssignButton) { ?>
        <div class="redirect">
            <?= displaySubscribeButton('Assinar', 'subscribe_btn'); ?>
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