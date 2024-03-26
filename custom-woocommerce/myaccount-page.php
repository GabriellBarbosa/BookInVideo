<?php
add_filter('woocommerce_account_menu_items', 'bookinvideo_remove_my_account_tabs');
function bookinvideo_remove_my_account_tabs($items) {
    unset($items['downloads']);
    return $items;
}

add_filter( 'woocommerce_account_menu_items', 'custom_my_account_menu_items', 22, 1 );
function custom_my_account_menu_items( $items ) {
    $items['edit-account'] = __("Conta", "woocommerce");
    $items['customer-logout'] = __("Sair", "woocommerce");
    return $items;
}
?>