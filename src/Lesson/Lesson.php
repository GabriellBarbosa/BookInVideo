<?php
class Lesson {
    private $courseRepository;
    private $user;

    public function __construct(CourseRepository $courseRepository, User $user) {
        $this->courseRepository = $courseRepository;
        $this->user = $user;
    }

    public function get($courseSlug, $lessonSlug) {
        $completedLessons = $this->courseRepository->getCompletedLessons($courseSlug);
        $rawLesson = $this->courseRepository->getSingleLesson($courseSlug, $lessonSlug);
        if ($rawLesson != null) {
            return $this->getLessonData($courseSlug, $rawLesson, $completedLessons);
        }
        return null;
    }

    private function getLessonData($courseSlug, $rawLesson, $completedLessons) {
        $lesson = $this->createLesson($courseSlug, $rawLesson);
        $lessonData = $lesson->getData($completedLessons);
        return $lessonData;
    }

    private function createLesson($courseSlug, $rawLesson) {
        if ($this->userCanAccessLesson($rawLesson)) {
            return new LessonForSubscribed($rawLesson);
        } else {
            return new LessonForUnsubscribed($rawLesson);
        }
    }

    public function userCanAccessLesson($rawLesson) {
        return $this->user->isSubscribed() || $rawLesson['free'] == 'true';
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