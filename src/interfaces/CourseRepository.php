<?php
interface CourseRepository {
    public function getCourse(string $slug);
    public function getModules(string $courseSlug);
    public function getLessons(string $courseSlug, string $moduleSlug);
    public function completeLesson(string $courseSlug, string $lessonSlug);
}
?>