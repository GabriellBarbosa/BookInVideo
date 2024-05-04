<?php
add_filter('woocommerce_add_to_cart_validation', 'blockAddMoreThanOneProduct', 10, 5);
function blockAddMoreThanOneProduct($passed, $product_id, $quantity, $variation_id = '', $variations= '') {
    WC()->cart->empty_cart();
    if ( WC()->cart->get_cart_contents_count() > 0 ) {
        $passed = false;
        wc_add_notice('Quantidade não permitida', 'error');
    }
    return $passed;
}

add_filter('woocommerce_add_to_cart_redirect', 'redirectToCheckout');
function redirectToCheckout() {
    return wc_get_checkout_url();
}
?>