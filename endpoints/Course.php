<?php
include(get_template_directory() . '/endpoints/CourseContent.php');

class Course {
    private $content;

    public function __construct() {
        $this->courseContent = new CourseContent();
    }

    function get_by_slug($slug) {
        $course = $this->find_by_slug($slug);
        $modules = $this->courseContent->get_modules_with_lessons();
        $result = array(
            'name' => $course->post_title, 
            'slug' => $course->post_name,
            'modules' => $modules
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