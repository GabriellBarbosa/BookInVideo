<?php
interface ICourseRepository {
    public function getCourse($courseSlug);
    public function getModules($courseSlug);
    public function getLessons($courseSlug, $moduleSlug);
}

class MockCourseRepository implements ICourseRepository {
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
}
?>