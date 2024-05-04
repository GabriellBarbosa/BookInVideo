<?php
add_filter('woocommerce_enable_order_notes_field', '__return_false');

add_filter('woocommerce_checkout_fields', 'removeNotRequiredCheckoutFields');
function removeNotRequiredCheckoutFields($fields) {
    unset($fields['billing']['billing_address_2']);
    return $fields;
}

add_filter('woocommerce_checkout_fields', 'changeSomeCheckoutFieldsToRequired');
function changeSomeCheckoutFieldsToRequired($fields) {
    $fields['billing']['billing_neighborhood']['required'] = 1;
    $fields['billing']['billing_phone']['required'] = 1;
    return $fields;
}

add_filter('woocommerce_checkout_fields', 'changeCheckoutFieldsPriority');
function changeCheckoutFieldsPriority($fields) {
    $fields['billing']['billing_email']['priority'] = 21;
    $fields['billing']['billing_phone']['priority'] = 27;
    return $fields;
}

add_filter('gettext', 'changeCheckoutBillingDetailsTitle', 20, 3);
function changeCheckoutBillingDetailsTitle($translated_text, $text, $domain) {
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

add_action('woocommerce_form_field','displayTitleBeforeCheckoutAddressFields', 10, 2);
function displayTitleBeforeCheckoutAddressFields( $field, $key ){
    if (is_checkout() && ( $key == 'billing_phone')) {
        $field .= '<h3 class="form-row form-row-wide">Endereço de faturamento</h3>';
    }
    return $field;
}

add_action('woocommerce_checkout_order_review','displayBookinvideoPrincingCard', 10, 2);
function displayBookinvideoPrincingCard() {
    displayPricingCard(false);
}

add_action('wp', 'removeTermsPageAccordion');
function removeTermsPageAccordion() {
    remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_page_content', 30 );
}
?>