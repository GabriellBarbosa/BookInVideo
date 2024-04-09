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
                'lessons' => $this->getLessons($courseSlug, $module->slug)
            ));
        }
        return $result;
    }

    private function getLessons($courseSlug, $moduleSlug) {
        $completedLessons = $this->courseRepository->getCompletedLessons($courseSlug, $moduleSlug);
        $lessons = $this->courseRepository->getLessons( $courseSlug, $moduleSlug);
        return $this->addCompletedLessonField($lessons, $completedLessons);
    }

    private function addCompletedLessonField($lessons, $completedLessons) {
        $result = array();
        foreach ($lessons as $lesson) {
            $lessonCopy = $lesson;
            $lessonCopy['completed'] = $this->lessonIsCompleted($completedLessons, $lessonCopy['slug']);
            array_push($result, $lessonCopy);
        }
        return $result;
    }

    private function lessonIsCompleted($completedLessons, $lessonSlug) {
        foreach ($completedLessons as $completedLesson) {
            if ($completedLesson->lessonSlug == $lessonSlug) 
                return true;
        }
        return false;
    }
}
?>