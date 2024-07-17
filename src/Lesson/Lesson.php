<?php
class Lesson {
    private $courseRepository;
    private $user;

    public function __construct(CourseRepository $courseRepository, User $user) {
        $this->courseRepository = $courseRepository;
        $this->user = $user;
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