<?php
class Lesson {
    private $courseRepository = null;
    private $userRepository = null;

    public function __construct(
        CourseRepository $courseRepo, UserRepository $userRepo
    ) {
        $this->courseRepository = $courseRepo;
        $this->userRepository = $userRepo;
    }

    public function get($courseSlug, $lessonSlug) {
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