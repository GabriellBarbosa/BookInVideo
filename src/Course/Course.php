<?php
class Course {
    private $courseRepository = null;
    private $courseSlug = null;

    public function __construct($courseSlug, CourseRepository $courseRepository) {
        $this->courseRepository = $courseRepository;
        $this->courseSlug = $courseSlug;
    }

    public function getContent() {
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
                'lessons' => $this->getLessons($module->slug)
            ));
        }
        return $result;
    }

    private function getLessons($moduleSlug) {
        $lessons = $this->courseRepository->getLessons(
            $this->courseSlug, $moduleSlug);
        return $this->addCompletedLessonField($lessons);
    }

    private function addCompletedLessonField($lessons) {
        $result = array();
        foreach ($lessons as $lesson) {
            $lessonCopy = $lesson;
            $lessonCopy['completed'] = $this->lessonIsCompleted($lessonCopy['slug']);
            array_push($result, $lessonCopy);
        }
        return $result;
    }

    private function lessonIsCompleted($lessonSlug) {
        $completedLessons = $this->courseRepository->getCompletedLessons($this->courseSlug);
        foreach ($completedLessons as $completed) {
            if ($completed->lessonSlug == $lessonSlug) 
                return true;
        }
        return false;
    }
}
?>