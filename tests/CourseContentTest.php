<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__ . '/src/Course/CourseRepository.php';
require_once __ROOT__ . '/src/Course/CourseRespositoryImpl.php';
require_once __ROOT__ . '/src/Course/Course.php';

require_once __ROOT__ . '/src/User/User.php';
require_once __ROOT__ . '/src/User/UserImpl.php';

final class CourseContentTest extends TestCase {
    public function testCourseContent(): void {
        $mockedRepo = $this->mockRepository();
        $user = $this->createMock(UserImpl::class);
        $course = new Course($mockedRepo, $user);
        $content = $course->getContent();
        $this->assertSame($this->expected(), $content);
    }

    private function mockRepository() {
        $repo = $this->createMock(CourseRepositoryImpl::class);
        $repo->method('getCourse')->willReturn($this->mockedCourse());
        $repo->method('getModules')->willReturn($this->mockedModule());
        $repo->method('getLessons')->willReturn($this->mockedLessons());
        $repo->method('getCompletedLessons')->willReturn($this->mockedCompletedLessons());
        return $repo;
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

    private function expected() {
        return array(
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
        );
    }
}