<?php
add_action('rest_api_init', 'registerGetLessonRoute');

function registerGetLessonRoute() {
    $courseSlug = '(?P<courseSlug>[-\w]+)';
    $lessonSlug = '(?P<lessonSlug>[-\w]+)';
    $apiRoute = '/curso' . '/' . $courseSlug . '/' . $lessonSlug;
    register_rest_route('api', $apiRoute, array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'getLesson',
        'permission_callback' => '__return_true'
    ));
}       

function getLesson($request) {
    $courseRepository = new CourseRepositoryImpl($request['courseSlug']);
    $userRepository = new UserRepositoryImpl();
    $user = new UserImpl(wp_get_current_user(), $userRepository);
    $course = new Course($courseRepository, $user);
    $lessonFound = $course->findLesson($request['lessonSlug']);
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