<?php
class UnloggedLesson {
    public static function getFields($lesson) {
        $lessonCopy = $lesson;
        $lessonCopy['video_src'] = '';
        $lessonCopy['has_slide'] = '';
        $lessonCopy['has_code'] = '';
        return $lessonCopy;
    }
}
?>