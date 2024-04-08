<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
if (!(__ROOT__)) define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__.'/tests/mock/CourseRepository.php';
require_once __ROOT__.'/tests/mock/UserRepository.php';

final class LessonTest extends TestCase {
    public function testGetLesson() {
        $course = new Course(
            new MockCourseRepository(),
            new SubscribedUserRepository()
        );
        $lesson = $course->getSingleLesson('codigo-limpo', '0102-codigo-limpo');
        $this->assertSame($lesson, array(
            'name' => 'Codigo limpo',
            'sequence' => '0102',
            'video_src' => 'http://vimeo.com',
            'prev' => '0101-configuracao',
            'next' => '0201-nomes-significativos',
            'has_code' => 'true', 
            'has_slide' => 'true'
        ));
    }

    public function testGetLessonUnsubscribedUser() {
        $course = new Course(
            new MockCourseRepository(),
            new UnsubscribedUserRepository()
        );
        $lesson = $course->getSingleLesson('codigo-limpo', '0102-codigo-limpo');
        $this->assertSame($lesson, array(
            'name' => 'Codigo limpo',
            'sequence' => '0102',
            'video_src' => null,
            'prev' => '0101-configuracao',
            'next' => '0201-nomes-significativos',
            'has_code' => null, 
            'has_slide' => null
        ));
    }
}
?>