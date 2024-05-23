<?php
add_filter('woocommerce_create_account_default_checked', function($checked) {
    return true;
});

add_filter('woocommerce_before_checkout_process', 'bookinvideo_forceAccountCreation');
function bookinvideo_forceAccountCreation() {
    $_POST['createaccount'] = 1;
}
?>