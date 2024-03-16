<?php
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
    $course = find_course_by_slug($request['slug']);
    $response = $course ? $course : get_course_not_found_err();
    return rest_ensure_response($response);
}

function find_course_by_slug($slug) {
    $courseQuery = array(
        'post_type' => 'curso',
        'name' => $slug,
        'numberposts' => 1,
    );
    $courseQueryResult = new WP_Query( $courseQuery );
    $coursePosts = $courseQueryResult->get_posts();
    return array_shift($coursePosts);
}

function get_course_not_found_err() {
    return new WP_Error(
        'not_found', 
        'O curso não foi encontrado', 
        array('status' => 404)
    );
}
?>