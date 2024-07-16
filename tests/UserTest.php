<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once __ROOT__ . '/src/User/User.php';
require_once __ROOT__ . '/src/User/UserImpl.php';
require_once __ROOT__ . '/src/User/UserRepository.php';
require_once __ROOT__ . '/src/User/UserRepositoryImpl.php';

final class UserTest extends TestCase {
    private $user;

    protected function setUp(): void {
        $obj = new stdClass();
        $obj->ID = 2;
        $userRepository = $this->createMock(UserRepositoryImpl::class);
        $this->user = new UserImpl($obj, $userRepository);
    }

    public function testUnloggedUserInfo() {
        $userInfo = $this->user->getInfoIfLoggedIn();
    }
}
?>