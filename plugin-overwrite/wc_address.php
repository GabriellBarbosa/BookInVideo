<?php 
add_filter('woocommerce_billing_fields', 'bookinvideo_removeBillingAddress2Field', 20, 1);
function bookinvideo_removeBillingAddress2Field($fields) {
    if (is_account_page()) 
        unset($fields['billing_address_2']);
    return $fields;
}

add_filter('woocommerce_billing_fields', 'bookinvideo_changeNeighbornhoodFieldToRequired', 20, 1);
function bookinvideo_changeNeighbornhoodFieldToRequired($fields) {
    if (is_account_page())
        $fields['billing_neighborhood']['required'] = 1;
    return $fields;
}
?>