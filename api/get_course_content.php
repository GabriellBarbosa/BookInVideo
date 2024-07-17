<?php
require_once get_template_directory() . '/src/Course/Course.php';

add_action('rest_api_init', 'registerGetCourseContentRoute');

function registerGetCourseContentRoute() {
    $slug = '(?P<slug>[-\w]+)';
    $apiRoute = '/curso' . '/' . $slug;
    register_rest_route('api', $apiRoute, array(
        array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => 'getCourseContent',
            'permission_callback' => '__return_true'
        )
    ));
}

function getCourseContent($request) {
    $courseRepository = new CourseRepositoryImpl($request['slug']);
    $userRepository = new UserRepositoryImpl();
    $user = new UserImpl(wp_get_current_user(), $userRepository);
    $course = new Course($courseRepository, $user);
    $content = $course->getContent();
    $response = $content 
        ? $content 
        : getNotFoundErr('O curso não foi encontrado');
    return rest_ensure_response($response);
}
?>