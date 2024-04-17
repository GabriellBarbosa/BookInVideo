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
        $completedLessons = $this->courseRepository->getCompletedLessons($courseSlug);
        $lesson = $this->courseRepository->getSingleLesson($courseSlug, $lessonSlug);
        if ($lesson)
            return $this->enrichLesson($lesson, $completedLessons, $lessonSlug);
        else
            return null;
    }

    private function enrichLesson($lesson, $completedLessons, $lessonSlug) {
        $lesson['completed'] = false;
        if ($this->userRepository->isSubscribed()) {
            $lesson['completed'] = $this->lessonIsCompleted($completedLessons, $lessonSlug);
            return $lesson;
        } else {
            return $this->emptySensitiveFields($lesson);
        }
    }

    private function lessonIsCompleted($completedLessons, $lessonSlug) {
        foreach ($completedLessons as $completedLesson) {
            if ($completedLesson->lessonSlug == $lessonSlug) 
                return true;
        }
        return false;
    }

    private function emptySensitiveFields($lesson) {
        $lessonCopy = $lesson;
        $lessonCopy['video_src'] = '';
        $lessonCopy['slide'] = '';
        $lessonCopy['code'] = '';
        return $lessonCopy;
    }

    public function complete($courseSlug, $lessonSlug) {
        if ($this->userRepository->isSubscribed()) {
            $isCompleted = $this->courseRepository->completeLesson($courseSlug, $lessonSlug);
            return $isCompleted;
        }
        throw new Exception('Não foi possível completar a aula');
    }
}
?>