<?php
require_once get_template_directory() . '/src/entities/CourseContent.php';
require_once get_template_directory() . '/src/entities/Lesson.php';

add_action('rest_api_init', 'registerGetCourse');

function registerGetCourse() {
    $slug = '(?P<slug>[-\w]+)';
    $apiRoute = '/curso' . '/' . $slug;
    register_rest_route('api', $apiRoute, array(
        array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => 'getCourseContent'
        )
    ));
}

function getCourseContent($request) {
    $courseContent = new CourseContent(new CourseRepository());
    $content = $courseContent->get($request['slug']);
    $response = $content 
        ? $content 
        : getNotFoundErr('O curso não foi encontrado');
    return rest_ensure_response($response);
}
?>