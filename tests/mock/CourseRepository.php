<?php
require_once __DIR__ . '/../../src/interfaces/CourseRepository.php';

class MockCourseRepository implements CourseRepository {
    public function getCourse($courseSlug) {
        return array(
            'name' => 'Codigo limpo', 
            'slug' => 'codigo-limpo',
        );
    }

    public function getModules($courseSlug) {
        $aModule = new stdClass();
        $aModule->name = 'Funções';
        $aModule->description = '03';
        return array($aModule);
    }

    public function getLessons($courseSlug, $moduleSlug) {
        return array(
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
        );
    }

    public function getSingleLesson($courseSlug, $lessonSlug) {
        return array(
            'name' => 'Codigo limpo',
            'sequence' => '0102',
            'video_src' => 'http://vimeo.com',
            'prev' => '0101-configuracao',
            'next' => '0201-nomes-significativos',
            'has_code' => 'true', 
            'has_slide' => 'true'
        );
    }

    public function completeLesson($courseSlug, $lessonSlug) {
        return 1;
    }
}
?>