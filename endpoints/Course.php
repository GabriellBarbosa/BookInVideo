<?php
include(get_template_directory() . '/endpoints/Lesson.php');

class Course {
    private $courseContent;

    public function __construct() {
        $this->courseContent = new Lesson(); // rename to CourseContent
    }

    function get_by_slug($slug) {
        $course = $this->find_by_slug($slug);
        $courseContent = $this->courseContent->getAll();
        $result = array(
            'course' => $course->post_title, 
            'content' => $courseContent
        );
        return $course ? $result : $this->get_not_found_err();
    }

    private function find_by_slug($slug) {
        $courseQuery = array(
            'post_type' => 'curso',
            'name' => $slug,
            'numberposts' => 1,
        );
        $courseQueryResult = new WP_Query( $courseQuery );
        $coursePosts = $courseQueryResult->get_posts();
        return array_shift($coursePosts);
    }

    private function get_not_found_err() {
        return new WP_Error(
            'not_found', 
            'O curso não foi encontrado', 
            array('status' => 404)
        );
    }
}
?>