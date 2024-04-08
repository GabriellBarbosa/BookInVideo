<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once __ROOT__ . '/tests/mock/CourseRepository.php';
require_once __ROOT__ . '/tests/mock/UserRepository.php';
require_once __ROOT__ . '/src/entities/Lesson.php';

final class LessonTest extends TestCase {
    public function testGetLesson() {
        $lesson = new Lesson(new MockCourseRepository(),new SubscribedUserRepository());
        $lessonFound = $lesson->get('codigo-limpo', '0102-codigo-limpo');

        $this->assertSame($lessonFound, array(
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
        $lesson = new Lesson(new MockCourseRepository(), new UnsubscribedUserRepository());
        $lessonFound = $lesson->get('codigo-limpo', '0102-codigo-limpo');

        $this->assertSame($lessonFound, array(
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