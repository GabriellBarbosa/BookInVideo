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
    return rest_ensure_response(tryToCompleteLesson(
        $request['courseSlug'], $request['lessonSlug']));
}

function tryToCompleteLesson($courseSlug, $lessonSlug) {
    try {
        $lesson = new Lesson(new CourseRepositoryImpl(), new UserRepositoryImpl());
        return $lesson->complete($courseSlug, $lessonSlug);
    } catch (Exception $err) {
        return new WP_Error('forbidden', $err->getMessage(), array('status' => 403));
    }
}
?>