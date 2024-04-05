<?php
class SubscribedUserSpec {
    public static function isSastifiedBy($user) {
        $productPost = get_page_by_path('codigo-limpo', OBJECT, 'product');
        $wcProduct = new WC_Product($productPost);
        return wc_customer_bought_product('', $user->ID, $wcProduct->get_id());
    }
}
?>