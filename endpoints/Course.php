<?php
include(get_template_directory() . '/endpoints/CourseContent.php');

class Course {
    private $content;

    public function __construct() {
        $this->courseContent = new CourseContent();
    }

    public function getBySlug($slug) {
        $course = $this->findBySlug($slug);
        if ($course) {
            $modules = $this->courseContent->getModulesWithLessons($slug);
            $result = array(
                'name' => $course->post_title, 
                'slug' => $course->post_name,
                'modules' => $modules
            );
            return $result;
        } else {
            return $this->getNotFoundErr();
        }
    }

    private function findBySlug($slug) {
        $courseQuery = array(
            'post_type' => 'curso',
            'name' => $slug,
            'numberposts' => 1,
        );
        $courseQueryResult = new WP_Query($courseQuery);
        $coursePosts = $courseQueryResult->get_posts();
        return array_shift($coursePosts);
    }

    private function getNotFoundErr() {
        return new WP_Error(
            'not_found', 
            'O curso não foi encontrado', 
            array('status' => 404)
        );
    }

    public function getLesson($courseSlug, $lessonSlug) {
        $lessonQuery = array(
            'post_type' => 'aula',
            'name' => $lessonSlug,
            'numberposts' => 1,
            'tax_query' => array(
                array(
                    'taxonomy' => $courseSlug
                )
            )
        );
        $lessonQueryResult = new WP_Query($lessonQuery);
        $lessonPosts = $lessonQueryResult->get_posts();
        return $lessonPosts;
    }
}
?>