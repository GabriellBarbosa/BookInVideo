<?php
require_once get_template_directory() . '/src/entities/Course.php';

add_action('rest_api_init', 'registerGetCourse');
add_action('rest_api_init', 'registerGetLesson');

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
    $course = new Course(new CourseRepository());
    $courseFound = $course->getContent($request['slug']);
    $response = $courseFound 
        ? $courseFound 
        : getNotFoundErr('O curso não foi encontrado');
    return rest_ensure_response($response);
}

function registerGetLesson() {
    $courseSlug = '(?P<courseSlug>[-\w]+)';
    $lessonSlug = '(?P<lessonSlug>[-\w]+)';
    $apiRoute = '/curso' . '/' . $courseSlug . '/' . $lessonSlug;
    register_rest_route('api', $apiRoute, array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'getLesson',
        'permission_callback' => function() {
            return true;
        }
    ));
}       

function getLesson($request) {
    $course = new Course(
        new CourseRepository(),
        new UserRepositoryImpl()
    );
    $lesson = $course->getSingleLesson(
        $request['courseSlug'], $request['lessonSlug']);
    $response = $lesson
        ? $lesson
        : getNotFoundErr('A aula não foi encontrada');
    return rest_ensure_response($response);
}

function getNotFoundErr($message) {
    return new WP_Error(
        'not_found', 
        $message, 
        array('status' => 404)
    );
}
?>