<?php
add_filter('woocommerce_create_account_default_checked', '__return_true');

add_filter('woocommerce_before_checkout_process', 'forceAccountCreation');
function forceAccountCreation() {
    $_POST['createaccount'] = 1;
}
?>