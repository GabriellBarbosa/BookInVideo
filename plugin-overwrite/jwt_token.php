<?php
class JwtToken {
    function generate($user_login) {
        $jwtRequest = $this->createRequest($user_login);
        $response = rest_do_request($jwtRequest);
        if ($response->is_error()) return null;
        return $response->get_data()['token'];
    }

    private function createRequest($user_login) {
        $request = new WP_REST_Request('POST', '/jwt-auth/v1/token');
        $request->set_header('content-type', 'application/json');
        $request->set_body($this->createBodyJson($user_login));
        return $request;
    }

    private function createBodyJson($user_login) {
        $user = get_user_by('login', $user_login);
        $requestBody = new stdClass();
        $requestBody->user_id = $user->ID;
        return json_encode($requestBody);
    }
}
?>