<?php
add_filter('woocommerce_add_cart_item_data', 'bookinvideo_emptyCartBeforeAdd');
function bookinvideo_emptyCartBeforeAdd($cartItemData) {
    WC()->cart->empty_cart();
    return $cartItemData;
}

add_filter('wc_add_to_cart_message_html', '__return_false', 10, 2);
?>