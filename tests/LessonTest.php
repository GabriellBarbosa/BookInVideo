<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once __ROOT__ . '/src/Course/CourseRepository.php';
require_once __ROOT__ . '/src/Course/CourseRespositoryImpl.php';

require_once __ROOT__ . '/src/User/User.php';
require_once __ROOT__ . '/src/User/UserImpl.php';

require_once __ROOT__ . '/src/Lesson/Lesson.php';
require_once __ROOT__ . '/src/Lesson/ILesson.php';
require_once __ROOT__ . '/src/Lesson/LessonForSubscribed.php';
require_once __ROOT__ . '/src/Lesson/LessonForUnsubscribed.php';

final class LessonTest extends TestCase {
    private $lesson = null;
    private $userRepository = null;
    private $courseRepository = null;

    protected function setUp(): void {
        $this->userRepository = $this->createMock(UserImpl::class);
        $this->courseRepository = $this->createMock(CourseRepositoryImpl::class);
        $this->lesson = new Lesson($this->courseRepository, $this->userRepository);
    }

    public function testCompleteLesson() {
        $this->courseRepository->method('completeLesson')->willReturn(true);
        $this->userRepository->method('isSubscribed')->willReturn(true);

        $completedFeedback = $this->lesson->complete('codigo-limpo', '0102-codigo-limpo');

        $this->assertEquals($completedFeedback, true);
    }

    public function testCompleteLessonFail() {
        $this->courseRepository->method('completeLesson')->willReturn(false);
        $this->userRepository->method('isSubscribed')->willReturn(true);

        $completedFeedback = $this->lesson->complete('codigo-limpo', '0102-codigo-limpo');

        $this->assertEquals($completedFeedback, false);
    }

    public function testUnsubscribedUserCompleteLesson() {
        $this->userRepository->method('isSubscribed')->willReturn(false);

        $this->expectException(Exception::class);
        
        $this->lesson->complete('codigo-limpo', '0102-codigo-limpo');
    }
}
?>