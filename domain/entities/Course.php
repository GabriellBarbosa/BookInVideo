<?php
require_once get_template_directory() . '/domain/repositories/CourseRespository.php';

class Course {
    private $courseSlug = null;
    private $courseRepository = null;

    public function __construct($slug) {
        $this->courseSlug = $slug;
        $this->courseRepository = new CourseRepository();
    }

    public function get() {
        $fields = ['name', 'slug'];
        $course = $this->courseRepository->getCourse($this->courseSlug, $fields);
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
            return null;
        }
    }

    private function getModules() {
        $modules = $this->courseRepository->getModules($this->courseSlug);
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
            $this->courseSlug, $moduleSlug, $fields);
    }

    public function getSingleLesson($lessonSlug) {
        $fields = ['name', 'sequence', 'video_src'];
        return $this->courseRepository->getSingleLesson(
            $this->courseSlug, $lessonSlug, $fields);
    }
}
?>