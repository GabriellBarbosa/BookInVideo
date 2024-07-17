<?php
class Course {
    private $repository;
    private $slug;

    public function __construct($courseSlug, CourseRepository $repository) {
        $this->repository = $repository;
        $this->slug = $courseSlug;
    }

    public function getContent() {
        $course = $this->repository->getCourse($this->slug);
        if ($course) {
            return array(
                'name' => $course['name'],
                'slug' => $course['slug'],
                'modules' => $this->getModules()
            );
        } else return null;
    }

    private function getModules() {
        $modules = $this->repository->getModules($this->slug);
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
        $lessons = $this->repository->getLessons($this->slug, $moduleSlug);
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
        $completedLessons = $this->repository->getCompletedLessons($this->slug);
        foreach ($completedLessons as $completed) {
            if ($completed->lessonSlug == $lessonSlug) 
                return true;
        }
        return false;
    }

    public function findLesson($lessonSlug, $user) {
        $rawLesson = $this->repository->getSingleLesson($this->slug, $lessonSlug);
        if ($rawLesson != null) {
            $completedLessons = $this->repository->getCompletedLessons($this->slug);
            return $this->getLessonData($rawLesson, $completedLessons, $user);
        }
        return null;
    }

    private function getLessonData($rawLesson, $completedLessons, $user) {
        $lesson = $this->createLesson($rawLesson, $user);
        $lessonData = $lesson->getData($completedLessons);
        return $lessonData;
    }

    private function createLesson($rawLesson, $user) {
        if ($this->userCanAccessLesson($rawLesson, $user)) {
            return new LessonForSubscribed($rawLesson);
        } else {
            return new LessonForUnsubscribed($rawLesson);
        }
    }

    private function userCanAccessLesson($rawLesson, $user) {
        return $user->isSubscribed() || $rawLesson['free'] == 'true';
    }

    public function completeLesson($lessonSlug, $user) {
        if ($user->isSubscribed()) {
            $isCompleted = $this->repository->completeLesson($this->slug, $lessonSlug);
            return $isCompleted;
        }
        throw new Exception('Não foi possível completar a aula');
    }
}
?>