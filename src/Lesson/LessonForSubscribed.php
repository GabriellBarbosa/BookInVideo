<?php
class LessonForSubscribed implements Lesson {
    private $lesson;
    private $completedLesson;

    public function __construct($lesson, $completedLessons) {
        $this->lesson = $lesson;
        $this->completedLessons = $completedLessons;
    }

    public function getData() {
        $lessonCopy = $this->lesson;
        $lessonCopy['completed'] = $this->isCompleted();
        return $lessonCopy;
    }

    private function isCompleted() {
        foreach ($this->completedLessons as $completedLesson) {
            if ($completedLesson->lessonSlug == $this->lesson['slug']) 
                return true;
        }
        return false;
    }
}
?>