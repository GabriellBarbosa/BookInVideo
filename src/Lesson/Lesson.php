<?php
class Lesson {
    private $courseRepository;
    private $user;

    public function __construct(CourseRepository $courseRepo, User $user) {
        $this->courseRepository = $courseRepo;
        $this->user = $user;
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
        $lessonCopy = $lesson;
        $lessonCopy['completed'] = false;
        if ($this->user->isSubscribed() || $lessonCopy['free'] == 'true') {
            if ($this->user->isSubscribed()) {
                $lessonCopy['completed'] = $this->lessonIsCompleted($completedLessons, $lessonSlug);
            }
            return $lessonCopy;
        } else {
            return $this->emptySensitiveFields($lessonCopy);
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
        $lessonCopy['note'] = '';
        return $lessonCopy;
    }

    public function complete($courseSlug, $lessonSlug) {
        if ($this->user->isSubscribed()) {
            $isCompleted = $this->courseRepository->completeLesson($courseSlug, $lessonSlug);
            return $isCompleted;
        }
        throw new Exception('Não foi possível completar a aula');
    }
}
?>