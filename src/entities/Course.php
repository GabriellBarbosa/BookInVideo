<?php
class Course {
    private $courseSlug = null;
    private $courseRepository = null;

    public function __construct($slug, ICourseRepository $respository) {
        $this->courseSlug = $slug;
        $this->courseRepository = $respository;
    }

    public function get() {
        $course = $this->courseRepository->getCourse($this->courseSlug);
        if ($course) {
            return array(
                'name' => $course['name'],
                'slug' => $course['slug'],
                'modules' => $this->getModules()
            );
        } else return null;
    }

    private function getModules() {
        $modules = $this->courseRepository->getModules($this->courseSlug);
        $result = array();
        foreach ($modules as $module) {
            array_push($result, array(
                'name' => $module->name,
                'sequence' => $module->description,
                'lessons' => $this->courseRepository->getLessons(
                    $this->courseSlug, $module->slug)
            ));
        }
        return $result;
    }

    public function getSingleLesson($lessonSlug) {
        $fields = ['name', 'sequence', 'video_src', 'prev', 'next', 'has_code', 'has_slide'];
        return $this->courseRepository->getSingleLesson(
            $this->courseSlug, $lessonSlug, $fields);
    }
}
?>