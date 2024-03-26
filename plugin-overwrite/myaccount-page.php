<?php
add_filter('woocommerce_account_menu_items', 'removeDownloadTab');
function removeDownloadTab($items) {
    unset($items['downloads']);
    return $items;
}

add_filter( 'woocommerce_account_menu_items', 'renameMenuItems', 22, 1 );
function renameMenuItems( $items ) {
    $items['edit-account'] = __("Conta", "woocommerce");
    $items['customer-logout'] = __("Sair", "woocommerce");
    return $items;
}
?>