<?php
include(get_template_directory() . '/domain/repositories/CourseRespository.php');

class Course {
    private $slug = null;
    private $courseRepository = null;

    public function __construct($slug) {
        $this->slug = $slug;
        $this->courseRepository = new CourseRepository();
    }

    public function get() {
        $fields = ['name', 'slug'];
        $course = $this->courseRepository->getCourse($this->slug, $fields);
        return $this->mountCourse($course);
    }

    private function mountCourse($course) {
        if ($course) {
            return array(
                'name' => $course['name'], 
                'slug' => $course['slug'],
                'modules' => $this->getModules()
            );
        } else {
            return $this->getNotFoundErr();
        }
    }

    private function getModules() {
        $modules = $this->courseRepository->getModules($this->slug);
        $result = array();
        foreach ($modules as $module) {
            array_push($result, $this->mountModule($module));
        }
        return $result;
    }

    private function mountModule($module) {
        return array(
            'name' => $module->name,
            'sequence' => $module->description,
            'lessons' => $this->getLessons($module->slug)
        );
    }

    private function getLessons($moduleSlug) {
        $fields = ['name', 'slug', 'sequence','duration'];
        return $this->courseRepository->getLessons(
            $this->slug, $moduleSlug, $fields);
    }

    public function getSingleLesson($lessonSlug) {
        $fields = ['name', 'sequence', 'video_src'];
        return $this->courseRepository->getSingleLesson(
            $this->slug, $lessonSlug, $fields);
    }

    private function getNotFoundErr() {
        return new WP_Error(
            'not_found', 
            'O curso não foi encontrado', 
            array('status' => 404)
        );
    }
}
?>