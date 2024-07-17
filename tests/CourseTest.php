<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once __ROOT__ . '/src/Course/CourseRepository.php';
require_once __ROOT__ . '/src/Course/CourseRespositoryImpl.php';
require_once __ROOT__ . '/src/Course/Course.php';

require_once __ROOT__ . '/src/User/User.php';
require_once __ROOT__ . '/src/User/UserImpl.php';

require_once __ROOT__ . '/src/Lesson/ILesson.php';
require_once __ROOT__ . '/src/Lesson/LessonForSubscribed.php';
require_once __ROOT__ . '/src/Lesson/LessonForUnsubscribed.php';

final class CourseTest extends TestCase {
    private $lesson;
    private $course;
    private $user;
    private $courseRepository;

    protected function setUp(): void {
        $this->user = $this->createMock(UserImpl::class);
        $this->courseRepository = $this->createMock(CourseRepositoryImpl::class);
        $this->course = new Course('codigo-limpo', $this->courseRepository);
    }

    public function testGetLessonSubscribedUser() {
        $this->user->method('isSubscribed')->willReturn(true);
        $this->courseRepository->method('getSingleLesson')->willReturn($this->rawLesson());

        $lessonFound = $this->course->findLesson('0102-codigo-limpo', $this->user);

        $this->assertEquals(false, $lessonFound['completed']);
        $this->assertEquals('http://vimeo.com', $lessonFound['video_src']);
        $this->assertEquals('/slide', $lessonFound['slide']);
        $this->assertEquals('/code', $lessonFound['code']);
        $this->assertEquals('some note', $lessonFound['note']);
    }

    public function testGetLessonUnsubscribedUser() {
        $this->user->method('isSubscribed')->willReturn(false);
        $this->courseRepository->method('getSingleLesson')->willReturn($this->rawLesson());

        $lessonFound = $this->course->findLesson('0102-codigo-limpo', $this->user);

        $this->assertEquals(false, $lessonFound['completed']);
        $this->assertEquals('', $lessonFound['video_src']);
        $this->assertEquals('', $lessonFound['slide']);
        $this->assertEquals('', $lessonFound['code']);
        $this->assertEquals('', $lessonFound['note']);
    }

    public function testGetCompletedLesson() {
        $lesson = new StdClass();
        $lesson->lessonSlug = '0102-codigo-limpo';
        $this->courseRepository->method('getCompletedLessons')->willReturn(array($lesson));
        $this->user->method('isSubscribed')->willReturn(true);
        $this->courseRepository->method('getSingleLesson')->willReturn($this->rawLesson());

        $lesson = $this->course->findLesson('0102-codigo-limpo', $this->user);

        $this->assertEquals($lesson['completed'], true);
    }

    public function testLessonNotFound() {
        $this->courseRepository->method('getSingleLesson')->willReturn(null);
        $lesson = $this->course->findLesson('0102-codigo-limpo', $this->user);
        $this->assertEquals(null, $lesson);
    }

    public function testFreeLessonForUnsubscribedUser() {
        $this->user->method('isSubscribed')->willReturn(false);
        $this->courseRepository->method('getSingleLesson')->willReturn($this->rawFreeLesson());

        $lesson = $this->course->findLesson('0102-codigo-limpo', $this->user);

        $this->assertEquals('true', $lesson['free']);
        $this->assertEquals('http://vimeo.com', $lesson['video_src']);
        $this->assertEquals('/slide', $lesson['slide']);
        $this->assertEquals('/code', $lesson['code']);
        $this->assertEquals('some note', $lesson['note']);
    }

    private function rawLesson() {
        return array(
            'name' => 'Codigo limpo',
            'sequence' => '0102',
            'slug' => '0102-codigo-limpo',
            'video_src' => 'http://vimeo.com',
            'prev' => '0101-configuracao',
            'next' => '0201-nomes-significativos',
            'slide' => '/slide', 
            'code' => '/code',
            'free' => '',
            'note' => 'some note',
        );
    }

    private function rawFreeLesson() {
        return array(
            'name' => 'Codigo limpo',
            'sequence' => '0102',
            'slug' => '0102-codigo-limpo',
            'video_src' => 'http://vimeo.com',
            'prev' => '0101-configuracao',
            'next' => '0201-nomes-significativos',
            'slide' => '/slide', 
            'code' => '/code',
            'free' => 'true',
            'note' => 'some note',
        );
    }
}
?>