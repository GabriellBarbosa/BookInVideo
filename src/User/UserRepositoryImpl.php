<?php
class UserRepositoryImpl implements UserRepository {
    public function getFirstName($userID) {
        return get_user_meta($userID, 'first_name', true);
    }
}
?>