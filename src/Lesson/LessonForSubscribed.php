<?php
class LessonForSubscribed implements ILesson {
    private $lesson;

    public function __construct($lesson) {
        $this->lesson = $lesson;
    }

    public function getData($completedLessons) {
        $lessonCopy = $this->lesson;
        $lessonCopy['completed'] = $this->isCompleted($completedLessons);
        return $lessonCopy;
    }

    private function isCompleted($completedLessons) {
        foreach ($completedLessons as $completedLesson) {
            if ($completedLesson->lessonSlug == $this->lesson['slug']) 
                return true;
        }
        return false;
    }
}
?>