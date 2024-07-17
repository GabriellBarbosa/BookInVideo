<?php
class LessonForUnsubscribed implements Lesson {
    private $lesson;

    public function __construct($lesson) {
        $this->lesson = $lesson;
    }

    public function getData() {
        $lessonCopy = $this->lesson;
        $lessonCopy['completed'] = false;
        $lessonCopy['video_src'] = '';
        $lessonCopy['slide'] = '';
        $lessonCopy['code'] = '';
        $lessonCopy['note'] = '';
        return $lessonCopy;
    }
}
?>