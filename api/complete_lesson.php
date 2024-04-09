<?php
require_once get_template_directory() . '/src/entities/Lesson.php';
require_once get_template_directory() . '/src/repositories/CourseRespositoryImpl.php';
require_once get_template_directory() . '/src/repositories/UserRepositoryImpl.php';

add_action('rest_api_init', 'registerCompleteLesson');

function registerCompleteLesson() {
    $courseSlug = '(?P<courseSlug>[-\w]+)';
    $lessonSlug = '(?P<lessonSlug>[-\w]+)';
    $apiRoute = '/curso' . '/' . $courseSlug . '/' . $lessonSlug;
    register_rest_route('api', $apiRoute, array(
        array(
            'methods' => WP_REST_Server::CREATABLE,
            'callback' => 'completeLesson'
        )
    ));
}

function completeLesson($request) {
    $lesson = new Lesson(new CourseRepositoryImpl(), new UserRepositoryImpl());
    $completed = $lesson->complete($request['courseSlug'], $request['lessonSlug']);
    $response = $completed
        ? $lessonFound
        : getNotFoundErr('ocorreu um erro');
    return rest_ensure_response($response);
}
?>