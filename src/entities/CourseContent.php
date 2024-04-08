<?php
class CourseContent {
    private $courseRepository = null;

    public function __construct(CourseRepository $courseRepository) {
        $this->courseRepository = $courseRepository;
    }

    public function get($courseSlug) {
        $course = $this->courseRepository->getCourse($courseSlug);
        if ($course) {
            return array(
                'name' => $course['name'],
                'slug' => $course['slug'],
                'modules' => $this->getModules($courseSlug)
            );
        } else return null;
    }

    private function getModules($courseSlug) {
        $modules = $this->courseRepository->getModules($courseSlug);
        $result = array();
        foreach ($modules as $module) {
            array_push($result, array(
                'name' => $module->name,
                'sequence' => $module->description,
                'lessons' => $this->courseRepository->getLessons(
                    $courseSlug, $module->slug)
            ));
        }
        return $result;
    }
}
?>