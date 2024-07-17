<?php
interface CourseRepository {
    public function getCourse();
    public function getModules();
    public function getLessons($moduleSlug);
    public function completeLesson($lessonSlug);
    public function getCompletedLessons();
}
?>