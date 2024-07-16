<?php
class UserImpl implements User {
    public function isSubscribed(): bool {
        $user = wp_get_current_user();
        if ($user->ID > 0) {
            return $this->userBoughtCourse($user->ID);
        }
        return false;
    }

    private function userBoughtCourse($userID) {
        $productPost = get_page_by_path('codigo-limpo', OBJECT, 'product');
        $wcProduct = new WC_Product($productPost);
        return wc_customer_bought_product(
            '', $userID, $wcProduct->get_id());
    }
}
?>