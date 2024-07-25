<?php
namespace AppUser;

class User {
    private $user;

    public function __construct($userID) {
        $this->user = get_userdata($userID);
    }

    public function getFullName() {
        $first_name = get_user_meta($this->user->ID, 'first_name', true);
        $last_name = get_user_meta($this->user->ID, 'last_name', true);
        return "{$first_name} {$last_name}";
    }
}
?>