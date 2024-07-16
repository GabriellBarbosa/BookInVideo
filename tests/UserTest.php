<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once __ROOT__ . '/src/User/User.php';
require_once __ROOT__ . '/src/User/UserImpl.php';
require_once __ROOT__ . '/src/User/UserRepository.php';
require_once __ROOT__ . '/src/User/UserRepositoryImpl.php';

final class UserTest extends TestCase {

    public function testUnloggedUserInfo() {
        $unlogged = $this->createUnloggedUser();
        $userInfo = $unlogged->getInfoIfLoggedIn();
        $this->assertEquals(null, $userInfo);
    }

    public function testLoggedUserInfo() {
        $logged = $this->createLoggedUser();
        $userInfo = $logged->getInfoIfLoggedIn();
        $this->assertEquals(array("username" => "Gabriel"), $userInfo);
    }

    private function createUnloggedUser() {
        $unloggedUser = new stdClass();
        $unloggedUser->ID = 0;
        $userRepo = $this->createMock(UserRepositoryImpl::class);
        return new UserImpl($unloggedUser, $userRepo);
    }

    private function createLoggedUser() {
        $loggedUser = new stdClass();
        $loggedUser->ID = 1;
        $userRepo = $this->mockedUserRepository();
        return new UserImpl($loggedUser, $userRepo);
    }

    private function mockedUserRepository() {
        $repository = $this->createMock(UserRepositoryImpl::class);
        $repository->method("getFirstName")->willReturn("Gabriel");
        return $repository;
    }
}
?>