<?php
add_filter('woocommerce_create_account_default_checked', function($checked) {
    return true;
});

add_filter('woocommerce_before_checkout_process', 'forceAccountCreation');
function forceAccountCreation() {
    $_POST['createaccount'] = 1;
}
?>