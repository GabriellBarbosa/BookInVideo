<?php
add_action('rest_api_init', 'register_api_get_course');

function register_api_get_course() {
    register_rest_route('api', '/curso', array(
        array(
            'methods' => 'GET',
            'callback' => 'get_course'
        )
    ));
}

function get_course($request) {
    $response = array(
        'curso' => 'Código limpo',
        'slug' => 'codigo-limpo'
    );
    return rest_ensure_response($response);
}
?>