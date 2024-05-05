<?php
add_filter('woocommerce_add_cart_item_data', 'emptyCartBeforeAdd', 10,  3);
function emptyCartBeforeAdd($cartItemData, $productID, $variationID) {
    global $woocommerce;
    $woocommerce->cart->empty_cart();
    return $cartItemData;
}

add_filter('woocommerce_add_to_cart_redirect', 'redirectToCheckout');
function redirectToCheckout() {
    return wc_get_checkout_url();
}
?>