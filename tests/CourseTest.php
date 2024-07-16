<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__ . '/src/interfaces/CourseRepository.php';
require_once __ROOT__ . '/src/repositories/CourseRespositoryImpl.php';
require_once __ROOT__ . '/src/Course/Course.php';

final class CourseTest extends TestCase {
    public function testGetCourseContent(): void {
        $courseRepository = $this->createMock(CourseRepositoryImpl::class);
        $courseRepository->method('getCourse')->willReturn($this->mockedCourse());
        $courseRepository->method('getModules')->willReturn($this->mockedModule());
        $courseRepository->method('getLessons')->willReturn($this->mockedLessons());
        $courseRepository->method('getCompletedLessons')->willReturn($this->mockedCompletedLessons());

        $course = new Course('codigo-limpo', $courseRepository);
        $content = $course->getContent();
        
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
                            'duration' => '15:05',
                            'free' => 'true',
                            'completed' => true
                        ),
                        array(
                            'name' => 'other lesson', 
                            'slug' => '0000-other-lesson',
                            'sequence' => '02',
                            'duration' => '15:05',
                            'free' => '',
                            'completed' => false
                        ),
                    )
                ),
            )
        ));
    }

    private function mockedCourse() {
        return array(
            'name' => 'Codigo limpo', 
            'slug' => 'codigo-limpo',
        );
    }

    private function mockedModule() {
        $module = new stdClass();
        $module->name = 'Funções';
        $module->description = '03';
        return array($module);
    }

    private function mockedLessons() {
        return array(
            array(
                'name' => 'random lesson',
                'slug' => '0000-random-lesson',
                'sequence' => '01',
                'duration' => '15:05',
                'free' => 'true',
            ),
            array(
                'name' => 'other lesson', 
                'slug' => '0000-other-lesson',
                'sequence' => '02',
                'duration' => '15:05',
                'free' => '',
            ),
        );
    }

    private function mockedCompletedLessons() {
        $lesson = new StdClass();
        $lesson->lessonSlug = '0000-random-lesson';
        return array($lesson);
    }
}