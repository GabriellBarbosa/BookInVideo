<?php
add_filter('woocommerce_enable_order_notes_field', '__return_false');

add_filter('woocommerce_checkout_fields', 'bookinvideo_removeNotRequiredCheckoutFields');
function bookinvideo_removeNotRequiredCheckoutFields($fields) {
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_company']);
    return $fields;
}

add_filter('gettext', 'bookinvideo_changeCheckoutBillingDetailsTitle', 20, 3);
function bookinvideo_changeCheckoutBillingDetailsTitle($translated_text, $text, $domain) {
    switch ( $translated_text ) {
        case 'Detalhes de faturamento' :
            $translated_text = __( 'Seus dados', 'woocommerce' );
            break;
    }
    return $translated_text;
}

add_action('woocommerce_checkout_order_review','bookinvideo_displayBookinvideoPrincingCard', 10, 2);
function bookinvideo_displayBookinvideoPrincingCard() {
    displayPricingCard(false);
}

add_action('wp', 'bookinvideo_removeTermsPageAccordion');
function bookinvideo_removeTermsPageAccordion() {
    remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_page_content', 30 );
}
?>