<?php
class Course {
    private $courseRepository = null;
    private $userRepository = null;

    public function __construct(ICourseRepository $c, UserRepository $u = null) {
        $this->courseRepository = $c;
        $this->userRepository = $u;
    }

    public function getContent($courseSlug) {
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

    public function getSingleLesson($courseSlug, $lessonSlug) {
        $lesson = $this->courseRepository->getSingleLesson($courseSlug, $lessonSlug);
        if ($this->userRepository->isSubscribed()) {
            return $lesson;
        }
        return $this->removeSensitiveFields($lesson);
    }

    private function removeSensitiveFields($lesson) {
        $lessonCopy = $lesson;
        $lessonCopy['video_src'] = null;
        $lessonCopy['has_slide'] = null;
        $lessonCopy['has_code'] = null;
        return $lessonCopy;
    }
}
?>