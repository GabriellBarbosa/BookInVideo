<?php
interface UserRepository {
    public function isSubscribed(): bool;
}

class SubscribedUserRepository implements UserRepository {
    public function isSubscribed(): bool {
        return true;
    }
}

class UnsubscribedUserRepository implements UserRepository {
    public function isSubscribed(): bool {
        return false;
    }
}
?>

