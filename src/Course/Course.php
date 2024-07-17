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
        foreach ($this->getCompletedLessons() as $completed) {
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
            return new LessonForSubscribed($rawLesson, $this->getCompletedLessons());
        } else if ($rawLesson['free'] == 'true') {
            return new LessonFree($rawLesson);
        } else {
            return new LessonForUnsubscribed($rawLesson);
        }
    }

    private function getCompletedLessons() {
        return $this->repository->getCompletedLessons($this->user->getID());
    }

    public function completeLesson($lessonSlug) {
        if ($this->user->isSubscribed()) {
            $this->repository->completeLesson($lessonSlug, $this->user->getID());
        } else {
            throw new Exception('Não foi possível completar a aula');
        }
    }
}
?>