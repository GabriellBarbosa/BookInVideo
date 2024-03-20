<?php
include(get_template_directory() . '/domain/entities/Course.php');

add_action('rest_api_init', 'registerGetCourse');
add_action('rest_api_init', 'registerGetLesson');

function registerGetCourse() {
    $slug = '(?P<slug>[-\w]+)';
    $apiRoute = '/curso' . '/' . $slug;
    register_rest_route('api', $apiRoute, array(
        array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => 'getCourse'
        )
    ));
}

function getCourse($request) {
    $course = new Course($request['slug']);
    $response = $course->get();
    return rest_ensure_response($response);
}

function registerGetLesson() {
    $courseSlug = '(?P<courseSlug>[-\w]+)';
    $lessonSlug = '(?P<lessonSlug>[-\w]+)';
    $apiRoute = '/curso' . '/' . $courseSlug . '/' . $lessonSlug;
    register_rest_route('api', $apiRoute, array(
        array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => 'getLesson'
        )
    ));
}

function getLesson($request) {
    $course = new Course($request['courseSlug']);
    $response = $course->getSingleLesson($request['lessonSlug']);
    return rest_ensure_response($response);
}
?>