<?php
class LessonForSubscribed implements ILesson {
    private $slug;
    private $lesson;

    public function __construct($lesson) {
        $this->slug = $lesson['slug'];
        $this->lesson = $lesson;
    }

    public function getData($completedLessons) {
        $lessonCopy = $this->lesson;
        $lessonCopy['completed'] = $this->lessonIsCompleted($completedLessons);
        return $lessonCopy;
    }

    private function lessonIsCompleted($completedLessons) {
        foreach ($completedLessons as $completedLesson) {
            if ($completedLesson->lessonSlug == $this->slug) 
                return true;
        }
        return false;
    }
}
?>