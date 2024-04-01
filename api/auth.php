<?php
add_action('rest_api_init', 'registerAuth');

function registerAuth() {
    $user_id = '(?P<user_id>[-\w]+)';
    $apiRoute = '/auth' . '/' . $user_id;
    register_rest_route('api', $apiRoute, array(
        array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => 'getUser'
        )
    ));
}

function getUser($request) {
    $authRequest = new WP_REST_Request('POST', '/jwt-auth/v1/token');
    $authRequest->set_header('content-type', 'application/json');
    $authRequest->set_body(createAuthBody($request));
    $response = rest_do_request($authRequest);
    return $response->is_error();
}

function createAuthBody($request) {
    $authBody = new stdClass();
    $authBody->user_id = $request['user_id'];
    return json_encode($authBody);
}
?>