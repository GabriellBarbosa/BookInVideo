<?php
class Course {
    private $repository;
    private $user;

    public function __construct(CourseRepository $repository, User $user) {
        $this->repository = $repository;
        $this->user = $user;
    }

    public function getContent() {
        $course = $this->repository->getCourse();
        if ($course) {
            return array(
                'name' => $course['name'],
                'slug' => $course['slug'],
                'modules' => $this->getModules()
            );
        } else return null;
    }

    private function getModules() {
        $modules = $this->repository->getModules();
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
        $lessons = $this->repository->getLessons($moduleSlug);
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
        $completedLessons = $this->repository->getCompletedLessons();
        foreach ($completedLessons as $completed) {
            if ($completed->lessonSlug == $lessonSlug) 
                return true;
        }
        return false;
    }

    public function findLesson($lessonSlug) {
        $rawLesson = $this->repository->getSingleLesson($lessonSlug);
        if ($rawLesson != null) {
            $lesson = $this->createLesson($rawLesson);
            return $lesson->getData();
        }
        return null;
    }

    private function createLesson($rawLesson) {
        if ($this->user->isSubscribed() ) {
            return new LessonForSubscribed(
                $rawLesson, $this->repository->getCompletedLessons());
        } else if ($rawLesson['free'] == 'true') {
            return new LessonFree($rawLesson);
        } else {
            return new LessonForUnsubscribed($rawLesson);
        }
    }

    public function completeLesson($lessonSlug) {
        if ($this->user->isSubscribed()) {
            $isCompleted = $this->repository->completeLesson($lessonSlug);
            return $isCompleted;
        }
        throw new Exception('Não foi possível completar a aula');
    }
}
?>