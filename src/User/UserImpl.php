<?php
class UserImpl implements User {
    private $user;
    private $repository;

    public function __construct($currentUser, UserRepository $repository) {
        $this->user = $currentUser;
        $this->repository = $repository;
    }

    public function getInfoIfLoggedIn() {
        if ($this->isLoggedIn()) {
            return array('username' => $this->firstName());
        } else {
            return null;
        }
    }

    private function firstName() {
        return $this->repository->getFirstName($this->user->ID);
    }

    public function isSubscribed(): bool {
        if ($this->isLoggedIn()) {
            return $this->boughtCourse();
        }
        return false;
    }

    private function isLoggedIn() {
        return $this->user->ID > 0;
    }

    private function boughtCourse() {
        $productPost = get_page_by_path('codigo-limpo', OBJECT, 'product');
        $wcProduct = new WC_Product($productPost);
        return wc_customer_bought_product(
            '', $this->user->ID, $wcProduct->get_id());
    }
}
?>