<?php
add_filter('woocommerce_account_menu_items', 'bookinvideo_removeDownloadTab');
function bookinvideo_removeDownloadTab($items) {
    unset($items['downloads']);
    return $items;
}

add_filter( 'woocommerce_account_menu_items', 'bookinvideo_renameMenuItems', 22, 1 );
function bookinvideo_renameMenuItems( $items ) {
    $items['edit-account'] = __("Conta", "woocommerce");
    $items['customer-logout'] = __("Sair", "woocommerce");
    return $items;
}
?>