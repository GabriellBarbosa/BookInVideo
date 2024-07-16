<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once __ROOT__ . '/src/User/User.php';
require_once __ROOT__ . '/src/User/UserImpl.php';

final class UserTest extends TestCase {
    private $user;

    protected function setUp(): void {
        $obj = new stdClass();
        $obj->ID = 2;
        $this->user = new UserImpl($obj);
    }

    public function testUnloggedUserInfo() {
        $userInfo = $this->user->getInfoIfLoggedIn();
    }
}
?>