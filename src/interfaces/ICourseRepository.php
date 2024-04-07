<?php
interface ICourseRepository {
    public function getCourse(string $slug);
    public function getModules(string $courseSlug);
    public function getLessons(string $courseSlug, string $moduleSlug);
}
?>