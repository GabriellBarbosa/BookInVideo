<?php
add_filter('woocommerce_add_to_cart_validation', 'emptyCartBeforeAdd', 10, 5);
function emptyCartBeforeAdd($passed, $product_id, $quantity, $variation_id = '', $variations= '') {
    if ( ! WC()->cart->is_empty() )
        WC()->cart->empty_cart();
    return $passed;
}

add_filter('woocommerce_add_to_cart_redirect', 'redirectToCheckout');
function redirectToCheckout() {
    return wc_get_checkout_url();
}
?>