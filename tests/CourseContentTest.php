<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__.'/tests/mock/CourseRepository.php';

final class CourseContentTest extends TestCase {
    public function testGetCourseContent(): void {
        $course = new Course('codigo-limpo', new MockCourseRepository());
        $content = $course->getContent('codigo-limpo');
        $this->assertSame($content, array(
            'name' => 'Codigo limpo', 
            'slug' => 'codigo-limpo',
            'modules' => array(
                array(
                    'name' => 'Funções',
                    'sequence' => '03',
                    'lessons' => array(
                        array(
                            'name' => 'random lesson',
                            'slug' => '0000-random-lesson',
                            'sequence' => '01',
                            'duration' => '15:05'
                        ),
                        array(
                            'name' => 'other lesson', 
                            'slug' => '0000-other-lesson',
                            'sequence' => '02',
                            'duration' => '15:05'
                        ),
                    )
                ),
            )
        ));
    }
}