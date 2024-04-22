<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once __ROOT__ . '/src/interfaces/CourseRepository.php';
require_once __ROOT__ . '/src/interfaces/UserRepository.php';
require_once __ROOT__ . '/src/repositories/CourseRespositoryImpl.php';
require_once __ROOT__ . '/src/repositories/UserRepositoryImpl.php';
require_once __ROOT__ . '/src/entities/Lesson.php';

final class LessonTest extends TestCase {
    private $lesson = null;
    private $userRepository = null;
    private $courseRepository = null;

    protected function setUp(): void {
        $this->userRepository = $this->createMock(UserRepositoryImpl::class);
        $this->courseRepository = $this->createMock(CourseRepositoryImpl::class);
        $this->lesson = new Lesson($this->courseRepository, $this->userRepository);
    }

    public function testGetLesson() {
        $this->userRepository->method('isSubscribed')->willReturn(true);
        $this->courseRepository->method('getSingleLesson')->willReturn(array(
            'name' => 'Codigo limpo',
            'sequence' => '0102',
            'slug' => '0102-codigo-limpo',
            'video_src' => 'http://vimeo.com',
            'prev' => '0101-configuracao',
            'next' => '0201-nomes-significativos',
            'slide' => '/slide', 
            'code' => '/code',
            'note' => 'Me diga o que voce achou do curso'
        ));

        $lessonFound = $this->lesson->get('codigo-limpo', '0102-codigo-limpo');

        $this->assertEquals($lessonFound, array(
            'name' => 'Codigo limpo',
            'sequence' => '0102',
            'slug' => '0102-codigo-limpo',
            'video_src' => 'http://vimeo.com',
            'prev' => '0101-configuracao',
            'next' => '0201-nomes-significativos',
            'slide' => '/slide', 
            'code' => '/code',
            'note' => 'Me diga o que voce achou do curso',
            'completed' => false
        ));
    }

    public function testGetLessonUnsubscribedUser() {
        $this->userRepository->method('isSubscribed')->willReturn(false);
        $this->courseRepository->method('getSingleLesson')->willReturn(array(
            'name' => 'Codigo limpo',
            'sequence' => '0102',
            'slug' => '0102-codigo-limpo',
            'video_src' => 'http://vimeo.com',
            'prev' => '0101-configuracao',
            'next' => '0201-nomes-significativos',
            'slide' => '/slide', 
            'code' => '/code',
            'note' => 'Me diga o que voce achou do curso',
        ));

        $lessonFound = $this->lesson->get('codigo-limpo', '0102-codigo-limpo');

        $this->assertEquals($lessonFound, array(
            'name' => 'Codigo limpo',
            'sequence' => '0102',
            'slug' => '0102-codigo-limpo',
            'video_src' => '',
            'prev' => '0101-configuracao',
            'next' => '0201-nomes-significativos',
            'slide' => '', 
            'code' => '',
            'note' => '',
            'completed' => false
        ));
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

    public function testGetCompletedLesson() {
        $completedLesson = new StdClass();
        $completedLesson->lessonSlug = '0102-codigo-limpo';
        $this->courseRepository->method('getCompletedLessons')->willReturn(array($completedLesson));
        $this->userRepository->method('isSubscribed')->willReturn(true);
        $this->courseRepository->method('getSingleLesson')->willReturn(array(
            'name' => 'Codigo limpo',
            'sequence' => '0102',
            'slug' => '0102-codigo-limpo',
            'video_src' => 'http://vimeo.com',
            'prev' => '0101-configuracao',
            'next' => '0201-nomes-significativos',
            'slide' => '/', 
            'code' => '/'
        ));

        $lesson = $this->lesson->get('codigo-limpo', '0102-codigo-limpo');

        $this->assertEquals($lesson['completed'], true);
    }

    public function testLessonNotFound() {
        $completedLesson = new StdClass();
        $completedLesson->lessonSlug = '0102-codigo-limpo';
        $this->courseRepository->method('getSingleLesson')->willReturn(null);

        $lesson = $this->lesson->get('codigo-limpo', '0102-codigo-limpo');

        $this->assertEquals($lesson, null);
    }
}
?>