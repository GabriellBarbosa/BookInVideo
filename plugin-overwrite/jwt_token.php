<?php
class JwtToken {
    function generateSplittedToken($user_login) {
        $user = get_user_by('login', $user_login);
        $response = $this->requestToken($user->ID);
        if ($response->is_error()) return null;
        else return $this->splitToken($response->get_data()['token']);
    }

    private function requestToken($userID) {
        $request = new WP_REST_Request('POST', '/jwt-auth/v1/token');
        $request->set_header('content-type', 'application/json');
        $request->set_body($this->createBodyJson($userID));
        $response = rest_do_request($request);
        return $response;
    }

    private function createBodyJson($userID) {
        $requestBody = new stdClass();
        $requestBody->user_id = $userID;
        return json_encode($requestBody);
    }

    function splitToken(string $token) {
        $tokenParts = explode('.', $token);
        return array( 
            'headerAndPayload' => $tokenParts[0] . '.' . $tokenParts[1],
            'signature' => $tokenParts[2]
        );
    }
}
?>