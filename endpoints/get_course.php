<?php
include(get_template_directory() . '/endpoints/Course.php');

add_action('rest_api_init', 'register_api_get_course');

function register_api_get_course() {
    $slug = '(?P<slug>[-\w]+)';
    $apiRoute = '/curso' . '/' . $slug;
    register_rest_route('api', $apiRoute, array(
        array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => 'get_course'
        )
    ));
}

function get_course($request) {
    $course = new Course();
    $response = $course->get_by_slug($request['slug']);
    return rest_ensure_response($response);
}
?>