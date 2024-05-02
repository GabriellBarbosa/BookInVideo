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
    $currentUser = wp_get_current_user();
    $response = array(
        'user' => $currentUser->ID == 0 ? null : array(
            'username' => get_user_meta($currentUser->ID, 'first_name', true)
        ),
        'activated' => SubscribedUserSpec::isSastifiedBy($currentUser)
    );
    return rest_ensure_response($response);
}
?>