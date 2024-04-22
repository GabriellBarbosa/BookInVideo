<?php
require_once get_template_directory() . '/src/entities/Lesson.php';

add_action('rest_api_init', 'registerGetLesson');

function registerGetLesson() {
    $courseSlug = '(?P<courseSlug>[-\w]+)';
    $lessonSlug = '(?P<lessonSlug>[-\w]+)';
    $apiRoute = '/curso' . '/' . $courseSlug . '/' . $lessonSlug;
    register_rest_route('api', $apiRoute, array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'getLesson',
    ));
}       

function getLesson($request) {
    $lesson = new Lesson(new CourseRepositoryImpl(), new UserRepositoryImpl());
    $lessonFound = $lesson->get($request['courseSlug'], $request['lessonSlug']);
    $response = $lessonFound
        ? $lessonFound
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