<?php
add_action('rest_api_init', 'registerCompleteLesson');

function registerCompleteLesson() {
    $courseSlug = '(?P<courseSlug>[-\w]+)';
    $lessonSlug = '(?P<lessonSlug>[-\w]+)';
    $apiRoute = '/curso' . '/' . $courseSlug . '/' . $lessonSlug;
    register_rest_route('api', $apiRoute, array(
        array(
            'methods' => WP_REST_Server::CREATABLE,
            'callback' => 'completeLesson',
            'permission_callback' => function($request) {
                $user = new UserImpl(wp_get_current_user(), new UserRepositoryImpl());
                return $user->isSubscribed();
            }
        )
    ));
}

function completeLesson($request) {
    return rest_ensure_response(tryToCompleteLesson(
        $request['courseSlug'], $request['lessonSlug']));
}

function tryToCompleteLesson($courseSlug, $lessonSlug) {
    try {
        $course = new Course($courseSlug, new CourseRepositoryImpl());
        $user = new UserImpl(wp_get_current_user(), new UserRepositoryImpl());
        return $course->completeLesson($lessonSlug, $user);
    } catch (Exception $err) {
        return new WP_Error('forbidden', $err->getMessage(), array('status' => 403));
    }
}
?>