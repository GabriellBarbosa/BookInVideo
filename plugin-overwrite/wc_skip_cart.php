<?php
add_filter('woocommerce_add_to_cart_redirect', 'redirectToCheckout');

function redirectToCheckout() {
    return wc_get_checkout_url();
}
?>