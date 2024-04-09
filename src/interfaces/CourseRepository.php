<?php
interface CourseRepository {
    public function getCourse($slug);
    public function getModules($courseSlug);
    public function getLessons($courseSlug, $moduleSlug);
    public function completeLesson($courseSlug, $lessonSlug);
    public function getCompletedLessons($courseSlug);
}
?>