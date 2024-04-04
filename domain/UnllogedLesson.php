<?php
class UnloggedLesson {
    public static function getFields($lesson) {
        $lessonCopy = $lesson;
        $lessonCopy['video_src'] = '';
        return $lessonCopy;
    }
}
?>