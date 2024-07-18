<?php
interface CourseRepository {
    public function getCourse();
    public function getModules();
    public function getLessons($moduleSlug);
    public function getTotalLessons();
    public function getSingleLesson($lessonSlug);
    public function completeLesson($lessonSlug, $userID);
    public function getCompletedLessons($userID);
    public function generateCertificate($userID);
    public function hasCertificate($userID);
}
?>