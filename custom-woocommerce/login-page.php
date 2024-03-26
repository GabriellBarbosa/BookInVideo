<?php
add_filter('login_errors', 'bookinvideo_change_login_error_message', 10, 1);   
function bookinvideo_change_login_error_message( $error ) {
    if ($error) {
        $error = '<span>E-mail e/ou senha inválidos</span>';
    }
    return $error;
}
?>