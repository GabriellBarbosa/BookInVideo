<?php
add_filter('woocommerce_create_account_default_checked', '__return_true');
add_filter('woocommerce_enable_order_notes_field', '__return_false');

add_filter('woocommerce_checkout_fields', 'removeNotRequiredCheckoutFields');
function removeNotRequiredCheckoutFields($fields) {
    unset($fields['billing']['billing_address_2']);
    return $fields;
}

add_filter('woocommerce_checkout_fields', 'changeSomeFieldsToRequired');
function changeSomeFieldsToRequired($fields) {
    $fields['billing']['billing_neighborhood']['required'] = 1;
    $fields['billing']['billing_phone']['required'] = 1;
    return $fields;
}

add_filter('woocommerce_checkout_fields', 'changeFieldsPriority');
function changeFieldsPriority($fields) {
    $fields['billing']['billing_email']['priority'] = 21;
    $fields['billing']['billing_phone']['priority'] = 27;
    return $fields;
}

add_filter('gettext', 'changeBillingDetailsTitle', 20, 3);
function changeBillingDetailsTitle($translated_text, $text, $domain) {
    switch ( $translated_text ) {
        case 'Detalhes de faturamento' :
            $translated_text = __( 'Dados', 'woocommerce' );
            break;
    }
    return $translated_text;
}

add_action('woocommerce_before_checkout_registration_form', 'displayCreatePasswordTitle');
function displayCreatePasswordTitle() {
    echo '<h3>Crie sua senha</h3>';
}

add_action('woocommerce_form_field','displayTitleBeforeAddressFields', 10, 2);
function displayTitleBeforeAddressFields( $field, $key ){
    if (is_checkout() && ( $key == 'billing_phone')) {
        $field .= '<h3 class="form-row form-row-wide">Endereço de faturamento</h3>';
    }
    return $field;
}

add_action('woocommerce_checkout_order_review','displayBookinvideoPrincingCard', 10, 2);
function displayBookinvideoPrincingCard() {
    displayPricingCard(false);
}
?>