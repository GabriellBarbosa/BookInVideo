<?php
add_action('rest_api_init', 'registerGetUser');

function registerGetUser() {
    $apiRoute = '/user';
    register_rest_route('api', $apiRoute, array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'getUser',
        'permission_callback' => '__return_true'
    ));
}

function getUser($request) {
    $user = new UserImpl(wp_get_current_user());
    $response = array(
        'user' => $user->getInfoIfLoggedIn(),
        'activated' => $user->isSubscribed()
    );
    return rest_ensure_response($response);
}
?>