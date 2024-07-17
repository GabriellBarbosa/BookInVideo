<?php
class LessonFree implements Lesson {
    private $lesson;

    public function __construct($lesson) {
        $this->lesson = $lesson;
    }

    public function getData() {
        $lessonCopy = $this->lesson;
        $lessonCopy['completed'] = false;
        return $lessonCopy;
    }
}
?>